<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
            DB::table('posts')->truncate();
            DB::table('image_post')->truncate();

        $postTres = Post::create([
               'id' => 4,
               'orden' => 0,
               'category_id' => 5,
               'title' => 'MODERNOS MEDIOS DE PRODUCCIÓN',
               'subtitulo' => 'TECNOLOGÍA',
               'url_clean' => '',
               'content' => "Contamos con modernos medios de producción.
               La confección de los tejidos es la parte más laboriosa de una fábrica de toldos.
               En una actividad tan estacional como es la fabricación de toldos, estamos preparados para dar respuesta a los pedidos en un corto espacio de tiempo.
               En este área disponemos de los mejores medios que nos permite desarrollar la actividad en cadena con personal especializado en cada labor.",
               'posted' => 'yes'                                   
        ]);
        $postTres->images()->sync([421, 422, 423]);
        
        $postSlider = Post::create([
                                    'id' => 1,
                                    'orden' => 3,
                                    'category_id' => 2,
                                    'title' => '',
                                    'subtitulo' => '',
                                    'url_clean' => '',
                                    'content' => "",
                                    'posted' => 'yes'                                   
        ]);
        $postSlider->images()->sync([ 469, 426, 429, 431, 168, 371, 340, 432]);

        $post = Post::create([
                                    'id' => 2,
                                    'orden' => 1,
                                    'category_id' => 1,
                                    'title' => 'ÚLTIMAS',
                                    'subtitulo' => 'NOVEDADES',
                                    'url_clean' => '',
                                    'content' => "Estar al día, innovar, ofrecer a nuestros clientes sistemas y productos nuevos forma parte de la filosofía de Sutoldo.
                                    Últimas novedades incorporadas por Sutoldo:
                                    
                                       NUEVOS PRODUCTOS:
                                    
                                    Sistema de macarrón Omega en la confección de pérgolas que garantiza total impermeabilidad de las lonas confeccionadas con este sistema
                                    
                                    Brazos extensibles de cinta para toldos y cofres con luces LED integrados.
                                    
                                    Cofres QUBICA Plumb y Light.Cofres de diseño y alta gama, especialmente indicados para la arquitectura moderna
                                    
                                    Sistema de bloqueo automático para los verticales ZIP, “Secure Wind Block System”
                                    
                                       TRANSPORTE
                                    
                                    Incorporación de un nuevo camión que permite aumentar la capacidad de reparto y mejorar el servicio a nuestros clientes
                                    
                                       NUEVO DISEÑO WEB
                                    
                                    Nueva pagina para beneficio de nuestros usuarios
                                    
                                       DIGITALIZACIÓN:
                                    
                                    Creación y puesta en marcha de una aplicación que permite a nuestros clientes, disponer en sus dispositivos móviles de nuestros catálogos y tarifas",
                                    
                                    'posted' => 'yes'                                   
        ]);
        $post->images()->sync(78);


        $postUna = Post::create([
                                    'id' => 3,
                                    'orden' => 2,
                                    'category_id' => 3,
                                    'title' => '',
                                    'subtitulo' => '',
                                    'url_clean' => '',
                                    'content' => "",
                                    'posted' => 'yes'                                   
        ]);
        $postUna->images()->sync(424);

        $post = Post::create([
                                    'id' => 5,
                                    'orden' => 4,
                                    'category_id' => 1,
                                    'title' => '',
                                    'subtitulo' => 'TRABAJAMOS PARA TI',
                                    'url_clean' => '',
                                    'content' => "SUTOLDO es una fábrica de toldos y pérgolas exclusivamente para el profesional.

                                    En nuestra fábrica de toldos la tradición no está reñida con la tecnología moderna. Fabricamos toldos de calidad, con unos plazos de entrega muy reducidos, aplicando unas tarifas especialmente estudiadas para que su empresa pueda ser ágil y competitiva en el mercado.
                                    
                                    La calidad, el servicio y la eficacia son para nosotros principios irrenunciables.
                                    
                                    En Sutoldo, te ofrecemos apoyo, estamos siempre dispuestos a ayudarte para que tu empresa venda más. Somos conscientes de que tu éxito será nuestro éxito.",
                                    'posted' => 'yes'                                   
        ]);
        $post->images()->sync(79);

        DB::statement("SET foreign_key_checks=1");
     
    }
}
