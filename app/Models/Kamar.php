<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamars'; // Sesuaikan dengan nama tabel di database

    protected $fillable = ['hotel_id', 'tipe', 'harga', 'deskripsi', 'status'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
