@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Manajemen Kamar</h2>
    <a href="{{ route('admin.kamar.create') }}" class="btn btn-primary mb-3">Tambah Kamar</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kapasitas</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kamars as $kamar)
            <tr>
                <td>{{ $kamar->nama_kamar }}</td>
                <td>{{ $kamar->kapasitas }} orang</td>
                <td>Rp {{ number_format($kamar->harga_per_malam, 0, ',', '.') }}</td>
                <td>
                    @if($kamar->gambar)
                        <img src="{{ asset('storage/'.$kamar->gambar) }}" width="100">
                    @else
                        Tidak ada gambar
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.kamar.edit', $kamar) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.kamar.destroy', $kamar) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
