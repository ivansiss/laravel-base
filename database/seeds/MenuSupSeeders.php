<?php

namespace Database\Seeders;

use App\Models\Menusuperior;
use App\Models\Pie;
use Illuminate\Database\Seeder;

class MenuSupSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = new Menusuperior();

        $menu->id = 1;
        $menu->btn = 'Nivel0';
        $menu->route = '';
        $menu->padre = 0;
        $menu->icono = '';
        $menu->orden = 0;
        $menu->activado = 0;
        $menu->tipo = "null";
        $menu->save();

        $menu = new Menusuperior();

        $menu->id = 2;
        $menu->btn = 'Inicio';
        $menu->route = '/';
        $menu->padre = 0;
        $menu->icono = '';
        $menu->orden = 1;
        $menu->activado = 1;
        $menu->tipo = "web";
        $menu->save();

        $menu = new Menusuperior();

        $menu->id = 3;
        $menu->btn = 'Servicios';
        $menu->route = 'servicios';
        $menu->padre = 0;
        $menu->icono = '';
        $menu->orden = 2;
        $menu->activado = 1;
        $menu->tipo = "web";
        $menu->save();

        $menu = new Menusuperior();

        $menu->id = 4;
        $menu->btn = 'Contacto';
        $menu->route = 'contacto';
        $menu->padre = 0;
        $menu->icono = '';
        $menu->orden = 3;
        $menu->activado = 1;
        $menu->tipo = "web";
        $menu->save();

        $menu = new Menusuperior();

        $menu->id = 5;
        $menu->btn = 'Soporte Técnico';
        $menu->route = 'servicios/soporte-tecnico';
        $menu->padre = 3;
        $menu->icono = '';
        $menu->orden = 0;
        $menu->activado = 1;
        $menu->tipo = "web";
        $menu->save();

        $menu = new Menusuperior();

        $menu->id = 6;
        $menu->btn = 'Formacion';
        $menu->route = 'servicios/formacion-toldos';
        $menu->padre = 3;
        $menu->icono = '';
        $menu->orden = 1;
        $menu->activado = 1;
        $menu->tipo = "web";
        $menu->save();

        $menu = new Menusuperior();

        $menu->id = 7;
        $menu->btn = 'Ventajas comerciales';
        $menu->route = 'servicios/ventajas-comerciales';
        $menu->padre = 3;
        $menu->icono = '';
        $menu->orden = 2;
        $menu->activado = 1;
        $menu->tipo = "web";
        $menu->save();


        $pie = new Pie();

        $pie->id = 1;
        $pie->empresa ='Sutoldo S.L.';
        $pie->texto ='Sutoldo, fábrica de toldos y pérgolas, una empresa formada por profesionales dedicados durante muchos años a la fabricación y venta de toldos.Nuestro equipo, altamente motivado, lleva a cabo los trabajos siempre teniendo en cuenta su completa satisfacción.

        Nos dedicamos a fabricar y comercializar toldos, pérgolas y otros artículos de protección solar para el toldero instalador. Realizamos una venta exclusiva al profesional Fábrica y oficinas en Leganés, MADRID';
        $pie->novedades1 ='st-plus';
        $pie->novedades2 ='serie-125x80';
        $pie->novedades3 ='front-shadow';
        $pie->enlace1 ='Aviso legal';
        $pie->enlace2 ='Politica de privacidad';
        $pie->enlace3 ='Politica de cookies';
        $pie->direccion ='Avda. de los Metales 8. <br> 28914 Leganés';
        $pie->email ='comercial@sutoldo.com';
        $pie->telefono ='916944986';
        $pie->fax ='916944986';
        $pie->horario ='
                            <br>
                            &nbsp;&nbsp;&nbsp;&nbsp; lunes	9:00–14:00, 15:30–18:30<br>
                            &nbsp;&nbsp;&nbsp;&nbsp; martes	9:00–14:00, 15:30–18:30<br>
                            &nbsp;&nbsp;&nbsp;&nbsp; miércoles	9:00–14:00, 15:30–18:30<br>
                            &nbsp;&nbsp;&nbsp;&nbsp; jueves	9:00–14:00, 15:30–18:30<br>
                            &nbsp;&nbsp;&nbsp;&nbsp; viernes	9:00–14:00, 15:30–18:30<br>
                            &nbsp;&nbsp;&nbsp;&nbsp; sábado	Cerrado<br>
                            &nbsp;&nbsp;&nbsp;&nbsp; domingo	Cerrado';
       
        $pie->save();
    }
}
