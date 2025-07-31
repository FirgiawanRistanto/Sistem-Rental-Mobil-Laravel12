<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Perawatan;
use App\Models\Mobil;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMobil = Mobil::count();
        $penyewaanAktif = Penyewaan::where('status', 'Disewa')->count();
        $totalPelanggan = Pelanggan::count();

        $mobilStatus = Mobil::select('status', DB::raw('count(*) as total'))
                            ->groupBy('status')
                            ->pluck('total', 'status')
                            ->toArray();

        Log::info('Mobil Status from DB:', $mobilStatus);

        $statusLabels = [
            'tersedia' => 'Tersedia',
            'disewa' => 'Disewa',
            'perawatan' => 'Perawatan',
        ];

        $labels = [];
        $data = [];
        foreach ($mobilStatus as $statusKey => $count) {
            $labels[] = $statusLabels[$statusKey] ?? ucfirst($statusKey); // Use mapped label, fallback to ucfirst
            $data[] = $count;
        }

        $mobilPerawatan = $mobilStatus['perawatan'] ?? 0; // Get 'perawatan' count, default to 0 if not exists

        // Dynamic Revenue Chart Data
        $monthlyRevenue = Penyewaan::select(
                                DB::raw('DATE_FORMAT(tanggal_sewa, "%Y-%m") as month'),
                                DB::raw('SUM(total_biaya + COALESCE(denda, 0)) as total_revenue')
                            )
                            ->where('tanggal_sewa', '>=', now()->subMonths(11)->startOfMonth())
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get();

        $revenueLabels = [];
        $revenueData = [];
        $months = [];

        // Generate last 12 months for labels
        // Use Carbon to ensure we get distinct months correctly
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->startOfMonth()->subMonths($i); // Start from first day of current month, then subtract
            $months[$date->format('Y-m')] = $date->format('M Y');
        }

        Log::info('Generated Months Array:', $months); // Add this log

        foreach ($months as $key => $monthLabel) {
            $revenueLabels[] = $monthLabel;
            $found = false;
            foreach ($monthlyRevenue as $revenue) {
                if ($revenue->month == $key) {
                    $revenueData[] = (float) $revenue->total_revenue; // Cast to float
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $revenueData[] = 0; // Add 0 if no revenue for that month
            }
        }

        Log::info('Monthly Revenue from DB:', $monthlyRevenue->toArray());
        Log::info('Final Revenue Data for Chart:', ['labels' => $revenueLabels, 'data' => $revenueData]);

        return view('admin.dashboard', compact('totalMobil', 'penyewaanAktif', 'totalPelanggan', 'labels', 'data', 'mobilPerawatan', 'revenueLabels', 'revenueData'));
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

        // Total biaya perawatan
        $totalBiayaPerawatan = Perawatan::whereMonth('tanggal_selesai', $month)
                                        ->whereYear('tanggal_selesai', $year)
                                        ->sum('biaya');

        // Pendapatan bersih
        $pendapatanBersih = $totalPendapatan - $totalBiayaPerawatan;

        // Mobil paling sering disewa
        $mobilPalingSeringDisewa = Penyewaan::select('mobil_id', DB::raw('count(*) as total_sewa'))
                                            ->whereMonth('tanggal_sewa', $month)
                                            ->whereYear('tanggal_sewa', $year)
                                            ->groupBy('mobil_id')
                                            ->orderByDesc('total_sewa')
                                            ->with('mobil')
                                            ->limit(5)
                                            ->get();

        return view('admin.reports.monthly', compact('totalPenyewaan', 'totalPendapatan', 'totalBiayaPerawatan', 'pendapatanBersih', 'mobilPalingSeringDisewa', 'month', 'year'));
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

        $totalBiayaPerawatan = Perawatan::whereMonth('tanggal_selesai', $month)
                                        ->whereYear('tanggal_selesai', $year)
                                        ->sum('biaya');

        $pendapatanBersih = $totalPendapatan - $totalBiayaPerawatan;

        $pdf = PDF::loadView('admin.reports.export', compact('penyewaans', 'month', 'year', 'totalPendapatan', 'totalBiayaPerawatan', 'pendapatanBersih'));
        return $pdf->stream('laporan-penyewaan-' . $month . '-' . $year . '.pdf');
    }
}
