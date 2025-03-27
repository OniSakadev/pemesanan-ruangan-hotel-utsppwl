<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index()
    {
        return view('user.kamars.index');
    }

    public function cariKamar(Request $request)
    {
        $query = $request->input('search');
        $kamars = Kamar::where('tipe', 'like', "%$query%")->get();

        return response()->json(['kamars' => $kamars]);
    }

    public function show($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('user.kamars.show', compact('kamar'));
    }

    public function pesanKamar(Request $request)
    {
        // Simpan pemesanan (sesuaikan dengan model pemesanan Anda)
        return redirect()->route('kamars.index')->with('success', 'Kamar berhasil dipesan!');
    }
}
