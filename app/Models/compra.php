<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compra extends Model
{
    use HasFactory;

    protected $table = "compras";
    protected $primaryKey = "id_compra";
    protected $fillable = [
        'fecha_compra',
        'monto',
        'descripcion',
        'id_proveedor',
    ];

    public function proveedor()
    {
        return $this->hasOne(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }
}
