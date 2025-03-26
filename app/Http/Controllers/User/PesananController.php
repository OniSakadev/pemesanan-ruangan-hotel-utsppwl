<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::where('user_id', Auth::id())->with('kamar')->get();
        return view('user.pesanans.pesanan', compact('pesanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
        ]);

        $pesanan = Pesanan::create([
            'user_id' => Auth::id(),
            'kamar_id' => $request->kamar_id,
            'tanggal_checkin' => $request->tanggal_checkin,
            'tanggal_checkout' => $request->tanggal_checkout,
            'status' => 'pending',
        ]);

        return redirect()->route('pesanan.index')->with('success', 'Pemesanan berhasil!');
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        if ($pesanan->status !== 'pending') {
            return redirect()->route('pesanan.index')->with('error', 'Pesanan tidak bisa dibatalkan.');
        }

        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
