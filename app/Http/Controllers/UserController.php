<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        // Logic to retrieve and return user data
        $users = \App\Models\User::all();
        return view('admin.user', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('foto')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['foto'] = "$profileImage";
        }

        $input['password'] = bcrypt($input['password']);

        \App\Models\User::create($input);

        return redirect()->route('admin.users')
            ->with('success', 'User created successfully');
    }

    public function edit(\App\Models\User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, \App\Models\User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $input = $request->all();

        if ($image = $request->file('foto')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['foto'] = "$profileImage";
        } else {
            unset($input['foto']);
        }

        if (!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        } else {
            unset($input['password']);
        }

        $user->update($input);

        return redirect()->route('admin.users')
            ->with('success', 'User updated successfully');
    }

    public function destroy(\App\Models\User $user)
    {
        $user->delete();

        return redirect()->route('admin.users')
            ->with('success', 'User deleted successfully');
    }
}
