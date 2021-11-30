<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proveedores')->insert([
            'empresa' => 'IDG Marketing',
            'rfc' => 'IDG38485D3E',
            'giro' => 'Marketing y publicidad',
        ]);

        DB::table('proveedores')->insert([
            'empresa' => 'Farmacias El Salto',
            'rfc' => 'FES4956845DE',
            'giro' => 'Farmacéutica',
        ]);

        DB::table('proveedores')->insert([
            'empresa' => 'Ventura Consulting',
            'rfc' => 'VTR34985474FRE4',
            'giro' => 'IT services',
        ]);

        DB::table('proveedores')->insert([
            'empresa' => 'Fabricas de parís',
            'rfc' => 'FBP4857393D3',
            'giro' => 'Manufactura',
        ]);

        DB::table('proveedores')->insert([
            'empresa' => 'Cognito Inc.',
            'rfc' => 'CNT2948542G4',
            'giro' => 'Investigación policial',
        ]);
    }
}
