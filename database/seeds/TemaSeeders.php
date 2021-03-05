<?php

namespace Database\Seeders;

use App\Models\Tema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemaSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        Tema::truncate();
        DB::statement("SET foreign_key_checks=1");

      
         $tema = Tema::create([
            'nombre' => 'btn_login',
            'color' => '#1ac6ff',
            'color_icono' => '#293751',
            'color_texto' => '#f5efef',
            'family' => 'loto',
            'tamaño' => '28px',
            'texto' => 'Entrar'
         ]);

         $tema = Tema::create([
            'nombre' => 'btn_save',
            'color' => '#1ac6ff',
            'color_icono' => '#304F6',
            'color_texto' => '#1ac6ff',
            'family' => 'loto',
            'tamaño' => '13px',
            'texto' => '#dee 4e6'
         ]);

         $tema = Tema::create([
            'nombre' => 'btn_new',
            'color' => '#8bc34a',
            'color_icono' => '#8bc34a',
            'color_texto' => '#1ac6ff',
            'family' => 'loto',
            'tamaño' => '13px',
            'texto' => 'Añade un nuevo registro'
         ]);

         $tema = Tema::create([
            'nombre' => 'btn_edit',
            'color' => '#9c27b0',
            'color_icono' => '#9c27b0',
            'color_texto' => '#1ac6ff',
            'family' => 'loto',
            'tamaño' => '13px',
            'texto' => 'Edita un registro'
         ]);

         $tema = Tema::create([
            'nombre' => 'btn_orden',
            'color' => '#1ac6ff',
            'color_icono' => '#304F6',
            'color_texto' => '#1ac6ff',
            'family' => 'loto',
            'tamaño' => '13px',
            'texto' => '#dee 4e6'
         ]);

         $tema = Tema::create([
            'nombre' => 'btn_save_orden',
            'color' => '#ff9800',
            'color_icono' => '#ff9800',
            'color_texto' => '#1ac6ff',
            'family' => 'loto',
            'tamaño' => '13px',
            'texto' => 'Guarda el orden'
         ]);

         $tema = Tema::create([
            'nombre' => 'cprimario',
            'color' => '#293751',
            'color_icono' => '',
            'color_texto' => '#f5efef',
            'family' => 'loto',
            'tamaño' => '',
            'texto' => ''
         ]);

         $tema = Tema::create([
            'nombre' => 'csecundario',
            'color' => '#1ac5fe',
            'color_icono' => '',
            'color_texto' => '#f5efef',
            'family' => 'loto',
            'tamaño' => '',
            'texto' => ''
         ]);

         $tema = Tema::create([
            'nombre' => 'cpuente',
            'color' => '#1b2638',
            'color_icono' => '',
            'color_texto' => '#f5efef',
            'family' => 'loto',
            'tamaño' => '',
            'texto' => ''
         ]);

         $tema = Tema::create([
            'nombre' => 'titulo',
            'color' => '#1ac5fe',
            'color_icono' => '',
            'color_texto' => '#e3eaec',
            'family' => 'loto',
            'tamaño' => '33px',
            'texto' => ''
         ]);

         $tema = Tema::create([
            'nombre' => 'btn_del',
            'color' => '#dc3545',
            'color_icono' => '#dc3545',
            'color_texto' => '#e8e0e1',
            'family' => 'loto',
            'tamaño' => '13px',
            'texto' => 'Borra el registro'
         ]);

         $tema = Tema::create([
            'nombre' => 'btn_subir',
            'color' => '#b5def1',
            'color_icono' => '#b5def1',
            'color_texto' => '#eff1f3',
            'family' => 'loto',
            'tamaño' => '13px',
            'texto' => 'Sube el orden del registro'
         ]);

         $tema = Tema::create([
            'nombre' => 'btn_bajar',
            'color' => '#a5d6a7',
            'color_icono' => '#a5d6a7',
            'color_texto' => '#eff1f3',
            'family' => 'loto',
            'tamaño' => '13px',
            'texto' => 'Baja el orden del registro'
         ]);

         $tema = Tema::create([
            'nombre' => 'neutro',
            'color' => '#343a40',
            'color_icono' => '#eff1f3',
            'color_texto' => '#eff1f3',
            'family' => 'loto',
            'tamaño' => '13px',
            'texto' => ''
         ]);

         //0.btn_login
         //1.btn_save
         //2.btn_new
         //3.btn_edit
         //4.btn_orden
         //5.btn_save_orden
         //6.cprimario
         //7.csecundario
         //8.cpuente
         //9.titulo
         //10.btn_del
         //11-btn_subir
         //12-btn_bajar
    }


}
