<template>

         <!--Panel-->
        <div class="card card-body mb-3 mt-5 z-depth-4 fondo-card">
            <div class="" style="position:relative;">
                <span class="badge ancho-categoria z-depth-4 p-3  text-md tipo-post" :style="{position: 'absolute', top: '-55px', left:'0', border: ds_admin[13].border }">
                    <i class="far fa-eye mr-3" :class="post['posted'] == 'yes' ? 'color-encendido' : 'color-apagado'" ></i>
                    <span class="badge badge-pill mr-2">{{post.orden}}</span>
                    Tipo Una imágen
                </span>
            </div>
            <div class="media d-block d-md-flex mb-5">
                <div class="media-body text-center text-md-left ml-md-3 ml-0">
                    <div class="mt-0 d-flex justify-content-end mr-4 fecha-formateada" v-html="'Actualizado: ' + post.fecha_formateada"></div>
                    <div v-if="post.title !='' || post.subtitulo !='' || post.content !=''">
                        <img class="mb-3 mr-3 img-fluid float-left" id="foto2" v-bind:src=" '/storage/imagenes/web_engranajes1.png'" alt="Generic placeholder image" width="50px">
                        <h3 class="mt-0 titulo-tarjeta" v-html="post.title"></h3>
                        <h5 class="mt-0" :style="{ color:ds_admin[12].texto }"  v-html="post.subtitulo"></h5>
                        <br>
                        <p v-html="post.content"></p>
                    </div>

                </div>
            </div>
            
            <!--Panel-->
            <div class="container">
                <div class="row">
               
                    <div class="col-lg-12 col-md-12 mb-3 d-flex justify-content-center" v-if="post['images'].length">
                        <img class="mb-3 mr-3 rounded img-fluid z-depth-3"  id="foto1" v-bind:src=" '/storage/imagenes/' + post['images'][0].image" alt="Generic placeholder image" width="945px">
                    </div>
                </div>

            </div>
            <div class="d-flex justify-content-end">
                <btns-component class="mr-3" v-if="post.orden != 0" :tipo="7" v-on:traeEmit="postSubir(post)"></btns-component>
                <btns-component class="mr-3" v-if="post.orden != ultimoOrden" :tipo="8" v-on:traeEmit="postBajar(post)"></btns-component>
                <router-link class="btn btn-lg myboton myicono mr-3" :to="{name: 'access.detalle.posts', params: {id: post.id}}"><i :class="ds_admin[9].icono"></i></router-link>
                <btns-component class="mr-3" :tipo="10" v-on:traeEmit="eliminarDato(post)"></btns-component>
            </div>

        </div>
        <!--/.Panel-->

</template>

<script>
    import { mapMutations, mapState } from 'vuex';
    export default {
        props:['post', 'ultimoOrden'],
        methods:{
             ...mapMutations('dsAdmin', ['parar']),
            postSubir(post){
                this.$emit('postSubirEmit', post);
            },
            postBajar(post){
                this.$emit('postBajarEmit', post);
            }
        },
        computed: {     
            ...mapState('dsAdmin', ['ds_admin']),
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style lang="scss"> 

</style>  
