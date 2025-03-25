<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kamar;
use Illuminate\Support\Facades\Storage;

class KamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::all();
        return view('admin.kamar.index', compact('kamars'));
    }

    public function create()
    {
        return view('admin.kamar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kamar' => 'required',
            'kapasitas' => 'required|integer',
            'harga_per_malam' => 'required|numeric',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $gambarPath = $request->file('gambar') ? $request->file('gambar')->store('images', 'public') : null;

        Kamar::create([
            'nama_kamar' => $request->nama_kamar,
            'kapasitas' => $request->kapasitas,
            'harga_per_malam' => $request->harga_per_malam,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath
        ]);

        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function edit(Kamar $kamar)
    {
        return view('admin.kamar.edit', compact('kamar'));
    }

    public function update(Request $request, Kamar $kamar)
    {
        $request->validate([
            'nama_kamar' => 'required',
            'kapasitas' => 'required|integer',
            'harga_per_malam' => 'required|numeric',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            if ($kamar->gambar) {
                Storage::delete('public/' . $kamar->gambar);
            }
            $gambarPath = $request->file('gambar')->store('images', 'public');
        } else {
            $gambarPath = $kamar->gambar;
        }

        $kamar->update([
            'nama_kamar' => $request->nama_kamar,
            'kapasitas' => $request->kapasitas,
            'harga_per_malam' => $request->harga_per_malam,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath
        ]);

        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    public function destroy(Kamar $kamar)
    {
        if ($kamar->gambar) {
            Storage::delete('public/' . $kamar->gambar);
        }
        $kamar->delete();

        return redirect()->route('admin.kamar.index')->with('success', 'Kamar berhasil dihapus.');
    }
}
