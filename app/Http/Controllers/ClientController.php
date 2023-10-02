<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    public function category()
    {
        $query = Book::with(['author', 'categories'])
            ->select('books.*', 'authors.name as author_name')
            ->whereNull('books.deleted_at');
        $books = $query->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->get();

        $query = Book::with(['author', 'categories'])
            ->select('books.*', 'authors.name as author_name')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->whereNull('books.deleted_at')
            ->where('authors.name', 'Robert Kiyosaki');

        $book2s = $query->get();

        $query = Book::with(['author', 'categories'])
            ->select('books.*', 'authors.name as author_name')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->whereNull('books.deleted_at')
            ->orderBy('books.created_at', 'desc');
        $book3s = $query->get();

        return view('client.home', compact('books', 'book2s', 'book3s'));
    }

    public function showbook(string $id)
    {
        $book = Book::with(['categories', 'author'])->find($id);

        if ($book) {
            $categories = $book->categories;
            $author = $book->author;
            $categoryNames = $book->categories->pluck('name')->toArray();

            $books2 = Book::with(['categories', 'author'])
                ->whereHas('categories', function ($query) use ($categoryNames) {
                    $query->whereIn('name', $categoryNames);
                })
                ->where('id', '!=', $id)
                ->get();

            $books3 = Book::with(['categories', 'author'])
                ->where('author_id', $author->id) // Match books with the same author
                ->where('id', '!=', $id) // Exclude the current book from the results
                ->get();

            $combinedBooks = $books2->concat($books3);

            return view('client.individualbook', [
                'book' => $book,
                'categories' => $categories,
                'author' => $author,
                'combinedBooks' => $combinedBooks,
            ]);
        } else {
            return redirect()->route('books.index')->with('error', 'Book not found');
        }
    }

    public function showauthor($id)
    {
        $author = Author::with('books')->find($id);
        return view('client.authorshow', compact('author'));
    }

    public function download($id)
    {
        $book = Book::with(['categories', 'author'])->find($id);
        return response()->download(public_path($book->books_file));
    }
    public function book()
    {
        $query = Book::with(['author', 'categories'])
            ->select('books.*', 'authors.name as author_name')
            ->whereNull('books.deleted_at');
        $books = $query->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->paginate(25);

        return view('client.books', compact('books'));
    }
    public function author()
    {
        $authors  =  Author::paginate(25);

        return view('client.authors', compact('authors'));
    }
    public function categoryOrBooks()
    {
        $categories = Category::all();
        $allBooks = [];
        foreach ($categories as $category) {
            $booksInCategory = Book::with(['categories', 'author'])
                ->whereHas('categories', function ($query) use ($category) {
                    $query->where('categories.id', $category->id);
                })
                ->get();
            $allBooks[$category->name] = $booksInCategory;
        }


        return view('client.categories', [
            'allBooks' => $allBooks,
        ]);
    }
    public function categoryshow($id)
    {
        $category = Category::findOrFail($id);
        $allBooks = [];


        $booksInCategory = Book::with(['categories', 'author'])
            ->whereHas('categories', function ($query) use ($category) {
                $query->where('categories.id', $category->id); // Specify the table name for 'id'
            })
            ->get();


        $allBooks[$category->name] = $booksInCategory;


        return view('client.categoriesshow', [
            'allBooks' => $allBooks,
        ]);
    }
    public function search(Request $request)
    {

        $query = $request->input('query');

        $books = Book::where('books_title', 'like', '%' . $query . '%')->get();


        $results = [];
        foreach ($books as $book) {
            $results[] = [
                'title' => $book->books_title,
                'url' => route('book.show', ['id' => $book->id]),

            ];
        }

        return response()->json(['results' => $results]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'subscriber_email' => 'required|email|unique:subscribers,email'
        ]);

        $subscriber = new Subscriber();
        $subscriber->email = $request->subscriber_email;
        $subscriber->save();

        Mail::raw('Thank you for subscribing to our newsletter!', function ($message) use ($subscriber) {
            $message->to($subscriber->email)
                ->subject('Subscription Successful');
        });

        return response()->json(['message' => 'Thanks for subscribing!']);
    }
}
