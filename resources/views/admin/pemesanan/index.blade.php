@extends('layouts.app')

@section('content')
    <h1>Daftar Kelola Pemesanan Ruangan</h1>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Kamar</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemesanan as $index => $pesanan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pesanan->user->name ?? 'Tidak Ada Data' }}</td>
                    <td>{{ $pesanan->kamar->tipe ?? 'Tidak Ada Data' }}</td>
                    <td>{{ \Carbon\Carbon::parse($pesanan->tanggal_checkin)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($pesanan->tanggal_checkout)->format('d M Y') }}</td>

                    <td>
                        @if($pesanan->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($pesanan->status == 'diterima')
                            <span class="badge bg-success">Diterima</span>
                        @else
                            <span class="badge bg-danger">Dibatalkan</span>
                        @endif
                    </td>
                    <td>
                        @if($pesanan->status == 'pending')
                            <form action="{{ route('admin.pemesanan.konfirmasi', $pesanan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Konfirmasi</button>
                            </form>
                            <form action="{{ route('admin.pemesanan.batalkan', $pesanan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Batalkan</button>
                            </form>
                        @else
                            <span>-</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
