<template>

    <div class="card card-widget widget-user-2 shadow-sm p-3 fondo-card">
        <div class="widget-user-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <h6 class="widget-user-desc-m color-texto">Última modificación: {{ img.fecha_formateada }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="widget-user-image">
                            <img class="elevation-2 imagen-ancho-full" v-bind:src=" '/storage/imagenes/' + img.image" :alt="img.alt" v-if="img.visible == 1">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 color-texto">
                        <h5 class="widget-user-desc mr-2 my-3">id: {{img.id}}</h5>
                        <h4 class="widget-user-desc color-texto-expecial linea-debajo-texto">{{ img.orden }}.- {{ img.image }}</h4>
                    </div>
                </div>
            </div>
            <div class="card-footer p-0">
            <ul class="nav flex-column">
                <li class="nav-item mt-5 text-lg color-texto">

                    Descripción: {{ img.description }}
                    <span class="float-right badge color-texto mb-2 linea-debajo-texto">
                            Sin descripción
                    </span>

                </li>
                <li class="nav-item text-lg color-texto mb-2">

                    Alt: {{ img.alt }}
                    <span        class="float-right badge bg-success color-texto"
                                v-if="img.alt == ' ' ? color_alt='red' : ''">
                                        Sin Alt
                    </span>
            
                </li>
                <li class="nav-item text-lg color-texto mb-2">

                    <i class="fas fa-link pr-1"></i>
                    Link: {{ img.link }}
            
                </li>
                <li class="nav-item text-lg color-texto mb-2">

                    <i class="fas fa-weight-hanging pr-1" v-bind:style="{ color: 'green'}"></i>
                    Size: {{ img.size }}
            
                </li>
                <li v-if="img.tipo_imagen !=null" class="text-lg color-texto mb-2">
                    <i class="far fa-images pr-1"></i>
                    Tipo: {{ img.tipo_imagen.title }}
                </li>
            </ul>
            </div>
            <div class="card-footer mt-3">
                <div class="text-right">
                    <li class="d-flex justify-content-start mt-4">
                        <btns-component  v-if="img.orden != 0" :tipo="7" v-on:traeEmit="subir(img)"></btns-component>
                        <btns-component   v-if="img.orden != ultimoOrden" :tipo="8" v-on:traeEmit="bajar(img)"></btns-component>
                    </li>
                    <div class="d-flex justify-content-end">
                        <btns-component :tipo="9" v-on:traeEmit="editar(img)"></btns-component>
                        <btns-component :tipo="10" v-on:traeEmit="eliminar(img)"></btns-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
import { mapMutations, mapState } from 'vuex';
export default {
        props: [ 'img', 'ultimoOrden'],
        data () {
            return { 
                        color_link: "green",
                        color_size: "",
                        color_description: "",
                        color_alt: "",
                        btn_estado: 0,
                       
                    };
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar']),
            editar(img){
                this.$emit('editarEmit', img);
            },
            eliminar(img){
                this.$emit('eliminarEmit', img);
            },
            subir(img){
                this.$emit('SubirEmit', img);
            },
            bajar(img){
                this.$emit('BajarEmit', img);
            }
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin']),
        },
        mounted (){
        }
    }
</script>

<style lang="scss">    
    .imagen-ancho-full{
        width: 100% !important;
    }

    .linea-debajo-texto{
        border-bottom: dotted 1px #778a46;
    }
</style>   
 
