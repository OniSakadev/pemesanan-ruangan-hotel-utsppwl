<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HotelController extends Controller
{
    // Menampilkan daftar semua hotel
    public function index()
    {
        $hotels = Hotel::with('kamar')->get(); // Ambil semua hotel dengan kamar
        return view('user.hotels.index', compact('hotels')); // Kirim ke Blade
    }

    // Menampilkan detail hotel berdasarkan ID
    public function show($id)
    {
        $hotel = Hotel::with('kamar')->find($id);

        if (!$hotel) {
            return redirect()->route('hotels.index')->with('error', 'Hotel tidak ditemukan');
        }

        return view('user.hotels.show', compact('hotel'));
    }


    public function pesanKamar(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'kamar_id' => 'required|exists:kamars,id',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
        ]);

        $pemesanan = Pesanan::create([
            'user_id' => Auth::id(),
            'hotel_id' => $request->hotel_id,
            'kamar_id' => $request->kamar_id,
            'tanggal_checkin' => $request->tanggal_checkin,
            'tanggal_checkout' => $request->tanggal_checkout,
            'status' => 'pending',
        ]);

        return redirect()->route('pesanan.index')->with('success', 'Pemesanan berhasil dilakukan!');
    }
}
