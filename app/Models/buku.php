<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    use HasFactory;

    protected $fillable = ["judul","penulis","kategoris_id","penerbit","foto","stok","deskripsi"];

    public function kategori()
{
    return $this->belongsTo(kategori::class, 'kategori_id');
}
public function peminjaman()
{
    return $this->hasMany(peminjaman::class, 'peminjamen_id');
}

}
