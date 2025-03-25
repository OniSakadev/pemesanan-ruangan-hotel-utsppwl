@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-success fw-bold">Pesanan Saya</h2>

    {{-- Alert pesan sukses atau error --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-lg p-4">
        @if($pesanan->count() > 0)
            <table class="table table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>No</th>
                        <th>Kamar</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesanan as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->kamar->tipe }}</td>
                            <td>{{ $item->tanggal_checkin }}</td>
                            <td>{{ $item->tanggal_checkout }}</td>
                            <td>
                                <span class="badge bg-{{ $item->status == 'pending' ? 'warning' : 'success' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>
                                @if($item->status == 'pending')
                                    <form action="{{ route('pesanan.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                                            ❌ Batalkan
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">Tidak dapat dibatalkan</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-danger">🚫 Tidak ada pesanan yang ditemukan.</p>
        @endif
    </div>
</div>
@endsection
