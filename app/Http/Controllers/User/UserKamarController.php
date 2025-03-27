<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use Illuminate\Http\Request;

class UserKamarController extends Controller
{
    public function index()
    {
        // User hanya boleh melihat daftar kamar yang tersedia
        $kamars = Kamar::where('status', 'Tersedia')->get();
        return view('user.kamars.index', compact('kamars'));
    }

    public function cariKamar(Request $request)
    {
        $query = $request->input('search');
        
        // Hanya mencari kamar yang tersedia agar user tidak bisa melihat kamar yang sudah terisi
        $kamars = Kamar::where('status', 'Tersedia')
                    ->where('tipe', 'like', "%$query%")
                    ->get();

        return response()->json(['kamars' => $kamars]);
    }

    public function show($id)
    {
        $kamar = Kamar::where('status', 'Tersedia')->findOrFail($id);
        return view('user.kamars.show', compact('kamar'));
    }

    public function pesanKamar(Request $request)
    {
        // Contoh pemesanan kamar (implementasi disesuaikan dengan sistem pemesanan yang ada)
        return redirect()->route('kamars.index')->with('success', 'Kamar berhasil dipesan!');
    }
}
