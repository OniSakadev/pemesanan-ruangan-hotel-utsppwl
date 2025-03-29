<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    // Menampilkan daftar pesanan user
    public function index()
    {
        $pesanan = Pesanan::where('user_id', Auth::id())->with('kamar')->latest()->get();
        return view('user.pesanans.index', compact('pesanan'));
    }

    // Menyimpan pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
            'tanggal_checkin' => 'required|date|after_or_equal:today',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
        ]);

        Pesanan::create([
            'user_id' => Auth::id(),
            'kamar_id' => $request->kamar_id,
            'tanggal_checkin' => $request->tanggal_checkin,
            'tanggal_checkout' => $request->tanggal_checkout,
            'status' => 'pending', // Status awal pemesanan
        ]);

        return redirect()->route('pesanan.index')->with('success', 'Pemesanan berhasil dibuat!');
    }

    // Membatalkan pesanan (hanya jika status masih pending)
    public function destroy($id)
    {
        $pesanan = Pesanan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($pesanan->status !== 'pending') {
            return redirect()->route('pesanan.index')->with('error', 'Pesanan tidak bisa dibatalkan.');
        }

        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibatalkan.');
    }
    public function batal($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        if ($pesanan->status == 'pending') {
            $pesanan->status = 'canceled';
            $pesanan->save();

            return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
        }

    return redirect()->back()->with('error', 'Pesanan tidak dapat dibatalkan.');
    }
}
