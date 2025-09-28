<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pelanggans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pelanggans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:16|unique:pelanggans,no_ktp',
            'no_hp' => 'required|string|max:13',
            'alamat' => 'required|string',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('admin.pelanggans.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function getPelanggansData()
    {
        $pelanggans = Pelanggan::select('pelanggans.*');

        return DataTables::of($pelanggans)
            ->addColumn('action', function ($pelanggan) {
                $showUrl = route('admin.pelanggans.show', $pelanggan->id);
                $editUrl = route('admin.pelanggans.edit', $pelanggan->id);
                $deleteUrl = route('admin.pelanggans.destroy', $pelanggan->id);

                $csrf = csrf_field();
                $method = method_field('DELETE');

                return '<a href="' . $showUrl . '" class="btn btn-info btn-sm">Lihat</a> ' . 
                       '<a href="' . $editUrl . '" class="btn btn-warning btn-sm">Edit</a> ' . 
                       '<form action="' . $deleteUrl . '" method="POST" class="d-inline delete-form">' . 
                       $csrf . $method . 
                       '<button type="submit" class="btn btn-danger btn-sm">Delete</button>' . 
                       '</form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        $pelanggan->load('penyewaans.mobil');
        return view('admin.pelanggans.show', compact('pelanggan'));
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('admin.pelanggans.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:16|unique:pelanggans,no_ktp,' . $pelanggan->id,
            'no_hp' => 'required|string|max:13',
            'alamat' => 'required|string',
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('admin.pelanggans.index')->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        if ($pelanggan->penyewaans()->exists()) {
            return redirect()->route('admin.pelanggans.index')->with('error', 'Gagal menghapus! Pelanggan ini memiliki penyewaan aktif.');
        }

        $pelanggan->delete();

        return redirect()->route('admin.pelanggans.index')->with('success', 'Data pelanggan berhasil dihapus.');
    }

    public function storeAjax(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:16|unique:pelanggans,no_ktp',
            'no_hp' => 'required|string|max:13',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pelanggan = Pelanggan::create($request->all());

        return response()->json($pelanggan, 201);
    }
}