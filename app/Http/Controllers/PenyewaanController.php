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
        return view('admin.penyewaans.create', compact('mobils'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = \App\Models\Penyewaan::rules();
        $messages = \App\Models\Penyewaan::messages();

        // Add customer-related rules
        $rules['nama'] = 'required|string|max:255';
        $rules['no_ktp'] = 'required|string|max:16|unique:pelanggans,no_ktp';
        $rules['no_hp'] = 'required|string|max:13';
        $rules['alamat'] = 'required|string';

        // Add customer-related messages
        $messages['nama.required'] = 'Nama pelanggan wajib diisi.';
        $messages['nama.string'] = 'Nama pelanggan harus berupa teks.';
        $messages['nama.max'] = 'Nama pelanggan tidak boleh lebih dari 255 karakter.';
        $messages['no_ktp.required'] = 'Nomor KTP/SIM wajib diisi.';
        $messages['no_ktp.string'] = 'Nomor KTP/SIM harus berupa teks.';
        $messages['no_ktp.max'] = 'Nomor KTP/SIM tidak boleh lebih dari 16 karakter.';
        $messages['no_ktp.unique'] = 'Nomor KTP/SIM sudah terdaftar.';
        $messages['no_hp.required'] = 'Nomor HP wajib diisi.';
        $messages['no_hp.string'] = 'Nomor HP harus berupa teks.';
        $messages['no_hp.max'] = 'Nomor HP tidak boleh lebih dari 13 karakter.';
        $messages['alamat.required'] = 'Alamat wajib diisi.';
        $messages['alamat.string'] = 'Alamat harus berupa teks.';

        // Remove 'pelanggan_id' and 'denda' from Penyewaan rules as they are not directly from request for store
        unset($rules['pelanggan_id']);
        unset($rules['denda']);
        unset($rules['tanggal_kembali_aktual']); // Not needed for store

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // Find or create customer
        $pelanggan = Pelanggan::firstOrCreate(
            ['no_ktp' => $request->no_ktp],
            [
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]
        );

        $penyewaan = Penyewaan::create([
            'mobil_id' => $request->mobil_id,
            'pelanggan_id' => $pelanggan->id,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'total_biaya' => $request->total_biaya,
            'status' => $request->status,
        ]);

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
     * Show the form for returning a car.
     */
    public function showPengembalianForm()
    {
        $penyewaans = Penyewaan::where('status', 'Disewa')->get();
        return view('admin.pengembalian.index', compact('penyewaans'));
    }

    /**
     * Process the car return.
     */
    public function prosesPengembalian(Request $request, Penyewaan $penyewaan)
    {
        // Debugging: Dump all request data
        // dd($request->all());

        $rules = [
            'tanggal_kembali_aktual' => 'required|date|after_or_equal:tanggal_sewa',
            'denda' => 'nullable|integer|min:0',
        ];

        $messages = [
            'tanggal_kembali_aktual.required' => 'Tanggal kembali aktual wajib diisi.',
            'tanggal_kembali_aktual.date' => 'Tanggal kembali aktual harus berupa tanggal yang valid.',
            'tanggal_kembali_aktual.after_or_equal' => 'Tanggal kembali aktual harus setelah atau sama dengan tanggal sewa.',
            'denda.integer' => 'Denda harus berupa angka.',
            'denda.min' => 'Denda tidak boleh kurang dari 0.',
        ];

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            // Debugging: Dump validation errors
            // dd($validator->errors());
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $penyewaan->tanggal_kembali_aktual = $request->tanggal_kembali_aktual;
        $penyewaan->status = 'Selesai';

        $tanggalKembaliSeharusnya = \Carbon\Carbon::parse($penyewaan->tanggal_kembali)->startOfDay();
        $tanggalKembaliAktual = \Carbon\Carbon::parse($request->tanggal_kembali_aktual)->startOfDay();

        if ($tanggalKembaliAktual->greaterThan($tanggalKembaliSeharusnya)) {
            $mobil = $penyewaan->mobil;
            $dendaPerHari = $mobil->denda_per_hari;
            $selisihHari = abs($tanggalKembaliAktual->diffInDays($tanggalKembaliSeharusnya)); // Menggunakan abs() untuk memastikan nilai positif
            $penyewaan->denda = $selisihHari * $dendaPerHari;
        }

        $penyewaan->save();

        // Update mobil status to 'Tersedia'
        $mobil = $penyewaan->mobil;
        $mobil->status = 'Tersedia';
        $mobil->save();

        return redirect()->route('admin.pengembalian.index')->with('success', 'Mobil berhasil dikembalikan.');
    }
}