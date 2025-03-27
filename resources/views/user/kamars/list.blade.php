@if($kamars->isEmpty())
    <p class="text-danger text-center">Kamar tidak ditemukan.</p>
@else
    <ul class="list-group">
        @foreach($kamars as $kamar)
            <li class="list-group-item">
                <a href="{{ route('kamars.show', $kamar->id) }}">
                    {{ $kamar->tipe }} - Rp {{ number_format($kamar->harga, 0, ',', '.') }}
                </a>
            </li>
        @endforeach
    </ul>
@endif
