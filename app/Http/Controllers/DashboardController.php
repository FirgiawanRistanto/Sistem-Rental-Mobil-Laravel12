<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function report(Request $request)
    {
        setlocale(LC_TIME, 'id_ID.utf8', 'id_ID', 'id'); // Set locale for PHP date functions

        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        // Total penyewaan
        $totalPenyewaan = Penyewaan::whereMonth('tanggal_sewa', $month)
                                    ->whereYear('tanggal_sewa', $year)
                                    ->count();

        // Total pendapatan
        $totalPendapatan = Penyewaan::whereMonth('tanggal_sewa', $month)
                                     ->whereYear('tanggal_sewa', $year)
                                     ->sum(DB::raw('total_biaya + COALESCE(denda, 0)'));

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

    public function export(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        $penyewaans = Penyewaan::with(['mobil', 'pelanggan'])
                                ->whereMonth('tanggal_sewa', $month)
                                ->whereYear('tanggal_sewa', $year)
                                ->get();

        $totalPendapatan = $penyewaans->sum(function ($penyewaan) {
            return $penyewaan->total_biaya + ($penyewaan->denda ?? 0);
        });

        $pdf = PDF::loadView('admin.reports.export', compact('penyewaans', 'month', 'year', 'totalPendapatan'));
        return $pdf->stream('laporan-penyewaan-' . $month . '-' . $year . '.pdf');
    }
}
