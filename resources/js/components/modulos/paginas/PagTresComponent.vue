<template>

         <!--Panel-->
        <div class="card card-body mb-3 mt-5 z-depth-4 bg-puente" :style="{ backgroundColor: ds_admin[12].backgroundColor, color:ds_admin[12].color }">
            <div class="" style="position:relative;">
                <span class="badge ancho-categoria z-depth-4 p-3  text-md" :style="{position: 'absolute', top: '-55px', left:'0', backgroundColor: ds_admin[13].backgroundColor, border: ds_admin[13].border }">
                    <i class="far fa-eye mr-3" :class="pag['posted'] == 'yes' ? 'color-encendido' : 'color-apagado'" ></i>
                    <span class="badge badge-pill bg-primario mr-2">{{pag.orden}}</span>
                    Tipo Tres Imágenes
                    </span>
                    {{ pag.pagina }}
            </div>
            <div class="media d-block d-md-flex mb-5">
                <div class="media-body text-center text-md-left ml-md-3 ml-0">
                    <div class="mt-0 d-flex justify-content-end mr-4" :style="{ color:ds_admin[12].texto }" v-html="'Actualizado: ' + pag.fecha_formateada"></div>
                    <img class="mb-3 mr-3 img-fluid float-left" id="foto2" v-bind:src=" '/storage/imagenes/web_engranajes2.png'" alt="Generic placeholder image" width="50px">
                    <h3 class="mt-0 font-weight-bold shadow" :style="{ color: ds_admin[12].linea }" v-html="pag.title"></h3>
                    <h5 class="mt-0" :style="{ color:ds_admin[12].texto }" v-html="pag.subtitulo"></h5>
                    <br>
                    <p v-html="pag.content"></p>

                </div>
            </div>
            
            <!--Panel-->
            <div class="container">
                <div class="row">
               
                    <div class="col-lg-4 col-md-12 mb-3 d-flex justify-content-center" v-if="pag['images'].length">
                        <img class="mb-3 mr-3 rounded img-fluid z-depth-3"  id="foto1" v-bind:src=" '/storage/imagenes/' + pag['images'][0].image" alt="Generic placeholder image" width="300px">
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3 d-flex justify-content-center" v-if="pag['images'].length == 3">
                        <img class="mb-3 mr-3 rounded img-fluid z-depth-3" id="foto2" v-bind:src=" '/storage/imagenes/' + pag['images'][2].image" alt="Generic placeholder image" width="300px">
                    </div>
                    <div class="col-lg-4 col-md-12 mb-3 d-flex justify-content-center" v-if="pag['images'].length == 2 || pag['images'].length == 3">
                        <img class="mb-3 rounded img-fluid z-depth-3" id="foto3" v-bind:src=" '/storage/imagenes/' + pag['images'][1].image" alt="Generic placeholder image" width="300px">
                    </div>
                </div>

            </div>
            <div class="d-flex justify-content-end">
                <btns-component class="mr-3" v-if="pag.orden != 0" :tipo="7" v-on:traeEmit="pagSubir(pag)"></btns-component>
                <btns-component class="mr-3" v-if="pag.orden != ultimoOrden" :tipo="8" v-on:traeEmit="pagBajar(pag)"></btns-component>
                <router-link 
                
                            class="btn btn-outline-primary btn-lg mr-3" 
                            :style="{ border: ds_admin[9].border, color: ds_admin[9].color }" 
                            :to="{name: 'access.edit.paginas', params: {id: pag.id}}">
                            <i :class="ds_admin[9].icono"></i>
                </router-link>
                <btns-component class="mr-3" :tipo="10" v-on:traeEmit="eliminarDato(pag)" v-if="permisos.includes('access.super')"></btns-component>                        
            </div>

        </div>
        <!--/.Panel-->

</template>

<script>
    import { mapMutations, mapState } from 'vuex';  
    export default {
        props:['pag', 'ultimoOrden', 'permisos'],
        methods:{
            ...mapMutations('dsAdmin', ['parar']),
            pagSubir(pag){
                this.$emit('pagSubirEmit', pag);
            },
            pagBajar(pag){
                this.$emit('pagBajarEmit', pag);
            },
            eliminarDato(pag){
                this.$emit('eliminarDatoEmit', pag);
            }
        },
        computed: {     
            ...mapState('dsAdmin', ['ds_admin']),
        },
        created() {
            console.log(this.pag)
        }
    }
</script>
<style lang="scss"> 

</style>  
