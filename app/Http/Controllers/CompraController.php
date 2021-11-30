<?php

namespace App\Http\Controllers;

use App\Exports\ComprasExport;
use App\Models\compra;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return compra::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($fecha_compra, $monto, $descripcion, $id_proveedor)
    {
        $response = compra::create([
            'fecha_compra' => $fecha_compra,
            'monto' => $monto,
            'descripcion' => $descripcion,
            'id_proveedor' => $id_proveedor,
        ]);

        if ($response !== null) {
            return $response;
        } else {
            return false;
        }
    } //


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show($id_compra)
    {
        return compra::where('id_compra', $id_compra)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit($id_compra, $fecha_compra, $monto, $descripcion, $id_proveedor)
    {
        $response = compra::where('id_compra', $id_compra)->create([
            'fecha_compra' => $fecha_compra,
            'monto' => $monto,
            'descripcion' => $descripcion,
            'id_proveedor' => $id_proveedor,
        ]);

        if ($response !== null) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_compra)
    {
        return compra::where('id_compra', $id_compra)->destroy();
    }

    public function exportar()
    {
        return Excel::download(new ComprasExport, 'compras.xlsx');
    }
}
