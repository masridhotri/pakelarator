<?php

namespace App\Imports;

use App\Models\buku;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class bukuImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2; // start from row 2
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(empty($row[0])) {
            return null;
        }

        return new Buku([
            'judul'       => $row[0], // Column A: 'judul'
            'penulis'     => $row[1], // Column B: 'penulis'
            'penerbit'    => $row[2], // Column C: 'penerbit'
            'tahun_terbit'=> $row[3], // Column D: 'tahun_terbit'
        ]);
    }
}
