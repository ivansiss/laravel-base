<template>

     <!--Panel-->
        <div class="card card-body" :style="{ 
                                                backgroundColor: ds_admin[14].backgroundColor,
                                                color:ds_admin[14].color,
                                            }">
            <div class="mb-3" style="position:relative;">
                <span class="badge ancho-categoria p-3  text-md" :style="{position: 'absolute', top: '-55px', left:'0', backgroundColor: ds_admin[14].backgroundColor, border: ds_admin[14].border }">
                    <span class="badge badge-pill bg-primario mr-2">{{item.orden}}</span>
                   {{ item.id }}
                </span>
                <div class="mt-0 d-flex justify-content-end mr-4" :style="{ color:ds_admin[4].texto }" v-html="item.fecha_formateada">
                </div>
            </div>
            
                    <div class="row">
                        <div class="col-12">
                        <h2 class="lead"></h2>
                        </div>
                    </div>
                    <!-- Carousel -->
                    <div class="row mb-3" v-if="prod_producto.length">            
                        <div class="col-12 text-center">
                            <div :id="'carouselExampleIndicators'+prod_producto[0]['id']" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li :data-target="'#carouselExampleIndicators'+prod_producto[0]['id']" :data-slide-to="index" :class="index == 0 ? 'active' : ''" v-for="(p, index) in prod_producto" :key="p.id"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item" :class="index == 0 ? 'active' : ''" v-for="(p, index) in prod_producto" :key="p.id">
                                        <img class="d-block w-100 img-fluid" v-bind:src=" '/storage/imagenes/' + p.image" alt="" v-if="p['visible'] == 1">
                                        <img class="d-block w-100 img-fluid" v-bind:src=" '/storage/imagenes/producto.jpg'" alt="" v-if="p['visible'] == 0">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" :href="'#carouselExampleIndicators'+prod_producto[0]['id']" role="button" data-slide="prev">
                                    <span class="carousel-control-custom-icon" aria-hidden="true">
                                    <i class="fas fa-chevron-left"></i>
                                    </span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" :href="'#carouselExampleIndicators'+prod_producto[0]['id']" role="button" data-slide="next">
                                    <span class="carousel-control-custom-icon" aria-hidden="true">
                                    <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Carousel -->
                    <div class="row mt-3">
                        <div class="col-12">
                        <p v-html="item.titulo" :style="{ 
                                                backgroundColor: ds_admin[14].backgroundColor,
                                                color:ds_admin[14].linea,
                                                fontSize:ds_admin[14].size,
                                                fontFamily:ds_admin[14].family,
                                            }"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                        <p class="text-muted text-sm" v-html="item.resena"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                        <h2 class="lead" v-html="item.subtitulo"></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                        <p class="text-muted text-sm" v-html="item.contenido"></p>
                        </div>
                    </div>
                    
                    <div class="card card-primary"> 
                                   
                        <div class="card-body">

                            <!-- iconos -->  
                            <div class="row">
                                <div class="col-sm-12 text-dark">
                                    <div class="mb-3" style="position:relative;">
                                        <span class="badge ancho-categoria z-depth-4 p-3  text-md" :style="{position: 'absolute', top: '-10px', left:'0', backgroundColor: ds_admin[14].backgroundColor, border: ds_admin[14].border, color:  ds_admin[14].color}">
                                            Iconos
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row" :style="{border: ds_admin[15].border}">
                                <div class="col-sm-2 text-center pt-4" v-for="ico in prod_icono" :key="ico.id">
                                        <img class="img-fluid mb-2" @click="toast(ico['alt'])" v-bind:src=" '/storage/imagenes/icono.png'" alt="" v-if="ico['visible'] == 0">
                                        <p class="text-dark">{{ ico['image'] }}</p>
                                        <img class="img-fluid mb-2" @click="toast(ico['alt'])" v-bind:src=" '/storage/imagenes/' + ico.image" alt="" v-if="ico['visible'] == 1">
                                </div>
                            </div>
                            <!-- /iconos -->

                            <!-- colores -->  
                            <div class="row">
                                <div class="col-sm-12 mt-3">
                                    <div class="mb-3" style="position:relative;">
                                        <span class="badge ancho-categoria p-3 text-md" :style="{position: 'absolute', top: '10px', left:'0', backgroundColor: ds_admin[14].backgroundColor, border: ds_admin[14].border, color:  ds_admin[14].color}">
                                            Colores
                                        </span>
                                        <div class="mt-0 d-flex justify-content-end mr-4" :style="{ color:ds_admin[4].texto }" v-html="item.fecha_formateada">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" :style="{border: ds_admin[15].border}">
                                <div class="col-sm-2 text-center pt-4" v-for="lacado in prod_lacado" :key="lacado.id">     
                                    <img class="img-fluid mb-2" @click="toast(lacado['alt'])" v-bind:src=" '/storage/imagenes/color.png'" alt="" v-if="lacado['visible'] == 0">
                  
                                    <img class="img-fluid mb-2" @click="toast(lacado['alt'])" v-bind:src=" '/storage/imagenes/' + lacado.image" alt="" v-if="lacado['visible'] == 1">
                                </div>
                            </div>
                            <!-- /colores -->

                            <!-- tarifa -->  
                            <div class="row">
                                <div class="col-sm-12 mt-3">
                                    <div class="mb-3" style="position:relative;">
                                        <span class="badge ancho-categoria p-3 text-md" :style="{position: 'absolute', top: '10px', left:'0', backgroundColor: ds_admin[14].backgroundColor, border: ds_admin[14].border, color:  ds_admin[14].color}">
                                            Tarifa
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row" :style="{border: ds_admin[15].border}">
                                <div class="col-sm-12 pt-4 text-center">     
                                    <img class="img-fluid mb-2" @click="toast(prod_tarifa.image)" v-bind:src=" '/storage/imagenes/color.png'" :alt="prod_tarifa.alt" v-if="prod_tarifa.visible == 0">
                  
                                    <img class="img-fluid mb-2" @click="toast(prod_tarifa.image)" v-bind:src=" '/storage/imagenes/' + prod_tarifa.image" :alt="prod_tarifa.alt" v-if="prod_tarifa.visible == 1">
                                </div>
                            </div>
                            <!-- /tarifa -->  
                            
                            <!-- sellos -->  
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="mb-3" style="position:relative;">
                                        <span class="badge ancho-categoria p-3 text-md" :style="{position: 'absolute', top: '20px', left:'0', backgroundColor: ds_admin[14].backgroundColor, border: ds_admin[14].border, color:  ds_admin[14].color}">
                                            Sellos
                                        </span>
                                        <div class="mt-0 d-flex justify-content-end mr-4" :style="{ color:ds_admin[4].texto }" v-html="item.fecha_formateada">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5" :style="{border: ds_admin[15].border}">
                                <div class="col-sm-2 mt-5" v-for="sello in prod_sello" :key="sello.id">
                                    <img class="img-fluid mb-2" @click="toast(sello['alt'])" v-bind:src=" '/storage/imagenes/sello.jpg'" alt="" v-if="sello['visible'] == 0">
  
                                    <img class="img-fluid mb-2" @click="toast(sello['alt'])" v-bind:src=" '/storage/imagenes/' + sello.image" alt="" v-if="sello['visible'] == 1">
                                </div>
                            </div>
                            <!-- /sellos -->
                        </div>

                    </div>
                      
            
            <div class="d-flex justify-content-end mt-4">
                <btns-component class="mr-3" v-if="item.orden != 0" :tipo="7" v-on:traeEmit="subir(item)"></btns-component>
                <btns-component class="mr-3" v-if="item.orden != ultimoOrden" :tipo="8" v-on:traeEmit="bajar(item)"></btns-component>
                <router-link class="btn btn-outline-primary btn-lg mr-3" :style="{ border: ds_admin[9].border, color: ds_admin[9].color }" :to="{name: 'access.edit.products', params: {id: item.id}}"><i :class="ds_admin[9].icono"></i></router-link>
                <btns-component class="mr-3" :tipo="10" v-on:traeEmit="eliminar(item)"></btns-component>
            </div>

        </div>
        <!--/.Panel-->

    
    
