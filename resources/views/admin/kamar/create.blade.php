@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-xl font-bold mb-4">Tambah Kamar</h1>

    <form action="{{ route('admin.kamar.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="tipe" class="block">Tipe Kamar:</label>
            <input type="text" name="tipe" class="border px-4 py-2 w-full" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="block">Harga:</label>
            <input type="number" name="harga" class="border px-4 py-2 w-full" required>
        </div>

        <div class="mb-3">
            <label for="status" class="block">Status:</label>
            <select name="status" class="border px-4 py-2 w-full">
                <option value="Tersedia">Tersedia</option>
                <option value="Terisi">Terisi</option>
            </select>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
