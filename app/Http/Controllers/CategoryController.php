<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $categories = Cache::remember('books-page-' . request('page', 1), 60, function () {
        //     return Category::paginate(15);
        // });

        // return $categories;
        if ($request->ajax()) {
            $data = Category::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $showUrl = route('categories.show', $row->id);
                    $editUrl = route('categories.edit', $row->id);
                    $destroyUrl = route('categories.destroy', $row->id);

                    $actionBtn = ' <a href="' . $showUrl . '" class="btn btn-primary btn-sm mt-2 me-2 ms-2"><i class="fa-regular fa-eye"></i> <span class="ms-2">Show</span></a>';
                    $actionBtn .= '<a href="' . $editUrl . '" class="edit btn btn-success btn-sm me-2 ms-2 mt-2"><i class="fa-solid fa-pen"></i><span class="ms-2">Edit</span></a>';
                    $actionBtn .= '<a href="javascript:void(0);" data-url="' . $destroyUrl . '" class="btn btn-danger btn-sm mt-2 delete-modal-btn me-2 ms-2"><i class="fa-solid fa-trash"></i><span class="ms-2">Delete</span></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.viewcategories');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addcategories');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'category.required' => 'The category field is mandatory.',
            'category.max'      => 'The category name is too long.',
            'category.min'      => 'The category name is too short.',
            'category.unique'   => 'This category already exists.',
        ];

        $request->validate([
            'category' => ['required', 'max:255', 'min:1', 'unique:categories,name']
        ], $messages);

        $category = new Category();
        $category->name = $request->category;
        $category->save();
        if (auth()->user()->user_role == 'author') {
            return redirect()->route('categories.create');
        } else {
            return redirect()->route('categories.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.showcategories', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $category = Category::findOrFail($id);
        return view('admin.editcategories', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'category.required' => 'The category field is mandatory.',
            'category.max'      => 'The category name is too long.',
            'category.min'      => 'The category name is too short.',
            'category.unique'   => 'This category already exists.',
        ];

        $request->validate([
            'category' => ['required', 'max:255', 'min:1', 'unique:categories,name']
        ], $messages);

        $category = Category::findOrFail($id);
        $category->name = $request->category;

        $category->save();
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->forceDelete();
        return redirect()->route('categories.index');
    }
}
