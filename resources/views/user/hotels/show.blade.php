@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4 border-0 rounded-4" style="background-color: #f0fdf4;">
        <h1 class="text-center my-4 text-success fw-bold">{{ $hotel->nama ?? 'Nama Hotel Tidak Tersedia' }}</h1>

        <div class="row">
            <div class="col-md-6">
                @if($hotel->gambar)
                    <img src="{{ asset('storage/images/hotels/' . $hotel->gambar) }}" 
                         class="img-fluid rounded-3 shadow-lg border border-3 border-success" 
                         alt="{{ $hotel->nama }}">
                @else
                    <img src="{{ asset('images/no-image.jpg') }}" 
                         class="img-fluid rounded-3 shadow-lg border border-3 border-secondary" 
                         alt="No Image Available">
                @endif
            </div>

            <div class="col-md-6">
                <h4 class="fw-bold text-success mt-3">📍 Lokasi: <span class="text-dark">{{ $hotel->lokasi ?? 'Tidak tersedia' }}</span></h4>
                <p class="text-secondary mt-3" style="font-size: 1.1rem;">{{ $hotel->deskripsi ?? 'Deskripsi belum tersedia' }}</p>

                <h4 class="fw-bold text-success mt-4">🛏️ Daftar Kamar</h4>
                @if($hotel->kamar->count() > 0)
                    <form action="{{ route('pesanan.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kamar_id" class="form-label fw-bold">Pilih Kamar:</label>
                            <select name="kamar_id" id="kamar_id" class="form-control" required>
                                @foreach($hotel->kamar as $kamar)
                                    <option value="{{ $kamar->id }}">
                                        {{ $kamar->tipe }} - Rp{{ number_format($kamar->harga, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_checkin" class="form-label">Tanggal Check-in:</label>
                            <input type="date" name="tanggal_checkin" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_checkout" class="form-label">Tanggal Check-out:</label>
                            <input type="date" name="tanggal_checkout" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-lg btn-success mt-3 w-100 fw-bold shadow-lg rounded-pill">
                            🛒 Pesan Sekarang
                        </button>
                    </form>
                @else
                    <p class="text-danger mt-3 fw-bold">❌ Tidak ada kamar tersedia.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
