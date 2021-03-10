<template>

    <div class="card card-widget widget-user-2 shadow-sm p-3 fondo-card text-white">
        <div class="widget-user-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                        <h6 class="widget-user-desc-m texto-blanco">Última modificación: {{ video.fecha_formateada }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" v-bind:src=" '/storage/videos/' + video.link" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 texto-blanco">
                        <h5 class="widget-user-desc mr-2 my-3">id: {{video.id}}</h5>
                        <h4 class="widget-user-desc titulo-listas linea-debajo-texto">{{ video.orden }}.- {{ video.titulo }}</h4>
                    </div>
                </div>
            </div>
            <div class="card-footer p-0">
            <ul class="nav flex-column">
                <li class="nav-item mt-5 text-lg texto-blanco">

                    - Descripción: {{ video.descripcion }}
                    <span class="float-right badge color-texto mb-2 linea-debajo-texto" v-if="!video.descripcion">
                            Sin descripción
                    </span>

                </li>
                <li class="nav-item mt-2 text-lg texto-blanco">

                   - Url-limpia: {{ video.miniatura }}
                    <span        class="float-right badge color-texto mb-2 linea-debajo-texto"
                                v-if="!video.miniatura">
                                        Sin Miniatura
                    </span>
            
                </li>
                <li class="nav-item mt-2 text-lg texto-blanco">

                    - Link: {{ video.link }}
                    <span        class="float-right badge color-texto mb-2 linea-debajo-texto"
                                v-if="!video.link">
                                        No tiene enlace a la imágen
                    </span>
            
                </li>
                <li class="nav-item mt-2 text-lg texto-blanco">

                    - Size: {{ video.size }}
                    <span        class="float-right badge color-texto mb-2 linea-debajo-texto"
                                v-if="!video.size">
                                        No tiene tamaño
                    </span>
            
                </li>
                <li v-if="video.tipo_id !=null" class="text-lg color-texto mb-2 mt-2">
                    - Tipo: {{ video.tipo_video.title }}
                </li>
            </ul>
            </div>
            <div class="card-footer mt-3">
                <div class="text-right">
                    <li class="d-flex justify-content-start mt-4">
                        <btns-component class="mr-3" v-if="video.orden != 0" :tipo="7" v-on:traeEmit="subir(video)"></btns-component>
                        <btns-component class="mr-3" v-if="video.orden != ultimoOrden" :tipo="8" v-on:traeEmit="bajar(video)"></btns-component>
                    </li>
                    <div class="d-flex justify-content-end">
                        <btns-component class="mr-3" :tipo="9" v-on:traeEmit="editar(video)"></btns-component>
                        <btns-component class="mr-3" :tipo="10" v-on:traeEmit="eliminar(video)"></btns-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
import { mapMutations, mapState } from 'vuex';
export default {
        props: [ 'video', 'ultimoOrden'],
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
            editar(vid){
                this.$emit('editarEmit', vid);
            },
            eliminar(vid){
                this.$emit('eliminarEmit', vid);
            },
            subir(vid){
                this.$emit('SubirEmit', vid);
            },
            bajar(vid){
                this.$emit('BajarEmit', vid);
            }
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin']),
        },
        mounted (){
            console.log('vid');
            console.log(this.vid);
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
 
