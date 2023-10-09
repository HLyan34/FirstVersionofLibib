<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Author::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return asset($row->image);
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('authors.show', $row->id);
                    $editUrl = route('authors.edit', $row->id);
                    $destroyUrl = route('authors.destroy', $row->id);
                    $actionBtn = ' <a href="' . $showUrl . '" class="btn btn-primary btn-sm mt-2 me-2 ms-2"><i class="fa-regular fa-eye"></i> <span class="ms-2">Show</span></a>';
                    $actionBtn .= ' <a href="' . $editUrl . '" class="delete btn btn-success btn-sm mt-2 ms-2 me-2"><i class="fa-solid fa-pen"></i><span class="ms-2">Edit</span></a>';
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

        return view('admin.viewauthors');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addauthors');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'authorName.required' => 'The author field is mandatory.',
            'authorName.max'      => 'The author name is too long.',
            'authorName.unique'   => 'This author already exists.',

            'authorImage.required' => 'An image for the author is required.',
            'authorImage.image'    => 'The uploaded file must be an image.',
            'authorImage.mimes'    => 'Only jpeg,png and webp images are allowed.',
            'authorImage.max'      => 'The image size must not exceed 2MB.',

            'authorDescription.required' => 'The author description is mandatory.',
        ];

        $request->validate([
            'authorName' => ['required', 'max:255', 'unique:authors,name'],
            'authorImage' => ['required', 'image', 'mimes:jpeg,png,webp', 'max:2048'],
            'authorDescription' => ['required'],
        ], $messages);

        $fileName = time() . '_' . $request->authorImage->getClientOriginalName();
        $filePath = $request->authorImage->storeAs('public/uploads/authors', $fileName);
        $filePath = str_replace('public/', '', $filePath);
        $filePath = '/storage/' . $filePath;
        $author = new Author();
        $author->name = $request->authorName;
        $author->background = $request->authorDescription;
        $author->image = $filePath;
        $author->save();

        return redirect()->route('authors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $author = Author::findOrFail($id);
        return view('admin.showauthors', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $author = Author::findOrFail($id);
        return view('admin.editauthors', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'authorName.required' => 'The author field is mandatory.',
            'authorName.max'      => 'The author name is too long.',
            'authorDescription.required' => 'The author description is mandatory.',
        ];

        $request->validate([
            'authorName' => ['required', 'max:255'],
            'authorDescription' => ['required']
        ], $messages);

        $author = Author::findOrFail($id);

        if ($request->hasFile('authorImage')) {
            $request->validate([
                'authorImage' => ['required', 'image', 'mimes:jpeg,png,webp', 'max:2048']
            ], [
                'authorImage.required' => 'An image for the author is required.',
                'authorImage.image'    => 'The uploaded file must be an image.',
                'authorImage.mimes'    => 'Only jpeg,png and webp images are allowed.',
                'authorImage.max'      => 'The image size must not exceed 2MB.'
            ]);
            $fileName = time() . '_' . $request->authorImage->getClientOriginalName();
            $filePath = $request->authorImage->storeAs('/public/uploads/authors', $fileName);
            File::delete(public_path($author->image));
            $filePath = str_replace("public/", "", $filePath);
            $filePath = '/storage/' . $filePath;
            $author->image = $filePath;
        }

        $author->name = $request->authorName;
        $author->background = $request->authorDescription;
        $author->save();
        return redirect()->route('authors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('authors.index');
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $data = Author::onlyTrashed()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    return asset($row->image);
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('authors.showtrash', $row->id);
                    $restore = route('authors.restore', $row->id);
                    $destroyUrl = route('authors.forceDelete', $row->id);
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

        return view('admin.viewtrashedauthors');
        // return view('trashed', compact('posts'));
    }
    public function showtrash($id)
    {
        $author = Author::onlyTrashed()->findOrFail($id);
        return view('admin.showtrashauthors', compact('author'));
    }
    public function restore($id)
    {
        $author = Author::onlyTrashed()->findOrFail($id);
        $author->restore();

        return redirect()->route('authors.trashed');
    }
    public function forceDelete($id)
    {
        $author = Author::onlyTrashed()->findOrFail($id);
        File::delete(public_path($author->image));
        $author->forceDelete();

        return redirect()->route('authors.trashed');
    }
}
