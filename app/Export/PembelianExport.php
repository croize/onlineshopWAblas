<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class PembelianExport implements FromCollection
{
    public function collection()
    {
        return Pembelian::all();
    }
}
