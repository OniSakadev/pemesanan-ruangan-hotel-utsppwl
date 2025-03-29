<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class AdminPemesananController extends Controller
{
    public function index()
    {
        $pemesanan = Pesanan::with('user', 'kamar')->get();
        return view('admin.pemesanan.index', compact('pemesanan'));
    }

    public function konfirmasi($id)
    {
        $pemesanan = Pesanan::findOrFail($id);
        $pemesanan->update(['status' => 'diterima']);

        return redirect()->route('admin.pemesanan.index')->with('success', 'Pesanan telah dikonfirmasi.');
    }

    public function batalkan($id)
    {
        $pemesanan = Pesanan::findOrFail($id);
        $pemesanan->update(['status' => 'canceled']);

        return redirect()->route('admin.pemesanan.index')->with('error', 'Pesanan telah dibatalkan.');
    }
}
