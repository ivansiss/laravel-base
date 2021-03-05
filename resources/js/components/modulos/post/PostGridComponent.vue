<template>

    <!--Panel-->
    <div class="card card-body mb-3 mt-5 z-depth-4" :style="{ backgroundColor: ds_admin[4].backgroundColor, color:ds_admin[4].color }">
        <div class="" style="position:relative;">
            <span class="badge ancho-categoria z-depth-4 p-3  text-md" :style="{position: 'absolute', top: '-55px', left:'0', backgroundColor: ds_admin[13].backgroundColor, border: ds_admin[13].border }">
                <i class="far fa-eye mr-3" :class="post['posted'] == 'yes' ? 'color-encendido' : 'color-apagado'" ></i>
                <span class="badge badge-pill bg-primario mr-2">{{post.orden}}</span>
                Grid
            </span>
        </div>
        <div class="media d-block d-md-flex mb-5">
            <div class="media-body text-center text-md-left ml-md-3 ml-0">
                <div class="mt-0 d-flex justify-content-end mr-4" :style="{ color:ds_admin[4].texto }" v-html="'Actualizado: ' + post.fecha_formateada">
                </div>
                <img class="mb-3 mr-3 img-fluid float-left" v-if="post.title" id="foto2" v-bind:src=" '/storage/imagenes/web_engranajes.png'" alt="Generic placeholder image" width="50px">
                <h3 class="mt-0 font-weight-bold shadow" :style="{ color: ds_admin[4].linea,borderBottom: ds_admin[4].border }" v-html="post.title"></h3>
                <h5 class="mt-0" :style="{ color:ds_admin[4].texto }" v-html="post.subtitulo"></h5>
                <br>
                <p v-html="post.content"></p>

            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2" v-for="p in post['images']" :key="p.id">
                    <img class="img-fluid mb-2"  id="foto1" v-bind:src=" '/storage/imagenes/' + p.image" alt="">
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <btns-component  v-if="post.orden != 0" :tipo="7" v-on:traeEmit="postSubir(post)"></btns-component>
            <btns-component   v-if="post.orden != ultimoOrden" :tipo="8" v-on:traeEmit="postBajar(post)"></btns-component>
            <router-link class="btn btn-outline-primary btn-lg mr-3" :style="{ border: ds_admin[9].border, color: ds_admin[9].color }" :to="{name: 'access.detalle.posts', params: {id: post.id}}"><i :class="ds_admin[9].icono"></i></router-link>
            <btns-component :tipo="10" v-on:traeEmit="eliminarDato(post)"></btns-component>
        </div>
    </div>
    <!--Panel-->
      
      
</template>

<script>
    import { mapMutations, mapState } from 'vuex';
    export default {
        props:['post', 'ultimoOrden'],
        data () {
            return { 
                   }
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar']),
            postSubir(post){
                this.$emit('postSubirEmit', post);
            },
            postBajar(post){
                this.$emit('postBajarEmit', post);
            },
            eliminarDato(post){
                this.$emit('eliminarDatoEmit', post);
            }
        },
        computed: {     
            ...mapState('dsAdmin', ['ds_admin']),
        },
        created() {
            console.log(this.post)
        }
    }
</script>
<style lang="scss"> 


  

</style>  
