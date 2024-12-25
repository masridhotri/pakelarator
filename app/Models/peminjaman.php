<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    use HasFactory;

    protected $fillable = ["user","buku","tgl_pinjam","tgl_kembali","denda"];

    public function user()
{
    return $this->hasMany(User::class, 'User_id');
}
public function buku()
{
    return $this->hasMany(buku::class, 'bukus_id' );
}

}
