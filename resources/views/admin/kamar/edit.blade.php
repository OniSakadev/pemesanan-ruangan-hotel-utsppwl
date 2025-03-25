@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Edit Kamar</h2>
    <a href="{{ route('admin.kamar.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kamar.update', $kamar) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_kamar" class="form-label">Nama Kamar</label>
            <input type="text" name="nama_kamar" class="form-control" value="{{ $kamar->nama_kamar }}" required>
        </div>

        <div class="mb-3">
            <label for="kapasitas" class="form-label">Kapasitas</label>
            <input type="number" name="kapasitas" class="form-control" value="{{ $kamar->kapasitas }}" required>
        </div>

        <div class="mb-3">
            <label for="harga_per_malam" class="form-label">Harga Per Malam</label>
            <input type="number" name="harga_per_malam" class="form-control" value="{{ $kamar->harga_per_malam }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $kamar->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            @if($kamar->gambar)
                <div>
                    <img src="{{ asset('storage/'.$kamar->gambar) }}" width="150" class="mb-2">
                </div>
            @endif
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
