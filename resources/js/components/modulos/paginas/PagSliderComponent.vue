<template>

         <!--Panel-->
        <div class="card card-body mb-3 mt-5" :style="{ backgroundColor: ds_admin[12].backgroundColor }">

            <div class="mb-3" style="position:relative;">
              <span class="badge ancho-categoria z-depth-4 p-3  text-md" :style="{position: 'absolute', top: '-55px', left:'0', backgroundColor: ds_admin[13].backgroundColor, border: ds_admin[13].border, color: ds_admin[13].texto}">
                  <i class="far fa-eye mr-3" :class="pag['posted'] == 'yes' ? 'color-encendido' : 'color-apagado'" ></i>
                  <span class="badge badge-pill bg-primario mr-2">{{pag.orden}}</span>
                  Tipo Carousel
              </span>
              {{ pag.pagina }}
            </div>

            <div class="media-body text-center text-md-left ml-md-3 ml-0">
              <div class="mt-0 d-flex justify-content-end mr-4" :style="{ color:ds_admin[12].texto }" v-html="'Actualizado: ' + pag.fecha_formateada"></div>
              <img class="mb-3 mr-3 img-fluid float-left" id="foto2" v-bind:src=" '/storage/imagenes/web_engranajes.png'" alt="Generic placeholder image" width="50px">
              <h3 class="mt-0 font-weight-bold shadow" :style="{ color: ds_admin[12].linea,borderBottom: ds_admin[12].border }" v-html="pag.title"></h3>
              <h5 class="mt-0" v-html="pag.subtitulo" :style="{ color:ds_admin[12].texto }"></h5>
              <p v-html="pag.content" :style="{ color:ds_admin[12].texto }"></p>
            </div>
           
           <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" :data-slide-to="index" :class="index == 0 ? 'active' : ''" v-for="(p, index) in pag['images']" :key="p.title"></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item" v-for="(p, index) in pag['images']" :key="p.title" :class="index == 0 ? 'active' : ''">
                      <img class="d-block w-100"  id="foto1" v-bind:src=" '/storage/imagenes/' + p.image" alt="Generic placeholder image">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-left"></i>
                    </span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-custom-icon" aria-hidden="true">
                      <i class="fas fa-chevron-right"></i>
                    </span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
            
            <div class="d-flex justify-content-end mt-4">
              <btns-component  v-if="pag.orden != 0" :tipo="7" v-on:traeEmit="pagSubir(pag)"></btns-component>
              <btns-component   v-if="pag.orden != ultimoOrden" :tipo="8" v-on:traeEmit="pagBajar(pag)"></btns-component>
              <router-link 
                              class="btn btn-outline-primary btn-lg mr-3" 
                              :style="{ border: ds_admin[9].border, color: ds_admin[9].color }" 
                              :to="{name: 'access.edit.paginas', params: {id: pag.id}}">
                              <i :class="ds_admin[9].icono"></i>
              </router-link>
              <btns-component :tipo="10" v-on:traeEmit="eliminarDato(pag)" v-if="permisos.includes('access.super')"></btns-component>
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
            console.log('pagSliderComponent');
        }
    }
</script>
<style lang="scss"> 

</style>  
