<?php

namespace App\Http\Controllers;

use App\Models\KategoriSampah;
use Illuminate\Http\Request;

class KategoriSampahController extends Controller
{
    public function index()
    {
        $kategori = KategoriSampah::latest()->get();
        return view('kategori_sampah.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori_sampah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'harga_per_kg'  => 'required|integer|min:0',
            'satuan'        => 'required|string|max:50',
        ]);

        KategoriSampah::create($request->all());

        return redirect()->route('kategori-sampah.index')
                         ->with('success', 'Data Kategori Sampah berhasil ditambahkan!');
    }

    public function edit(KategoriSampah $kategoriSampah)
    {
        return view('kategori_sampah.edit', compact('kategoriSampah'));
    }

    public function update(Request $request, KategoriSampah $kategoriSampah)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'harga_per_kg'  => 'required|integer|min:0',
            'satuan'        => 'required|string|max:50',
        ]);

        $kategoriSampah->update($request->all());

        return redirect()->route('kategori-sampah.index')
                         ->with('success', 'Data Kategori Sampah berhasil diperbarui!');
    }

    public function destroy(KategoriSampah $kategoriSampah)
    {
        $kategoriSampah->delete();

        return redirect()->route('kategori-sampah.index')
                         ->with('success', 'Data Kategori Sampah berhasil dihapus!');
    }
}