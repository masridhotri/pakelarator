<?php

namespace App\Exports;

use App\Models\kategori;
use Maatwebsite\Excel\Concerns\FromCollection;

class kategoriExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return kategori::all();
    }
}
