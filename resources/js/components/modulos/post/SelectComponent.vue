<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <!-- Grid row -->
                <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-6 mb-4">

                        <!-- Exaple 1 -->
                        <div class="card example-1 mt-5">
                
                                <div id="section1" class="p-2 ml-3" :style="{ borderBottom:ds_admin[16].border }">Este Post tiene imagenes?</div>

                                    <!-- Search form -->
                                    <form class="form-inline d-flex justify-content-center md-form form-sm active-purple-2 p-2">
                                        <input class="form-control form-control-sm mr-3 mt-1 w-75" 
                                            type="text" 
                                        placeholder="Buscar por nombre de imagen"
                                            v-model="consulta"
                                            @keyup="buscar"
                                            aria-label="Buscar">
                                        <span style="font-size: 25px;">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </form>
                                    <!-- /Search form -->
                                    <ul class="list-group mt-2" v-if="imagenes.length">
                                        <li class="list-group-item d-flex justify-content-between" v-for="img in imagenes" :key="img.id">
                                            <btns-component :tipo="16" v-on:traeEmit="add(img)"></btns-component>  
                                            <img class="mb-3 mr-3 rounded img-fluid z-depth-3"  id="foto1" v-bind:src=" '/storage/imagenes/' + img.image" alt="Generic placeholder image" width="50px">{{img.image}}
                                        </li>
                                    </ul>
              
                        </div>
                        <!-- /Exaple 1 -->
                    </div>
                    <!-- Grid column -->
                    <div class="col-md-6">

                        <!-- Exaple 1 -->
                        <div class="card example-1 mt-5">
                            <div id="section1" class="p-2 ml-3" :style="{ borderBottom:ds_admin[16].border }">
                                Imagenes agregadas
                            </div>
                            <!-- Imagenes Selecionadas -->
                            <ul class="list-group mt-3" v-if="selecionados">
                                <li class="list-group-item d-flex justify-content-between" v-for="(sel, index) in selecionados" :key="sel.image">
                                    <btns-component :tipo="17" v-on:traeEmit="del(index)"></btns-component>
                                    <img class="mb-3 mr-3 rounded img-fluid z-depth-3"  id="foto1" v-bind:src=" '/storage/imagenes/' + sel.image" alt="Generic placeholder image" width="50px">{{sel.image}}
                                </li>
                            </ul>
                        </div>
                        <!-- /Exaple 1 -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>                         

<script>
    import { mapMutations, mapState, mapActions } from 'vuex';
    export default {
        props: ['selecionados','max'],
        data (){
            return{
                imagenes: {},
                consulta: '',
                setTimeoutBuscador:'',
            };          
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar']),
            getImagenes(){
                let url = '/api/images/';
                axios.get(url).then(response => {

                        this.imagenes = response.data;
                        console.log(this.imagenes);
                        this.$emit('selecionadosEmit', this.selecionados); 
                });
            },
            getImagenesBuscar(){

                let enviar = { result: this.consulta };
      
                let url = '/api/images/search/mini';
                axios.post(url, enviar).then(response => {

                    this.imagenes = response.data;          
                    console.log(response.data.data);
                });
            },
            buscar(){

                clearTimeout( this.setTimeoutBuscador);
                this.setTimeoutBuscador = setTimeout( this.getImagenesBuscar(),360);
                
            },
            add(img){

                let errorCometido = false;
                if(this.selecionados.length + 1 > this.max){
                    
                    errorCometido = true;
                    Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Imágenes máximas '+ this.max +'!!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                }

                
                this.selecionados.forEach(element => {
                    if(element.image == img.image){
                        errorCometido = true;

                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Imagen duplicada!!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });

                if(errorCometido == false){
                    this.selecionados.push(img);
                    this.$emit('selecionadosEmit', this.selecionados);
                }
            },
            del(index){
                this.selecionados.splice(index, 1);
            },
            maxImagenes(){

                console.log('cat: '+this.category_id);
                switch (this.category_id) {
                    case 1: 
                        this.max = 1;
                    break;
                    
                    case 2: 
                        this.max = 10;
                    break;
                    
                    case 3: 
                        this.max = 1;
                    break;

                    case 4: 
                        this.max = 6;
                        console.log('imagenesMax: 6');
                    break;

                    case 5: 
                        this.max = 3;
                    break;
                    
                    default:
                        this.max = 1;
                }

            }
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin']),
        },
        mounted() {
            this.getImagenes();
            console.log('SelectComponent')
        }
    }
</script>
<style lang="scss">    

    .card {
        background-color: #f6f9fc;
        width: 90% !important;
    }

    .swal2-title{
        font-size: 1.2em;
    }


.scrollbar-ripe-malinka::-webkit-scrollbar-track {
-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
background-color: #F5F5F5;
border-radius: 10px; }

.scrollbar-ripe-malinka::-webkit-scrollbar {
width: 12px;
background-color: #F5F5F5; }

.scrollbar-ripe-malinka::-webkit-scrollbar-thumb {
border-radius: 10px;
-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
background-image: -webkit-linear-gradient(330deg, #f093fb 0%, #f5576c 100%);
background-image: linear-gradient(120deg, #f093fb 0%, #f5576c 100%); }


.example-1 {
position: relative;
overflow-y: scroll;
height: 500px; 
}
</style>    
