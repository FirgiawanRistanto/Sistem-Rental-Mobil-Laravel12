<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Mobil;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyewaans = Penyewaan::all();
        return view('admin.penyewaans.index', compact('penyewaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mobils = Mobil::where('status', 'Tersedia')->get();
        $pelanggans = Pelanggan::all();
        return view('admin.penyewaans.create', compact('mobils', 'pelanggans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
            'total_biaya' => 'required|integer|min:0',
            'status' => 'required|in:Disewa,Selesai',
        ]);

        $penyewaan = Penyewaan::create($request->all());

        // Update mobil status to 'Disewa'
        $mobil = Mobil::find($request->mobil_id);
        if ($mobil) {
            $mobil->status = 'Disewa';
            $mobil->save();
        }

        return redirect()->route('admin.penyewaans.index')->with('success', 'Penyewaan added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penyewaan $penyewaan)
    {
        return view('admin.penyewaans.show', compact('penyewaan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penyewaan $penyewaan)
    {
        $mobils = Mobil::all();
        $pelanggans = Pelanggan::all();
        return view('admin.penyewaans.edit', compact('penyewaan', 'mobils', 'pelanggans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penyewaan $penyewaan)
    {
        $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
            'tanggal_kembali_aktual' => 'nullable|date|after_or_equal:tanggal_sewa',
            'total_biaya' => 'required|integer|min:0',
            'status' => 'required|in:Disewa,Selesai',
        ]);

        $data = $request->all();
        $denda = 0;

        if ($request->status == 'Selesai' && $request->tanggal_kembali_aktual) {
            $tanggalKembaliTerlambat = \Carbon\Carbon::parse($request->tanggal_kembali_aktual);
            $tanggalKembaliSeharusnya = \Carbon\Carbon::parse($request->tanggal_kembali);

            if ($tanggalKembaliTerlambat->greaterThan($tanggalKembaliSeharusnya)) {
                $selisihHari = $tanggalKembaliTerlambat->diffInDays($tanggalKembaliSeharusnya);
                $mobil = Mobil::find($request->mobil_id);
                if ($mobil) {
                    $denda = $selisihHari * $mobil->denda_per_hari;
                }
            }
        }

        $data['denda'] = $denda;
        $data['total_biaya'] = $request->total_biaya + $denda; // Add fine to total_biaya

        $penyewaan->update($data);

        // Update mobil status if rental status changes to 'Selesai'
        if ($request->status == 'Selesai') {
            $mobil = Mobil::find($penyewaan->mobil_id);
            if ($mobil) {
                $mobil->status = 'Tersedia';
                $mobil->save();
            }
        }

        return redirect()->route('admin.penyewaans.index')->with('success', 'Penyewaan updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penyewaan $penyewaan)
    {
        // Deletion logic will go here
        return redirect()->route('admin.penyewaans.index')->with('success', 'Penyewaan deleted successfully!');
    }
}
