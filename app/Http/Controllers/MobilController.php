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
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), array_merge(\App\Models\Mobil::rules(), [
            'interior_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'exterior_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'interior_urutan.*' => 'nullable|integer|min:0',
            'exterior_urutan.*' => 'nullable|integer|min:0',
        ]), [
            'nopol.unique' => 'nopol sudah ada',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $mobil = Mobil::create($request->all());

        $interior_labels = explode(',', $request->input('interior_labels'));
        $exterior_labels = explode(',', $request->input('exterior_labels'));
        $interior_urutan = explode(',', $request->input('interior_urutan'));
        $exterior_urutan = explode(',', $request->input('exterior_urutan'));

        if ($request->hasFile('interior_images')) {
            foreach ($request->file('interior_images') as $key => $image) {
                $path = $image->store('mobils', 'public');
                $mobil->gambars()->create([
                    'path' => $path,
                    'tipe' => 'interior',
                    'label' => $interior_labels[$key] ?? '',
                    'urutan' => $interior_urutan[$key] ?? 0
                ]);
            }
        }

        if ($request->hasFile('exterior_images')) {
            foreach ($request->file('exterior_images') as $key => $image) {
                $path = $image->store('mobils', 'public');
                $mobil->gambars()->create([
                    'path' => $path,
                    'tipe' => 'exterior',
                    'label' => $exterior_labels[$key] ?? '',
                    'urutan' => $exterior_urutan[$key] ?? 0
                ]);
            }
        }

        return redirect()->route('admin.mobils.index')->with('success', 'Data mobil berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mobil $mobil)
    {
        $mobil->load(['gambars' => function($query) {
            $query->orderBy('urutan');
        }]);
        $gambars = $mobil->gambars->groupBy('tipe');
        return view('admin.mobils.show', compact('mobil', 'gambars'));
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
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), array_merge(\App\Models\Mobil::rules($mobil->id), [
            'interior_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'exterior_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'interior_urutan.*' => 'nullable|integer|min:0',
            'exterior_urutan.*' => 'nullable|integer|min:0',
        ]));

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $mobil->update($request->all());

        // Handle image deletion
        if ($request->has('deleted_images')) {
            \App\Models\MobilGambar::destroy($request->input('deleted_images'));
        }

        $interior_labels = explode(',', $request->input('interior_labels'));
        $exterior_labels = explode(',', $request->input('exterior_labels'));
        $interior_urutan = explode(',', $request->input('interior_urutan'));
        $exterior_urutan = explode(',', $request->input('exterior_urutan'));

        if ($request->hasFile('interior_images')) {
            foreach ($request->file('interior_images') as $key => $image) {
                $path = $image->store('mobils', 'public');
                $mobil->gambars()->create([
                    'path' => $path,
                    'tipe' => 'interior',
                    'label' => $interior_labels[$key] ?? '',
                    'urutan' => $interior_urutan[$key] ?? 0
                ]);
            }
        }

        if ($request->hasFile('exterior_images')) {
            foreach ($request->file('exterior_images') as $key => $image) {
                $path = $image->store('mobils', 'public');
                $mobil->gambars()->create([
                    'path' => $path,
                    'tipe' => 'exterior',
                    'label' => $exterior_labels[$key] ?? '',
                    'urutan' => $exterior_urutan[$key] ?? 0
                ]);
            }
        }

        return redirect()->route('admin.mobils.index')->with('success', 'Data mobil berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mobil $mobil)
    {
        $mobil->delete();
        return redirect()->route('admin.mobils.index')->with('success', 'Data mobil berhasil dihapus!');
    }
}
