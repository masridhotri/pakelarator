<?php

namespace App\Exports;

use App\Models\buku;
use Maatwebsite\Excel\Concerns\FromCollection;

class bukuExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return buku::all();
    }
}
