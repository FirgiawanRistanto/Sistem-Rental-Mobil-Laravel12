<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggans = Pelanggan::all();
        return view('admin.pelanggans.index', compact('pelanggans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pelanggans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:255|unique:pelanggans',
            'no_hp' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('admin.pelanggans.index')->with('success', 'Pelanggan added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        return view('admin.pelanggans.show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        return view('admin.pelanggans.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:255|unique:pelanggans,no_ktp,' . $pelanggan->id,
            'no_hp' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('admin.pelanggans.index')->with('success', 'Pelanggan updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('admin.pelanggans.index')->with('success', 'Pelanggan deleted successfully!');
    }
}
