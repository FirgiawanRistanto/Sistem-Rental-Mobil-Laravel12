<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserLogin;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $userLogins = UserLogin::select(DB::raw('DATE(logged_in_at) as login_date'), DB::raw('count(*) as total_logins'))
            ->join('users', 'user_logins.user_id', '=', 'users.id')
            ->where('users.role', 'user')
            ->groupBy('login_date')
            ->orderBy('login_date', 'asc')
            ->get();

        $labels = $userLogins->pluck('login_date');
        $data = $userLogins->pluck('total_logins');

        return view('admin.dashboard', compact('labels', 'data'));
    }
}
