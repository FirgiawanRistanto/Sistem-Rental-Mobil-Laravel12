<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserLogin;
use App\Models\User;
use App\Models\Visitor;
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

        $visitorData = Visitor::select(DB::raw('DATE(visited_at) as visit_date'), DB::raw('count(*) as total_visits'))
            ->groupBy('visit_date')
            ->orderBy('visit_date', 'asc')
            ->get();

        $visitorLabels = $visitorData->pluck('visit_date');
        $visitorCounts = $visitorData->pluck('total_visits');

        return view('admin.dashboard', compact('labels', 'data', 'visitorLabels', 'visitorCounts'));
    }
}
