<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualan = Penjualan::all();
        return view('admin.penjualan', ['penjualan' => $penjualan]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.penjualan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'jumlah' => 'required|integer',
        ]);

        Penjualan::create($request->all());

        return redirect()->route('admin.penjualan')
                         ->with('success', 'Data penjualan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        return view('admin.penjualan.edit', compact('penjualan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'jumlah' => 'required|integer',
        ]);

        $penjualan->update($request->all());

        return redirect()->route('admin.penjualan')
                         ->with('success', 'Data penjualan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();

        return redirect()->route('admin.penjualan')
                         ->with('success', 'Data penjualan berhasil dihapus.');
    }
}