<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserLogin;
use App\Models\User;
use App\Models\Visitor;
use App\Models\Product; // Added for Product model
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Added for date manipulation

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

        // New: Product Upload Chart Data
        $productUploads = Product::select(DB::raw('DATE(created_at) as upload_date'), DB::raw('count(*) as total_uploads'))
            ->groupBy('upload_date')
            ->orderBy('upload_date', 'asc')
            ->get();

        $productLabels = $productUploads->pluck('upload_date')->map(function ($date) {
            return Carbon::parse($date)->format('M d'); // Format date like "Jul 25"
        });
        $productData = $productUploads->pluck('total_uploads');

        return view('admin.dashboard', compact('labels', 'data', 'visitorLabels', 'visitorCounts', 'productLabels', 'productData'));
    }
}
