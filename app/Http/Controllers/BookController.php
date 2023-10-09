<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $this->authorize('view', Book::class);
        // $book = Book::find(1);
        // $book->categories()->attach([1, 2]);
        if ($request->ajax()) {

            $query = Book::with(['author', 'categories'])
                ->select('books.*', 'authors.name as author_name')
                ->whereNull('books.deleted_at');

            if (auth()->user()->user_role == 'author') {
                $query->where('name', auth()->user()->name);
            }
            $data = $query->leftJoin('authors', 'books.author_id', '=', 'authors.id')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return asset($row->image);
                })
                ->addColumn('author_name', function ($row) {
                    return $row->author_name;
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('books.show', $row->id);
                    $editUrl = route('books.edit', $row->id);
                    $destroyUrl = route('books.destroy', $row->id);
                    $actionBtn = ' <a href="' . $showUrl . '" class="btn btn-primary btn-sm mt-2 me-2 ms-2"><i class="fa-regular fa-eye"></i> <span class="ms-2">Show</span></a>';
                    $actionBtn .= '<a href="' . $editUrl . '" class="edit btn btn-success btn-sm mt-2 me-2 ms-2"><i class="fa-solid fa-pen"></i><span class="ms-2">Edit</span></a>';
                    $actionBtn .= '<a href="javascript:void(0);" onclick="document.getElementById(\'delete-form-' . $row->id . '\').submit();" class="btn btn-danger btn-sm mt-2 me-2 ms-2"><i class="fa-solid fa-trash"></i><span class="ms-2">Delete</span></a>';
                    $actionBtn .= '<form id="delete-form-' . $row->id . '" action="' . $destroyUrl . '" method="POST" style="display: none;" onsubmit="return confirm(\'Are you sure you want to delete this item?\');">';
                    $actionBtn .= csrf_field();
                    $actionBtn .= method_field('DELETE');
                    $actionBtn .= '</form>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.viewbooks');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create', Book::class);
        $categories = Category::orderBy('name')->get();
        $authors = Author::orderBy('name')->get();
        return view('admin.addbooks', compact('categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Book::class);
        $messages = [
            'bookTitle.required' => 'The Book Title field is mandatory.',
            'bookTitle.max'      => 'The Book Title name is too long.',
            'bookTitle.min'      => 'The Book Title name is too short.',
            'categories.required'   => 'Category field is mandatory.',
            'bookImage.required' => 'An image for the book is required.',
            'bookImage.image'    => 'The uploaded file must be an image.',
            'bookImage.mimes'    => 'Only jpeg ,png  and webp images are allowed.',
            'bookImage.max'      => 'The image size must not exceed 2MB.',
            'bookFile.required'  => 'The Book file field is mandatory.',
            'bookFile.mimes'     => 'Invalid file type. Only PDF, EPUB, MOBI, and TXT files are allowed.',
            'bookFile.max'       => 'The Book file is too large. It should not exceed 100MB.'

        ];
        $request->validate([
            'bookTitle' => ['required', 'max:255', 'min:1'],
            'categories' => ['required'],
            'bookDescription' => ['required'],
            'bookImage' =>  ['required', 'image', 'mimes:jpeg,png,webp', 'max:2048'],
            'bookFile'  => ['required', 'mimes:pdf,epub,mobi,txt', 'max:102400']
        ], $messages);


        $fileName = time() . '_' . $request->bookImage->getClientOriginalName();
        $filePath = $request->bookImage->storeAs('public/uploads/books', $fileName);
        $filePath = str_replace('public/', '', $filePath);
        $filePath = '/storage/' . $filePath;

        $fileName1 = time() . '_' . $request->bookFile->getClientOriginalName();
        $filePath1 = $request->bookFile->storeAs('public/uploads/booksfiles', $fileName1);
        $filePath1 = str_replace("public/", "", $filePath1);
        $filePath1 = '/storage/' . $filePath1;



        $book = new Book();
        $book->books_title = $request->bookTitle;
        $book->books_description = $request->bookDescription;
        if ($request->has('author_id')) {
            $request->validate(['author_id' => ['required']], ['author_id.required'   => 'Author field is mandatory.']);
            $book->author_id = $request->author_id;
        }

        if ($request->has('author_name')) {
            $author = Author::where('name', $request->author_name)->first();
            $authorId = $author->id;

            $book->author_id = $authorId;
        }
        $book->image = $filePath;
        $book->books_file = $filePath1;
        $book->save();
        $book->categories()->attach($request->categories);


        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with(['categories', 'author'])->find($id);

        if ($book) {
            $categories = $book->categories;
            $author = $book->author;


            return view('admin.showbooks', [
                'book' => $book,
                'categories' => $categories,
                'author' => $author,
            ]);
        } else {
            return redirect()->route('books.index')->with('error', 'Book not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::with(['categories', 'author'])->find($id);
        if ($book) {
            $authors = Author::all();
            $categories = Category::all();
            $category_ids = $book->categories->pluck('id')->toArray();

            return view('admin.editbooks', [
                'book' => $book,
                'categories' => $categories,
                'authors' => $authors,
                'category_ids' => $category_ids
            ]);
        } else {
            return redirect()->route('books.index')->with('error', 'Book not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'bookTitle.required' => 'The Book Title field is mandatory.',
            'bookTitle.max'      => 'The Book Title name is too long.',
            'bookTitle.min'      => 'The Book Title name is too short.',
            'author_id.required'   => 'Author field is mandatory.',
            'categories.required'   => 'Category field is mandatory.',
        ];

        $request->validate([
            'bookTitle' => ['required', 'max:255', 'min:1'],
            'author_id' => ['required'],
            'categories' => ['required'],
            'bookDescription' => ['required'],

        ], $messages);
        $book = Book::findOrFail($id);
        if ($request->hasFile('bookImage')) {
            $request->validate([
                'bookImage' => ['required', 'image', 'mimes:jpeg,png,webp', 'max:2048']
            ], [
                'bookImage.required' => 'An image for the book is required.',
                'bookImage.image'    => 'The uploaded file must be an image.',
                'bookImage.mimes'    => 'Only jpeg,png and webp images are allowed.',
                'bookImage.max'      => 'The image size must not exceed 2MB.'
            ]);
            $fileName = time() . '_' . $request->bookImage->getClientOriginalName();
            $filePath = $request->bookImage->storeAs('/public/uploads/books', $fileName);
            File::delete(public_path($book->image));
            $filePath = str_replace("public/", "", $filePath);
            $filePath = '/storage/' . $filePath;
            $book->image = $filePath;
        }

        if ($request->hasFile('bookFile')) {
            $request->validate([
                'bookFile'  => ['required', 'mimes:pdf,epub,mobi,txt', 'max:102400']
            ], [
                'bookFile.required'  => 'The Book file field is mandatory.',
                'bookFile.mimes'     => 'Invalid file type. Only PDF, EPUB, MOBI, and TXT files are allowed.',
                'bookFile.max'       => 'The Book file is too large. It should not exceed 100MB.'
            ]);
            $fileName = time() . '_' . $request->bookFile->getClientOriginalName();
            $filePath = $request->bookFile->storeAs('/public/uploads/booksfiles', $fileName);
            File::delete(public_path($book->books_file));
            $filePath = str_replace("public/", "", $filePath);
            $filePath = '/storage/' . $filePath;
            $book->books_file = $filePath;
        }


        $book->books_title = $request->bookTitle;
        $book->books_description = $request->bookDescription;
        $book->author_id = $request->author_id;
        $book->save();
        $book->categories()->sync($request->categories);


        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        $book->delete();
        return redirect()->route('books.index');
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $query = Book::with(['author', 'categories'])
                ->select('books.*', 'authors.name as author_name')
                ->leftJoin('authors', 'books.author_id', '=', 'authors.id');
            if (auth()->user()->user_role == 'author') {
                $query->where('name', auth()->user()->name);
            }
            $query->onlyTrashed();
            $data = $query;
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return asset($row->image);
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('books.showtrash', $row->id);
                    $restore = route('books.restore', $row->id);
                    $destroyUrl = route('books.forceDelete', $row->id);
                    $actionBtn = ' <a href="' . $showUrl . '" class="btn btn-primary btn-sm mt-2 me-2 ms-2"><i class="fa-regular fa-eye"></i> <span class="ms-2">Show</span></a>';
                    $actionBtn .= ' <a href="' . $restore . '" class="btn btn-warning btn-sm mt-2 ms-2 me-2"><i class="fa-solid fa-trash-can-arrow-up"></i><span class="ms-2">Restore</span></a>';
                    $actionBtn .= '<a href="javascript:void(0);" data-url="' . $destroyUrl . '" class="btn btn-danger btn-sm mt-2 delete-modal-btn ms-2 me-2"><i class="fa-solid fa-trash"></i><span class="ms-2">Delete</span></a>';
                    $actionBtn .= csrf_field();
                    $actionBtn .= method_field('DELETE');
                    $actionBtn .= '</form>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.viewtrashedbooks');
        // return view('trashed', compact('posts'));
    }
    public function showtrash($id)
    {
        $book = Book::onlyTrashed()->with(['author', 'categories'])->findOrFail($id);
        return view('admin.showtrashbooks', compact('book'));
    }
    public function restore($id)
    {
        $author = Book::onlyTrashed()->findOrFail($id);
        $author->restore();

        return redirect()->route('books.trashed');
    }

    public function forceDelete($id)
    {
        $book = Book::onlyTrashed()->findOrFail($id);
        File::delete(public_path($book->image));
        $book->categories()->detach();
        $book->forceDelete();

        return redirect()->route('books.trashed');
    }
}
