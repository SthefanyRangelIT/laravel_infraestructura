<?php

namespace App\Http\Livewire;

use App\Http\Controllers\CompraController;
use App\Models\compra;
use App\Models\proveedor;
use Livewire\Component;

class TablaCompras extends Component
{

    public $compras;
    public $proveedores;

    public $id_compra;
    public $fecha_compra;
    public $monto;
    public $descripcion;
    public $id_proveedor;
    public $empresa;
    public $giro;

    public $agregar_modal = false;
    public $editar_modal = false;
    public $eliminar_modal = false;
    public $excel_modal = false;
    public $confirmacion_modal = false;
    public $confirmacion_message;

    public $reglas = [
        'fecha_compra' => 'required',
        'monto' => 'required',
        'descripcion' => 'required',
        'id_proveedor' => 'int',
    ];

    public function mount()
    {
        $this->compras = compra::join('proveedores', 'proveedores.id_proveedor', '=', 'compras.id_proveedor')->get();
        $this->proveedores = proveedor::all();
    }

    public function openAgregarModal()
    {
        $this->agregar_modal = true;
    }

    public function openEditarModal($id_compra)
    {
        $this->id_compra = $id_compra;
        $compra = compra::where('id_compra', $this->id_compra)
            ->join('proveedores', 'proveedores.id_proveedor', '=', 'compras.id_proveedor')
            ->first();
        $this->fecha_compra = $compra->fecha_compra;
        $this->monto = $compra->monto;
        $this->descripcion = $compra->descripcion;
        $this->proveedor = $compra->proveedor;
        $this->id_proveedor = $compra->id_proveedor;
        $this->editar_modal = true;
    }

    public function openEliminarModal($id_compra)
    {
        $this->id_compra = $id_compra;
        $compra = compra::where('id_compra', $this->id_compra)
            ->join('proveedores', 'proveedores.id_proveedor', '=', 'compras.id_proveedor')
            ->first();
        $this->fecha_compra = $compra->fecha_compra;
        $this->monto = $compra->monto;
        $this->descripcion = $compra->descripcion;
        $this->empresa = $compra->empresa;
        $this->giro = $compra->giro;
        $this->id_proveedor = $compra->id_proveedor;
        $this->eliminar_modal = true;
    }

    public function openExcelModal()
    {
        $this->excel_modal = true;
    }

    public function cleanVariables()
    {
        $this->id_compra = null;
        $this->fecha_compra = null;
        $this->monto = null;
        $this->descripcion = null;
        $this->id_proveedor = null;
        $this->confirmacion_message;
    }

    public function agregarCompra()
    {

        $this->validate($this->reglas);
        $compra = new CompraController;

        $response = $compra->create(
            $fecha_compra = $this->fecha_compra,
            $monto = $this->monto,
            $descripcion = $this->descripcion,
            $id_proveedor = $this->id_proveedor,
        );

        if ($response !== null) {
            $this->cleanVariables();
            $this->confirmacion_message = "Compra registrada exitosamente";
            $this->agregar_modal = false;
            $this->confirmacion_modal = true;
        } else {
            $this->cleanVariables();
            $this->confirmacion_message = "Ocurrio un error, por favor inténtelo nuevamente";
            $this->agregar_modal = false;
            $this->confirmacion_modal = true;
        }
    }

    public function editarCompra()
    {
        $this->validate($this->reglas);
        $compra = new CompraController;

        $response = $compra->edit(
            $id_compra = $this->id_compra,
            $fecha_compra = $this->fecha_compra,
            $monto = $this->monto,
            $descripcion = $this->descripcion,
            $id_proveedor = $this->id_proveedor,
        );

        if ($response !== null) {
            $this->cleanVariables();
            $this->confirmacion_message = "Compra editada exitosamente";
            $this->editar_modal = false;
            $this->confirmacion_modal = true;
        } else {
            $this->cleanVariables();
            $this->confirmacion_message = "Ocurrio un error, por favor inténtelo nuevamente";
            $this->editar_modal = false;
            $this->confirmacion_modal = true;
        }
    }

    public function eliminarCompra()
    {
        $response = compra::destroy(
            $id_compra = $this->id_compra
        );

        if ($response !== null) {
            $this->cleanVariables();
            $this->confirmacion_message = "Compra eliminada exitosamente";
            $this->eliminar_modal = false;
            $this->confirmacion_modal = true;
        } else {
            $this->cleanVariables();
            $this->confirmacion_message = "Ocurrio un error, por favor inténtelo nuevamente";
            $this->eliminar_modal = false;
            $this->confirmacion_modal = true;
        }
    }

    public function exportarCompras()
    {
        return redirect()->route('exportar_compras');
    }

    public function render()
    {
        $this->compras = compra::join('proveedores', 'proveedores.id_proveedor', '=', 'compras.id_proveedor')->get();
        $this->proveedores = proveedor::all();
        return view('livewire.tabla-compras');
    }
}
