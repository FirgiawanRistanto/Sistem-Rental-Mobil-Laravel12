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
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        return view('admin.pelanggans.show', compact('pelanggan'));
    }
}