</template>

<script>
    import { mapMutations, mapState } from 'vuex';
    export default {
        props: [ 'item', 'ultimoOrden' ],
        data () {
            return { 
                        prod_icono: [],
                        prod_icono_primeros: [],
                        prod_sello: [],
                        prod_sello_primeros: [],
                        prod_lacado: [],
                        prod_tarifa: {},
                        prod_lacado_primeros: [],
                        prod_producto: [],
                    };
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar']),
            editar(prod){
                console.log('editar() Producto');
                this.$emit('editarEmit', prod);
            },
            eliminar(prod){
                console.log('eliminar() Producto');
                this.$emit('eliminarEmit', prod);
            },
            subir(prod){
                console.log('subir() Producto');
                this.$emit('SubirEmit', prod);
            },
            bajar(prod){
                console.log('bajar() Producto');
                this.$emit('BajarEmit', prod);
            },
            colocarImagenes(){

                if(this.item.images){

                    this.item.images.forEach(item => {
                        if(item.tipo_id == 1){
                            this.prod_producto.push(item);
                        }
                        if(item.tipo_id == 5){
                            this.prod_icono.push(item);
                        }
                        if(item.tipo_id == 7){
                            this.prod_sello.push(item);
                        }
                        if(item.tipo_id == 6){
                          this.prod_lacado.push(item);
                        }
                        if(item.tipo_id == 3){
                          this.prod_tarifa = item;
                        }
                           
                    });
                }
            },
            tresProductos(){
                console.log('tresProductos() iconos');
                if(this.prod_icono){
                    let total = this.prod_icono.length / 3;
                    return Math.ceil(total);
                }
                return 0;
            },
            tresProductosLacados(){
                console.log('tresProductosLacados() lacados');
                if(this.prod_lacado){
                    let total = this.prod_lacado.length / 3;
                    return Math.ceil(total);
                }
                return 0;
            },
            tresProductosSellos(){
                console.log('tresProductosSellos()');
                if(this.prod_sello){
                    let total = this.prod_sello.length / 3;
                    return Math.ceil(total);
                }
                return 0;
            },
            colocarTipoProducto(){
                console.log('colocarTipoProducto()');
                console.log(this.prod.images);
                
                if(this.prod.images){
                
                    this.prod.images.forEach(item => {
                        if(item.tipo_imagen.title == "producto"){
                            this.prod_producto.push(item);
                        }
                        if(item.tipo_imagen.title == "icono"){
                            this.prod_icono.push(item);
                        }
                        if(item.tipo_imagen.title == "sello"){
                            this.prod_sello.push(item);
                        }
                        if(item.tipo_imagen.title == "color"){
                          this.prod_lacado.push(item);
                           
                        }
                        if(item.tipo_id == 3){
                          this.prod_tarifa = item;
                        }
                    });

                    if(this.prod_icono){
                        console.log('icono : '+this.prod_icono.length);

                        let contandoIco = 2;
                        let conjuntoIco = [];
                        for (let index = 0; index < this.prod_icono.length; index++) {

                          conjuntoIco.push(this.prod_icono[index]);

                          if(index == contandoIco || this.prod_icono.length - 1 == index){
                             this.prod_icono_primeros.push(conjuntoIco);
                              conjuntoIco = [];
                              contandoIco = contandoIco + 3;
                          }
 
                        }
                    }

                    if(this.prod_sello){
                        console.log('sello : '+ this.prod_sello.length);
                        
                        let contandoSello = 2;
                        let conjuntoSello = [];
                        for (let index = 0; index < this.prod_sello.length; index++) {

                           conjuntoSello.push(this.prod_sello[index]);

                          if(index == contandoSello || this.prod_sello.length - 1 == index){
                              this.prod_sello_primeros.push(conjuntoSello);
                              conjuntoSello = [];
                              contandoSello = contandoSello + 3;
                          }
 
                        }
                    }

                    if(this.prod_lacado){
                        console.log('lacado: '+this.prod_lacado.length);
                        
                        let contandoLacado = 2;
                        let conjuntoLacado = [];
                        for (let index = 0; index < this.prod_lacado.length; index++) {

                           conjuntoLacado.push(this.prod_lacado[index]);
                          
                          if(index == contandoLacado || this.prod_lacado.length - 1 == index){
 
                              this.prod_lacado_primeros.push(conjuntoLacado);
                              conjuntoLacado = [];
                              contandoLacado = contandoLacado + 3;
                          }
 
                        }
                    }
                }
                
            },
            toast: function(alt){
            const answers = JSON.stringify(alt)
                                            Swal.fire({
                                            position: 'top-center',
                                            icon: 'info',
                                            title: answers,
                                            showConfirmButton: true,
                                            timer: 8000
                                            })
            }
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin']),
        },
        created (){
  
            this.colocarImagenes();

        },
        mounted (){
            console.log('ProductListItemComponent');
        }
    }
</script>

<style lang="scss">    
    .card {
        background-color: #f6f9fc;
        width: 260px;
        margin-left:1rem;
        margin-bottom: 1rem;
    }

    .ancho-pantalla{
         width: 100%;
    }

    .panel-principal{
        position: relative;
    }

    .panel-posicion{
        position: absolute !important;
        top: -20px !important;
        left: 40px !important;
    }

    .winter-neva-gradient {
         background-image: linear-gradient(120deg, #efeff500 0%, #f2f2fd54 100%); 
    }

    .iconos-pequeños {
        -ms-flex-negative: 0;
        flex-shrink: 0;
        width: 85%;
    }

    .ancho-carousel{
        width: 100%;
    } 

    .carousel-multi-item .carousel-inner {
        padding-top: 2rem;
    }

   .lhorizontal {
       border: 0; 
       height: 0; 
       border-top: 4px double black; 
       text-align:center;
    }

    .active {
        border-bottom: none !important;
    }

  

</style>   
 
