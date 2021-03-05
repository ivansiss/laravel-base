<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class productSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
 
        $productos = $this->colocarProducto();
        $imageProduct = $this->colocarImageProduct();
        
                foreach ($productos as $item) {

                        $miproducto = Product::create([
                                                            'id' => $item['id'],
                                                        'titulo' => $item['nombre'],
                                                    'subtitulo' => $item['titulo_comp'],
                                                        'resena' => $item['descripcion'],
                                                    'contenido' => $item['descripcion_comp'],
                                                        'pdf' => $item['pdf'],
                                                'precio_ahora' => 0,
                                                'precio_antes' => 0,
                                            'precio_liquidacion' => 0,
                                                        'estado' => 'yes',
                                                        'stock' => 0,
                                                        'slug' => $item['url_amigable'],
                                                    'num_ventas' => 0,
                                                        'orden' => $item['orden'],
                                                        'padre' => $item['padre'],
                        ]);

                        $id_img_all = [];
                        foreach ($imageProduct as $item_img) {

                            if($miproducto->id == $item_img['id_producto']){
                                array_push($id_img_all, $item_img['id_imagen']);
                            }
                        }

                        $miproducto->images()->sync( $id_img_all );
                }
            

        //Schema::enableForeignKeyConstraints();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }//fin run

    public function colocarProducto(){
        
        return array(
            array('id' => '4','padre' => '0','nombre' => 'Toldos verticales y Front','descripcion' => '','titulo_comp' => '','descripcion_comp' => '','pdf' => '','orden' => '2','title' => '','title_desc' => '','img' => '','url_amigable' => '#','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '8','padre' => '0','nombre' => 'Capotas','descripcion' => '','titulo_comp' => '','descripcion_comp' => '','pdf' => '','orden' => '5','title' => '','title_desc' => '','img' => '','url_amigable' => '#','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '11','padre' => '0','nombre' => 'Complementos','descripcion' => '','titulo_comp' => '','descripcion_comp' => '','pdf' => '','orden' => '6','title' => '','title_desc' => '','img' => '','url_amigable' => '#','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '164','padre' => '0','nombre' => 'Toldos clásicos','descripcion' => '','titulo_comp' => '','descripcion_comp' => '','pdf' => '','orden' => '0','title' => '','title_desc' => '','img' => '','url_amigable' => '#','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '166','padre' => '0','nombre' => 'Lonas','descripcion' => '','titulo_comp' => '','descripcion_comp' => '','pdf' => '','orden' => '7','title' => '','title_desc' => '','img' => '','url_amigable' => '#','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '172','padre' => '0','nombre' => 'Cofres','descripcion' => '','titulo_comp' => '','descripcion_comp' => '','pdf' => '','orden' => '1','title' => '','title_desc' => '','img' => '','url_amigable' => '#','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '219','padre' => '0','nombre' => 'Pérgolas','descripcion' => '','titulo_comp' => '','descripcion_comp' => '','pdf' => '','orden' => '4','title' => '','title_desc' => '','img' => '','url_amigable' => '#','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '220','padre' => '0','nombre' => 'Verandas','descripcion' => '','titulo_comp' => '','descripcion_comp' => '','pdf' => '','orden' => '3','title' => '','title_desc' => '','img' => '','url_amigable' => '#','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '221','padre' => '0','nombre' => 'Motorización','descripcion' => '','titulo_comp' => '','descripcion_comp' => '','pdf' => '','orden' => '8','title' => '','title_desc' => '','img' => '','url_amigable' => '#','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '307','padre' => '0','nombre' => 'Fábrica','descripcion' => '','titulo_comp' => '','descripcion_comp' => '','pdf' => '','orden' => '9','title' => '','title_desc' => '','img' => '','url_amigable' => '#','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '127','padre' => '8','nombre' => 'Practic','descripcion' => '<h4>Capota Practic</h4> <br>
                          Sistema para protección solar plegable. Compuesto por estructura de aluminio de cuatro arcos tapizados con lona. El plegado de la capota es manual mediante tiro de cuerda. <br>
                          Representa una interesante opción para la protección solar de ventanas de pequeñas y medianas dimensiones. Aporta sombra, e intimidad.<br>','titulo_comp' => 'Características','descripcion_comp' => '-Estructura de 4 arcos, abatible, tapizada en lona<br>
                          -Perfiles de aluminio extrusionado<br>
                          -Instalación dentro o fuera del hueco de la ventana<br>
                          -Medias máximas recomendadas 300x120<br>
                          -Sistema de anclaje sobre “perchas”<br>
                          -Maniobra de recogida con cuerda<br>','pdf' => 'ficha_tecnica_capota.pdf','orden' => '0','title' => 'Capota Practic - Sutoldo','title_desc' => 'Toldo capota practic, un sistema protección solar, formado por una estructura cuatro arcos tapizados con lona plegable.','img' => 'capota_10.jpg','url_amigable' => 'capota-practic','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '128','padre' => '11','nombre' => 'Front Shadow','descripcion' => '<h4>Front Shadow</h4><br>
                          Diseñado para proyectar sombras vertical, como complemento a los toldos extensibles.<br>
                          El perfil de carga se ha diseñado para contener un tubo de enrolle. ','titulo_comp' => 'Características','descripcion_comp' => '- Maniobra manual.<br>
                          - Perfilería y accesorios en aluminio extrusionado .<br>
                          - Pletina contrapeso. <br>','pdf' => 'ficha_tecnica_front_shadow.pdf','orden' => '33','title' => 'Front Shadow - Sutoldo','title_desc' => 'Toldo front shadow proyecta sombra vertical, es un complemento para toldos extensibles.','img' => 'frontShadow2.jpg','url_amigable' => 'front-shadow','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '129','padre' => '11','nombre' => 'Mampara NOWIND','descripcion' => '<h4>Mampara NOWIND</h4><br>
          
                          Las mamparas NOWIND, son un excelente elemento de protección para terrazas.<br>
                          Consta de dos partes:<br>
                          <b>Módulo fijo</b>. Los postes verticales son muy robusto y permiten la incorporación de bases de instalación de diversos formatos, en función de las exigencias de las normativas municipales, y la instalación del módulo móvil.<br>
                          <b>Módulo móvil</b>. Es un marco de perfileria de aluminio que desliza sobre unas guías instaladas en los postes del módulo fijo elevando la altura de la mampara hasta 800mm. Dispone de una cremallera que permite regular la altura de la mampara adaptándola a las necesidades de confort de la terraza.','titulo_comp' => 'Características técnicas','descripcion_comp' => '-Mampara fija o extensible<br>
                          -Cristal templado de 5mm en la parte fija y policarbonato en la parte móvil<br>
                          -Aluminio extrusionado<br>
                          -Fijación a suelo o móvil<br>','pdf' => 'ficha_tecnica_mampara.pdf','orden' => '0','title' => 'Mampara nowind - Sutoldo','title_desc' => 'Mampara extensible Nowind puede ser fija o móvil con aluminio extrusionado y cristal templado de 5mm.','img' => 'mampara3.jpg','url_amigable' => 'mampara-nowind','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '130','padre' => '11','nombre' => 'Pie Telescópico','descripcion' => '<h4>Pie Telescópico</h4><br>
                          El Pie Telescópico  es un accesorio que aporta seguridad a toldos y cofres extensibles.<br>
                          Permite fijar el toldo al suelo, evitando así vibraciones y daños provocados por golpes de viento.<br>
                          Desmontable. Se puede desmontar fácilmente con un simple giro, quedando la base en el suelo.','titulo_comp' => 'Características Técnicas ','descripcion_comp' => '-Telescópico, se adapta a cualquier  altura hasta 2,75<br>
                          -Sujeción a suelo con base metálica <br>
                          -Plegable al perfil delantero del toldo<br>
                          -Desmontable.<br
                          -Base con formas redondeadas para evitar tropiezos<br>
                          -<b>No utilizar este producto si el toldo funciona con motor</b><br>','pdf' => 'ficha_tecnica_pata_extensible.pdf','orden' => '0','title' => 'Pie Telescopico - Sutoldo','title_desc' => 'El Pie Telescópico es un accesorio que aporta seguridad a toldos y cofres extensibles. Permite fijar el toldo al suelo, evitando así vibraciones y daños provocados por golpes de viento.','img' => 'pie_extensible1.jpg','url_amigable' => 'pie-telescopico','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '131','padre' => '232','nombre' => 'ST Eco','descripcion' => '<h4>ST Eco</h4> <br>
                          Toldo de brazos extensibles sobre soportes independientes laterales que
                          permiten la cómoda regulación del ángulo del brazo.<br>
                          Brazos extensibles con sistema "<i>Balteus</i>" mantienen la lona siempre tensa.','titulo_comp' => 'Características ','descripcion_comp' => '-Inclinación desde 0º  hasta 90º. <br>
                          -Soportes laterales de inyección de aluminio. <br>
                          -Posibilidad de anclar a pared, techo o costado.<br>
                          -Brazos extensibles de cinta, sistema “<i>BALTEUS</i>”.<br>
                          -Sistema SPIN en los brazos, evita el roce de elementos metálicos con la lona.<br>
                          -Se puede instalar con manivela o motor. <br>
                          -Posibilidad de lacar en múltiples colores. <br>','pdf' => 'ficha_tecnica_st_eco.pdf','orden' => '0','title' => 'Toldo extensible ST Eco - Sutoldo','title_desc' => 'Toldo ST Eco de brazos extensibles con sistema "Balteus" que mantienen la lona siempre tensa.','img' => 'st_eco_7.jpg','url_amigable' => 'toldo-extensible-st-eco','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '132','padre' => '232','nombre' => 'ST 360','descripcion' => '<h4>ST 360</h4><br>
                          Toldo de brazos extensibles sobre soportes independientes laterales que permiten la cómoda regulación del ángulo del brazo.<br>
                          Particularmente ágil, desde 0º a 85º grados. Versátil y fácil de instalar,
                          de diseño robusto pero al mismo tiempo elegante.<br>','titulo_comp' => 'Características','descripcion_comp' => '-Inclinación desde 0º  hasta 85º. <br>
                          -Soportes laterales de inyección de aluminio. <br>
                          -Posibilidad de anclar a pared, techo o costado.<br>
                          -Brazos de gran tensión con sistema de cinta “<i>BALTEUS</i>”.<br>
                          -Sistema <i>SPIN</i> en los brazos, evita el roce de elementos metálicos con la lona.<br>
                          -Se puede instalar con manivela o motor. <br>
                          -Permite sistema de brazos cruzados.<br>
                          -Posibilidad de lacar en múltiples colores. <br>
                          -Admite brazos con luces LED integradas.<br>
                          ','pdf' => 'ficha_tecnica_ST360.pdf','orden' => '0','title' => 'Toldo extensible ST 360 - Sutoldo','title_desc' => 'Toldo ST 360 con brazos extensibles con sistema de cinta, con soportes independientes laterales que permiten regular la inclinación de los brazos.','img' => 'St_360_7.jpg','url_amigable' => 'toldo-extensible-st-360','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '133','padre' => '232','nombre' => 'Monobloc 410','descripcion' => '<h4>MONOBLOC 410</h4> <br>
                          Toldo con brazos extensibles sobre barra cuadrada de 40mm en acero galvanizado y lacado, brazos con sistema de cinta "<i>BALTEUS</i>" y soporte de brazo en fundición o extrusión de aluminio según medida.<br>
                          Es un toldo modular: añadiendo más perfiles se puede alcanzar una mayor longitud. <br>','titulo_comp' => 'Características ','descripcion_comp' => '-Anclaje con soportes y barra de hierro de 40x40.<br>
                          -Inclinación desde 0º  hasta 60º. <br>
                          -Posibilidad de anclar a pared o techo.<br>
                          -Brazos de gran tensión con sistema de cinta “<i>BALTEUS</i>”.<br>
                          -Permite añadir más de dos brazos.<br>
                          -Sistema <i>SPIN</i>  en los brazos, evita el roce de elementos metálicos con la lona.<br>
                          -Se puede instalar con manivela o motor. <br>
          
                          -Permite sistema de brazos cruzados.<br>
          
                          -Posibilidad de lacar en múltiples colores. <br>
                          -Admite brazos con luces LED integradas.<br>','pdf' => 'ficha_tecnica_monobloc_410.pdf','orden' => '0','title' => 'Toldo extensible monobloc 410 - Sutoldo','title_desc' => 'Toldo monobloc 410 modular de brazos extensibles con sistema "Balteus", sobre barra cuadrada de acero, añadiendo más perfiles, permite mayor longitud.','img' => 'monobloc410_3.jpg','url_amigable' => 'toldo-extensible-monobloc-410','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '134','padre' => '232','nombre' => 'Monobloc 485','descripcion' => '<h4>Monobloc 485</h4><br>
                          Toldo de brazos extensibles sobre barra cuadrada de acero 50 mm. Los soportes de aluminio extruido garantizan la resistencia y la solidez.<br>
                          Solidez y diseño son las características que lo convierten en la solución ideal para coberturas de espacios públicos o privados de amplias dimensiones. Dispone de un brazo tipo spin, construido expresamente con accesorios forjados.','titulo_comp' => 'Características ','descripcion_comp' => '-Anclaje con soportes y barra de hierro de 50x50.<br>
                          -Inclinación desde 0º  hasta 45º. <br>
                          -Posibilidad de anclar a pared o techo.<br>
                          -Brazos de gran tensión de cinta sistema <i>"BALTEUS GIANT"</i> o cadena de doble eslabón.<br>
                          -Sistema <i>SPIN</i>  en los brazos, evita el roce de elementos metálicos con la lona.<br>
                          -Este toldo solo con motor. <br>
                          -Permite sistema de brazos cruzados.<br>
                          -Posibilidad de lacar en múltiples colores.<br>
                          ','pdf' => 'ficha_tecnica_monobloc_485.pdf','orden' => '0','title' => 'Toldo extensible monobloc 485 - Sutoldo','title_desc' => 'Toldo monobloc 485, con brazos de gran tensión de cinta sistema "BALTEUS GIANT" o cadena de doble eslabón sobre barra de acero.','img' => 'monobloc485_1.jpg','url_amigable' => 'toldo-extensible-monobloc-485','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '135','padre' => '164','nombre' => 'Punto recto','descripcion' => '<h4>Punto recto</h4><br>
                          Toldo diseñado para balcones o ventanas y otras estructuras. El sistema del toldo de punto recto es muy fácil de manejar, permite ser instalado en el frente, techo o costado.<br>
                          Al extender el toldo, estos brazos bajan formando ángulos de hasta 180º. Ofrece la posibilidad de instalación con brazos de tensión, que permiten que el toldo tenga una mayor estabilidad contra el viento.','titulo_comp' => 'Características','descripcion_comp' => '-Juego de brazos con opción de ser con tensión.<br>
                          -Juego de soportes de hierro lacado.<br>
                          -Maniobra manual o motorizado.<br>
                          -Fijación pared, techo o costado.<br>
                          -Perfilería y brazos en aluminio extrusionado.<br>
                          -Soportes en hierro lacado. Posibilidad de soportes en aluminio.<br>
                          -Confeccionable con cualquier tipo de tejido.<br>
                          -Posibilidad de lacar en múltiples colores. <br>
                          ','pdf' => 'ficha_tecnica_punto_recto.pdf','orden' => '0','title' => 'Toldo punto recto - Sutoldo','title_desc' => 'Toldo punto recto, diseñado para balcones o ventanas y otras estructuras. Sistema muy fácil de manejar. Perfilería y brazos en aluminio extrusionado.','img' => 'punto_recto_3.jpg','url_amigable' => 'toldo-punto-recto','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '136','padre' => '164','nombre' => 'Stor','descripcion' => '<h4>Toldo Stor</h4> <br>
          
                          Toldo diseñado para balcones y terrazas con techo. Consta de brazos de 50 cm montados en el tubo de carga que suben y bajan con el toldo. Fijación sobre la baranda del balcón, mediante una pieza que permite dos tipos de sujeción: Vertical o con inclinación. <br>','titulo_comp' => 'Características','descripcion_comp' => '-Juego de soportes de hierro lacado. <br>
                          -Perfilería y brazos en aluminio extrusionado.<br>
                          -Soportes en hierro lacado. Posibilidad de soportes en aluminio.<br>
                          -Posibilidad de anclar a pared, techo o costado.<br>
                          -Brazos stor, anclados al tubo de carga del toldo.<br>
                          -Se puede instalar con manivela o motor. <br>
                          -Posibilidad de lacar en múltiples colores. <br>
                          ','pdf' => 'ficha_tecnica_toldo_stor.pdf','orden' => '0','title' => 'Toldo Stor - Sutoldo','title_desc' => 'Toldo stor diseñado para balcones y terrazas con techo, con brazos de 50 cm montados en el tubo de carga, que suben y bajan con el toldo.','img' => 'stor_1.jpg','url_amigable' => 'toldo-stor','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '137','padre' => '172','nombre' => 'St 410','descripcion' => '<h4>Cofre St 410</h4><br>
                          Cofre de brazos extensibles con cierre total.<br>
                          Sistema de inclinación BAT donde basculan lona y perfil frontal, permaneciendo la parte trasera del cofre siempre en la misma posición.<br>','titulo_comp' => 'Características','descripcion_comp' => '-Toldo en cofre, cerrado protege lona y los elementos mecánicos del toldo.<br>
                          -Sistema de inclinación BAT.<br>
                          -Inclinación desde 0º hasta 40º, basculan lona y perfil frontal, permaneciendo la parte trasera del cofre siempre en la misma  posición. <br>
                          -Posibilidad de anclar a pared o techo con escuadras.<br>
                          -La posición de los brazos en el toldo coincide con las perchas de sujeción.<br>
                          -Admite más de dos brazos, estos no van a los extremos.<br>
                          -Brazos de gran tensión con sistema de cinta “<i>BALTEUS</i>”.<br>
                          -Este toldo siempre irá motorizado. <br>
                          -Posibilidad de lacar en múltiples colores. <br>
                          -Admite brazos con luces LED integradas.<br>
                          ','pdf' => 'ficha_tecnica_cofre_410.pdf','orden' => '0','title' => 'Cofre 410 - Sutoldo','title_desc' => 'Cofre ST 410 de brazos extensibles con cierre total, que protege la lona y los elementos mecánicos del toldo.','img' => 'cofre_410_8.jpg','url_amigable' => 'cofre-410','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '138','padre' => '172','nombre' => 'Minicofre','descripcion' => '<h4>Minicofre</h4><br>
                          El minicofre es un toldo en cofre que protege la lona cuando esta recogido y con brazos tensión mantiene la lona siempre tensa.<br>
                          Cerrado oculta la lona aportando discreción y sencillez.<br>','titulo_comp' => 'Características','descripcion_comp' => '-Toldo en cofre para brazos de portada o stor.<br>
                          -Permite una inclinación de hasta 180º.<br>
                          -Sujeción mediante anclaje tipo percha. <br>
                          -Posibilidad de anclar a pared o techo.<br>
                          -Con brazos de tensión mantienen la lona tensa.<br>
                          -Se puede instalar con manivela o motor. <br>
                          -Posibilidad de lacar en múltiples colores. <br>
                          ','pdf' => 'ficha_tecnica_minicofre.pdf','orden' => '0','title' => 'Minicofre - Sutoldo','title_desc' => 'Toldo minicofre, protege la lona cuando esta recogido, admite brazos stor o de portada,  con brazos tensión mantiene la lona siempre tensa. ','img' => 'minicofre_2.jpg','url_amigable' => 'minicofre','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '139','padre' => '172','nombre' => 'St Base','descripcion' => '<h4>St Base</h4><br>
                          Toldo cofre de brazos extensibles sistema <i>"BALTEUS"</i> sobre soportes laterales fijos con contra placa de anclaje.<br>
                          Los soportes permiten instalar el toldo a pared o a techo.<br>
                          Permite regular la posición del eje de  los brazos para el correcto cierre del cofre.<br>','titulo_comp' => 'Características','descripcion_comp' => '-Toldo en cofre, cerrado protege lona y los elementos mecánicos del toldo.<br>
                          -Inclinación de los brazos regulable por sistema de cremallera hasta 75º.<br>
                          -Anclado a pared o techo con sistema de perchas a los extremos.<br>
                          -Brazos extensibles con sistema de cinta “<i>BALTEUS</i>”.<br>
                          -Sistema <i>SPIN</i> en los brazos, evita el roce de elementos metálicos con la lona.<br>
                          -Se puede instalar con manivela o motor.<br>
                          -Posibilidad de lacar en múltiples colores.<br>
                          ','pdf' => 'ficha_tecnica_st_base.pdf','orden' => '0','title' => 'St Base - Sutoldo','title_desc' => 'Toldo cofre ST Base con brazos extensibles sistema "BALTEUS". Opción de instalar el toldo a pared o a techo. Regulable el eje de brazos para cierre del cofre.','img' => 'st_base_6.jpg','url_amigable' => 'st-base','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '140','padre' => '172','nombre' => 'St Plus','descripcion' => '<h4>St Plus </h4><br>
                          Cofre de brazos extensibles sobre soportes laterales fijos con contraplaca de anclaje. <br>
                          Los soportes permiten instalar el toldo tanto a pared como en el techo y además de los tornillos de microregulación, que permiten un acoplamiento perfecto de los perfiles, disponen también de un nuevo sistema de inclinación del toldo con tornillos pasantes.
          
                          Permite regular la posición del eje de  los brazos para el correcto cierre del cofre.<br>','titulo_comp' => 'Características','descripcion_comp' => '-Toldo en cofre, cerrado protege lona y los elementos mecánicos del toldo.<br>
                          -Inclinación de los brazos regulable por sistema de cremallera hasta 75º.<br>
                          -Anclado a pared o techo con sistema de perchas a los extremos.<br>
                          -Brazos de gran tensión con sistema de cinta “<i>BALTEUS</i>”.<br>
                          -Sistema <i>SPIN</i> en los brazos, evita el roce de elementos metálicos con la lona.<br>
                          -Se puede instalar con manivela o motor.<br>
                          -Posibilidad de lacar en múltiples colores.<br>','pdf' => 'ficha_tecnica_st_plus.pdf','orden' => '0','title' => 'St Plus - Sutoldo','title_desc' => 'Toldo cofre ST Plus con brazos de cinta “BALTEUS”, los tornillos de microregulación permiten acoplar los perfiles, además de un nuevo sistema de inclinación.','img' => 'st_plus_7.jpg','url_amigable' => 'st-plus','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '141','padre' => '175','nombre' => 'Domina','descripcion' => '<h4>Domina</h4><br>
                          Toldo cofre, moderno de brazos extensibles sistema <i>"BALTEUS"</i> sobre soportes laterales fijos con contra placa de anclaje.<br>
                          Domina es fácil de ensamblar, ajustar y colocar con la máxima seguridad y calidad.<br>
                          ','titulo_comp' => 'Características','descripcion_comp' => '-Toldo en cofre, cerrado protege lona y los elementos mecánicos del toldo.<br>
                          -Inclinación de los brazos regulable por sistema de cremallera hasta 80º. <br>
                          -Anclado a pared o techo con  sistema de perchas, a los extremos.<br>
                          -Posibilidad de anclar a pared o techo .<br>
                          -Brazos de gran tensión con sistema de cinta “<i>BALTEUS</i>”.<br>
                          -Deberá de ir siempre con motor. <br>
                          -Posibilidad de lacar en múltiples colores. <br>
                          -Admite brazos con luces LED integradas.<br>','pdf' => 'ficha_tecnica_domina.pdf','orden' => '0','title' => 'Domina - Sutoldo','title_desc' => 'Toldo cofre Domina, de líneas modernas con  brazos extensibles sistema BALTEUS, fácil de colocar con la máxima seguridad y calidad.','img' => 'domina_2.jpg','url_amigable' => 'domina','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '142','padre' => '172','nombre' => 'Veneto','descripcion' => '<h4>Veneto</h4><br>
                          VENETO uno de los producto punteros en la gama de los cofres de brazos extensibles.<br>
                          Caracterizado por la extrema facilidad de montaje, regulación e instalación, garantiza los estándares de seguridad y elevada calidad de un modelo de esta categoría.<br>','titulo_comp' => 'Características','descripcion_comp' => '-Toldo en cofre, cerrado protege lona y los elementos mecánicos del toldo.<br>
                          -Inclinación de los brazos regulable por sistema de cremallera hasta 80º. <br>
                          -Anclado a pared o techo con  sistema de perchas, a los extremos.<br>
                          -Posibilidad de anclar a pared o techo.<br>
                          -Brazos de gran tensión con sistema de cinta “<i>BALTEUS</i>”.<br>
                          -Deberá de ir siempre con motor. <br>
                          -Posibilidad de lacar en múltiples colores. <br>
                          -Admite brazos con luces LED integradas.<br>','pdf' => 'ficha_tecnica_veneto.pdf','orden' => '0','title' => 'Veneto - Sutoldo','title_desc' => 'Toldo cofre Veneto, puntero en la gama de los cofres de brazos extensibles. Fácil montaje, regulación e instalación.','img' => 'veneto_5.jpg','url_amigable' => 'veneto','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '143','padre' => '172','nombre' => 'Qubica LIGHT','descripcion' => '<h4>Qubica LIGHT</h4><br>
                          Novedad en la categoría de toldos cofre de brazos extensibles con soportes laterales; se caracteriza por sus líneas sobrias y puras, los elementos de fijación y la tornillería permanecen ocultos. <br>
                          Las piezas del toldo se pueden personalizar con diferentes combinaciones de colores, por lo cual cuando se encuentra cerrado es un elemento más de decoración de fachadas.<br>','titulo_comp' => 'Características','descripcion_comp' => '-Toldo en cofre, cerrado protege lona y los elementos mecánicos del toldo.<br>
                          -Inclinación de los brazos regulable por sistema de cremallera de 10º hasta 80º grados.<br>
                          -Soportes y brazos a los extremos.<br>
                          -Brazos extensibles con sistema de cinta “<i>BALTEUS</i>”.<br>
                          -Tornillería totalmente oculta.<br>
          
                          -Modelo exclusivamente motorizado.<br>
                          -Permite combinar dos colores en la estructura.<br>
          
                          -Admite brazos con luces LED integradas.<br>','pdf' => 'ficha_tecnica_qubica_light.pdf','orden' => '0','title' => 'Qubica LIGHT - Sutoldo','title_desc' => 'Toldo Qubica Light de brazos extensibles,  caracterizado por sus líneas sobrias y puras permite combinación de colores, creando un elemento más de decoración.','img' => 'qubica_light_2.jpg','url_amigable' => 'qubica-light','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '144','padre' => '172','nombre' => 'Qubica PLUMB','descripcion' => '<h4>Qubica PLUMB</h4><br>
                          Nuevo concepto de cofre de diseño sofisticado con pureza de lineas acorde a la nueva arquitectura.<br>
                          Sistema de inclinación BAT donde basculan lona y perfil frontal, permaneciendo la parte trasera del cofre siempre en la misma posición.<br>','titulo_comp' => 'Características','descripcion_comp' => '-Toldo en cofre, cerrado protege lona y los elementos mecánicos del toldo.<br>
                          -Inclinación desde 0º hasta 40º, basculan lona y perfil frontal, permaneciendo la parte trasera del cofre siempre en la misma posición. <br>
                          -Brazos de gran tensión con sistema de cinta “<i>BALTEUS</i>”.<br>
                          -La posición de los brazos en el toldo coincide con las perchas de sujeción.<br>
                          -Admite más de dos brazos, estos no van a los extremos.<br>
                          -Tornillería totalmente oculta.<br>
                          -Modelo exclusivamente motorizado.<br>
                          -Permite combinar dos colores en la estructura.<br>
                          -Admite brazos con luces LED integradas.<br>','pdf' => 'ficha_tecnica_qubica_plumb.pdf','orden' => '0','title' => 'Qubica PLUMB - Sutoldo','title_desc' => 'Toldo cofre Qubica Plumb de líneas sobrias y puras, con brazos extensibles, acorde a la nueva arquitectura. ','img' => 'qubica_plumb_5.jpg','url_amigable' => 'qubica-plumb','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '145','padre' => '11','nombre' => 'Cortina Lateral','descripcion' => '<h4>Cortina Lateral con Cofre</h4><br>
          
                          Toldo en cofre sin brazos, indicado para utilizar como cortina lateral enrollable o en aplicaciones verticales.<br>
                          Incluye un sistema de muelle de tensión interno, que mantiene la lona tensa  y favorece su recogida.<br>
                          Apropiado para utilizar como separador en espacios públicos o privados. En el ámbito privado proporciona protección contra la brisa lateral y aporta intimidad en terrazas, balcones, patios... <br>','titulo_comp' => 'Características','descripcion_comp' => '-Toldo en cofre, cerrado protege lona y los elementos mecánicos del toldo.<br>
                          -Anclado a pared con sistema de perchas. <br>
                          -Muelle interno con tensión que mantiene la lona tensa y favorece su recogida. <br>
                          -Por seguridad, dispone de un sistema de bloqueo <i>"SECUR STOP"</i><br>
                          -Admite lona Acrílica y Sunworker. <br>
                          -Posibilidad de lacar en múltiples colores. <br>
                          -Puede ser utilizado como toldo horizontal o vertical. Si es preciso incluye un poste para su anclaje frontal.<br>
                          ','pdf' => 'ficha_tecnica_cofre_cortina_lateral.pdf','orden' => '0','title' => 'Cofre cortina lateral - Sutoldo','title_desc' => 'Toldo cofre cortina lateral compuesto de un muelle de tensión interno, que mantiene la lona tensa y favorece su recogida.','img' => 'cofre_lateral_4.jpg','url_amigable' => 'cofre-cortina-lateral','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '146','padre' => '4','nombre' => 'Front Box Cable y Varilla','descripcion' => '<h4>Front Box Cable/Varilla</h4><br>
                          Toldo con cofre 110 y 130 para protección solar exterior de enrolle vertical guiado por cable o varilla inox.<br>
                          Solución a la luz y el calor del sol.<br>
                          ','titulo_comp' => 'Características','descripcion_comp' => '-Posibilidad de anclar el toldo a pared, techo. Soportes ocultos.<br>
                          -Cofre de 110 o 130 inspeccionable.<br>
                          -Guiado por cable o varilla inox 10mm.<br>
                          -Cable y varilla se pueden anclar a frente, suelo o costado.<br>
                          -Admite lona Acrílica, Sunworker y Recscreen.<br>
                          -Lonas mas indicadas son las microperforadas como "Sunworker" o "Recscreen", siempre soldadas.<br>
                          -Posibilidad de lacar en múltiples colores.<br>
                          -Se puede instalar con manivela o motor. <br>
                          ','pdf' => 'ficha_tecnica_front_box_cable.pdf','orden' => '0','title' => 'Front Box Cable | Varilla - Sutoldo','title_desc' => 'Toldo front Box Cable/Varilla, de enrolle vertical guiado por cable o varilla inox, puede componerse de cofre de 110 o 130.','img' => 'front_box_cable_2.jpg','url_amigable' => 'front-box-cable-y-varilla','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '147','padre' => '4','nombre' => 'Front Box Cremallera','descripcion' => '<h4>Front Box Cremallera</h4><br>
                          Toldo con cofre 110 ó 130 para protección solar exterior de enrolle vertical con guía ZIP y cremallera que impide que la lona se salga de las guías .<br>
                          Solución a la luz y el calor del sol.<br>','titulo_comp' => 'Características ','descripcion_comp' => '-Posibilidad de anclar el toldo a pared o techo. Soportes ocultos.<br>
                          -Cofre de 110 o 130 inspeccionable.<br>
          
                          -Guiado por guía ZIP.<br>
                          -Sistema de cremallera impide que la lona se salga de las guías.<br>
                          -Lonas mas indicadas son las microperforadas como "Sunworker" o "Recscreen", siempre soldadas.<br>
                          -Posibilidad de lacar en múltiples colores.<br>
                          -Se puede instalar con manivela o motor.
                          <br>','pdf' => 'ficha_tecnica_front_box_cremallera.pdf','orden' => '0','title' => 'Front Box Cremallera - Sutoldo','title_desc' => 'Toldo front box cremallera con cofre 110 ó 130 vertical con guía ZIP y cremallera, que impide que la lona se salga de las guías.','img' => 'fornt_box_cremallera_1.jpg','url_amigable' => 'front-box-cremallera','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '148','padre' => '4','nombre' => 'Front Tensionado','descripcion' => '<h4>Front Tensionado</h4><br>
                          Toldo con cofre 110 ó 130,  tensionado para protección solar exterior de enrolle vertical.<br> Con guía ZIP y cremallera que impide que la lona se salga de las guías.<br>
                          Sistema de tensión interior por muelles, lona siempre tensa.<br>
                          Solución a la luz y el calor del sol aplicable en ventanas, cristaleras, claraboyas...<br>
                          ','titulo_comp' => 'Características ','descripcion_comp' => '-Cofre de 110 o 130 inspeccionable.<br>
                          -Posibilidad de anclar el toldo a pared o techo.<br>
                          -Se puede instalar vertical o inclinado.<br>
                          -Guía ZIP con tensión por muelles internos.<br>
                          -Sistema de cremallera impide que la lona se salga de las guías.<br>
                          -Posibilidad de lacar en múltiples colores.<br>
                          -Modelo exclusivamente motorizado.<br>','pdf' => 'ficha_tecnica_front_tensionado.pdf','orden' => '0','title' => 'Front Tensionado - Sutoldo','title_desc' => 'Toldo front tensionado de enrolle vertical con sistema de tensión interior por muelles, lona siempre tensa, con guía ZIP y cremallera.
                  ','img' => 'front_tensionado_1.jpg','url_amigable' => 'front-tensionado','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '149','padre' => '4','nombre' => 'Front Cable y Varilla','descripcion' => '<h4>Front Cable/Varilla</h4><br>
                          Sistema de protección solar exterior de enrolle vertical  guiado por cable o varilla inox.<br>
                          Solución a la luz y el calor del sol.<br>
                          ','titulo_comp' => 'Características','descripcion_comp' => '-Posibilidad de anclar el toldo a pared, techo o costado.<br>
          
                          -Guiado por cable o varilla inox 10mm.<br>
                          -Cable y varilla se pueden anclar a frente, suelo o costado.<br>
                          -Admite lona Acrílica, Sunworker y Recscreen.<br>
                          -Lonas mas indicadas son las microperforadas como "Sunworker" o "Recscreen", siempre soldadas.<br>
                          -Posibilidad de lacar en múltiples colores. <br>
                          -Se puede instalar con manivela o motor. <br>','pdf' => 'ficha_tecnica_front_cable.pdf','orden' => '0','title' => 'Front Cable | Varilla - Sutoldo','title_desc' => 'Toldo front Cable/Varilla sistema de enrolle vertical guiado por cable o por varilla inox.','img' => 'front_cable_1.jpg','url_amigable' => 'front-cable-y-varilla','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '150','padre' => '4','nombre' => 'Front Cremallera ','descripcion' => '<h4>Front Cremallera 110</h4><br>
          
                          Sistema de protección solar exterior de enrolle vertical con guía ZIP y cremallera que impide que la lona se salga de las guías .<br>
                          Solución a la luz y el calor del sol.<br>','titulo_comp' => 'Características','descripcion_comp' => '-Posibilidad de anclar a pared, techo o costado.<br>
                          -Guiado por guía ZIP.<br>
                          -Sistema de cremallera impide que la lona se salga de las guías.<br>
          
                          -Lonas mas indicadas son las microperforadas como "Sunworker" o "Recscreen", siempre soldadas.<br>
                          -Posibilidad de lacar en múltiples colores.<br>
                          -Se puede instalar con manivela o motor.<br>','pdf' => 'ficha_tecnica_front_cremallera.pdf','orden' => '0','title' => 'Front Cremallera - Sutoldo','title_desc' => 'Toldo front cremallera con un sistema de enrolle vertical con guía ZIP y cremallera que impide que la lona se salga de las guías.','img' => 'front_cremallera_1.jpg','url_amigable' => 'front-cremallera','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '151','padre' => '4','nombre' => 'Cortavientos','descripcion' => '<h4>Cortavientos</h4><br>
                          Toldo de desenrolle vertical  que proporciona intimidad y protección lateral frente a sol, lluvia, frío y viento.<br>
                          Funcionamiento sencillo. Se desplaza en vertical por dos guías de aluminio laterales.<br>
                          Muy buena solución para laterales de pérgolas, terrazas, porches, locales comerciales, etc.<br>','titulo_comp' => 'Características','descripcion_comp' => '-Toldo de enrolle y caída vertical.<br>
                          -Desplazamiento a través de guías laterales de aluminio.<br>
                          -Guías laterales que impiden la salida de la lona.<br>
                          -Posibilidad de anclaje a pared, techo o costado.<br>
                          -Sujeción en la parte inferior a través de cerrojos metálicos.<br>
                          -Existe la opción de cofre 110, 130, 150.<br>
                          -Aporta protección lateral frente a sol, lluvia, frío y viento.<br>
                          -Puede incluir perfiles de aluminio horizontales de refuerzo.<br>
                          -Se puede instalar con manivela o motor. <br>
                          -Posibilidad de lacar en múltiples colores. <br>','pdf' => 'ficha_tecnica_cortaviento.pdf','orden' => '0','title' => 'Cortavientos - Sutoldo','title_desc' => 'Toldo cortavientos vertical que proporciona intimidad y protección lateral. Se desplaza por dos guías de aluminio laterales.','img' => 'cortaviento_cristal.jpg','url_amigable' => 'cortavientos','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '231','padre' => '219','nombre' => 'Europa','descripcion' => '','titulo_comp' => '','descripcion_comp' => '','pdf' => '','orden' => '0','title' => '','title_desc' => '','img' => '','url_amigable' => '','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '232','padre' => '164','nombre' => 'Extensibles','descripcion' => '','titulo_comp' => '','descripcion_comp' => '','pdf' => '','orden' => '0','title' => '','title_desc' => '','img' => '','url_amigable' => '','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '179','padre' => '231','nombre' => 'Europa 550','descripcion' => '<h4>Europa 550</h4><br>
          
                          Toldo tipo pérgola, para proporcionar protección contra el sol, lluvia o frío.<br>
                          Estructura de aluminio con cubierta retráctil de lona,
                          soportada por perfiles trasversales y poleas que se deslizan por guías.<br>
                          La lona de la cubierta es impermeable de poliester recubierta de PVC.<br>
          
                          Cuando la pérgola está desplegada, la lona queda tensada facilitando que el agua se desplace hacia la parte
                          delantera.<br>
                          La viga frontal tiene forma de de canalón de manera que recoge el agua de la pérgola y esta desciende
                          por el interior de los pilares<br>
                          Este modelo debe de tener una inclinación mínima para la correcta evacuación del agua.("Ver ficha técnica").<br>
                          Pérgola original Gennius fabricada en Sutoldo. ','titulo_comp' => 'Características','descripcion_comp' => '-Guías 110x60.<br>
                          -Terminal 60x83.<br>
                          -Palillo 60x35.<br>
                          -Este modelo permite inclinación.<br>
                          -Viga frontal con forma de canalón.<br>
                          -Maniobra solo con motor.<br>
                          -Posibilidad de lacar en múltiples colores.<br>','pdf' => 'ficha_tecnica_europa_550.pdf','orden' => '0','title' => 'Pergola europa 550 - Sutoldo ','title_desc' => 'Toldo pérgola Europa 550 aporta protección contra sol, lluvia o frío. Estructura de aluminio y cubierta de lona. Viga frontal con forma de canalón.','img' => 'europa550_2.jpg','url_amigable' => 'pergola-europa-550','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '180','padre' => '231','nombre' => 'Europa 650','descripcion' => '<h4>Europa 650</h4><br>
                          Toldo tipo pérgola, para proporcionar protección contra el sol, lluvia o frío.
                          Estructura de aluminio con cubierta retráctil de lona,<br>
                          soportada por perfiles trasversales y poleas que se deslizan por guías.
                          La lona de la cubierta es impermeable de poliester recubierta de PVC.<br><br>
          
                          Cuando la pérgola está desplegada, la lona queda tensada facilitando que el agua se desplace hacia la parte delantera.<br>
          
                          En el frente puede acoplarse un canalón para recogida de agua, que
                          puede descender por el interior del poste.<br><br>
                          La cubierta puede recogerse en la parte trasera en forma de pliegues.<br>
                          El funcionamiento de desplegado y recogida de la cubierta de lona, se hace mediante un sistema de correa dentada y
                          motor tubular eléctrico.<br>
                          Este modelo debe de tener una inclinación mínima para la correcta evacuación del agua.("Ver ficha técnica").<br>
                          Pérgola original Gennius fabricada en Sutoldo. ','titulo_comp' => 'Características','descripcion_comp' => '-Guías 110x60.<br>
                          -Terminal 60x83.<br>
                          -Palillo 60x35.<br>
                          -Debe tener una inclinación mínima para la correcta evacuación del agua.<br>
                          -Viga frontal con forma de canalón.<br>
                          -Maniobra solo con motor.<br>
                          -Posibilidad de lacar en múltiples colores.<br>','pdf' => 'ficha_tecnica_europa_650.pdf','orden' => '0','title' => 'Pérgola europa 650 - Sutoldo','title_desc' => 'Toldo pérgola Europa 650 aporta protección contra sol, lluvia o frío. Estructura de aluminio y cubierta de lona. Debe tener inclinación para evacuar el agua.','img' => 'europa650_1.jpg','url_amigable' => 'pergola-europa-650','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '181','padre' => '231','nombre' => 'Europa 800','descripcion' => '<h4>Europa 800</h4>
                          Toldo tipo pérgola, para proporcionar protección contra el sol, lluvia o frío. <br>Estructura de aluminio con cubierta retráctil de lona,
                          soportada por perfiles trasversales y poleas que se deslizan por guías. La lona de la cubierta es impermeable de poliester recubierta de PVC.<br><br>
          
                          Cuando la pérgola está desplegada, la lona queda tensada facilitando que el agua se desplace hacia la parte delantera.
                          En el frente puede acoplarse un canalón para recogida de agua, que puede descender por el interior del poste.<br><br>
          
                          La cubierta se recoge en la parte trasera en forma de pliegues. <br>
                          El funcionamiento de desplegado y recogida de la cubierta de lona, se hace mediante un sistema de correa dentada y motor tubular eléctrico.<br>
                          Este modelo debe de tener una inclinación mínima para la correcta evacuación del agua.("Ver ficha técnica").<br>
                          Pérgola original Gennius fabricada en Sutoldo. ','titulo_comp' => 'Características','descripcion_comp' => '-Guías 160x145.<br>
                          -Terminal 60x83.<br>
                          -Palillo 60x35.<br>
                          -Tubo 160x145.<br>
                          -Este modelo permite inclinación.<br>
                          -Viga frontal con forma de canalón.<br>
                          -Maniobra solo con motor.<br>
                          -Posibilidad de lacar en múltiples colores.<br>','pdf' => 'ficha_tecnica_europa_800.pdf','orden' => '0','title' => 'Pérgola europa 800 - Sutoldo','title_desc' => 'Toldo pérgola Europa 800 aporta protección contra sol, lluvia o frío. Estructura de aluminio y cubierta de lona. Este modelo permite inclinación.','img' => 'europa800_3.jpg','url_amigable' => 'europa 880','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '182','padre' => '220','nombre' => 'Veranda NEO','descripcion' => '<h4>Veranda NEO</h4>
          
          
                          Toldo con cofre de enrolle y desplazamiento por guías laterales.<br>
                          Sistema interno de tensión por muelles, lona siempre tensa.
                          Concebido para cubrir cerramientos,cristaleras, terrazas... evita el calentamiento de cristales y estructuras.<br>','titulo_comp' => 'Características','descripcion_comp' => '-Toldo en cofre, protege la lona enrollada.<br>
                          -Sistema interno de tensión por muelles.<br>
                          -Lona siempre tensa.<br>
                          -Guías instaladas a los extremos.<br>
                          -Para este tipo de toldo se recomienda lona Acrilica.<br>
                          -Maniobra sólo con motor.<br>
                          -Lacado en múltiples colores.<br>','pdf' => 'ficha_tecnica_veranda_neo.pdf','orden' => '0','title' => 'Veranda NEO - Sutoldo','title_desc' => 'Toldo veranda NEO con cofre diseñado para cubrir cerramientos, cristaleras, terrazas... evita el calentamiento de cristales y estructuras.','img' => 'veranda_neo_1.jpg','url_amigable' => 'veranda-neo','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '183','padre' => '220','nombre' => 'Veranda Vertens','descripcion' => '<h4>Veranda Vertens</h4><br>
                          Toldo veranda, con cofre, tensado con sistema de pistones de aire comprimido ocultos en las guías.<br>
                          Concebido para cubrir cerramientos,cristaleras, terrazas... evita el calentamiento de cristales y estructuras.
          
                          <br>','titulo_comp' => 'Características','descripcion_comp' => '
                          -Toldo en cofre, protege la lona enrollada.<br>
          
                          -Tensado con sistema de pistones de aire comprimido ocultos dentro de las guías.<br>
          
                          -Las guías pueden ir a los extremos o desplazadas hacia el interior.<br>
                          -Lona siempre tensa.<br>
                          -Este toldo sólo se fabrica con lona Acrílica.<br>
                          -Maniobra sólo con motor.<br>
                          -Lacado en múltiples colores.<br>','pdf' => 'ficha_tecnica_veranda_vertens.pdf','orden' => '0','title' => 'Veranda Vertens - Sutoldo','title_desc' => 'Toldo veranda Vertens, con cofre tensado con sistema de pistones de aire comprimido ocultos. Ideado para cubrir cerramientos, cristaleras, terrazas... ','img' => 'veranda_vertens_2.jpg','url_amigable' => 'veranda-vertens','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '184','padre' => '166','nombre' => 'Acrílicas','descripcion' => '<h4>Lonas acrílicas, lisas, rayadas y estampadas</h4><br><br>
                          <b>Lonas Acrílicas,  lisas y rayadas.</b> <br>
                          Este es el tipo de lona predominante en los toldos. Lonas compuestas 100% de fibra acrílica teñida en masa con un peso de 300 grs/m2.<br>
                          Por sus características técnicas es apta para todos los tipos de toldos.  El ancho standard es de 120 ctms.<br>
                          En algunos colores lisos existen otros anchos, 240 ó 320.
                          Los precios  si no se especifica lo contrario, están calculados con lona acrílica de 120 de ancho. <br>
                          Estas lonas se confeccionan por  inyección de cola, en las uniones y dobladillos verticales,  innovador sistema sin hilos.  En costuras horizontales y ribete, cosidas con hilo  especial para intemperie.<br>
                          Incluímos una etiqueta identificativa con el sello de LONA SOLDADA.<br><br>
          
                          <b>Lonas Acrílicas - resinadas y estampadas. </b><br>
                          No admiten soldadura. Costuras verticales y horizontales cosidas con hilo  especial para intemperie. <br>
                          <a title="Somfy" href="http://recasens.com/toldos/" target="_blank" ><img src="https://sutoldo.com/asdfghjkl/logoRecasens.jpg" width="180px" data-toggle="tooltip" data-placement="top" title="Recasense"  data-original-title=""  rel="nofollow"  class="m-3"></a>
                          ','titulo_comp' => 'Características ','descripcion_comp' => '-Peso 300 grs/m2 en acrilicas<br>
                          -Peso 360 grs/m2 en estampadas<br>
                          -Lona teñida en masa<br>
                          -Lona acrílica soldada por inyección de cola<br>
                          -Lona estampada cosida con hilo especial para intemperie<br>
                          ','pdf' => 'ficha_tecnica_acrilico.pdf','orden' => '0','title' => 'Lonas acrílicas - Sutoldo','title_desc' => 'Lonas acrílicas, predominante en los toldos.  Compuestas 100% de fibra acrílica teñida en masa con un peso de 300 grs/m2.','img' => 'lona_acrilica_portada.jpg','url_amigable' => 'acrilicas','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '185','padre' => '166','nombre' => 'Microperforadas','descripcion' => '<h4>Lonas microperforadas</h4><br>
                          Lonas con soporte de poliester recubierto en PVC, que permite el paso de aire a través de los poros.<br>
                          Por su calidad, Sutoldo recomienda SUNWORKER. Se confecciona con termosoldadura de aire caliente o impulso térmico.<br>
                          Excepcionalmente puede ir cosida si así lo requieren las medidas, formas, etc.<br>
          
                          ','titulo_comp' => 'Características','descripcion_comp' => '-Confección con termosoldadura de aire caliente o impulso térmico.<br>
                          -Peso RECSCREEN 4000 de 430 g/m2<br>
                          -Peso RECSCREEN 6000 de 605 g/m2<br>
                          -Peso SUNWORKER de 330 g/m2<br>
                          ','pdf' => 'ficha_tecnica_microperforado.pdf','orden' => '0','title' => 'Lonas microperforadas - Sutoldo','title_desc' => 'Lonas microperforadas, con soporte de poliester recubierto en PVC, permite el paso de aire a través de los poros.','img' => 'lona_microperforada_portada.jpg','url_amigable' => 'microperforadas','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '186','padre' => '166','nombre' => 'PVC','descripcion' => '<h4>Lonas PVC standard, ignífugas y opacas</h4><br>
                          Lonas con soporte de poliester recubierto de PVC totalmente impermeable.<br>
          
                          <b>PVC Standard</b>:<br> Perfectas para cualquier aplicación excepto toldos de enrolle de grandes dimensiones.<br>
                          <b>PVC Ignifugo</b>: <br>Ofrece mayor resistencia a la combustión. Indicada para lugares y aplicaciones para las cuales la normativa exija tejidos ignífugos.<br>
                          <b>PVC Opaco</b>: <br>Ignífugas, ofrecen mayor resistencia a la combustión y son totalmente opacas . Debido a una capa de interior de tejido oscurante que impiden el paso de los rayos ultravioleta y de la luz. Muy adecuadas para pérgolas.<br>
                          ','titulo_comp' => '<a title="Somfy" href="http://www.industrialsedo.com/index.html" target="_blank"  rel="nofollow"><span size=16 color="black">PVC Sedo</span></a>','descripcion_comp' => '','pdf' => 'ficha_tecnica_pvc.pdf','orden' => '0','title' => 'Lona PVC - Sutoldo','title_desc' => 'Lonas PVC con soporte de poliester recubierto totalmente impermeable. Tipos de lona PVC Standard, PVC Ignifugo, PVC Opaco. Muy adecuadas para toldo pérgola.','img' => 'lona_pvc_portada.jpg','url_amigable' => 'pvc','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '187','padre' => '221','nombre' => 'Somfy','descripcion' => '<h4>Somfy</h4><br>
                          Somfy ofrece un amplio abanico de posibilidades para motorizar y controlar su toldo.<br>
                          Cuenta con diversos automatismos que ofrecen mayor seguridad a su toldo prolongando su vida util.<br>
                          Los motores son de tipo tubular y se integran en el tubo de enrolle del toldo. Pueden ser accionados desde un mando o desde un automatismo (sensor de viento / sol).<br><br>
                          <a title="Somfy" href="https://www.somfy.es/producto/exteriores/toldos" target="_blank"  rel="nofollow"><img src="https://sutoldo.com/asdfghjkl/somfy.gif" class="mb-1 wow zoomIn" width="80px" data-toggle="tooltip" data-placement="top" title="Somfy" style="visibility: visible; animation-name: zoomIn;" data-original-title=""></a><br>
          
                          ','titulo_comp' => 'Catalogo','descripcion_comp' => '<b><i>DOMÓTICA</i></b><br>
                          <b>Tahoma</b><br>
                          Control manual de los equipos gestion de tu casa según tu ritmo de vida (creación de días personalizados).<br>
          
                          <b>Connexon</b><br>
                          Con la solución Somfy Connexoon, programa escenarios de presencia y ausencia y maneja tu casa y tus accesos de donde quieras, cuando quieras.
                          <br><br>
          
                          <b><i>MANDOS</i></b><br>
          
                          <b>Situo 1 IO Pure</b><br>
                          Mando a distancia monocanal con tecnología io-homecontrol.
                          Permite el control individual o centralizado de tus dsipositivos motorizados<br>
          
                          <b>Situo 5 IO Pure</b><br>
                          Mando a distancia multicanal (5 canales) con tecnología io-homecontrol.
                          Permite el control individual o centralizado de tus dispositivos motorizados.<br>
          
                          <b>Impresaio chronis IO</b><br>
                          Mando de pared de la gama io. Tecnología táctil para interactuar de forma intuitiva con todas las aberturas de la casa.
                          Permite crear hasta 16 escenarios diferentes, accionando hasta 40 automatismos.<br>
          
                          <b>Smove origin IO</b><br>
                          El mando de pared de la gama io. Imagen innovadora y elegante.
                          Mando inalámbrico. Puede ubicarse en cualquier situación. No necesita cableado.<br>
          
                          <b>Smove A/M io</b><br>
                          Mando inalámbrico. Puede ubicarse en cualquier situación. No necesita cableado.<br><br>
          
                          <b><i>SENSORES</i></b><br>
          
                          <b>Eolis 3D IO</b><br>
                          El sensor de viento vía radio para toldos. Sensor inteligente: adapta su conducta en días de mucho viento<br>
          
                          <b>Eolis Wirefree IO</b><br>
                          Sensor de viento sin cables para toldos y persianas venecianas exteriores.<br>
          
                          <b>SUNIS IO</b><br>
                          El sensor Sunis IO permite controlar automáticamente tus persianas, toldos o cortinas en función del nivel de sol.<br>
          
                          <b>Sensor Box IO</b><br>
                          Permite la comunicación entre Easy Sun Io y tu sensor de sol IO<br><br>
          
          
                          ','pdf' => '','orden' => '0','title' => 'Motores y automatismos Somfy - Sutoldo','title_desc' => 'Somfy ofrece un amplio abanico de posibilidades para motorizar y controlar su toldo, pérgola, cofre, etc.','img' => '0','url_amigable' => 'somfy','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '188','padre' => '221','nombre' => 'Cherubini','descripcion' => '<h4>Cherubini</h4><br>
                          Cherubini ofrece un amplio abanico de posibilidades para motorizar y controlar su toldo.
                          Cuenta con diversos automatismos que ofrecen mayor seguridad a su toldo prolongando su vida util.
                          Los motores son de tipo tubular y se integran en el tubo de enrolle del toldo. Pueden ser accionados desde un mando o desde un automatismo (sensor de viento / sol).<br>
          
                          <a title="Cherubini" href="http://www.cherubini.es/" target="_blank"><img src="https://sutoldo.com/asdfghjkl/cherubini.png" class="mb-1 wow zoomIn" width="150px" data-toggle="tooltip" data-placement="top" title="Cherubini" style="visibility: visible; animation-name: zoomIn;" data-original-title="Cherubini" rel="nofollow"></a><br>
                          ','titulo_comp' => 'Catalogo','descripcion_comp' => '<b><i>MANDOS</i></b><br>
                          <b>Skipper</b><br>
                          Emisor monocanal destinado al manejo de un motor o grupo de motores.<br>
          
                          <b>Skipper Plus</b><br>
                          Emisor multicanal de 7 canales individuales y un canal global (0).<br>
          
                          <b>Skipper LCD</b><br>
                          Emisor multifunción con pantalla LCD a color 1.8".<br>
          
                          <b>Skipper Wall</b><br>
                          Emisor mural monocanal destinado al manejo de un motor o grupo de motores.<br>
          
                          <b>Mando de Giro</b><br>
                          Permite controlar los toldos y persianas motorizadas. Con hasta siete canales individualmente o todos a la vez en el canal global, mediante una simple y ligera rotación de extremidad, acciona los motores de toldos y persianas.<br><br>
          
          
                          <b><i>SENSORES</i></b><br>
                          <b>Wind Tec Lux</b><br>
                          Control climático sol y viento, con receptor radio integrado.<br>
          
                          <b>Mistral</b><br>
                          Protege el toldo a través de la detección del movimiento del toldo originado por el viento.<br>
          
                          <b>Goccia</b><br>
                          Sensor lluvia cableado para toldo.<br><br>
          
                          <b><i>CALEFACCION</i></b><br>
                          <b>Calefactor infrarrojo STD</b><br>
                          Calefactor mediante infrarrojos con sistema STD con una superficie calefactable hasta 16 m2<br>
          
                          <b>Calefactor infrarrojo CRC</b><br>
                          Calefactor mediante infrarrojos con sistema SRC con una superficie calefactable hasta 16 m2<br>
          
                          <b>DOMI</b><br>
                          Sistema domótico de Cherubini que a través de una aplicación permite accionar toldos y persianas desde Smartphone o Tablet.<br>
                          ','pdf' => '','orden' => '0','title' => 'Motores y automatismos Cherubini - Sutoldo','title_desc' => 'Cherubini ofrece un amplio abanico de posibilidades para motorizar y controlar su toldo, pérgola, cofre, etc.','img' => 'cherubini_portada.jpg','url_amigable' => 'cherubini','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '189','padre' => '307','nombre' => 'Fábrica de toldos','descripcion' => '<h4>Fábrica de toldos</h4><br><br>
                          En la idea de que somos el respaldo y apoyo del profesional instalador, ponemos a disposición de nuestros clientes nuestra fábrica de Léganes.<br>
                          Instalación de 1800m<sup>2</sup> que nos permiten ofrecer una gran productividad y calidad de acabado en todo tipo de toldos y pérgolas.<br>
                          Con medios productivos avanzados, un amplio stock de accesorios, perfiles y lonas y un equipo de profesionales cualificados, convierten a Sutoldo en el proveedor de toldos, ideal para tu negocio. <br><br>
                          ','titulo_comp' => '','descripcion_comp' => '','pdf' => '','orden' => '0','title' => 'Fábrica de toldos - Sutoldo','title_desc' => 'En nuestra fábrica de Leganés, disponemos de sistemas robotizados con los que  conseguimos una gran productividad y calidad en todo tipo toldos y pérgolas.','img' => 'veneto_3.jpg','url_amigable' => 'veneto','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '190','padre' => '307','nombre' => 'Fábrica de Pérgolas','descripcion' => '<h4>Fábrica de Pérgolas</h4><br><br>
                          La pérgola se ha convertido en los últimos años en un elemento de protección contra los agentes atmosféricos en diferentes espacios y ambientes, a la vez que un elemento ornamental.<br>
                          Desde la composición más sencilla, hasta las modernas estructuras de diseño, para pequeños espacios o para grandes superficies, en SUTOLDO fabricamos pérgolas para todas las necesidades o gustos.<br><br>
          
                          Pérgolas de aluminio, pérgolas de hierro, vestidas con una gran variedad de tejidos, siempre a elegir por el cliente. Tejidos técnicos especialmente diseñados para resistir las inclemencias de los ambientes a los que son expuestos.<br>
                          Para la fabricación de pérgolas, en Sutoldo disponemos de la más amplia gama de tejidos técnicos del mercado. Producto salidos de las mejores fábricas de Europa:<br><br>
          
                          - Lona acrílica tradicional. Permeable, estética y duradera<br>
                          - Lona acrílica impermeabilizada “System”, tejido técnico diseñado para ambientes marinos, muy utilizado en pérgolas para el sol y la lluvia<br>
                          - Lona poliéster recubierta de PVC, totalmente impermeable, muy utilizada en cafeterías y restaurantes que buscan proteger a sus clientes del frío y la lluvia<br>
                          - Lonas transparentes, muy utilizadas en laterales de pérgolas, como ventanas o toldos verticales<br>
                          - Lona Microperforada, para ambientes de sombra agradables, el poro permite la circulación del aire y da lugar a sensación de fresco en verano.
                          Especialmente los tejidos SUNWORKER, RECSCREEN y SOLTIS<br>
                          - Lonas OPACK, de una alta calidad y resistencia. Impermeables. Diseñadas y fabricadas para evitar el paso de los rayos solares. Protegen de la lluvia en invierno y en verano minimizan el efecto invernadero.<br>
                          - Lonas para fabricar pérgolas para interiores, tejidas con hilos de poliéster ignífugos M1.<br><br>
          
                          Desde SUTOLDO recomendamos a profesionales y cliente final que, para la fabricación de pérgolas, se usen siempre tejidos adecuados al uso que se les va a dar. Muy especialmente utilizar TEJIDOS IGNÍFUGOS (resistentes al fuego), en espacios públicos.<br><br>
          
          
          
                          En la confección de lonas impermeables para pérgolas utilizamos el <b> Sistema Omega</b>, la única solución que garantiza total impermeabilidad.<br><br>
          
                          Si usted prefiere la costura tradicional, en SUTOLDO se lo podemos fabricar, pero aconsejamos para un mejor aprovechamiento de la pérgola demandar producto confeccionados con las nuevas tecnologías.<br><br>
          
                          En cuanto a las estructuras, fabricamos una amplia gama de pérgolas, de diferentes tipos, tamaños y prestaciones. Desde la sencillez de los clásicos, hasta los modernos diseños cuatro estaciones.<br>
          
                          ','titulo_comp' => '','descripcion_comp' => '','pdf' => '','orden' => '0','title' => 'Fábrica de Pérgolas - Sutoldo','title_desc' => 'En nuestra fábrica de Leganés, disponemos de sistemas robotizados que nos permiten una gran productividad y calidad de acabado en todo tipo toldos y pérgolas.','img' => 'europa550_4.jpg','url_amigable' => 'fabrica-de-pergolas','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '192','padre' => '166','nombre' => 'Cristal estabilizado','descripcion' => '<h4>Cristal estabilizado</h4><br><br>
          
                          En sutoldo disponemos de PVC cristal <i>"GLASS 0´"</i>. Este producto, aporta soluciones interesantes en paso de luz y transparencia.<br>
                          Otros cristales tienen el inconveniente de la falta de estabilidad dimensional al contraerse con los cambios de temperatura.<br>
                          El cristal <i>GLASS 0´</i> tiene MINIMA CONTRACCIÓN, avalado por el ITA (Instituto Tecnológico de Aragón) en diversos ensayos.<br>
                          Se confecciona con termosoldadura de aire caliente o impulso termico.<br>
                          Es ideal para TOLDOS TENSADOS Y ENROLLABLES DE EXTERIOR.<br>
                          ','titulo_comp' => 'Características','descripcion_comp' => '-Resistencia al fuego ignífugo M2<br>
                          -Resistencia a la contracción<br>
                          -Estabilidad térmica de – 20º A  60º<br>
                          -Peso 610 gr/m2<br>
                          -Espesor 0,5 mm<br>
                          -Encogimiento 0,1%<br>','pdf' => 'ficha_tecnica_pvc_cristal.pdf','orden' => '0','title' => 'Cristal estabilizado - Sutoldo','title_desc' => 'En Sutoldo disponemos de PVC cristal "GLASS 0". Producto que aporta soluciones interesantes en paso de luz y transparencia.','img' => '0','url_amigable' => 'cristal estabilizado','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '193','padre' => '307','nombre' => 'Confección de lonas','descripcion' => '<h4>Confección</h4><br>
          
                          Cada tejido debe ser tratado y confeccionado por personas cualificadas y con los medios adecuados.<br>
                          En SUTOLDO disponemos de medios personales y técnicos avanzados.<br><br>
          
                          -Lonas acrílicas cortadas por ultrasonido en mesa robotizada. El ultrasonido permite un corte rápido limpio que  evita deshilachados<br>
                          -Sistema de inyección de cola para lonas acrílicas, que evita los hilos en los dobladillos y uniones verticales<br>
                          -Soldadura por impulso térmico o chorro de aire caliente, para lonas microperforadas, screen y pvc <br>
                          -Confección de "sistema omega" para pérgolas impermeables.<br>
                          -Maquinas automáticas para costura de uniones, dobladillos y macarrones.<br><br>
          
          
                          <h4>Confección pérgolas</h4><br>
          
                          La lona de pérgola se confecciona para palillero sencillo, doble o cuádruple ranura. Los macarrones irán cosidos si es lona acrílica y soldados si es Microperforada o de PVC.<br>
          
                          Sistema Omega. Ademas de los sistemas tradicionales de confección de pérgolas, Sutoldo ofrece el novedoso <b>Sistema Omega</b>.<br>
                          Lona de pérgola confeccionada para palillero sencillo, <b>SISTEMA OMEGA</b>. Nuevo sistema, para lonas PVC.<br>
          
                          Lonas totalmente impermeables.<br>
                          Proceso técnico que suelda el macarrón en la parte superior de la lona.<br>
                          La ausencia de costuras evita el perforado de tejido.<br>
                          Los "gajos" van unidos, formando un solo cuerpo. Todo soldado por calor, tanto la unión de la lona como los macarrones.<br>','titulo_comp' => '','descripcion_comp' => '','pdf' => 'confeccion_lona.pdf','orden' => '0','title' => 'Confección de lonas - Sutoldo','title_desc' => 'En nuestra fábrica de Leganés, disponemos de sistemas robotizados que permiten conseguir una gran productividad y calidad de lonas para toldos y pérgolas.','img' => 'entreparedes125x80_2.jpg','url_amigable' => 'confeccion-de-lonas','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '194','padre' => '231','nombre' => 'Entreparedes Techo','descripcion' => '<h4>Europa Entreparedes/Techo</h4><br>
                          Toldo tipo pérgola, para proporcionar sombra, de estructura de aluminio y cubierta retráctil de lona.<br> La lona está
                          soportada por perfiles de aluminio trasversales y poleas que se deslizan por guías de aluminio. La lona de la cubierta
                          es impermeable, de poliester recubierta de PVC.<br>
                          Este modelo es una cubierta, está concebido para instalar a una estructura existente. Se puede anclar a techo,
                          laterales o frente.<br>
                          Con soportes al frente, se puede instalar: <br>
                          - hasta 4,50mts de salida con guía normal<br>
                          - partir de 4,50mts hasta 6,0 0mts, de salida, con guía reforzada<br>
                          - entre 6,00mts y 7,00mts de salida, deberá de tener puntos de anclaje intermedios<br>
                          Cuando la pérgola está desplegada, la lona queda tensada facilitando que el agua se desplace hacia la parte
                          delantera.<br>
                          Pérgola original Gennius fabricada en Sutoldo. ','titulo_comp' => 'Características','descripcion_comp' => '-Guías 100x55.<br>
                          -Guías reforzadas 150x55.<br>
                          -Terminal 60x83.<br>
                          -Palillo 60x35.<br>
                          -Este modelo permite inclinación.<br>
                          -Maniobra solo con motor.<br>
                          -Posibilidad de lacar en múltiples colores<br>','pdf' => 'ficha_tecnica_europa_entreparedes.pdf','orden' => '0','title' => 'Pérgola entreparedes/techo - Sutoldo','title_desc' => 'Toldo pérgola Europa entreparedes/techo aporta protección contra sol, lluvia o frío. Estructura de aluminio y cubierta de lona. Este modelo permite inclinación.','img' => 'europa_entreparedes1.jpg','url_amigable' => 'entreparedes-techo','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '500','padre' => '11','nombre' => 'Brazos','descripcion' => '','titulo_comp' => '','descripcion_comp' => '','pdf' => '','orden' => '0','title' => '','title_desc' => '','img' => '','url_amigable' => '','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '195','padre' => '319','nombre' => 'Balteus','descripcion' => '<h4>Brazos Balteus</h4><br>
                          Brazo de cinta Balteus, ejerce la fuerza de tensado en el codo a través de una cinta de cables de acero recubierta de PVC.<br>
                          Este sistema está concebido para realizar más de 30.000 ciclos, mucho más de cualquier brazo de cable o cadena.<br>
                          Proyección desde 135 hasta 410.
          
                          ','titulo_comp' => '','descripcion_comp' => '','pdf' => 'Balteus.pdf','orden' => '0','title' => 'Brazos Balteus','title_desc' => 'Brazo de cinta Balteus, ejerce fuerza de tensado a través de una cinta de cables de acero recubierta de PVC.','img' => 'domina_10.jpg','url_amigable' => 'brazo-balteus','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '196','padre' => '319','nombre' => 'Balteus Giant','descripcion' => '<h4>Brazo Balteus Giant</h4><br>
                          Brazo de cinta Balteus, ejerce la fuerza de tensado en el codo a través de una cinta de cables de acero recubierta de PVC.<br>
                          Este sistema está concebido para realizar más de 30.000 ciclos, mucho más de cualquier brazo de cable o cadena.<br>
                          Proyección desde 360 hasta 485.','titulo_comp' => '','descripcion_comp' => '','pdf' => 'Balteus giant.pdf','orden' => '0','title' => 'Brazo Balteus Giant','title_desc' => 'Brazo de cinta Balteus Giant, ejerce la fuerza de tensado a través de una cinta de cables de acero recubierta de PVC.','img' => 'monobloc485_1.jpg','url_amigable' => 'brazo-balteus-giant','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '197','padre' => '319','nombre' => 'Balteus Lite','descripcion' => '<h4>Brazo Balteus Lite</h4><br>
                          Brazo de cinta Balteus, ejerce la fuerza de tensado en el codo a través de una cinta de cables de acero recubierta de PVC.<br>
                          Este sistema está concebido para realizar más de 30.000 ciclos, mucho más de cualquier brazo de cable o cadena.<br>
                          Proyección desde 160 hasta 310.<br>','titulo_comp' => '','descripcion_comp' => '','pdf' => 'Balteus Lite.pdf','orden' => '0','title' => 'Brazo Balteus Lite','title_desc' => 'Brazo de cinta Balteus Lite, ejerce la fuerza de tensado en el codo a través de una cinta de cables de acero recubierta de PVC.','img' => 'st_base_6.jpg','url_amigable' => 'balteus-lite','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '198','padre' => '319','nombre' => 'Balteus LED','descripcion' => '<h4>Brazo Balteus LED</h4>
                          Brazo de cinta Balteus con LED integrado, novedad en el mercado español de toldos.<br>
                          Los brazos LED son compatibles con toldos de máquina y con toldo de motor.<br>
                          Barra LED, integrada en el perfil de los brazos. Luz natural 4200k; 9,6 W/m; 900 Lum/m 24V.<br>
                          Proyección desde 160 hasta 410.<br>
                          Encendido con interruptor, mando a distancia del motor o con los nuevos sistemas a través de dispositivos móviles.<br>
          
                          <b>Aplicables sobre todos los producto con brazo Balteus excepto ST Plus.</b><br>','titulo_comp' => '','descripcion_comp' => '','pdf' => 'Balteus led.pdf','orden' => '0','title' => 'Brazo Balteus LED','title_desc' => 'Brazo de cinta Balteus con LED integrado en el perfil de los brazos. Luz natural 4200k; 9,6 W/m; 900 Lum/m 24V.','img' => 'novedades_brazos_led.jpg','url_amigable' => 'brazo-balteus-led','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '199','padre' => '219','nombre' => 'Serie 90x96','descripcion' => '<h4>Serie - 90x96 </h4><br>
          
                          Pérgola de líneas rectas.
                          Estructura compuesta por tubos y guías de 90x96.<br>
                          Cubierta plegable con perfiles de aluminio "palilleros" que sostienen la lona. Indicada para proteger de los agentes atmosféricos especialmente del sol terrazas,porches, locales comerciales...<br>
          
                          Con lona impermeable y confección SISTEMA OMEGA puede ser utilizada como protección contra la lluvia.<br>','titulo_comp' => 'Características','descripcion_comp' => '-Estructura de perfiles 90x96mm de aluminio.<br>
                          -Admite palillero simple y doble.<br>
                          -Anclaje a suelo, frente o a techo.<br>
                          -Admite diferentes tipos de tejidos.<br>
                          -Permite motorización. <b>Las pérgolas motorizadas no permiten inclinación.</b><br>
                          -Maniobra manual.<br>
                          -Posibilidad de lacar en múltiples colores.<br>','pdf' => 'FichaTecnica90x96Cubo.pdf','orden' => '0','title' => 'Pérgola serie 90x96 - Sutoldo','title_desc' => 'Toldo pérgola 90x96 de líneas rectas. Apropiada para proteger de los agentes atmosféricos especialmente del sol terrazas, porches, locales comerciales...','img' => 'elite110x110_1.jpg','url_amigable' => 'serie-elite-90x96','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '200','padre' => '219','nombre' => 'Serie 125x80','descripcion' => '<h4>Serie 125x80</h4><br>
          
                          Pérgola de líneas rectas y sobrias. Estructura robusta y elegante compuesta por tubos y guías 125x80.<br>
                          Existe tubo de 125x125 para medidas especiales o estéticas de mayor solidez.<br>
                          Cubierta plegable con perfiles de aluminio "palilleros" que sostienen la lona. <br>
                          Por solidez esta indicada para espacios grandes o estética acorde a las nuevas tendencias.<br>
                          Con lona impermeable y  SISTEMA OMEGA puede ser utilizada como protección contra la lluvia.<br>
                          El sistema de motorización "centrado" permite llevar las guías a los extremos en caso de instalación con motor.<br>','titulo_comp' => 'Características','descripcion_comp' => '-Estructura de perfiles 125x125mm o 125x80mm de aluminio.<br>
                          -Guías 80x125mm de aluminio.<br>
                          -Admite palillero simple y doble.<br>
                          -Anclaje a suelo, frente o a techo.<br>
                          -Admite diferentes tipos de tejidos.<br>
                          -Maniobra manual.<br>
                          -Permite motorización. <b>Las pérgolas motorizadas no permiten inclinación.</b><br>
                          -Posibilidad de lacar en múltiples colores.<br>','pdf' => 'FichaTecnica125x80Recta.pdf','orden' => '0','title' => 'Pérgola serie 125x80 - Sutoldo','title_desc' => 'Toldo pérgola 125x80 robusta y elegante, por solidez esta estructura está indicada para espacios grandes o estética acorde a las nuevas tendencias.','img' => 'castilla80x125_4.jpg','url_amigable' => 'serie-elite-125x80','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '201','padre' => '219','nombre' => 'Serie 120x120','descripcion' => '<h4>Serie - 120x120</h4><br>
                          Pérgola de lineas suaves con perfiles de esquinas redondeadas. <br>
                          Estructura robusta, compuesta por tubos y guías de 120x120.<br>
                          Cubierta plegable con perfiles de aluminio "palilleros" que sostienen la lona.<br>
                          Indicada para proteger de los agentes atmosféricos especialmente del sol terrazas,porches, locales comerciales...<br>
                          Con lona impermeable y SISTEMA OMEGA puede ser utilizada como protección contra la lluvia.<br>
                          ','titulo_comp' => 'Características','descripcion_comp' => '-Estructura de perfiles 120x120mm de aluminio.<br>
                          -Admite palillero simple y doble.<br>
                          -Admite diferentes tipos de tejidos.<br>
          
                          -Anclaje a suelo, frente o a techo.<br>
                          -Maniobra manual.<br>
                          -Posibilidad de lacar en múltiples colores.<br>','pdf' => 'FichaTecnica120x120Cubo.pdf','orden' => '0','title' => 'Pérgola serie - 120x120 - Sutoldo','title_desc' => 'Toldo pérgola 120x120 de lineas suaves con perfiles de esquinas redondeadas. Protege especialmente del sol terrazas, porches, locales comerciales...','img' => 'elite120x120_3.jpg','url_amigable' => 'serie-elite-120x120','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '202','padre' => '219','nombre' => 'Serie 110x110','descripcion' => '<h4>Serie - 110x110</h4><br>
                          Pérgola de líneas rectas en perfiles de esquinas ligeramente redondeadas. <br>
                          Estructura compuesta por tubos y guías de 110x110. Cubierta plegable con perfiles de aluminio "palilleros" que sostienen la lona.<br>
                          Indicada para proteger de los agentes atmosféricos especialmente del sol terrazas,porches, locales comerciales...<br>
                          Con lona impermeable y  SISTEMA OMEGA puede ser utilizada como protección contra la lluvia.<br>','titulo_comp' => 'Características ','descripcion_comp' => '-Estructura de perfiles 110x110mm de aluminio.<br>
                          -Admite palillero simple y doble.<br>
                          -Admite diferentes tipos de tejidos.<br>
                          -Este modelo no permite inclinación.<br>
                          -Anclaje a suelo, frente o a techo.<br>
                          -Maniobra manual.<br>
                          -Este tipo de pérgola no admite motorización.<br>
                          -Posibilidad de lacar en múltiples colores.<br>','pdf' => 'FichaTecnica110x110Cubo.pdf','orden' => '0','title' => 'Pérgola serie 110x110 - Sutoldo','title_desc' => 'Toldo pérgola 110x110 de líneas rectas en perfiles de esquinas ligeramente redondeadas. ','img' => 'elite110x110_2.jpg','url_amigable' => 'serie-elite-110x110','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45'),
            array('id' => '203','padre' => '219','nombre' => 'Serie 110x50','descripcion' => '<h4>Serie - 110x50</h4><br>
          
                          Pérgola de líneas rectas en perfiles de esquinas ligeramente redondeadas.
                          Estructura compuesta por tubos y guías de 110x50. Cubierta plegable con perfiles de aluminio "palilleros" que sostienen la lona.<br>
                          Indicada para proteger de los agentes atmosféricos especialmente del sol terrazas,porches, locales comerciales...<br>
                          Con lona impermeable y SISTEMA OMEGA puede ser utilizada como protección contra la lluvia.<br>','titulo_comp' => 'Características ','descripcion_comp' => '-Estructura de perfiles 110x50mm de aluminio.<br>
                          -Admite palillero simple y doble.<br>
                          -Admite diferentes tipos de tejidos.<br>
                          -Este modelo no permite inclinación.<br>
                          -Anclaje a suelo, frente o a techo.<br>
                          -Maniobra manual.<br>
                          -Este tipo de pérgola no admite motorización.<br>
                          -Posibilidad de lacar en múltiples colores.<br>','pdf' => 'FichaTecnica110x50Cubo.pdf','orden' => '0','title' => 'Pérgola serie - 110x50 - Sutoldo','title_desc' => 'Toldo pérgola 110x50 de líneas rectas en perfiles de esquinas ligeramente redondeadas. Indicada para proteger del sol terrazas, porches, locales comerciales...','img' => 'pergola_110x50_12.jpg','url_amigable' => 'serie-elite-110x50','created_at' => '2021-02-15 19:26:45','updated_at' => '2021-02-15 19:26:45')
          );
          
  
    }//fin colocarProducto

    public function colocarImageProduct(){

        return array(
            array('id' => '475','id_producto' => '127','id_imagen' => '91'),
            array('id' => '477','id_producto' => '127','id_imagen' => '100'),
            array('id' => '478','id_producto' => '127','id_imagen' => '98'),
            array('id' => '493','id_producto' => '128','id_imagen' => '91'),
            array('id' => '494','id_producto' => '128','id_imagen' => '98'),
            array('id' => '495','id_producto' => '128','id_imagen' => '100'),
            array('id' => '496','id_producto' => '128','id_imagen' => '101'),
            array('id' => '504','id_producto' => '129','id_imagen' => '145'),
            array('id' => '505','id_producto' => '129','id_imagen' => '146'),
            array('id' => '506','id_producto' => '129','id_imagen' => '147'),
            array('id' => '507','id_producto' => '129','id_imagen' => '144'),
            array('id' => '511','id_producto' => '129','id_imagen' => '91'),
            array('id' => '512','id_producto' => '129','id_imagen' => '101'),
            array('id' => '516','id_producto' => '130','id_imagen' => '148'),
            array('id' => '517','id_producto' => '130','id_imagen' => '149'),
            array('id' => '518','id_producto' => '130','id_imagen' => '150'),
            array('id' => '519','id_producto' => '130','id_imagen' => '151'),
            array('id' => '531','id_producto' => '130','id_imagen' => '91'),
            array('id' => '532','id_producto' => '130','id_imagen' => '101'),
            array('id' => '545','id_producto' => '131','id_imagen' => '102'),
            array('id' => '557','id_producto' => '131','id_imagen' => '91'),
            array('id' => '558','id_producto' => '131','id_imagen' => '98'),
            array('id' => '559','id_producto' => '131','id_imagen' => '100'),
            array('id' => '560','id_producto' => '131','id_imagen' => '99'),
            array('id' => '561','id_producto' => '131','id_imagen' => '101'),
            array('id' => '563','id_producto' => '131','id_imagen' => '105'),
            array('id' => '564','id_producto' => '131','id_imagen' => '399'),
            array('id' => '574','id_producto' => '132','id_imagen' => '105'),
            array('id' => '575','id_producto' => '132','id_imagen' => '103'),
            array('id' => '576','id_producto' => '132','id_imagen' => '118'),
            array('id' => '587','id_producto' => '132','id_imagen' => '91'),
            array('id' => '588','id_producto' => '132','id_imagen' => '98'),
            array('id' => '589','id_producto' => '132','id_imagen' => '100'),
            array('id' => '590','id_producto' => '132','id_imagen' => '99'),
            array('id' => '591','id_producto' => '132','id_imagen' => '101'),
            array('id' => '602','id_producto' => '133','id_imagen' => '105'),
            array('id' => '603','id_producto' => '133','id_imagen' => '102'),
            array('id' => '604','id_producto' => '133','id_imagen' => '119'),
            array('id' => '615','id_producto' => '133','id_imagen' => '91'),
            array('id' => '616','id_producto' => '133','id_imagen' => '98'),
            array('id' => '617','id_producto' => '133','id_imagen' => '100'),
            array('id' => '618','id_producto' => '133','id_imagen' => '99'),
            array('id' => '619','id_producto' => '133','id_imagen' => '101'),
            array('id' => '627','id_producto' => '134','id_imagen' => '105'),
            array('id' => '628','id_producto' => '134','id_imagen' => '103'),
            array('id' => '639','id_producto' => '134','id_imagen' => '91'),
            array('id' => '640','id_producto' => '134','id_imagen' => '98'),
            array('id' => '641','id_producto' => '134','id_imagen' => '100'),
            array('id' => '642','id_producto' => '134','id_imagen' => '99'),
            array('id' => '643','id_producto' => '134','id_imagen' => '101'),
            array('id' => '644','id_producto' => '134','id_imagen' => '400'),
            array('id' => '652','id_producto' => '135','id_imagen' => '106'),
            array('id' => '664','id_producto' => '135','id_imagen' => '91'),
            array('id' => '665','id_producto' => '135','id_imagen' => '98'),
            array('id' => '666','id_producto' => '135','id_imagen' => '100'),
            array('id' => '667','id_producto' => '135','id_imagen' => '99'),
            array('id' => '668','id_producto' => '135','id_imagen' => '101'),
            array('id' => '669','id_producto' => '135','id_imagen' => '401'),
            array('id' => '673','id_producto' => '128','id_imagen' => '92'),
            array('id' => '674','id_producto' => '128','id_imagen' => '105'),
            array('id' => '675','id_producto' => '128','id_imagen' => '141'),
            array('id' => '677','id_producto' => '129','id_imagen' => '143'),
            array('id' => '679','id_producto' => '130','id_imagen' => '402'),
            array('id' => '690','id_producto' => '127','id_imagen' => '101'),
            array('id' => '693','id_producto' => '136','id_imagen' => '317'),
            array('id' => '711','id_producto' => '136','id_imagen' => '91'),
            array('id' => '712','id_producto' => '136','id_imagen' => '98'),
            array('id' => '713','id_producto' => '136','id_imagen' => '100'),
            array('id' => '714','id_producto' => '136','id_imagen' => '99'),
            array('id' => '715','id_producto' => '136','id_imagen' => '101'),
            array('id' => '716','id_producto' => '136','id_imagen' => '403'),
            array('id' => '725','id_producto' => '137','id_imagen' => '105'),
            array('id' => '726','id_producto' => '137','id_imagen' => '102'),
            array('id' => '727','id_producto' => '137','id_imagen' => '119'),
            array('id' => '738','id_producto' => '137','id_imagen' => '91'),
            array('id' => '739','id_producto' => '137','id_imagen' => '98'),
            array('id' => '740','id_producto' => '137','id_imagen' => '100'),
            array('id' => '741','id_producto' => '137','id_imagen' => '99'),
            array('id' => '742','id_producto' => '137','id_imagen' => '101'),
            array('id' => '763','id_producto' => '138','id_imagen' => '91'),
            array('id' => '764','id_producto' => '138','id_imagen' => '98'),
            array('id' => '765','id_producto' => '138','id_imagen' => '100'),
            array('id' => '766','id_producto' => '138','id_imagen' => '99'),
            array('id' => '767','id_producto' => '138','id_imagen' => '101'),
            array('id' => '768','id_producto' => '138','id_imagen' => '102'),
            array('id' => '769','id_producto' => '138','id_imagen' => '106'),
            array('id' => '770','id_producto' => '138','id_imagen' => '97'),
            array('id' => '779','id_producto' => '139','id_imagen' => '102'),
            array('id' => '780','id_producto' => '139','id_imagen' => '106'),
            array('id' => '781','id_producto' => '139','id_imagen' => '112'),
            array('id' => '792','id_producto' => '139','id_imagen' => '91'),
            array('id' => '793','id_producto' => '139','id_imagen' => '98'),
            array('id' => '794','id_producto' => '139','id_imagen' => '100'),
            array('id' => '795','id_producto' => '139','id_imagen' => '99'),
            array('id' => '796','id_producto' => '139','id_imagen' => '101'),
            array('id' => '807','id_producto' => '140','id_imagen' => '102'),
            array('id' => '819','id_producto' => '140','id_imagen' => '91'),
            array('id' => '820','id_producto' => '140','id_imagen' => '98'),
            array('id' => '821','id_producto' => '140','id_imagen' => '100'),
            array('id' => '822','id_producto' => '140','id_imagen' => '99'),
            array('id' => '823','id_producto' => '140','id_imagen' => '101'),
            array('id' => '831','id_producto' => '141','id_imagen' => '105'),
            array('id' => '832','id_producto' => '141','id_imagen' => '102'),
            array('id' => '833','id_producto' => '141','id_imagen' => '117'),
            array('id' => '845','id_producto' => '141','id_imagen' => '91'),
            array('id' => '846','id_producto' => '141','id_imagen' => '98'),
            array('id' => '847','id_producto' => '141','id_imagen' => '100'),
            array('id' => '848','id_producto' => '141','id_imagen' => '99'),
            array('id' => '849','id_producto' => '141','id_imagen' => '101'),
            array('id' => '856','id_producto' => '142','id_imagen' => '105'),
            array('id' => '857','id_producto' => '142','id_imagen' => '102'),
            array('id' => '858','id_producto' => '142','id_imagen' => '117'),
            array('id' => '869','id_producto' => '142','id_imagen' => '91'),
            array('id' => '870','id_producto' => '142','id_imagen' => '98'),
            array('id' => '871','id_producto' => '142','id_imagen' => '100'),
            array('id' => '872','id_producto' => '142','id_imagen' => '99'),
            array('id' => '873','id_producto' => '142','id_imagen' => '101'),
            array('id' => '875','id_producto' => '143','id_imagen' => '341'),
            array('id' => '880','id_producto' => '143','id_imagen' => '105'),
            array('id' => '881','id_producto' => '143','id_imagen' => '103'),
            array('id' => '882','id_producto' => '143','id_imagen' => '118'),
            array('id' => '886','id_producto' => '143','id_imagen' => '91'),
            array('id' => '887','id_producto' => '143','id_imagen' => '98'),
            array('id' => '888','id_producto' => '143','id_imagen' => '100'),
            array('id' => '889','id_producto' => '143','id_imagen' => '99'),
            array('id' => '890','id_producto' => '143','id_imagen' => '101'),
            array('id' => '891','id_producto' => '144','id_imagen' => '344'),
            array('id' => '892','id_producto' => '144','id_imagen' => '345'),
            array('id' => '893','id_producto' => '144','id_imagen' => '346'),
            array('id' => '894','id_producto' => '144','id_imagen' => '347'),
            array('id' => '895','id_producto' => '144','id_imagen' => '348'),
            array('id' => '898','id_producto' => '144','id_imagen' => '105'),
            array('id' => '899','id_producto' => '144','id_imagen' => '103'),
            array('id' => '900','id_producto' => '144','id_imagen' => '119'),
            array('id' => '904','id_producto' => '144','id_imagen' => '91'),
            array('id' => '905','id_producto' => '144','id_imagen' => '98'),
            array('id' => '906','id_producto' => '144','id_imagen' => '100'),
            array('id' => '907','id_producto' => '144','id_imagen' => '99'),
            array('id' => '908','id_producto' => '144','id_imagen' => '101'),
            array('id' => '913','id_producto' => '145','id_imagen' => '92'),
            array('id' => '925','id_producto' => '145','id_imagen' => '91'),
            array('id' => '926','id_producto' => '145','id_imagen' => '98'),
            array('id' => '927','id_producto' => '145','id_imagen' => '100'),
            array('id' => '928','id_producto' => '145','id_imagen' => '101'),
            array('id' => '929','id_producto' => '145','id_imagen' => '404'),
            array('id' => '930','id_producto' => '146','id_imagen' => '370'),
            array('id' => '931','id_producto' => '146','id_imagen' => '371'),
            array('id' => '933','id_producto' => '146','id_imagen' => '373'),
            array('id' => '934','id_producto' => '146','id_imagen' => '374'),
            array('id' => '951','id_producto' => '146','id_imagen' => '91'),
            array('id' => '952','id_producto' => '146','id_imagen' => '98'),
            array('id' => '953','id_producto' => '146','id_imagen' => '100'),
            array('id' => '954','id_producto' => '146','id_imagen' => '99'),
            array('id' => '955','id_producto' => '146','id_imagen' => '101'),
            array('id' => '956','id_producto' => '147','id_imagen' => '375'),
            array('id' => '957','id_producto' => '147','id_imagen' => '376'),
            array('id' => '958','id_producto' => '147','id_imagen' => '377'),
            array('id' => '959','id_producto' => '147','id_imagen' => '378'),
            array('id' => '963','id_producto' => '147','id_imagen' => '105'),
            array('id' => '976','id_producto' => '147','id_imagen' => '91'),
            array('id' => '977','id_producto' => '147','id_imagen' => '98'),
            array('id' => '978','id_producto' => '147','id_imagen' => '100'),
            array('id' => '979','id_producto' => '147','id_imagen' => '99'),
            array('id' => '980','id_producto' => '147','id_imagen' => '101'),
            array('id' => '981','id_producto' => '146','id_imagen' => '105'),
            array('id' => '983','id_producto' => '148','id_imagen' => '386'),
            array('id' => '984','id_producto' => '148','id_imagen' => '387'),
            array('id' => '985','id_producto' => '148','id_imagen' => '388'),
            array('id' => '986','id_producto' => '148','id_imagen' => '389'),
            array('id' => '1002','id_producto' => '148','id_imagen' => '91'),
            array('id' => '1003','id_producto' => '148','id_imagen' => '98'),
            array('id' => '1004','id_producto' => '148','id_imagen' => '100'),
            array('id' => '1005','id_producto' => '148','id_imagen' => '99'),
            array('id' => '1006','id_producto' => '148','id_imagen' => '101'),
            array('id' => '1007','id_producto' => '148','id_imagen' => '105'),
            array('id' => '1008','id_producto' => '148','id_imagen' => '115'),
            array('id' => '1009','id_producto' => '149','id_imagen' => '379'),
            array('id' => '1010','id_producto' => '149','id_imagen' => '380'),
            array('id' => '1011','id_producto' => '149','id_imagen' => '381'),
            array('id' => '1013','id_producto' => '149','id_imagen' => '383'),
            array('id' => '1017','id_producto' => '149','id_imagen' => '106'),
            array('id' => '1030','id_producto' => '149','id_imagen' => '91'),
            array('id' => '1031','id_producto' => '149','id_imagen' => '98'),
            array('id' => '1032','id_producto' => '149','id_imagen' => '100'),
            array('id' => '1033','id_producto' => '149','id_imagen' => '99'),
            array('id' => '1034','id_producto' => '149','id_imagen' => '101'),
            array('id' => '1035','id_producto' => '150','id_imagen' => '384'),
            array('id' => '1036','id_producto' => '150','id_imagen' => '385'),
            array('id' => '1053','id_producto' => '150','id_imagen' => '91'),
            array('id' => '1054','id_producto' => '150','id_imagen' => '98'),
            array('id' => '1055','id_producto' => '150','id_imagen' => '100'),
            array('id' => '1056','id_producto' => '150','id_imagen' => '99'),
            array('id' => '1057','id_producto' => '150','id_imagen' => '101'),
            array('id' => '1078','id_producto' => '151','id_imagen' => '91'),
            array('id' => '1079','id_producto' => '151','id_imagen' => '98'),
            array('id' => '1080','id_producto' => '151','id_imagen' => '100'),
            array('id' => '1081','id_producto' => '151','id_imagen' => '99'),
            array('id' => '1082','id_producto' => '151','id_imagen' => '101'),
            array('id' => '1083','id_producto' => '151','id_imagen' => '405'),
            array('id' => '1709','id_producto' => '179','id_imagen' => '168'),
            array('id' => '1716','id_producto' => '179','id_imagen' => '91'),
            array('id' => '1717','id_producto' => '179','id_imagen' => '98'),
            array('id' => '1718','id_producto' => '179','id_imagen' => '99'),
            array('id' => '1719','id_producto' => '179','id_imagen' => '101'),
            array('id' => '1720','id_producto' => '131','id_imagen' => '406'),
            array('id' => '1721','id_producto' => '131','id_imagen' => '408'),
            array('id' => '1725','id_producto' => '131','id_imagen' => '92'),
            array('id' => '1771','id_producto' => '136','id_imagen' => '316'),
            array('id' => '1772','id_producto' => '136','id_imagen' => '318'),
            array('id' => '1773','id_producto' => '136','id_imagen' => '319'),
            array('id' => '1774','id_producto' => '136','id_imagen' => '315'),
            array('id' => '1803','id_producto' => '128','id_imagen' => '406'),
            array('id' => '1815','id_producto' => '127','id_imagen' => '406'),
            array('id' => '1817','id_producto' => '132','id_imagen' => '406'),
            array('id' => '1818','id_producto' => '132','id_imagen' => '408'),
            array('id' => '1819','id_producto' => '138','id_imagen' => '406'),
            array('id' => '1821','id_producto' => '143','id_imagen' => '408'),
            array('id' => '1826','id_producto' => '129','id_imagen' => '406'),
            array('id' => '1827','id_producto' => '130','id_imagen' => '406'),
            array('id' => '1842','id_producto' => '131','id_imagen' => '432'),
            array('id' => '1843','id_producto' => '131','id_imagen' => '307'),
            array('id' => '1844','id_producto' => '131','id_imagen' => '305'),
            array('id' => '1845','id_producto' => '131','id_imagen' => '308'),
            array('id' => '1846','id_producto' => '131','id_imagen' => '310'),
            array('id' => '1861','id_producto' => '132','id_imagen' => '92'),
            array('id' => '1869','id_producto' => '133','id_imagen' => '406'),
            array('id' => '1872','id_producto' => '133','id_imagen' => '408'),
            array('id' => '1873','id_producto' => '133','id_imagen' => '92'),
            array('id' => '1895','id_producto' => '133','id_imagen' => '291'),
            array('id' => '1897','id_producto' => '133','id_imagen' => '294'),
            array('id' => '1898','id_producto' => '134','id_imagen' => '430'),
            array('id' => '1899','id_producto' => '134','id_imagen' => '295'),
            array('id' => '1903','id_producto' => '134','id_imagen' => '406'),
            array('id' => '1904','id_producto' => '134','id_imagen' => '408'),
            array('id' => '1916','id_producto' => '135','id_imagen' => '406'),
            array('id' => '1917','id_producto' => '135','id_imagen' => '408'),
            array('id' => '1918','id_producto' => '135','id_imagen' => '92'),
            array('id' => '1919','id_producto' => '136','id_imagen' => '406'),
            array('id' => '1920','id_producto' => '136','id_imagen' => '408'),
            array('id' => '1921','id_producto' => '136','id_imagen' => '92'),
            array('id' => '1922','id_producto' => '137','id_imagen' => '406'),
            array('id' => '1923','id_producto' => '137','id_imagen' => '408'),
            array('id' => '1932','id_producto' => '137','id_imagen' => '426'),
            array('id' => '1933','id_producto' => '137','id_imagen' => '322'),
            array('id' => '1934','id_producto' => '137','id_imagen' => '321'),
            array('id' => '1935','id_producto' => '137','id_imagen' => '324'),
            array('id' => '1936','id_producto' => '137','id_imagen' => '323'),
            array('id' => '1937','id_producto' => '137','id_imagen' => '325'),
            array('id' => '1938','id_producto' => '137','id_imagen' => '413'),
            array('id' => '1939','id_producto' => '138','id_imagen' => '408'),
            array('id' => '1940','id_producto' => '138','id_imagen' => '92'),
            array('id' => '1950','id_producto' => '139','id_imagen' => '427'),
            array('id' => '1951','id_producto' => '139','id_imagen' => '350'),
            array('id' => '1956','id_producto' => '139','id_imagen' => '406'),
            array('id' => '1957','id_producto' => '139','id_imagen' => '408'),
            array('id' => '1958','id_producto' => '139','id_imagen' => '92'),
            array('id' => '1966','id_producto' => '140','id_imagen' => '105'),
            array('id' => '1967','id_producto' => '140','id_imagen' => '116'),
            array('id' => '1968','id_producto' => '140','id_imagen' => '406'),
            array('id' => '1969','id_producto' => '140','id_imagen' => '408'),
            array('id' => '1970','id_producto' => '140','id_imagen' => '92'),
            array('id' => '1978','id_producto' => '140','id_imagen' => '428'),
            array('id' => '1985','id_producto' => '140','id_imagen' => '356'),
            array('id' => '1986','id_producto' => '140','id_imagen' => '358'),
            array('id' => '1987','id_producto' => '140','id_imagen' => '357'),
            array('id' => '1988','id_producto' => '140','id_imagen' => '354'),
            array('id' => '1989','id_producto' => '140','id_imagen' => '355'),
            array('id' => '1990','id_producto' => '140','id_imagen' => '359'),
            array('id' => '1991','id_producto' => '141','id_imagen' => '406'),
            array('id' => '1992','id_producto' => '141','id_imagen' => '408'),
            array('id' => '2001','id_producto' => '142','id_imagen' => '406'),
            array('id' => '2002','id_producto' => '142','id_imagen' => '408'),
            array('id' => '2012','id_producto' => '142','id_imagen' => '429'),
            array('id' => '2013','id_producto' => '142','id_imagen' => '361'),
            array('id' => '2017','id_producto' => '142','id_imagen' => '360'),
            array('id' => '2018','id_producto' => '142','id_imagen' => '414'),
            array('id' => '2019','id_producto' => '142','id_imagen' => '363'),
            array('id' => '2020','id_producto' => '143','id_imagen' => '340'),
            array('id' => '2021','id_producto' => '143','id_imagen' => '342'),
            array('id' => '2022','id_producto' => '143','id_imagen' => '343'),
            array('id' => '2023','id_producto' => '143','id_imagen' => '406'),
            array('id' => '2024','id_producto' => '144','id_imagen' => '406'),
            array('id' => '2025','id_producto' => '144','id_imagen' => '408'),
            array('id' => '2026','id_producto' => '145','id_imagen' => '406'),
            array('id' => '2027','id_producto' => '145','id_imagen' => '433'),
            array('id' => '2030','id_producto' => '145','id_imagen' => '329'),
            array('id' => '2031','id_producto' => '145','id_imagen' => '328'),
            array('id' => '2032','id_producto' => '145','id_imagen' => '327'),
            array('id' => '2033','id_producto' => '146','id_imagen' => '406'),
            array('id' => '2036','id_producto' => '147','id_imagen' => '406'),
            array('id' => '2040','id_producto' => '148','id_imagen' => '406'),
            array('id' => '2041','id_producto' => '148','id_imagen' => '408'),
            array('id' => '2043','id_producto' => '149','id_imagen' => '406'),
            array('id' => '2046','id_producto' => '150','id_imagen' => '406'),
            array('id' => '2049','id_producto' => '151','id_imagen' => '406'),
            array('id' => '2058','id_producto' => '151','id_imagen' => '105'),
            array('id' => '2059','id_producto' => '151','id_imagen' => '408'),
            array('id' => '2060','id_producto' => '151','id_imagen' => '92'),
            array('id' => '2118','id_producto' => '179','id_imagen' => '406'),
            array('id' => '2119','id_producto' => '179','id_imagen' => '165'),
            array('id' => '2120','id_producto' => '179','id_imagen' => '164'),
            array('id' => '2121','id_producto' => '179','id_imagen' => '167'),
            array('id' => '2122','id_producto' => '179','id_imagen' => '454'),
            array('id' => '2124','id_producto' => '179','id_imagen' => '458'),
            array('id' => '2125','id_producto' => '179','id_imagen' => '408'),
            array('id' => '2132','id_producto' => '180','id_imagen' => '406'),
            array('id' => '2133','id_producto' => '180','id_imagen' => '454'),
            array('id' => '2134','id_producto' => '180','id_imagen' => '459'),
            array('id' => '2135','id_producto' => '180','id_imagen' => '408'),
            array('id' => '2138','id_producto' => '180','id_imagen' => '91'),
            array('id' => '2139','id_producto' => '180','id_imagen' => '98'),
            array('id' => '2140','id_producto' => '180','id_imagen' => '99'),
            array('id' => '2141','id_producto' => '180','id_imagen' => '101'),
            array('id' => '2142','id_producto' => '181','id_imagen' => '177'),
            array('id' => '2143','id_producto' => '181','id_imagen' => '178'),
            array('id' => '2144','id_producto' => '181','id_imagen' => '179'),
            array('id' => '2145','id_producto' => '181','id_imagen' => '180'),
            array('id' => '2146','id_producto' => '181','id_imagen' => '406'),
            array('id' => '2147','id_producto' => '181','id_imagen' => '454'),
            array('id' => '2148','id_producto' => '181','id_imagen' => '457'),
            array('id' => '2149','id_producto' => '181','id_imagen' => '408'),
            array('id' => '2160','id_producto' => '181','id_imagen' => '91'),
            array('id' => '2161','id_producto' => '181','id_imagen' => '98'),
            array('id' => '2162','id_producto' => '181','id_imagen' => '99'),
            array('id' => '2163','id_producto' => '181','id_imagen' => '101'),
            array('id' => '2170','id_producto' => '182','id_imagen' => '115'),
            array('id' => '2171','id_producto' => '182','id_imagen' => '105'),
            array('id' => '2172','id_producto' => '182','id_imagen' => '408'),
            array('id' => '2173','id_producto' => '182','id_imagen' => '406'),
            array('id' => '2185','id_producto' => '182','id_imagen' => '91'),
            array('id' => '2186','id_producto' => '182','id_imagen' => '98'),
            array('id' => '2187','id_producto' => '182','id_imagen' => '100'),
            array('id' => '2188','id_producto' => '182','id_imagen' => '99'),
            array('id' => '2189','id_producto' => '182','id_imagen' => '101'),
            array('id' => '2190','id_producto' => '183','id_imagen' => '395'),
            array('id' => '2191','id_producto' => '183','id_imagen' => '396'),
            array('id' => '2192','id_producto' => '183','id_imagen' => '397'),
            array('id' => '2193','id_producto' => '183','id_imagen' => '406'),
            array('id' => '2194','id_producto' => '183','id_imagen' => '105'),
            array('id' => '2206','id_producto' => '183','id_imagen' => '91'),
            array('id' => '2207','id_producto' => '183','id_imagen' => '98'),
            array('id' => '2208','id_producto' => '183','id_imagen' => '100'),
            array('id' => '2209','id_producto' => '183','id_imagen' => '99'),
            array('id' => '2210','id_producto' => '183','id_imagen' => '101'),
            array('id' => '2211','id_producto' => '183','id_imagen' => '460'),
            array('id' => '2212','id_producto' => '183','id_imagen' => '408'),
            array('id' => '2218','id_producto' => '184','id_imagen' => '406'),
            array('id' => '2219','id_producto' => '184','id_imagen' => '91'),
            array('id' => '2220','id_producto' => '184','id_imagen' => '98'),
            array('id' => '2221','id_producto' => '184','id_imagen' => '100'),
            array('id' => '2222','id_producto' => '184','id_imagen' => '101'),
            array('id' => '2226','id_producto' => '185','id_imagen' => '406'),
            array('id' => '2227','id_producto' => '185','id_imagen' => '91'),
            array('id' => '2228','id_producto' => '185','id_imagen' => '98'),
            array('id' => '2229','id_producto' => '185','id_imagen' => '100'),
            array('id' => '2230','id_producto' => '185','id_imagen' => '101'),
            array('id' => '2231','id_producto' => '186','id_imagen' => '447'),
            array('id' => '2232','id_producto' => '186','id_imagen' => '406'),
            array('id' => '2233','id_producto' => '186','id_imagen' => '91'),
            array('id' => '2234','id_producto' => '186','id_imagen' => '98'),
            array('id' => '2235','id_producto' => '186','id_imagen' => '100'),
            array('id' => '2236','id_producto' => '186','id_imagen' => '101'),
            array('id' => '2237','id_producto' => '187','id_imagen' => '451'),
            array('id' => '2238','id_producto' => '187','id_imagen' => '452'),
            array('id' => '2239','id_producto' => '187','id_imagen' => '449'),
            array('id' => '2240','id_producto' => '187','id_imagen' => '450'),
            array('id' => '2241','id_producto' => '187','id_imagen' => '448'),
            array('id' => '2242','id_producto' => '187','id_imagen' => '91'),
            array('id' => '2243','id_producto' => '187','id_imagen' => '99'),
            array('id' => '2244','id_producto' => '187','id_imagen' => '101'),
            array('id' => '2245','id_producto' => '188','id_imagen' => '438'),
            array('id' => '2246','id_producto' => '188','id_imagen' => '434'),
            array('id' => '2247','id_producto' => '188','id_imagen' => '435'),
            array('id' => '2248','id_producto' => '188','id_imagen' => '436'),
            array('id' => '2249','id_producto' => '188','id_imagen' => '437'),
            array('id' => '2250','id_producto' => '188','id_imagen' => '91'),
            array('id' => '2251','id_producto' => '188','id_imagen' => '99'),
            array('id' => '2252','id_producto' => '188','id_imagen' => '101'),
            array('id' => '2263','id_producto' => '189','id_imagen' => '429'),
            array('id' => '2264','id_producto' => '189','id_imagen' => '428'),
            array('id' => '2265','id_producto' => '189','id_imagen' => '427'),
            array('id' => '2266','id_producto' => '189','id_imagen' => '426'),
            array('id' => '2267','id_producto' => '189','id_imagen' => '414'),
            array('id' => '2277','id_producto' => '189','id_imagen' => '91'),
            array('id' => '2278','id_producto' => '189','id_imagen' => '98'),
            array('id' => '2279','id_producto' => '189','id_imagen' => '100'),
            array('id' => '2280','id_producto' => '189','id_imagen' => '99'),
            array('id' => '2281','id_producto' => '189','id_imagen' => '101'),
            array('id' => '2282','id_producto' => '190','id_imagen' => '168'),
            array('id' => '2283','id_producto' => '190','id_imagen' => '170'),
            array('id' => '2285','id_producto' => '190','id_imagen' => '175'),
            array('id' => '2286','id_producto' => '190','id_imagen' => '183'),
            array('id' => '2287','id_producto' => '190','id_imagen' => '184'),
            array('id' => '2288','id_producto' => '190','id_imagen' => '91'),
            array('id' => '2289','id_producto' => '190','id_imagen' => '98'),
            array('id' => '2290','id_producto' => '190','id_imagen' => '100'),
            array('id' => '2291','id_producto' => '190','id_imagen' => '99'),
            array('id' => '2292','id_producto' => '190','id_imagen' => '101'),
            array('id' => '2298','id_producto' => '133','id_imagen' => '409'),
            array('id' => '2299','id_producto' => '133','id_imagen' => '410'),
            array('id' => '2304','id_producto' => '149','id_imagen' => '114'),
            array('id' => '2305','id_producto' => '149','id_imagen' => '92'),
            array('id' => '2306','id_producto' => '149','id_imagen' => '408'),
            array('id' => '2307','id_producto' => '146','id_imagen' => '114'),
            array('id' => '2308','id_producto' => '146','id_imagen' => '92'),
            array('id' => '2309','id_producto' => '146','id_imagen' => '408'),
            array('id' => '2313','id_producto' => '150','id_imagen' => '107'),
            array('id' => '2314','id_producto' => '150','id_imagen' => '110'),
            array('id' => '2315','id_producto' => '150','id_imagen' => '92'),
            array('id' => '2316','id_producto' => '150','id_imagen' => '408'),
            array('id' => '2317','id_producto' => '147','id_imagen' => '114'),
            array('id' => '2318','id_producto' => '147','id_imagen' => '92'),
            array('id' => '2319','id_producto' => '147','id_imagen' => '408'),
            array('id' => '2320','id_producto' => '182','id_imagen' => '472'),
            array('id' => '2321','id_producto' => '182','id_imagen' => '390'),
            array('id' => '2322','id_producto' => '182','id_imagen' => '392'),
            array('id' => '2323','id_producto' => '182','id_imagen' => '431'),
            array('id' => '2324','id_producto' => '182','id_imagen' => '391'),
            array('id' => '2325','id_producto' => '182','id_imagen' => '394'),
            array('id' => '2326','id_producto' => '180','id_imagen' => '473'),
            array('id' => '2327','id_producto' => '180','id_imagen' => '170'),
            array('id' => '2329','id_producto' => '180','id_imagen' => '174'),
            array('id' => '2330','id_producto' => '180','id_imagen' => '175'),
            array('id' => '2331','id_producto' => '180','id_imagen' => '173'),
            array('id' => '2337','id_producto' => '129','id_imagen' => '474'),
            array('id' => '2358','id_producto' => '143','id_imagen' => '474'),
            array('id' => '2360','id_producto' => '144','id_imagen' => '474'),
            array('id' => '2412','id_producto' => '179','id_imagen' => '474'),
            array('id' => '2435','id_producto' => '192','id_imagen' => '476'),
            array('id' => '2438','id_producto' => '192','id_imagen' => '406'),
            array('id' => '2439','id_producto' => '192','id_imagen' => '91'),
            array('id' => '2440','id_producto' => '192','id_imagen' => '98'),
            array('id' => '2441','id_producto' => '192','id_imagen' => '100'),
            array('id' => '2442','id_producto' => '192','id_imagen' => '101'),
            array('id' => '2458','id_producto' => '193','id_imagen' => '91'),
            array('id' => '2459','id_producto' => '193','id_imagen' => '98'),
            array('id' => '2460','id_producto' => '193','id_imagen' => '99'),
            array('id' => '2461','id_producto' => '193','id_imagen' => '100'),
            array('id' => '2462','id_producto' => '193','id_imagen' => '101'),
            array('id' => '2486','id_producto' => '193','id_imagen' => '162'),
            array('id' => '2491','id_producto' => '193','id_imagen' => '93'),
            array('id' => '2494','id_producto' => '193','id_imagen' => '317'),
            array('id' => '2501','id_producto' => '193','id_imagen' => '476'),
            array('id' => '2502','id_producto' => '193','id_imagen' => '406'),
            array('id' => '2586','id_producto' => '194','id_imagen' => '183'),
            array('id' => '2587','id_producto' => '194','id_imagen' => '184'),
            array('id' => '2588','id_producto' => '194','id_imagen' => '185'),
            array('id' => '2589','id_producto' => '194','id_imagen' => '186'),
            array('id' => '2590','id_producto' => '194','id_imagen' => '187'),
            array('id' => '2591','id_producto' => '194','id_imagen' => '107'),
            array('id' => '2592','id_producto' => '194','id_imagen' => '459'),
            array('id' => '2593','id_producto' => '194','id_imagen' => '408'),
            array('id' => '2594','id_producto' => '194','id_imagen' => '406'),
            array('id' => '2606','id_producto' => '194','id_imagen' => '91'),
            array('id' => '2607','id_producto' => '194','id_imagen' => '98'),
            array('id' => '2608','id_producto' => '194','id_imagen' => '99'),
            array('id' => '2609','id_producto' => '194','id_imagen' => '100'),
            array('id' => '2610','id_producto' => '194','id_imagen' => '101'),
            array('id' => '2621','id_producto' => '195','id_imagen' => '406'),
            array('id' => '2633','id_producto' => '195','id_imagen' => '91'),
            array('id' => '2634','id_producto' => '195','id_imagen' => '98'),
            array('id' => '2635','id_producto' => '195','id_imagen' => '99'),
            array('id' => '2636','id_producto' => '195','id_imagen' => '100'),
            array('id' => '2637','id_producto' => '195','id_imagen' => '101'),
            array('id' => '2640','id_producto' => '196','id_imagen' => '406'),
            array('id' => '2652','id_producto' => '196','id_imagen' => '91'),
            array('id' => '2653','id_producto' => '196','id_imagen' => '98'),
            array('id' => '2654','id_producto' => '196','id_imagen' => '99'),
            array('id' => '2655','id_producto' => '196','id_imagen' => '100'),
            array('id' => '2656','id_producto' => '196','id_imagen' => '101'),
            array('id' => '2659','id_producto' => '197','id_imagen' => '406'),
            array('id' => '2671','id_producto' => '197','id_imagen' => '91'),
            array('id' => '2672','id_producto' => '197','id_imagen' => '98'),
            array('id' => '2673','id_producto' => '197','id_imagen' => '99'),
            array('id' => '2674','id_producto' => '197','id_imagen' => '100'),
            array('id' => '2675','id_producto' => '197','id_imagen' => '101'),
            array('id' => '2677','id_producto' => '198','id_imagen' => '406'),
            array('id' => '2688','id_producto' => '198','id_imagen' => '474'),
            array('id' => '2689','id_producto' => '198','id_imagen' => '91'),
            array('id' => '2690','id_producto' => '198','id_imagen' => '98'),
            array('id' => '2691','id_producto' => '198','id_imagen' => '99'),
            array('id' => '2692','id_producto' => '198','id_imagen' => '100'),
            array('id' => '2693','id_producto' => '198','id_imagen' => '101'),
            array('id' => '2702','id_producto' => '199','id_imagen' => '406'),
            array('id' => '2703','id_producto' => '199','id_imagen' => '158'),
            array('id' => '2704','id_producto' => '199','id_imagen' => '105'),
            array('id' => '2705','id_producto' => '199','id_imagen' => '475'),
            array('id' => '2718','id_producto' => '199','id_imagen' => '91'),
            array('id' => '2719','id_producto' => '199','id_imagen' => '98'),
            array('id' => '2720','id_producto' => '199','id_imagen' => '100'),
            array('id' => '2721','id_producto' => '199','id_imagen' => '101'),
            array('id' => '2722','id_producto' => '200','id_imagen' => '156'),
            array('id' => '2723','id_producto' => '200','id_imagen' => '157'),
            array('id' => '2724','id_producto' => '200','id_imagen' => '153'),
            array('id' => '2725','id_producto' => '200','id_imagen' => '154'),
            array('id' => '2726','id_producto' => '200','id_imagen' => '155'),
            array('id' => '2727','id_producto' => '200','id_imagen' => '159'),
            array('id' => '2728','id_producto' => '200','id_imagen' => '162'),
            array('id' => '2729','id_producto' => '200','id_imagen' => '163'),
            array('id' => '2730','id_producto' => '200','id_imagen' => '406'),
            array('id' => '2731','id_producto' => '200','id_imagen' => '158'),
            array('id' => '2732','id_producto' => '200','id_imagen' => '105'),
            array('id' => '2733','id_producto' => '200','id_imagen' => '475'),
            array('id' => '2746','id_producto' => '200','id_imagen' => '91'),
            array('id' => '2747','id_producto' => '200','id_imagen' => '98'),
            array('id' => '2751','id_producto' => '201','id_imagen' => '491'),
            array('id' => '2752','id_producto' => '201','id_imagen' => '492'),
            array('id' => '2753','id_producto' => '201','id_imagen' => '493'),
            array('id' => '2754','id_producto' => '201','id_imagen' => '488'),
            array('id' => '2755','id_producto' => '201','id_imagen' => '489'),
            array('id' => '2756','id_producto' => '201','id_imagen' => '257'),
            array('id' => '2757','id_producto' => '201','id_imagen' => '259'),
            array('id' => '2758','id_producto' => '201','id_imagen' => '246'),
            array('id' => '2759','id_producto' => '201','id_imagen' => '247'),
            array('id' => '2760','id_producto' => '201','id_imagen' => '248'),
            array('id' => '2761','id_producto' => '201','id_imagen' => '260'),
            array('id' => '2762','id_producto' => '201','id_imagen' => '406'),
            array('id' => '2763','id_producto' => '201','id_imagen' => '105'),
            array('id' => '2764','id_producto' => '201','id_imagen' => '158'),
            array('id' => '2765','id_producto' => '201','id_imagen' => '475'),
            array('id' => '2778','id_producto' => '201','id_imagen' => '91'),
            array('id' => '2779','id_producto' => '201','id_imagen' => '98'),
            array('id' => '2780','id_producto' => '201','id_imagen' => '100'),
            array('id' => '2781','id_producto' => '201','id_imagen' => '101'),
            array('id' => '2792','id_producto' => '202','id_imagen' => '218'),
            array('id' => '2794','id_producto' => '202','id_imagen' => '406'),
            array('id' => '2795','id_producto' => '202','id_imagen' => '105'),
            array('id' => '2796','id_producto' => '202','id_imagen' => '158'),
            array('id' => '2797','id_producto' => '202','id_imagen' => '475'),
            array('id' => '2810','id_producto' => '202','id_imagen' => '91'),
            array('id' => '2811','id_producto' => '202','id_imagen' => '98'),
            array('id' => '2812','id_producto' => '202','id_imagen' => '100'),
            array('id' => '2813','id_producto' => '202','id_imagen' => '101'),
            array('id' => '2814','id_producto' => '203','id_imagen' => '504'),
            array('id' => '2815','id_producto' => '203','id_imagen' => '503'),
            array('id' => '2816','id_producto' => '203','id_imagen' => '505'),
            array('id' => '2817','id_producto' => '203','id_imagen' => '502'),
            array('id' => '2818','id_producto' => '203','id_imagen' => '214'),
            array('id' => '2819','id_producto' => '203','id_imagen' => '406'),
            array('id' => '2820','id_producto' => '203','id_imagen' => '105'),
            array('id' => '2821','id_producto' => '203','id_imagen' => '158'),
            array('id' => '2822','id_producto' => '203','id_imagen' => '475'),
            array('id' => '2835','id_producto' => '203','id_imagen' => '91'),
            array('id' => '2836','id_producto' => '203','id_imagen' => '98'),
            array('id' => '2837','id_producto' => '203','id_imagen' => '100'),
            array('id' => '2838','id_producto' => '203','id_imagen' => '101'),
            array('id' => '2839','id_producto' => '199','id_imagen' => '226'),
            array('id' => '2846','id_producto' => '204','id_imagen' => '511'),
            array('id' => '2847','id_producto' => '204','id_imagen' => '269'),
            array('id' => '2848','id_producto' => '204','id_imagen' => '270'),
            array('id' => '2849','id_producto' => '204','id_imagen' => '262'),
            array('id' => '2850','id_producto' => '204','id_imagen' => '508'),
            array('id' => '2851','id_producto' => '204','id_imagen' => '275'),
            array('id' => '2852','id_producto' => '204','id_imagen' => '278'),
            array('id' => '2853','id_producto' => '204','id_imagen' => '279'),
            array('id' => '2854','id_producto' => '204','id_imagen' => '284'),
            array('id' => '2855','id_producto' => '204','id_imagen' => '506'),
            array('id' => '2856','id_producto' => '204','id_imagen' => '507'),
            array('id' => '2857','id_producto' => '204','id_imagen' => '509'),
            array('id' => '2858','id_producto' => '204','id_imagen' => '510'),
            array('id' => '2859','id_producto' => '204','id_imagen' => '406'),
            array('id' => '2860','id_producto' => '204','id_imagen' => '105'),
            array('id' => '2875','id_producto' => '204','id_imagen' => '91'),
            array('id' => '2876','id_producto' => '204','id_imagen' => '98'),
            array('id' => '2877','id_producto' => '204','id_imagen' => '100'),
            array('id' => '2878','id_producto' => '204','id_imagen' => '101'),
            array('id' => '2879','id_producto' => '127','id_imagen' => '512'),
            array('id' => '2880','id_producto' => '127','id_imagen' => '513'),
            array('id' => '2881','id_producto' => '127','id_imagen' => '514'),
            array('id' => '2882','id_producto' => '127','id_imagen' => '93'),
            array('id' => '2883','id_producto' => '127','id_imagen' => '94'),
            array('id' => '2884','id_producto' => '127','id_imagen' => '453'),
            array('id' => '2897','id_producto' => '151','id_imagen' => '516'),
            array('id' => '2900','id_producto' => '151','id_imagen' => '511'),
            array('id' => '2901','id_producto' => '151','id_imagen' => '517'),
            array('id' => '2902','id_producto' => '151','id_imagen' => '518'),
            array('id' => '2903','id_producto' => '151','id_imagen' => '515'),
            array('id' => '2904','id_producto' => '151','id_imagen' => '476'),
            array('id' => '2905','id_producto' => '151','id_imagen' => '477'),
            array('id' => '2906','id_producto' => '151','id_imagen' => '478'),
            array('id' => '2907','id_producto' => '151','id_imagen' => '367'),
            array('id' => '2908','id_producto' => '151','id_imagen' => '364'),
            array('id' => '2909','id_producto' => '151','id_imagen' => '365'),
            array('id' => '2910','id_producto' => '192','id_imagen' => '518'),
            array('id' => '2911','id_producto' => '192','id_imagen' => '477'),
            array('id' => '2912','id_producto' => '192','id_imagen' => '478'),
            array('id' => '2913','id_producto' => '141','id_imagen' => '519'),
            array('id' => '2915','id_producto' => '141','id_imagen' => '521'),
            array('id' => '2916','id_producto' => '141','id_imagen' => '520'),
            array('id' => '2918','id_producto' => '141','id_imagen' => '331'),
            array('id' => '2919','id_producto' => '141','id_imagen' => '332'),
            array('id' => '2920','id_producto' => '141','id_imagen' => '333'),
            array('id' => '2924','id_producto' => '138','id_imagen' => '525'),
            array('id' => '2927','id_producto' => '138','id_imagen' => '522'),
            array('id' => '2929','id_producto' => '138','id_imagen' => '524'),
            array('id' => '2933','id_producto' => '134','id_imagen' => '527'),
            array('id' => '2934','id_producto' => '134','id_imagen' => '528'),
            array('id' => '2935','id_producto' => '134','id_imagen' => '296'),
            array('id' => '2936','id_producto' => '134','id_imagen' => '297'),
            array('id' => '2937','id_producto' => '134','id_imagen' => '298'),
            array('id' => '2938','id_producto' => '128','id_imagen' => '527'),
            array('id' => '2939','id_producto' => '128','id_imagen' => '139'),
            array('id' => '2940','id_producto' => '128','id_imagen' => '152'),
            array('id' => '2941','id_producto' => '135','id_imagen' => '529'),
            array('id' => '2942','id_producto' => '135','id_imagen' => '530'),
            array('id' => '2943','id_producto' => '135','id_imagen' => '312'),
            array('id' => '2947','id_producto' => '135','id_imagen' => '313'),
            array('id' => '2948','id_producto' => '135','id_imagen' => '311'),
            array('id' => '2949','id_producto' => '135','id_imagen' => '314'),
            array('id' => '2951','id_producto' => '132','id_imagen' => '532'),
            array('id' => '2952','id_producto' => '132','id_imagen' => '531'),
            array('id' => '2953','id_producto' => '132','id_imagen' => '467'),
            array('id' => '2955','id_producto' => '132','id_imagen' => '301'),
            array('id' => '2956','id_producto' => '132','id_imagen' => '300'),
            array('id' => '2957','id_producto' => '132','id_imagen' => '411'),
            array('id' => '2958','id_producto' => '139','id_imagen' => '533'),
            array('id' => '2959','id_producto' => '139','id_imagen' => '534'),
            array('id' => '2960','id_producto' => '139','id_imagen' => '349'),
            array('id' => '2961','id_producto' => '139','id_imagen' => '352'),
            array('id' => '2962','id_producto' => '139','id_imagen' => '351'),
            array('id' => '2963','id_producto' => '139','id_imagen' => '353'),
            array('id' => '2965','id_producto' => '142','id_imagen' => '536'),
            array('id' => '2966','id_producto' => '142','id_imagen' => '535'),
            array('id' => '2967','id_producto' => '183','id_imagen' => '537'),
            array('id' => '2968','id_producto' => '136','id_imagen' => '538'),
            array('id' => '2969','id_producto' => '138','id_imagen' => '523'),
            array('id' => '2970','id_producto' => '138','id_imagen' => '539'),
            array('id' => '2971','id_producto' => '138','id_imagen' => '526'),
            array('id' => '2972','id_producto' => '138','id_imagen' => '334'),
            array('id' => '2973','id_producto' => '138','id_imagen' => '335'),
            array('id' => '2974','id_producto' => '138','id_imagen' => '474'),
            array('id' => '2976','id_producto' => '138','id_imagen' => '128'),
            array('id' => '2977','id_producto' => '138','id_imagen' => '127'),
            array('id' => '2978','id_producto' => '138','id_imagen' => '126'),
            array('id' => '2979','id_producto' => '138','id_imagen' => '125'),
            array('id' => '2980','id_producto' => '138','id_imagen' => '124'),
            array('id' => '2982','id_producto' => '138','id_imagen' => '123'),
            array('id' => '2986','id_producto' => '198','id_imagen' => '541'),
            array('id' => '2988','id_producto' => '198','id_imagen' => '479'),
            array('id' => '2989','id_producto' => '198','id_imagen' => '540'),
            array('id' => '2991','id_producto' => '198','id_imagen' => '128'),
            array('id' => '2992','id_producto' => '198','id_imagen' => '127'),
            array('id' => '2993','id_producto' => '198','id_imagen' => '126'),
            array('id' => '2994','id_producto' => '198','id_imagen' => '125'),
            array('id' => '2995','id_producto' => '198','id_imagen' => '124'),
            array('id' => '2996','id_producto' => '198','id_imagen' => '123'),
            array('id' => '2997','id_producto' => '198','id_imagen' => '122'),
            array('id' => '2998','id_producto' => '198','id_imagen' => '121'),
            array('id' => '3001','id_producto' => '204','id_imagen' => '474'),
            array('id' => '3013','id_producto' => '204','id_imagen' => '115'),
            array('id' => '3014','id_producto' => '204','id_imagen' => '475'),
            array('id' => '3015','id_producto' => '204','id_imagen' => '408'),
            array('id' => '3017','id_producto' => '204','id_imagen' => '128'),
            array('id' => '3018','id_producto' => '204','id_imagen' => '127'),
            array('id' => '3019','id_producto' => '204','id_imagen' => '126'),
            array('id' => '3020','id_producto' => '204','id_imagen' => '125'),
            array('id' => '3021','id_producto' => '204','id_imagen' => '124'),
            array('id' => '3022','id_producto' => '204','id_imagen' => '123'),
            array('id' => '3023','id_producto' => '204','id_imagen' => '122'),
            array('id' => '3024','id_producto' => '204','id_imagen' => '121'),
            array('id' => '3027','id_producto' => '199','id_imagen' => '408'),
            array('id' => '3048','id_producto' => '199','id_imagen' => '486'),
            array('id' => '3049','id_producto' => '199','id_imagen' => '487'),
            array('id' => '3050','id_producto' => '199','id_imagen' => '484'),
            array('id' => '3051','id_producto' => '199','id_imagen' => '485'),
            array('id' => '3052','id_producto' => '199','id_imagen' => '189'),
            array('id' => '3053','id_producto' => '199','id_imagen' => '192'),
            array('id' => '3054','id_producto' => '199','id_imagen' => '194'),
            array('id' => '3055','id_producto' => '199','id_imagen' => '198'),
            array('id' => '3057','id_producto' => '202','id_imagen' => '474'),
            array('id' => '3059','id_producto' => '202','id_imagen' => '128'),
            array('id' => '3060','id_producto' => '202','id_imagen' => '127'),
            array('id' => '3061','id_producto' => '202','id_imagen' => '126'),
            array('id' => '3062','id_producto' => '202','id_imagen' => '125'),
            array('id' => '3063','id_producto' => '202','id_imagen' => '124'),
            array('id' => '3064','id_producto' => '202','id_imagen' => '123'),
            array('id' => '3065','id_producto' => '202','id_imagen' => '122'),
            array('id' => '3066','id_producto' => '202','id_imagen' => '121'),
            array('id' => '3069','id_producto' => '203','id_imagen' => '474'),
            array('id' => '3071','id_producto' => '203','id_imagen' => '128'),
            array('id' => '3072','id_producto' => '203','id_imagen' => '127'),
            array('id' => '3073','id_producto' => '203','id_imagen' => '126'),
            array('id' => '3074','id_producto' => '203','id_imagen' => '125'),
            array('id' => '3075','id_producto' => '203','id_imagen' => '124'),
            array('id' => '3076','id_producto' => '203','id_imagen' => '123'),
            array('id' => '3077','id_producto' => '203','id_imagen' => '122'),
            array('id' => '3078','id_producto' => '203','id_imagen' => '121'),
            array('id' => '3081','id_producto' => '201','id_imagen' => '474'),
            array('id' => '3083','id_producto' => '201','id_imagen' => '128'),
            array('id' => '3084','id_producto' => '201','id_imagen' => '127'),
            array('id' => '3085','id_producto' => '201','id_imagen' => '126'),
            array('id' => '3086','id_producto' => '201','id_imagen' => '125'),
            array('id' => '3087','id_producto' => '201','id_imagen' => '123'),
            array('id' => '3088','id_producto' => '201','id_imagen' => '122'),
            array('id' => '3089','id_producto' => '201','id_imagen' => '121'),
            array('id' => '3090','id_producto' => '201','id_imagen' => '124'),
            array('id' => '3093','id_producto' => '200','id_imagen' => '474'),
            array('id' => '3095','id_producto' => '200','id_imagen' => '128'),
            array('id' => '3096','id_producto' => '200','id_imagen' => '127'),
            array('id' => '3097','id_producto' => '200','id_imagen' => '126'),
            array('id' => '3098','id_producto' => '200','id_imagen' => '125'),
            array('id' => '3099','id_producto' => '200','id_imagen' => '124'),
            array('id' => '3100','id_producto' => '200','id_imagen' => '123'),
            array('id' => '3101','id_producto' => '200','id_imagen' => '122'),
            array('id' => '3102','id_producto' => '200','id_imagen' => '121'),
            array('id' => '3105','id_producto' => '200','id_imagen' => '408'),
            array('id' => '3106','id_producto' => '200','id_imagen' => '99'),
            array('id' => '3107','id_producto' => '200','id_imagen' => '100'),
            array('id' => '3108','id_producto' => '200','id_imagen' => '101'),
            array('id' => '3109','id_producto' => '201','id_imagen' => '490'),
            array('id' => '3110','id_producto' => '202','id_imagen' => '227'),
            array('id' => '3111','id_producto' => '202','id_imagen' => '228'),
            array('id' => '3112','id_producto' => '202','id_imagen' => '494'),
            array('id' => '3113','id_producto' => '202','id_imagen' => '497'),
            array('id' => '3114','id_producto' => '202','id_imagen' => '496'),
            array('id' => '3115','id_producto' => '202','id_imagen' => '498'),
            array('id' => '3116','id_producto' => '202','id_imagen' => '499'),
            array('id' => '3117','id_producto' => '202','id_imagen' => '500'),
            array('id' => '3118','id_producto' => '202','id_imagen' => '501'),
            array('id' => '3119','id_producto' => '202','id_imagen' => '229'),
            array('id' => '3120','id_producto' => '202','id_imagen' => '237'),
            array('id' => '3121','id_producto' => '127','id_imagen' => '474'),
            array('id' => '3123','id_producto' => '127','id_imagen' => '128'),
            array('id' => '3124','id_producto' => '127','id_imagen' => '127'),
            array('id' => '3125','id_producto' => '127','id_imagen' => '126'),
            array('id' => '3126','id_producto' => '127','id_imagen' => '125'),
            array('id' => '3127','id_producto' => '127','id_imagen' => '124'),
            array('id' => '3128','id_producto' => '127','id_imagen' => '123'),
            array('id' => '3129','id_producto' => '127','id_imagen' => '122'),
            array('id' => '3130','id_producto' => '127','id_imagen' => '121'),
            array('id' => '3131','id_producto' => '127','id_imagen' => '96'),
            array('id' => '3132','id_producto' => '127','id_imagen' => '120'),
            array('id' => '3133','id_producto' => '128','id_imagen' => '474'),
            array('id' => '3135','id_producto' => '128','id_imagen' => '128'),
            array('id' => '3136','id_producto' => '128','id_imagen' => '127'),
            array('id' => '3137','id_producto' => '128','id_imagen' => '126'),
            array('id' => '3138','id_producto' => '128','id_imagen' => '125'),
            array('id' => '3139','id_producto' => '128','id_imagen' => '124'),
            array('id' => '3140','id_producto' => '128','id_imagen' => '123'),
            array('id' => '3141','id_producto' => '128','id_imagen' => '121'),
            array('id' => '3142','id_producto' => '128','id_imagen' => '122'),
            array('id' => '3145','id_producto' => '129','id_imagen' => '128'),
            array('id' => '3146','id_producto' => '129','id_imagen' => '127'),
            array('id' => '3147','id_producto' => '130','id_imagen' => '474'),
            array('id' => '3149','id_producto' => '130','id_imagen' => '128'),
            array('id' => '3150','id_producto' => '130','id_imagen' => '127'),
            array('id' => '3151','id_producto' => '130','id_imagen' => '126'),
            array('id' => '3152','id_producto' => '130','id_imagen' => '125'),
            array('id' => '3153','id_producto' => '130','id_imagen' => '124'),
            array('id' => '3154','id_producto' => '130','id_imagen' => '123'),
            array('id' => '3155','id_producto' => '130','id_imagen' => '122'),
            array('id' => '3156','id_producto' => '130','id_imagen' => '121'),
            array('id' => '3157','id_producto' => '130','id_imagen' => '96'),
            array('id' => '3158','id_producto' => '130','id_imagen' => '120'),
            array('id' => '3159','id_producto' => '131','id_imagen' => '474'),
            array('id' => '3161','id_producto' => '131','id_imagen' => '128'),
            array('id' => '3162','id_producto' => '131','id_imagen' => '127'),
            array('id' => '3163','id_producto' => '131','id_imagen' => '126'),
            array('id' => '3164','id_producto' => '131','id_imagen' => '125'),
            array('id' => '3165','id_producto' => '131','id_imagen' => '124'),
            array('id' => '3166','id_producto' => '131','id_imagen' => '123'),
            array('id' => '3167','id_producto' => '131','id_imagen' => '122'),
            array('id' => '3168','id_producto' => '131','id_imagen' => '121'),
            array('id' => '3169','id_producto' => '131','id_imagen' => '120'),
            array('id' => '3170','id_producto' => '131','id_imagen' => '96'),
            array('id' => '3171','id_producto' => '132','id_imagen' => '474'),
            array('id' => '3173','id_producto' => '132','id_imagen' => '128'),
            array('id' => '3174','id_producto' => '132','id_imagen' => '127'),
            array('id' => '3175','id_producto' => '132','id_imagen' => '125'),
            array('id' => '3176','id_producto' => '132','id_imagen' => '124'),
            array('id' => '3177','id_producto' => '132','id_imagen' => '126'),
            array('id' => '3178','id_producto' => '132','id_imagen' => '122'),
            array('id' => '3179','id_producto' => '132','id_imagen' => '123'),
            array('id' => '3180','id_producto' => '132','id_imagen' => '121'),
            array('id' => '3181','id_producto' => '132','id_imagen' => '120'),
            array('id' => '3182','id_producto' => '132','id_imagen' => '96'),
            array('id' => '3183','id_producto' => '133','id_imagen' => '474'),
            array('id' => '3185','id_producto' => '133','id_imagen' => '128'),
            array('id' => '3186','id_producto' => '133','id_imagen' => '127'),
            array('id' => '3187','id_producto' => '133','id_imagen' => '126'),
            array('id' => '3188','id_producto' => '133','id_imagen' => '125'),
            array('id' => '3189','id_producto' => '133','id_imagen' => '123'),
            array('id' => '3190','id_producto' => '133','id_imagen' => '124'),
            array('id' => '3191','id_producto' => '133','id_imagen' => '122'),
            array('id' => '3192','id_producto' => '133','id_imagen' => '121'),
            array('id' => '3193','id_producto' => '133','id_imagen' => '120'),
            array('id' => '3194','id_producto' => '133','id_imagen' => '96'),
            array('id' => '3195','id_producto' => '134','id_imagen' => '474'),
            array('id' => '3197','id_producto' => '134','id_imagen' => '128'),
            array('id' => '3198','id_producto' => '134','id_imagen' => '127'),
            array('id' => '3199','id_producto' => '134','id_imagen' => '126'),
            array('id' => '3200','id_producto' => '134','id_imagen' => '125'),
            array('id' => '3201','id_producto' => '134','id_imagen' => '124'),
            array('id' => '3202','id_producto' => '134','id_imagen' => '123'),
            array('id' => '3203','id_producto' => '134','id_imagen' => '121'),
            array('id' => '3204','id_producto' => '134','id_imagen' => '122'),
            array('id' => '3205','id_producto' => '134','id_imagen' => '120'),
            array('id' => '3206','id_producto' => '134','id_imagen' => '96'),
            array('id' => '3207','id_producto' => '135','id_imagen' => '474'),
            array('id' => '3209','id_producto' => '135','id_imagen' => '128'),
            array('id' => '3210','id_producto' => '135','id_imagen' => '127'),
            array('id' => '3211','id_producto' => '135','id_imagen' => '126'),
            array('id' => '3212','id_producto' => '135','id_imagen' => '125'),
            array('id' => '3213','id_producto' => '135','id_imagen' => '124'),
            array('id' => '3214','id_producto' => '135','id_imagen' => '123'),
            array('id' => '3215','id_producto' => '135','id_imagen' => '121'),
            array('id' => '3216','id_producto' => '135','id_imagen' => '122'),
            array('id' => '3217','id_producto' => '135','id_imagen' => '120'),
            array('id' => '3218','id_producto' => '135','id_imagen' => '96'),
            array('id' => '3219','id_producto' => '136','id_imagen' => '474'),
            array('id' => '3221','id_producto' => '136','id_imagen' => '128'),
            array('id' => '3222','id_producto' => '136','id_imagen' => '127'),
            array('id' => '3223','id_producto' => '136','id_imagen' => '126'),
            array('id' => '3224','id_producto' => '136','id_imagen' => '125'),
            array('id' => '3225','id_producto' => '136','id_imagen' => '124'),
            array('id' => '3226','id_producto' => '136','id_imagen' => '123'),
            array('id' => '3227','id_producto' => '136','id_imagen' => '122'),
            array('id' => '3228','id_producto' => '136','id_imagen' => '121'),
            array('id' => '3229','id_producto' => '136','id_imagen' => '96'),
            array('id' => '3230','id_producto' => '136','id_imagen' => '120'),
            array('id' => '3231','id_producto' => '137','id_imagen' => '474'),
            array('id' => '3233','id_producto' => '137','id_imagen' => '128'),
            array('id' => '3234','id_producto' => '137','id_imagen' => '127'),
            array('id' => '3235','id_producto' => '137','id_imagen' => '126'),
            array('id' => '3236','id_producto' => '137','id_imagen' => '125'),
            array('id' => '3237','id_producto' => '137','id_imagen' => '124'),
            array('id' => '3238','id_producto' => '137','id_imagen' => '123'),
            array('id' => '3239','id_producto' => '137','id_imagen' => '122'),
            array('id' => '3240','id_producto' => '137','id_imagen' => '121'),
            array('id' => '3241','id_producto' => '137','id_imagen' => '120'),
            array('id' => '3242','id_producto' => '137','id_imagen' => '96'),
            array('id' => '3243','id_producto' => '139','id_imagen' => '474'),
            array('id' => '3245','id_producto' => '139','id_imagen' => '128'),
            array('id' => '3246','id_producto' => '139','id_imagen' => '127'),
            array('id' => '3247','id_producto' => '139','id_imagen' => '126'),
            array('id' => '3248','id_producto' => '139','id_imagen' => '125'),
            array('id' => '3249','id_producto' => '139','id_imagen' => '124'),
            array('id' => '3250','id_producto' => '139','id_imagen' => '123'),
            array('id' => '3251','id_producto' => '139','id_imagen' => '122'),
            array('id' => '3252','id_producto' => '139','id_imagen' => '120'),
            array('id' => '3253','id_producto' => '139','id_imagen' => '121'),
            array('id' => '3254','id_producto' => '139','id_imagen' => '96'),
            array('id' => '3255','id_producto' => '140','id_imagen' => '474'),
            array('id' => '3257','id_producto' => '140','id_imagen' => '128'),
            array('id' => '3258','id_producto' => '140','id_imagen' => '127'),
            array('id' => '3259','id_producto' => '140','id_imagen' => '126'),
            array('id' => '3260','id_producto' => '140','id_imagen' => '125'),
            array('id' => '3261','id_producto' => '140','id_imagen' => '124'),
            array('id' => '3262','id_producto' => '140','id_imagen' => '123'),
            array('id' => '3263','id_producto' => '140','id_imagen' => '122'),
            array('id' => '3264','id_producto' => '140','id_imagen' => '121'),
            array('id' => '3265','id_producto' => '140','id_imagen' => '120'),
            array('id' => '3266','id_producto' => '140','id_imagen' => '96'),
            array('id' => '3267','id_producto' => '141','id_imagen' => '474'),
            array('id' => '3269','id_producto' => '141','id_imagen' => '128'),
            array('id' => '3270','id_producto' => '141','id_imagen' => '127'),
            array('id' => '3271','id_producto' => '141','id_imagen' => '126'),
            array('id' => '3272','id_producto' => '141','id_imagen' => '125'),
            array('id' => '3273','id_producto' => '141','id_imagen' => '124'),
            array('id' => '3274','id_producto' => '141','id_imagen' => '122'),
            array('id' => '3275','id_producto' => '141','id_imagen' => '123'),
            array('id' => '3276','id_producto' => '141','id_imagen' => '121'),
            array('id' => '3277','id_producto' => '141','id_imagen' => '120'),
            array('id' => '3278','id_producto' => '141','id_imagen' => '96'),
            array('id' => '3279','id_producto' => '142','id_imagen' => '474'),
            array('id' => '3281','id_producto' => '142','id_imagen' => '128'),
            array('id' => '3282','id_producto' => '142','id_imagen' => '127'),
            array('id' => '3283','id_producto' => '142','id_imagen' => '126'),
            array('id' => '3284','id_producto' => '142','id_imagen' => '125'),
            array('id' => '3285','id_producto' => '142','id_imagen' => '124'),
            array('id' => '3286','id_producto' => '142','id_imagen' => '123'),
            array('id' => '3287','id_producto' => '142','id_imagen' => '122'),
            array('id' => '3288','id_producto' => '142','id_imagen' => '121'),
            array('id' => '3289','id_producto' => '142','id_imagen' => '120'),
            array('id' => '3290','id_producto' => '142','id_imagen' => '96'),
            array('id' => '3291','id_producto' => '143','id_imagen' => '124'),
            array('id' => '3292','id_producto' => '143','id_imagen' => '125'),
            array('id' => '3293','id_producto' => '143','id_imagen' => '128'),
            array('id' => '3294','id_producto' => '144','id_imagen' => '124'),
            array('id' => '3295','id_producto' => '144','id_imagen' => '125'),
            array('id' => '3296','id_producto' => '144','id_imagen' => '128'),
            array('id' => '3297','id_producto' => '145','id_imagen' => '474'),
            array('id' => '3299','id_producto' => '145','id_imagen' => '128'),
            array('id' => '3300','id_producto' => '145','id_imagen' => '127'),
            array('id' => '3301','id_producto' => '145','id_imagen' => '126'),
            array('id' => '3302','id_producto' => '145','id_imagen' => '125'),
            array('id' => '3303','id_producto' => '145','id_imagen' => '122'),
            array('id' => '3304','id_producto' => '145','id_imagen' => '124'),
            array('id' => '3305','id_producto' => '145','id_imagen' => '123'),
            array('id' => '3306','id_producto' => '145','id_imagen' => '121'),
            array('id' => '3307','id_producto' => '145','id_imagen' => '120'),
            array('id' => '3308','id_producto' => '145','id_imagen' => '96'),
            array('id' => '3309','id_producto' => '146','id_imagen' => '474'),
            array('id' => '3311','id_producto' => '146','id_imagen' => '128'),
            array('id' => '3312','id_producto' => '146','id_imagen' => '127'),
            array('id' => '3313','id_producto' => '146','id_imagen' => '126'),
            array('id' => '3314','id_producto' => '146','id_imagen' => '125'),
            array('id' => '3315','id_producto' => '146','id_imagen' => '124'),
            array('id' => '3316','id_producto' => '146','id_imagen' => '123'),
            array('id' => '3317','id_producto' => '146','id_imagen' => '122'),
            array('id' => '3318','id_producto' => '146','id_imagen' => '121'),
            array('id' => '3319','id_producto' => '146','id_imagen' => '120'),
            array('id' => '3320','id_producto' => '146','id_imagen' => '96'),
            array('id' => '3323','id_producto' => '147','id_imagen' => '128'),
            array('id' => '3324','id_producto' => '147','id_imagen' => '127'),
            array('id' => '3325','id_producto' => '147','id_imagen' => '126'),
            array('id' => '3326','id_producto' => '147','id_imagen' => '125'),
            array('id' => '3327','id_producto' => '147','id_imagen' => '124'),
            array('id' => '3328','id_producto' => '147','id_imagen' => '123'),
            array('id' => '3329','id_producto' => '147','id_imagen' => '122'),
            array('id' => '3330','id_producto' => '147','id_imagen' => '121'),
            array('id' => '3331','id_producto' => '147','id_imagen' => '120'),
            array('id' => '3332','id_producto' => '147','id_imagen' => '96'),
            array('id' => '3333','id_producto' => '148','id_imagen' => '474'),
            array('id' => '3335','id_producto' => '148','id_imagen' => '128'),
            array('id' => '3336','id_producto' => '148','id_imagen' => '126'),
            array('id' => '3337','id_producto' => '148','id_imagen' => '127'),
            array('id' => '3338','id_producto' => '148','id_imagen' => '123'),
            array('id' => '3339','id_producto' => '148','id_imagen' => '125'),
            array('id' => '3340','id_producto' => '148','id_imagen' => '122'),
            array('id' => '3341','id_producto' => '148','id_imagen' => '124'),
            array('id' => '3342','id_producto' => '148','id_imagen' => '121'),
            array('id' => '3343','id_producto' => '148','id_imagen' => '96'),
            array('id' => '3344','id_producto' => '148','id_imagen' => '120'),
            array('id' => '3345','id_producto' => '149','id_imagen' => '474'),
            array('id' => '3347','id_producto' => '149','id_imagen' => '128'),
            array('id' => '3348','id_producto' => '149','id_imagen' => '127'),
            array('id' => '3349','id_producto' => '149','id_imagen' => '126'),
            array('id' => '3350','id_producto' => '149','id_imagen' => '125'),
            array('id' => '3351','id_producto' => '149','id_imagen' => '124'),
            array('id' => '3352','id_producto' => '149','id_imagen' => '123'),
            array('id' => '3353','id_producto' => '149','id_imagen' => '121'),
            array('id' => '3354','id_producto' => '149','id_imagen' => '122'),
            array('id' => '3355','id_producto' => '149','id_imagen' => '120'),
            array('id' => '3356','id_producto' => '149','id_imagen' => '96'),
            array('id' => '3357','id_producto' => '150','id_imagen' => '474'),
            array('id' => '3359','id_producto' => '150','id_imagen' => '128'),
            array('id' => '3360','id_producto' => '150','id_imagen' => '127'),
            array('id' => '3361','id_producto' => '150','id_imagen' => '126'),
            array('id' => '3362','id_producto' => '150','id_imagen' => '125'),
            array('id' => '3363','id_producto' => '150','id_imagen' => '124'),
            array('id' => '3364','id_producto' => '150','id_imagen' => '123'),
            array('id' => '3365','id_producto' => '150','id_imagen' => '122'),
            array('id' => '3366','id_producto' => '150','id_imagen' => '121'),
            array('id' => '3367','id_producto' => '150','id_imagen' => '120'),
            array('id' => '3368','id_producto' => '150','id_imagen' => '96'),
            array('id' => '3369','id_producto' => '151','id_imagen' => '474'),
            array('id' => '3371','id_producto' => '151','id_imagen' => '128'),
            array('id' => '3372','id_producto' => '151','id_imagen' => '127'),
            array('id' => '3373','id_producto' => '151','id_imagen' => '126'),
            array('id' => '3374','id_producto' => '151','id_imagen' => '125'),
            array('id' => '3375','id_producto' => '151','id_imagen' => '124'),
            array('id' => '3376','id_producto' => '151','id_imagen' => '123'),
            array('id' => '3377','id_producto' => '151','id_imagen' => '122'),
            array('id' => '3378','id_producto' => '151','id_imagen' => '120'),
            array('id' => '3379','id_producto' => '151','id_imagen' => '121'),
            array('id' => '3380','id_producto' => '151','id_imagen' => '96'),
            array('id' => '3384','id_producto' => '180','id_imagen' => '474'),
            array('id' => '3387','id_producto' => '181','id_imagen' => '474'),
            array('id' => '3399','id_producto' => '182','id_imagen' => '474'),
            array('id' => '3401','id_producto' => '182','id_imagen' => '128'),
            array('id' => '3402','id_producto' => '182','id_imagen' => '127'),
            array('id' => '3403','id_producto' => '182','id_imagen' => '126'),
            array('id' => '3404','id_producto' => '182','id_imagen' => '125'),
            array('id' => '3405','id_producto' => '182','id_imagen' => '123'),
            array('id' => '3406','id_producto' => '182','id_imagen' => '124'),
            array('id' => '3407','id_producto' => '182','id_imagen' => '120'),
            array('id' => '3408','id_producto' => '182','id_imagen' => '122'),
            array('id' => '3409','id_producto' => '182','id_imagen' => '121'),
            array('id' => '3410','id_producto' => '182','id_imagen' => '96'),
            array('id' => '3411','id_producto' => '183','id_imagen' => '474'),
            array('id' => '3413','id_producto' => '183','id_imagen' => '128'),
            array('id' => '3414','id_producto' => '183','id_imagen' => '127'),
            array('id' => '3415','id_producto' => '183','id_imagen' => '126'),
            array('id' => '3416','id_producto' => '183','id_imagen' => '125'),
            array('id' => '3417','id_producto' => '183','id_imagen' => '123'),
            array('id' => '3418','id_producto' => '183','id_imagen' => '124'),
            array('id' => '3419','id_producto' => '183','id_imagen' => '122'),
            array('id' => '3420','id_producto' => '183','id_imagen' => '121'),
            array('id' => '3421','id_producto' => '183','id_imagen' => '120'),
            array('id' => '3422','id_producto' => '183','id_imagen' => '96'),
            array('id' => '3423','id_producto' => '194','id_imagen' => '474'),
            array('id' => '3425','id_producto' => '194','id_imagen' => '128'),
            array('id' => '3426','id_producto' => '194','id_imagen' => '127'),
            array('id' => '3427','id_producto' => '194','id_imagen' => '126'),
            array('id' => '3428','id_producto' => '194','id_imagen' => '125'),
            array('id' => '3429','id_producto' => '194','id_imagen' => '124'),
            array('id' => '3430','id_producto' => '194','id_imagen' => '123'),
            array('id' => '3431','id_producto' => '194','id_imagen' => '122'),
            array('id' => '3432','id_producto' => '194','id_imagen' => '121'),
            array('id' => '3433','id_producto' => '194','id_imagen' => '96'),
            array('id' => '3434','id_producto' => '194','id_imagen' => '120'),
            array('id' => '3435','id_producto' => '195','id_imagen' => '474'),
            array('id' => '3437','id_producto' => '195','id_imagen' => '128'),
            array('id' => '3438','id_producto' => '195','id_imagen' => '127'),
            array('id' => '3439','id_producto' => '195','id_imagen' => '126'),
            array('id' => '3440','id_producto' => '195','id_imagen' => '125'),
            array('id' => '3441','id_producto' => '195','id_imagen' => '124'),
            array('id' => '3442','id_producto' => '195','id_imagen' => '123'),
            array('id' => '3443','id_producto' => '195','id_imagen' => '122'),
            array('id' => '3444','id_producto' => '195','id_imagen' => '121'),
            array('id' => '3447','id_producto' => '196','id_imagen' => '474'),
            array('id' => '3449','id_producto' => '196','id_imagen' => '128'),
            array('id' => '3450','id_producto' => '196','id_imagen' => '127'),
            array('id' => '3451','id_producto' => '196','id_imagen' => '126'),
            array('id' => '3452','id_producto' => '196','id_imagen' => '125'),
            array('id' => '3453','id_producto' => '196','id_imagen' => '124'),
            array('id' => '3454','id_producto' => '196','id_imagen' => '123'),
            array('id' => '3455','id_producto' => '196','id_imagen' => '121'),
            array('id' => '3456','id_producto' => '196','id_imagen' => '122'),
            array('id' => '3459','id_producto' => '197','id_imagen' => '474'),
            array('id' => '3461','id_producto' => '197','id_imagen' => '128'),
            array('id' => '3462','id_producto' => '197','id_imagen' => '127'),
            array('id' => '3463','id_producto' => '197','id_imagen' => '125'),
            array('id' => '3464','id_producto' => '197','id_imagen' => '126'),
            array('id' => '3465','id_producto' => '197','id_imagen' => '124'),
            array('id' => '3466','id_producto' => '197','id_imagen' => '123'),
            array('id' => '3467','id_producto' => '197','id_imagen' => '122'),
            array('id' => '3468','id_producto' => '197','id_imagen' => '121'),
            array('id' => '3471','id_producto' => '199','id_imagen' => '474'),
            array('id' => '3473','id_producto' => '199','id_imagen' => '128'),
            array('id' => '3474','id_producto' => '199','id_imagen' => '127'),
            array('id' => '3475','id_producto' => '199','id_imagen' => '126'),
            array('id' => '3476','id_producto' => '199','id_imagen' => '125'),
            array('id' => '3477','id_producto' => '199','id_imagen' => '124'),
            array('id' => '3478','id_producto' => '199','id_imagen' => '123'),
            array('id' => '3479','id_producto' => '199','id_imagen' => '122'),
            array('id' => '3480','id_producto' => '199','id_imagen' => '121'),
            array('id' => '3483','id_producto' => '195','id_imagen' => '519'),
            array('id' => '3484','id_producto' => '195','id_imagen' => '520'),
            array('id' => '3486','id_producto' => '195','id_imagen' => '531'),
            array('id' => '3487','id_producto' => '195','id_imagen' => '532'),
            array('id' => '3493','id_producto' => '196','id_imagen' => '295'),
            array('id' => '3494','id_producto' => '196','id_imagen' => '296'),
            array('id' => '3495','id_producto' => '196','id_imagen' => '297'),
            array('id' => '3496','id_producto' => '196','id_imagen' => '298'),
            array('id' => '3510','id_producto' => '197','id_imagen' => '427'),
            array('id' => '3511','id_producto' => '197','id_imagen' => '533'),
            array('id' => '3515','id_producto' => '197','id_imagen' => '432'),
            array('id' => '3516','id_producto' => '197','id_imagen' => '352'),
            array('id' => '3517','id_producto' => '197','id_imagen' => '349'),
            array('id' => '3557','id_producto' => '192','id_imagen' => '468'),
            array('id' => '3596','id_producto' => '136','id_imagen' => '581'),
            array('id' => '3597','id_producto' => '144','id_imagen' => '610'),
            array('id' => '3598','id_producto' => '204','id_imagen' => '582'),
            array('id' => '3599','id_producto' => '199','id_imagen' => '583'),
            array('id' => '3600','id_producto' => '203','id_imagen' => '584'),
            array('id' => '3601','id_producto' => '202','id_imagen' => '585'),
            array('id' => '3603','id_producto' => '201','id_imagen' => '586'),
            array('id' => '3604','id_producto' => '137','id_imagen' => '587'),
            array('id' => '3605','id_producto' => '127','id_imagen' => '588'),
            array('id' => '3606','id_producto' => '151','id_imagen' => '589'),
            array('id' => '3607','id_producto' => '145','id_imagen' => '590'),
            array('id' => '3608','id_producto' => '141','id_imagen' => '591'),
            array('id' => '3609','id_producto' => '146','id_imagen' => '592'),
            array('id' => '3610','id_producto' => '147','id_imagen' => '593'),
            array('id' => '3611','id_producto' => '149','id_imagen' => '594'),
            array('id' => '3616','id_producto' => '150','id_imagen' => '611'),
            array('id' => '3618','id_producto' => '138','id_imagen' => '595'),
            array('id' => '3619','id_producto' => '133','id_imagen' => '596'),
            array('id' => '3620','id_producto' => '134','id_imagen' => '597'),
            array('id' => '3621','id_producto' => '182','id_imagen' => '598'),
            array('id' => '3622','id_producto' => '130','id_imagen' => '599'),
            array('id' => '3623','id_producto' => '135','id_imagen' => '600'),
            array('id' => '3624','id_producto' => '143','id_imagen' => '602'),
            array('id' => '3625','id_producto' => '132','id_imagen' => '603'),
            array('id' => '3626','id_producto' => '139','id_imagen' => '604'),
            array('id' => '3627','id_producto' => '131','id_imagen' => '605'),
            array('id' => '3628','id_producto' => '140','id_imagen' => '606'),
            array('id' => '3629','id_producto' => '148','id_imagen' => '607'),
            array('id' => '3630','id_producto' => '142','id_imagen' => '608'),
            array('id' => '3631','id_producto' => '183','id_imagen' => '609'),
            array('id' => '3632','id_producto' => '139','id_imagen' => '129'),
            array('id' => '3633','id_producto' => '133','id_imagen' => '129'),
            array('id' => '3634','id_producto' => '134','id_imagen' => '129'),
            array('id' => '3635','id_producto' => '132','id_imagen' => '129'),
            array('id' => '3636','id_producto' => '131','id_imagen' => '129'),
            array('id' => '3637','id_producto' => '135','id_imagen' => '129'),
            array('id' => '3638','id_producto' => '136','id_imagen' => '129'),
            array('id' => '3640','id_producto' => '138','id_imagen' => '122'),
            array('id' => '3641','id_producto' => '138','id_imagen' => '121'),
            array('id' => '3642','id_producto' => '138','id_imagen' => '96'),
            array('id' => '3643','id_producto' => '138','id_imagen' => '120'),
            array('id' => '3644','id_producto' => '138','id_imagen' => '129'),
            array('id' => '3645','id_producto' => '141','id_imagen' => '129'),
            array('id' => '3646','id_producto' => '140','id_imagen' => '129'),
            array('id' => '3647','id_producto' => '142','id_imagen' => '129'),
            array('id' => '3648','id_producto' => '137','id_imagen' => '129'),
            array('id' => '3649','id_producto' => '149','id_imagen' => '129'),
            array('id' => '3650','id_producto' => '146','id_imagen' => '129'),
            array('id' => '3652','id_producto' => '147','id_imagen' => '129'),
            array('id' => '3653','id_producto' => '150','id_imagen' => '129'),
            array('id' => '3654','id_producto' => '148','id_imagen' => '129'),
            array('id' => '3655','id_producto' => '151','id_imagen' => '129'),
            array('id' => '3656','id_producto' => '182','id_imagen' => '129'),
            array('id' => '3657','id_producto' => '183','id_imagen' => '129'),
            array('id' => '3658','id_producto' => '179','id_imagen' => '128'),
            array('id' => '3659','id_producto' => '179','id_imagen' => '127'),
            array('id' => '3660','id_producto' => '179','id_imagen' => '126'),
            array('id' => '3661','id_producto' => '179','id_imagen' => '125'),
            array('id' => '3662','id_producto' => '179','id_imagen' => '124'),
            array('id' => '3663','id_producto' => '179','id_imagen' => '123'),
            array('id' => '3664','id_producto' => '179','id_imagen' => '122'),
            array('id' => '3665','id_producto' => '179','id_imagen' => '121'),
            array('id' => '3666','id_producto' => '179','id_imagen' => '96'),
            array('id' => '3667','id_producto' => '179','id_imagen' => '120'),
            array('id' => '3668','id_producto' => '179','id_imagen' => '129'),
            array('id' => '3674','id_producto' => '180','id_imagen' => '128'),
            array('id' => '3675','id_producto' => '180','id_imagen' => '127'),
            array('id' => '3676','id_producto' => '180','id_imagen' => '126'),
            array('id' => '3677','id_producto' => '180','id_imagen' => '125'),
            array('id' => '3678','id_producto' => '180','id_imagen' => '124'),
            array('id' => '3679','id_producto' => '180','id_imagen' => '123'),
            array('id' => '3680','id_producto' => '180','id_imagen' => '122'),
            array('id' => '3681','id_producto' => '180','id_imagen' => '121'),
            array('id' => '3682','id_producto' => '180','id_imagen' => '96'),
            array('id' => '3683','id_producto' => '180','id_imagen' => '120'),
            array('id' => '3684','id_producto' => '180','id_imagen' => '129'),
            array('id' => '3685','id_producto' => '181','id_imagen' => '128'),
            array('id' => '3686','id_producto' => '181','id_imagen' => '127'),
            array('id' => '3687','id_producto' => '181','id_imagen' => '126'),
            array('id' => '3688','id_producto' => '181','id_imagen' => '125'),
            array('id' => '3689','id_producto' => '181','id_imagen' => '124'),
            array('id' => '3690','id_producto' => '181','id_imagen' => '123'),
            array('id' => '3691','id_producto' => '181','id_imagen' => '122'),
            array('id' => '3692','id_producto' => '181','id_imagen' => '121'),
            array('id' => '3693','id_producto' => '181','id_imagen' => '96'),
            array('id' => '3694','id_producto' => '181','id_imagen' => '120'),
            array('id' => '3695','id_producto' => '181','id_imagen' => '129'),
            array('id' => '3696','id_producto' => '194','id_imagen' => '129'),
            array('id' => '3697','id_producto' => '199','id_imagen' => '96'),
            array('id' => '3698','id_producto' => '199','id_imagen' => '120'),
            array('id' => '3699','id_producto' => '199','id_imagen' => '129'),
            array('id' => '3701','id_producto' => '200','id_imagen' => '96'),
            array('id' => '3702','id_producto' => '200','id_imagen' => '120'),
            array('id' => '3703','id_producto' => '200','id_imagen' => '129'),
            array('id' => '3704','id_producto' => '201','id_imagen' => '96'),
            array('id' => '3705','id_producto' => '201','id_imagen' => '120'),
            array('id' => '3706','id_producto' => '201','id_imagen' => '129'),
            array('id' => '3707','id_producto' => '202','id_imagen' => '96'),
            array('id' => '3708','id_producto' => '202','id_imagen' => '120'),
            array('id' => '3709','id_producto' => '202','id_imagen' => '129'),
            array('id' => '3710','id_producto' => '203','id_imagen' => '96'),
            array('id' => '3711','id_producto' => '203','id_imagen' => '120'),
            array('id' => '3712','id_producto' => '203','id_imagen' => '129'),
            array('id' => '3713','id_producto' => '204','id_imagen' => '96'),
            array('id' => '3714','id_producto' => '204','id_imagen' => '120'),
            array('id' => '3715','id_producto' => '204','id_imagen' => '129'),
            array('id' => '3716','id_producto' => '127','id_imagen' => '129'),
            array('id' => '3717','id_producto' => '195','id_imagen' => '96'),
            array('id' => '3718','id_producto' => '195','id_imagen' => '120'),
            array('id' => '3719','id_producto' => '195','id_imagen' => '129'),
            array('id' => '3720','id_producto' => '196','id_imagen' => '96'),
            array('id' => '3721','id_producto' => '196','id_imagen' => '120'),
            array('id' => '3722','id_producto' => '196','id_imagen' => '129'),
            array('id' => '3723','id_producto' => '197','id_imagen' => '96'),
            array('id' => '3724','id_producto' => '197','id_imagen' => '120'),
            array('id' => '3725','id_producto' => '197','id_imagen' => '129'),
            array('id' => '3726','id_producto' => '198','id_imagen' => '96'),
            array('id' => '3727','id_producto' => '198','id_imagen' => '120'),
            array('id' => '3728','id_producto' => '198','id_imagen' => '129'),
            array('id' => '3729','id_producto' => '128','id_imagen' => '96'),
            array('id' => '3730','id_producto' => '128','id_imagen' => '120'),
            array('id' => '3731','id_producto' => '128','id_imagen' => '129'),
            array('id' => '3732','id_producto' => '130','id_imagen' => '129'),
            array('id' => '3733','id_producto' => '145','id_imagen' => '129'),
            array('id' => '3734','id_producto' => '205','id_imagen' => '616'),
            array('id' => '3735','id_producto' => '205','id_imagen' => '614'),
            array('id' => '3736','id_producto' => '205','id_imagen' => '615'),
            array('id' => '3737','id_producto' => '205','id_imagen' => '617'),
            array('id' => '3738','id_producto' => '205','id_imagen' => '618'),
            array('id' => '3739','id_producto' => '205','id_imagen' => '406'),
            array('id' => '3740','id_producto' => '205','id_imagen' => '105'),
            array('id' => '3741','id_producto' => '205','id_imagen' => '103'),
            array('id' => '3742','id_producto' => '205','id_imagen' => '119'),
            array('id' => '3743','id_producto' => '205','id_imagen' => '408'),
            array('id' => '3744','id_producto' => '205','id_imagen' => '474'),
            array('id' => '3745','id_producto' => '205','id_imagen' => '128'),
            array('id' => '3746','id_producto' => '205','id_imagen' => '127'),
            array('id' => '3747','id_producto' => '205','id_imagen' => '126'),
            array('id' => '3748','id_producto' => '205','id_imagen' => '125'),
            array('id' => '3749','id_producto' => '205','id_imagen' => '124'),
            array('id' => '3750','id_producto' => '205','id_imagen' => '123'),
            array('id' => '3751','id_producto' => '205','id_imagen' => '122'),
            array('id' => '3752','id_producto' => '205','id_imagen' => '121'),
            array('id' => '3753','id_producto' => '205','id_imagen' => '96'),
            array('id' => '3754','id_producto' => '205','id_imagen' => '120'),
            array('id' => '3755','id_producto' => '205','id_imagen' => '129'),
            array('id' => '3756','id_producto' => '205','id_imagen' => '91'),
            array('id' => '3757','id_producto' => '205','id_imagen' => '98'),
            array('id' => '3758','id_producto' => '205','id_imagen' => '100'),
            array('id' => '3759','id_producto' => '205','id_imagen' => '99'),
            array('id' => '3760','id_producto' => '205','id_imagen' => '101'),
            array('id' => '3810','id_producto' => '185','id_imagen' => '646'),
            array('id' => '3811','id_producto' => '185','id_imagen' => '639'),
            array('id' => '3812','id_producto' => '185','id_imagen' => '445'),
            array('id' => '3813','id_producto' => '184','id_imagen' => '649'),
            array('id' => '3821','id_producto' => '184','id_imagen' => '629'),
            array('id' => '3822','id_producto' => '184','id_imagen' => '628'),
            array('id' => '3823','id_producto' => '184','id_imagen' => '640'),
            array('id' => '3824','id_producto' => '184','id_imagen' => '627'),
            array('id' => '3825','id_producto' => '184','id_imagen' => '635'),
            array('id' => '3826','id_producto' => '184','id_imagen' => '631'),
            array('id' => '3827','id_producto' => '184','id_imagen' => '626'),
            array('id' => '3834','id_producto' => '205','id_imagen' => '654')
          );
    }//fin imageProduct
}
