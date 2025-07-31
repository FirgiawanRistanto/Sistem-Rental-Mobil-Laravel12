<?php

namespace App\Http\Controllers;

use App\Models\Perawatan;
use App\Models\Mobil;
use Illuminate\Http\Request;

class PerawatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perawatans = Perawatan::with('mobil')->latest()->get();
        return view('admin.perawatans.index', compact('perawatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mobils = Mobil::where('status', 'tersedia')->get();
        return view('admin.perawatans.create', compact('mobils'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'tanggal_mulai' => 'required|date',
            'deskripsi' => 'required|string',
            'biaya' => 'required|integer|min:0',
        ]);

        Perawatan::create($request->all());

        $mobil = Mobil::find($request->mobil_id);
        $mobil->status = 'perawatan';
        $mobil->save();

        return redirect()->route('admin.perawatans.index')->with('success', 'Catatan perawatan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $perawatan = Perawatan::findOrFail($id);
        $mobils = Mobil::all(); // Ambil semua mobil, karena mobil yang sedang dirawat juga harus bisa dipilih
        return view('admin.perawatans.edit', compact('perawatan', 'mobils'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'tanggal_mulai' => 'required|date',
            'deskripsi' => 'required|string',
            'biaya' => 'required|integer|min:0',
        ]);

        $perawatan = Perawatan::findOrFail($id);
        $perawatan->update($request->only(['mobil_id', 'tanggal_mulai', 'deskripsi', 'biaya']));

        return redirect()->route('admin.perawatans.index')->with('success', 'Detail perawatan berhasil diperbarui.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function showCompleteForm(string $id)
    {
        $perawatan = Perawatan::findOrFail($id);
        return view('admin.perawatans.complete', compact('perawatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function complete(Request $request, string $id)
    {
        $perawatan = Perawatan::findOrFail($id);

        $request->validate([
            'tanggal_selesai' => 'required|date|after_or_equal:' . $perawatan->tanggal_mulai,
        ]);

        $perawatan->update([
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'selesai',
        ]);

        $mobil = $perawatan->mobil;
        $mobil->status = 'tersedia';
        $mobil->save();

        return redirect()->route('admin.perawatans.index')->with('success', 'Perawatan berhasil diselesaikan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
