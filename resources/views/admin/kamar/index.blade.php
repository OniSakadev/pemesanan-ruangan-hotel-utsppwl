@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-xl font-bold mb-4">Manajemen Kamar</h1>

    <a href="{{ route('admin.kamar.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-3">Tambah Kamar</a>

    @if(session('success'))
        <div class="bg-green-500 text-white p-2 my-2">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Tipe</th>
                <th class="border px-4 py-2">Harga</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kamars as $kamar)
                <tr>
                    <td>{{ $loop->iteration }}</td> 
                    <td class="border px-4 py-2">{{ $kamar->tipe }}</td>
                    <td class="border px-4 py-2">{{ number_format($kamar->harga) }}</td>
                    <td class="border px-4 py-2">{{ $kamar->status }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.kamar.edit', $kamar->id) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('admin.kamar.destroy', $kamar->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection