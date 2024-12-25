<?php

namespace App\Exports;

use App\Models\peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;

class peminjamanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return peminjaman::all();
    }
}
