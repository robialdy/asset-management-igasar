<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Division;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'User | SMK IGAPIN',
            'users' => User::orderBy('updated_at', 'desc')->get()
        ];
        return view('admin.user.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create User | SMK IGAPIN',
            'divisions' => Division::orderBy('name', 'asc')->get(),
        ];
        return view('admin.user.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required|max:15',
            'role' => 'required',
            'password' => 'required|min:8',
            're_password' => 'required|same:password'
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'slug' => Str::slug($request->first_name .' '. $request->last_name),
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'role' => $request->role,
            'id_division' => $request->division,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user')->with('success', 'Akun Berhasil ditambahkan!');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Edit User | SMK IGAPIN',
            'divisions' => Division::orderBy('name', 'asc')->get(),
            'user' => User::where('slug', $slug)->firstOrFail(),
        ];
        return view('admin.user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($id)
            ],
            'no_hp' => 'required|max:15',
            'role' => 'required',
        ]);

        User::where('id', $id)->firstOrFail()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'slug' => Str::slug($request->first_name . ' ' . $request->last_name),
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'role' => $request->role,
            'id_division' => $request->division,
        ]);

        return redirect()->route('user')->with('succes', 'Update User Berhasil!');
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $user->delete();

        return redirect()->route('user')->with('success', 'Delete Akun Berhasil');
    }
}
