<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mobils = Mobil::all();
        return view('admin.mobils.index', compact('mobils'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mobils.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'nopol' => 'required|string|max:255|unique:mobils',
            'harga_sewa' => 'required|integer|min:0',
            'denda_per_hari' => 'required|integer|min:0',
            'status' => 'required|in:Tersedia,Disewa',
        ]);

        Mobil::create($request->all());

        return redirect()->route('admin.mobils.index')->with('success', 'Mobil added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mobil $mobil)
    {
        return view('admin.mobils.show', compact('mobil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mobil $mobil)
    {
        return view('admin.mobils.edit', compact('mobil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mobil $mobil)
    {
        $request->validate([
            'merk' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'nopol' => 'required|string|max:255|unique:mobils,nopol,' . $mobil->id,
            'harga_sewa' => 'required|integer|min:0',
            'denda_per_hari' => 'required|integer|min:0',
            'status' => 'required|in:Tersedia,Disewa',
        ]);

        $mobil->update($request->all());

        return redirect()->route('admin.mobils.index')->with('success', 'Mobil updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mobil $mobil)
    {
        $mobil->delete();
        return redirect()->route('admin.mobils.index')->with('success', 'Mobil deleted successfully!');
    }
}
