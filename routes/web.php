<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ClientController::class, 'category'])->name('home');
Route::get('/book', [ClientController::class, 'book'])->name('book');
Route::get('/author', [ClientController::class, 'author'])->name('author');

Route::get('/book/{id}', [ClientController::class, 'showbook'])->name('book.show');
Route::get('/author/{id}', [ClientController::class, 'showauthor'])->name('author.show');

Route::get('/category', [ClientController::class, 'categoryOrBooks'])->name('book.category');
Route::get('/categoryshow/{id}', [ClientController::class, 'categoryshow'])->name('book.categoryshow');
Route::get('/books/search', [ClientController::class, 'search'])->name('books.search');
Route::delete('/user/{id}', [ClientController::class, 'destroy'])->name('user.delete');


Route::post('/sendemail', [ClientController::class, 'sendEmail'])->name('sendemail');

Route::get('/download/{id}', [ClientController::class, 'download'])->name('book.download');

// Route::middleware(['auth', 'subscriber'])->group(function () {
// });



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'author'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'combinedDash'])->name('dashboard');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/books/trash', [BookController::class, 'trashed'])->name('books.trashed');
    Route::get('/books/showtrash/{id}', [BookController::class, 'showtrash'])->name('books.showtrash');
    Route::get('/books/{id}/restore', [BookController::class, 'restore'])->name('books.restore');
    Route::delete('/books/{id}/force-delete', [BookController::class, 'forceDelete'])->name('books.forceDelete');
    Route::resource('books', BookController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::get('/authors/trash', [AuthorController::class, 'trashed'])->name('authors.trashed');
        Route::get('/authors/showtrash/{id}', [AuthorController::class, 'showtrash'])->name('authors.showtrash');
        Route::get('/authors/{id}/restore', [AuthorController::class, 'restore'])->name('authors.restore');
        Route::delete('/authors/{id}/force-delete', [AuthorController::class, 'forceDelete'])->name('authors.forceDelete');
        Route::resource('authors', AuthorController::class);
    });
});


require __DIR__ . '/auth.php';
