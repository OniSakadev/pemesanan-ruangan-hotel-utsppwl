<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'lokasi', 'deskripsi', 'harga_per_malam', 'gambar'];

    public function kamar()
    {
        return $this->hasMany(Kamar::class);
    }
}
