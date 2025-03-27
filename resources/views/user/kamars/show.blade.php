@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Detail Kamar</h3>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $kamar->tipe }}</h5>
            <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($kamar->harga, 0, ',', '.') }}</p>
            <p class="card-text"><strong>Deskripsi:</strong> {{ $kamar->deskripsi }}</p>

            <!-- Form Pemesanan -->
            <form action="{{ route('pesanan.store') }}" method="POST">
                @csrf
                <input type="hidden" name="kamar_id" value="{{ $kamar->id }}">

                <div class="mb-3">
                    <label for="tanggal_checkin" class="form-label">Tanggal Check-in</label>
                    <input type="date" id="tanggal_checkin" name="tanggal_checkin" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal_checkout" class="form-label">Tanggal Check-out</label>
                    <input type="date" id="tanggal_checkout" name="tanggal_checkout" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Pesan Sekarang</button>
            </form>
        </div>
    </div>
</div>
@endsection  
