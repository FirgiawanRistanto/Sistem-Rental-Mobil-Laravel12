<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Models\Mobil;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.penyewaans.index');
    }

    public function getPenyewaansData()
    {
        $penyewaans = Penyewaan::with(['mobil', 'pelanggan'])->select('penyewaans.*');

        return DataTables::of($penyewaans)
            ->addColumn('action', function ($penyewaan) {
                $showUrl = route('admin.penyewaans.show', $penyewaan->id);
                $editUrl = route('admin.penyewaans.edit', $penyewaan->id);
                return '<a href="' . $showUrl . '" class="btn btn-info btn-sm">Lihat</a> ' . 
                       '<a href="' . $editUrl . '" class="btn btn-warning btn-sm">Edit</a>';
            })
            ->editColumn('id', function ($penyewaan) {
                return 'BOOK-' . str_pad($penyewaan->id, 5, '0', STR_PAD_LEFT);
            })
            ->editColumn('mobil.merk', function ($penyewaan) {
                return $penyewaan->mobil->merk . ' (' . $penyewaan->mobil->nopol . ')';
            })
            ->editColumn('total_biaya', function ($penyewaan) {
                return 'Rp ' . number_format($penyewaan->total_biaya, 0, ',', '.');
            })
            ->editColumn('tanggal_sewa', function ($penyewaan) {
                return $penyewaan->tanggal_sewa->translatedFormat('d F Y');
            })
            ->editColumn('tanggal_kembali', function ($penyewaan) {
                return $penyewaan->tanggal_kembali->translatedFormat('d F Y');
            })
            ->rawColumns(['action'])
            ->make(true);
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
        $rules = \App\Models\Penyewaan::rules();
        $messages = \App\Models\Penyewaan::messages();

        // Validate the request
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $penyewaan = Penyewaan::create($request->all());

        // Update mobil status to 'Disewa'
        $mobil = Mobil::find($request->mobil_id);
        if ($mobil) {
            $mobil->status = 'Disewa';
            $mobil->disewa = $mobil->disewa + 1; // Increment disewa count
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
        $mobils = Mobil::where('status', 'Tersedia')->orWhere('id', $penyewaan->mobil_id)->get();
        $pelanggans = Pelanggan::all();
        return view('admin.penyewaans.edit', compact('penyewaan', 'mobils', 'pelanggans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penyewaan $penyewaan)
    {
        $rules = \App\Models\Penyewaan::rules($penyewaan->id);
        $messages = \App\Models\Penyewaan::messages();

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $penyewaan->update($request->all());

        return redirect()->route('admin.penyewaans.index')->with('success', 'Penyewaan updated successfully!');
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