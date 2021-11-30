<?php

namespace App\Exports;

use App\Models\compra;
use Maatwebsite\Excel\Concerns\FromCollection;

class ComprasExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return compra::join('proveedores', 'proveedores.id_proveedor', '=', 'compras.id_proveedor')->get();
    }
}
