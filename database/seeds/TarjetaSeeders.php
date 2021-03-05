<?php

namespace Database\Seeders;

use App\Models\Tarjeta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TarjetaSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
            DB::table('tarjetas')->truncate();
            DB::table('image_tarjeta')->truncate();

        $postTres = Tarjeta::create([
                                    'id' => 1,
                                    'pagina' => 'servicio_tecnico',
                                    'orden' => 0,
                                    'category_id' => 5,
                                    'title' => 'ENTENDEMOS, AYUDAMOS Y ASESORAMOS',
                                    'subtitulo' => 'TECNOLOGÍA',
                                    'url_clean' => '',
                                    'content' => "El sector de la protección solar experimenta cambios constantes. Aparecen novedades, tanto de productos, como de tecnologías aplicadas a nuestro sector.
                                    En Sutoldo, nos preocupamos y preparamos para estar al corriente de las últimas innovaciones.
                                    
                                    Disponemos de un equipo de técnicos-comerciales experimentados y capacitados para asesorar a nuestros clientes en consultas técnicas, documentación técnica o cursos de formación.",
                                    'posted' => 'yes'                                   
        ]);
        $postTres->images()->sync([80, 81, 82]);

        $post = Tarjeta::create([
                                    'id' => 2,
                                    'pagina' => 'servicio_tecnico',
                                    'orden' => 1,
                                    'category_id' => 1,
                                    'title' => 'AYUDA Y ASESORAMIENTO',
                                    'subtitulo' => '',
                                    'url_clean' => '',
                                    'content' => "El proceso de venta de cualquier sistema de protección solar es complejo y laborioso. Por eso, en SUTOLDO nos involucramos en ayudar a nuestros clientes. Nuestros profesionales de comercial y tecnicos se encargan de prestar todo el servicio necesario para facilitar cualquier venta.

                                    Periódicamente editamos numeroso material comercial y publicitario de nuestros productos que sin duda suponen un respaldo importante en el momento de la venta:
                                    Catálogos y muestrarios de tejidos.

                                    Catálogos comerciales de todos los productos.

                                    Documentación y fichas técnicas.

                                    Tarifas de precios.

                                    Actualización de página WEB con productos y fichas técnicas de los mismos.

                                    Aplicación para dispositivos móviles con información comercial y técnica.",
                                    
                                    'posted' => 'yes'                                   
        ]);
        $post->images()->sync(658);

        $postTres = Tarjeta::create([
                                    'id' => 3,
                                    'pagina' => 'formacion',
                                    'orden' => 2,
                                    'category_id' => 5,
                                    'title' => 'FORMACIÓN EN TOLDOS',
                                    'subtitulo' => 'Y PÉRGOLAS',
                                    'url_clean' => '',
                                    'content' => "En nuestra fábrica de toldos y pérgolas en Leganés, disponemos de una gran exposición de productos y aula formativa en la que impartimos cursos técnicos y comerciales a nuestros clientes.<br><br>
                                     Cada año expertos de nuestros proveedores y personal técnico de Sutoldo hacen que cientos de profesionales puedan estar al día en lonas, toldos, cofres, pérgolas, motores para toldos, automatismos, domótica.",
                                    'posted' => 'yes'                                   
        ]);
        $postTres->images()->sync([463, 464, 465]);
        
        $postSlider = Tarjeta::create([
                                    'id' => 4,
                                    'pagina' => 'formacion',
                                    'orden' => 3,
                                    'category_id' => 2,
                                    'title' => '',
                                    'subtitulo' => '',
                                    'url_clean' => '',
                                    'content' => "",
                                    'posted' => 'not'                                   
        ]);
        $postSlider->images()->sync([ 687, 688, 690]);

        $postUna = Tarjeta::create([
                                    'id' => 5,
                                    'pagina' => 'formacion',
                                    'orden' => 4,
                                    'category_id' => 3,
                                    'title' => '',
                                    'subtitulo' => '',
                                    'url_clean' => '',
                                    'content' => "",
                                    'posted' => 'not'                                   
        ]);
        $postUna->images()->sync(424);

        $post = Tarjeta::create([
            'id' => 6,
            'pagina' => 'ventajas',
            'orden' => 5,
            'category_id' => 1,
            'title' => '¿QUE VENTAJAS TIENES CON NOSOTROS?',
            'subtitulo' => '',
            'url_clean' => '',
            'content' => "Todo se reduce a seriedad y eficacia. En una actividad estacional como es la protección solar, cada hora cuenta. Usted debe contar con una empresa
            que tenga los recursos, la capacidad, la pericia y el compromiso para atender sus necesidades de manera ágil y seria. Le ofrecemos:<br><br>

            - Gran variedad de productos<br>
            - Alta calidad de los materiales utilizados en la fabricación de toldos y pérgolas<br>
            - Amplio stock para una rápida respuesta<br>
            - Medios técnicos, personales y comerciales<br>
            - Servicio ágil y profesional<br>
            - Respetamos y apoyamos a nuestros clientes. Venta exclusiva al profesional<br><br>


            Razones por las que muchas empresas y profesionales del sector del toldo cada año confían en Sutoldo, posicionada como una de las fábricas de toldos más importantes en La Comunidad de Madrid",
            
            'posted' => 'yes'                                   
        ]);
        $post->images()->sync(658);

        $post = Tarjeta::create([
            'id' => 7,
            'pagina' => 'contacto',
            'orden' => 6,
            'category_id' => 1,
            'title' => 'Si necesitas ponerte en contacto con nosotros:',
            'subtitulo' => '',
            'url_clean' => '',
            'content' => "
                            Avda. de los Metales 8.
                            28914 Leganés <br><br>

                            comercial@sutoldo.com<br>
                            91 6944986",
            
            'posted' => 'yes'                                   
            ]);
            $post->images()->sync(425);



        DB::statement("SET foreign_key_checks=1");
     
    }
}
