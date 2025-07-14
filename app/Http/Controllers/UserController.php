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
}
