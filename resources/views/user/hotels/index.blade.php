@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Cari Hotel</h1>

    <!-- Search Bar -->
    <form action="{{ route('hotels.index') }}" method="GET" class="mb-4">
        <input type="text" name="search" class="form-control" placeholder="Cari hotel..." value="{{ request('search') }}">
    </form>

    <div class="row">
        @foreach($hotels as $hotel)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('images/hotels/' . $hotel->image) }}" class="card-img-top" alt="{{ $hotel->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $hotel->name }}</h5>
                        <p class="card-text">{{ $hotel->location }}</p>
                        <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
