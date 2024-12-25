<?php

namespace Database\Seeders;

use App\Models\kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */ 

    public function run()
    {
        kategori::create(['nama'=>'fiksi']);
        Kategori::create(['nama'=>'nonfiksi']);
        Kategori::create(['nama'=>'sains']);
    }
}
