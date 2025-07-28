<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function report(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        // Total penyewaan
        $totalPenyewaan = Penyewaan::whereMonth('tanggal_sewa', $month)
                                    ->whereYear('tanggal_sewa', $year)
                                    ->count();

        // Total pendapatan
        $totalPendapatan = Penyewaan::whereMonth('tanggal_sewa', $month)
                                     ->whereYear('tanggal_sewa', $year)
                                     ->sum('total_biaya');

        // Mobil paling sering disewa
        $mobilPalingSeringDisewa = Penyewaan::select('mobil_id', DB::raw('count(*) as total_sewa'))
                                            ->whereMonth('tanggal_sewa', $month)
                                            ->whereYear('tanggal_sewa', $year)
                                            ->groupBy('mobil_id')
                                            ->orderByDesc('total_sewa')
                                            ->with('mobil')
                                            ->limit(5)
                                            ->get();

        return view('admin.reports.monthly', compact('totalPenyewaan', 'totalPendapatan', 'mobilPalingSeringDisewa', 'month', 'year'));
    }
}
