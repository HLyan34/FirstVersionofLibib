<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $showUrl = route('users.show', $row->id);
                    $editUrl = route('users.edit', $row->id);
                    $destroyUrl = route('users.destroy', $row->id);
                    $actionBtn = ' <a href="' . $showUrl . '" class="btn btn-primary btn-sm mt-2"><i class="fa-regular fa-eye"></i> <span class="ms-2">Show</span></a>';
                    $actionBtn .= ' <a href="' . $editUrl . '" class="delete btn btn-success btn-sm mt-2 ms-2 me-2"><i class="fa-solid fa-pen"></i><span class="ms-2">Edit</span></a>';
                    $actionBtn .= '<a href="javascript:void(0);" data-url="' . $destroyUrl . '" class="btn btn-danger btn-sm mt-2 delete-modal-btn me-2 ms-2"><i class="fa-solid fa-trash"></i><span class="ms-2">Delete</span></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.viewusers');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addusers');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'username.required' => 'Name field is mandatory.',
            'username.max'      => 'Name is too long.',
            'username.min'      => 'Name is too short.',
            'username.unique'   => 'This username already exists.',

            'email.required' => 'Email field is mandatory.',
            'email.max' => 'Email is too long.',
            'email.min' => 'Email is too short.',
            'email.unique' => 'This email is already registered.',

            'password.required' => 'Password field is mandatory.',
            'password.max' => 'Password is too long.',
            'password.min' => 'Password should be at least 6 characters.',

            'userImage.required' => 'User image is mandatory.',
            'userImage.image' => 'Uploaded file must be an image.',
            'userImage.mimes' => 'Image must be a type of jpeg, png, or webp.',
            'userImage.max' => 'Image size should not exceed 2048KB.',


            'userRole.required' => 'User role is mandatory.',
            'userRole.max' => 'User role is too long.',
            'userRole.min' => 'User role is too short.'
        ];

        $request->validate([
            'username' => ['required', 'max:255', 'min:1', 'unique:users,name'],
            'email' => ['required', 'max:255', 'min:1', 'unique:users,email'],
            'password' => ['required', 'max:255', 'min:6'],
            'userImage' => ['required', 'image', 'mimes:jpeg,png,webp', 'max:2048'],
            'userRole' => ['required', 'max:255', 'min:1'],
        ], $messages);

        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $password = Hash::make($request->password);
        $user->password =  $password;
        $fileName = time() . '_' . $request->userImage->getClientOriginalName();
        $filePath = $request->userImage->storeAs('public/uploads/users', $fileName);
        $filePath = str_replace('public/', '', $filePath);
        $filePath = '/storage/' . $filePath;
        $user->image = $filePath;
        $user->user_role = $request->userRole;
        $user->save();
        if ($request->userRole == "author") {
            $author = new Author();
            $author->name = $request->username;
            $author->image = $filePath;
            $author->save();
        }

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.showusers', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.editusers', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'username.required' => 'Name field is mandatory.',
            'username.max'      => 'Name is too long.',
            'username.min'      => 'Name is too short.',

            'email.required' => 'Email field is mandatory.',
            'email.max' => 'Email is too long.',
            'email.min' => 'Email is too short.',

            'password.required' => 'Password field is mandatory.',
            'password.max' => 'Password is too long.',
            'password.min' => 'Password should be at least 6 characters.',

            'userRole.required' => 'User role is mandatory.',
            'userRole.max' => 'User role is too long.',
            'userRole.min' => 'User role is too short.'
        ];

        $request->validate([
            'username' => ['required', 'max:255', 'min:1'],
            'email' => ['required', 'max:255', 'min:1'],
            'password' => ['required', 'max:255', 'min:6'],
            'userRole' => ['required', 'max:255', 'min:1'],
        ], $messages);

        $user = User::findOrFail($id);
        $user->name = $request->username;
        $user->email = $request->email;
        $password = Hash::make($request->password);
        $user->password =  $password;
        $user->user_role = $request->userRole;

        if ($request->hasFile('userImage')) {
            $request->validate([
                'userImage' => ['required', 'image', 'mimes:jpeg,png,webp', 'max:2048'],
            ], [
                'userImage.required' => 'User image is mandatory.',
                'userImage.image' => 'Uploaded file must be an image.',
                'userImage.mimes' => 'Image must be a type of jpeg, png, or webp.',
                'userImage.max' => 'Image size should not exceed 2048KB.',
            ]);
            $fileName = time() . '_' . $request->userImage->getClientOriginalName();
            $filePath = $request->userImage->storeAs('/public/uploads/books', $fileName);
            File::delete(public_path($user->image));
            $filePath = str_replace("public/", "", $filePath);
            $filePath = '/storage/' . $filePath;
            $user->image = $filePath;
        }
        $user->save();

        if ($request->userRole == "author") {
            $author = Author::firstOrNew(['name' => $request->username]);
            $author->image = $filePath ?? $author->image;
            $author->name = $request->username;

            $author->save();
        }

        if ($request->userRole != "author") {
            $author = Author::firstOrNew(['name' => $request->username]);
            $author->delete();
        }



        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
