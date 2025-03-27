@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Cari Kamar</h3>
    <form id="search-form">
        <input type="text" id="search" class="form-control" placeholder="Cari tipe kamar..." required>
        <button type="submit" class="btn btn-primary mt-2">Cari</button>
    </form>

    <div id="kamar-list" class="mt-3">
        <p class="text-muted">Masukkan tipe kamar untuk mencari...</p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        function fetchKamars(query = '') {
            $.ajax({
                url: "{{ route('kamars.cari') }}",
                type: "GET",
                data: { search: query },
                success: function(response) {
                    let kamarList = $('#kamar-list');
                    kamarList.empty();

                    if (response.kamars.length === 0) {
                        kamarList.html('<p class="text-danger text-center">Kamar tidak ditemukan.</p>');
                    } else {
                        let html = '<ul class="list-group">';
                        response.kamars.forEach(function(kamar) {
                            html += `<li class="list-group-item">
                                <a href="/kamars/${kamar.id}">${kamar.tipe} - Rp ${new Intl.NumberFormat().format(kamar.harga)}</a>
                            </li>`;
                        });
                        html += '</ul>';
                        kamarList.html(html);
                    }
                },
                error: function(xhr) {
                    console.error("Error:", xhr.responseText);
                    $('#kamar-list').html('<p class="text-danger">Terjadi kesalahan, coba lagi.</p>');
                }
            });
        }

        $('#search-form').on('submit', function(e) {
            e.preventDefault();
            fetchKamars($('#search').val());
        });
    });
</script>
@endsection
