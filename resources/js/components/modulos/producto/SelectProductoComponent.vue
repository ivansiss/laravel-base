<template>
    <div class="container" v-bind:style="{ backgroundColor: ds_admin[14].backgroundColor }">
        <!-- Productos -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card example-1 mt-5">
        
                    <div id="section1" class="p-2 ml-3" :style="{ borderBottom:ds_admin[16].border }">Añade imágenes al carousel</div>

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
                            <div class="d-flex">
                                <btns-component :tipo="16" v-on:traeEmit="addProducto(img)"></btns-component>  
                                <img class="mb-3 rounded img-fluid m-l-2"  id="foto1" v-bind:src=" '/storage/imagenes/' + img.image" alt="Generic placeholder image" width="50px">
                            </div>
                            {{img.image}}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card example-1 mt-5">
                    <div id="section1" class="p-2 ml-3" :style="{ borderBottom:ds_admin[16].border }">
                        Imagenes agregadas
                    </div>
                    <!-- Imagenes Selecionadas -->
                    <ul class="list-group mt-3" v-if="listaProductos.length">
                        <li class="list-group-item d-flex justify-content-between" v-for="(producto, index) in listaProductos" :key="producto.id">
                            <btns-component :tipo="17" v-on:traeEmit="delProducto(index)"></btns-component>
                            <img class="mb-3 mr-3 rounded img-fluid z-depth-3"  id="foto1" v-bind:src=" '/storage/imagenes/' + producto.image" alt="Generic placeholder image" width="50px">{{producto.image}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Productos -->

        <!-- Iconos -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card example-1 mt-5">
                    <div id="section1" class="p-2 ml-3" :style="{ borderBottom:ds_admin[16].border }">Añade iconos</div>
                    <ul class="list-group mt-2" v-if="imagenesIconos.length">
                        <li class="list-group-item d-flex justify-content-between" v-for="imgI in imagenesIconos" :key="imgI.id">
                            <div class="d-flex">
                                <btns-component :tipo="16" v-on:traeEmit="addIcono(imgI)"></btns-component>  
                                <img class="mb-3 mr-3 rounded img-fluid z-depth-3"  id="foto1" v-bind:src=" '/storage/imagenes/' + imgI.image" alt="Generic placeholder image" width="50px">
                            </div>
                            {{imgI.image}}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card example-1 mt-5">
                    <div id="section1" class="p-2 ml-3" :style="{ borderBottom:ds_admin[16].border }">
                        Imagenes agregadas
                    </div>
                    <ul class="list-group mt-3" v-if="listaIconos.length">
                        <li class="list-group-item d-flex justify-content-between" v-for="(icono, index) in listaIconos" :key="icono.id">
                            <btns-component :tipo="17" v-on:traeEmit="delIcono(index)"></btns-component>
                            <img class="mb-3 mr-3 rounded img-fluid z-depth-3"  id="foto1" v-bind:src=" '/storage/imagenes/' + icono.image" alt="Generic placeholder image" width="50px">{{icono.image}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Iconos -->

        <!-- Colores -->
        <div class="row justify-content-center">
            <div class="col-md-6">  
                <div class="card example-1 mt-5">
                    <div id="section1" class="p-2 ml-3" :style="{ borderBottom:ds_admin[16].border }">Añade colores</div>                          
                    <ul class="list-group mt-2" v-if="imagenesColores.length">
                        <li class="list-group-item d-flex justify-content-between" v-for="imgC in imagenesColores" :key="imgC.id">
                            <div class="d-flex"> 
                                <btns-component :tipo="16" v-on:traeEmit="addColor(imgC)"></btns-component>  
                                <img class="mb-3 mr-3 rounded img-fluid z-depth-3"  id="foto1" v-bind:src=" '/storage/imagenes/' + imgC.image" alt="Generic placeholder image" width="50px">
                            </div>
                            {{imgC.image}}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card example-1 mt-5">
                    <div id="section1" class="p-2 ml-3" :style="{ borderBottom:ds_admin[16].border }">
                        Imagenes agregadas
                    </div>
                    <ul class="list-group mt-3" v-if="listaColores.length">
                        <li class="list-group-item d-flex justify-content-between" v-for="(color, index) in listaColores" :key="color.image">
                            <div class="d-flex"> 
                                <btns-component :tipo="17" v-on:traeEmit="delColor(index)"></btns-component>
                                <img class="mb-3 mr-3 rounded img-fluid z-depth-3"  id="foto1" v-bind:src=" '/storage/imagenes/' + color.image" alt="Generic placeholder image" width="50px">
                            </div>
                            {{color.image}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Colores -->

        <!-- Sellos -->
        <div class="row justify-content-center">
            <div class="col-md-6">  
                <div class="card example-1 mt-5">
                    <div id="section1" class="p-2 ml-3" :style="{ borderBottom:ds_admin[16].border }">Añade Sellos</div>                                
                    <ul class="list-group mt-2" v-if="imagenesSellos.length">
                        <li class="list-group-item d-flex justify-content-between" v-for="imgS in imagenesSellos" :key="imgS.id">
                            <div class="d-flex"> 
                                <btns-component :tipo="16" v-on:traeEmit="addSello(imgS)"></btns-component>  
                                <img class="mb-3 mr-3 rounded img-fluid z-depth-3"  id="foto1" v-bind:src=" '/storage/imagenes/' + imgS.image" alt="Generic placeholder image" width="50px">
                            </div>  
                            {{imgS.image}}
                        </li>
                    </ul>
                </div>    
            </div>
            <div class="col-md-6">
                <div class="card example-1 mt-5">
                    <div id="section1" class="p-2 ml-3" :style="{ borderBottom:ds_admin[16].border }">
                        Imagenes agregadas
                    </div>
                    <ul class="list-group mt-3" v-if="listaSellos.length">
                        <li class="list-group-item d-flex justify-content-between" v-for="(sello, index) in listaSellos" :key="sello.image">
                            <btns-component :tipo="17" v-on:traeEmit="delSello(index)"></btns-component>
                            <img class="mb-3 mr-3 rounded img-fluid z-depth-3"  id="foto1" v-bind:src=" '/storage/imagenes/' + sello.image" alt="Generic placeholder image" width="50px">{{sello.image}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Sellos -->

        <!-- Tarifas -->
        <div class="row justify-content-center">
            <div class="col-md-6">  
                <div class="card example-1 mt-5">
                    <div id="section1" class="p-2 ml-3" :style="{ borderBottom:ds_admin[16].border }">Añade Tarifas</div>                                
                    <ul class="list-group mt-2" v-if="imagenesTarifas.length">
                        <li class="list-group-item d-flex justify-content-between" v-for="imgT in imagenesTarifas" :key="imgT.id">
                            <div class="d-flex"> 
                                <btns-component :tipo="16" v-on:traeEmit="addTarifa(imgT)"></btns-component>  
                                <img class="mb-3 mr-3 rounded img-fluid z-depth-3"  id="foto1" v-bind:src=" '/storage/imagenes/' + imgT.image" alt="Generic placeholder image" width="50px">
                            </div>  
                            {{imgT.image}}
                        </li>
                    </ul>
                </div>    
            </div>
            <div class="col-md-6">
                <div class="card example-1 mt-5">
                    <div id="section1" class="p-2 ml-3" :style="{ borderBottom:ds_admin[16].border }">
                        Imagenes agregadas
                    </div>
                    <ul class="list-group mt-3" v-if="listaTarifas.length">
                        <li class="list-group-item d-flex justify-content-between" v-for="(tarifa, e) in listaTarifas" :key="tarifa.id">
                            <btns-component :tipo="17" v-on:traeEmit="delTarifa(e)"></btns-component>
                            <img class="mb-3 mr-3 rounded img-fluid z-depth-3"  id="foto1" v-bind:src=" '/storage/imagenes/' + tarifa.image" alt="Generic placeholder image" width="50px">{{tarifa.image}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Tarifas -->

    </div>

</template>                         

<script>
    import { mapMutations, mapState, mapActions } from 'vuex';
    export default {
        props: ['listaProductos','listaIconos','listaColores','listaSellos', 'listaTarifas' ,'max'],
        data (){
            return{
                imagenes: [],
                imagenesIconos: [],
                imagenesColores: [],
                imagenesSellos: [],
                imagenesTarifas: [],
                consulta: '',
                setTimeoutBuscador:'',
                listaEnvio: [],
                contador: 0,
            };          
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar']),
            loadImagenes: async function(){

                let enviar = { result: 'producto' };
                let url = '/api/images/search/mini';
                await axios.post(url, enviar).then(response => {

                    this.imagenes = response.data;          
                });

                let enviar1 = { result: 'icono' };
                let url1 = '/api/images/search/mini';
                await axios.post(url1, enviar1).then(response1 => {

                    this.imagenesIconos = response1.data;  
                    console.log('this.imagenesIconos');
                    console.log(this.imagenesIconos);
                });

                let enviar2 = { result: 'color' };
                let url2 = '/api/images/search/mini';
                await axios.post(url2, enviar2).then(response2 => {

                    this.imagenesColores = response2.data;          
                });

                let enviar3 = { result: 'sello' };
                let url3 = '/api/images/search/mini';
                await axios.post(url3, enviar3).then(response3 => {

                    this.imagenesSellos = response3.data;          
                });

                let enviar4 = { result: 'tarifa' };
                let url4 = '/api/images/search/mini';
                await axios.post(url4, enviar4).then(response4 => {
                    console.log('imagenesTarifas');
                    console.log(response4.data);
                    this.imagenesTarifas = response4.data;          
                });

            },
            buscar(){

                clearTimeout( this.setTimeoutBuscador);
                this.setTimeoutBuscador = setTimeout( this.getImagenesBuscar(),360);
                
            },
            getImagenesBuscar(){

                let enviar = { result: this.consulta };
                let url = '/api/images/search/mini';
                axios.post(url, enviar).then(response => {
                    this.imagenes = response.data;          
                });
            },      
            addProducto(img){

                let errorCometido = false;
                this.listaProductos.forEach(item => {
                    if(item.image == img.image){
                        errorCometido = true;

                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Imagen duplicada!!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        this.parar();
                    }
                }); 

                if(errorCometido == false){

                    this.listaProductos.push(img);

                    Array.prototype.push.apply(this.listaEnvio, this.listaProductos);
                    Array.prototype.push.apply(this.listaEnvio, this.listaIconos);
                    Array.prototype.push.apply(this.listaEnvio, this.listaColores);
                    Array.prototype.push.apply(this.listaEnvio, this.listaSellos);
                    Array.prototype.push.apply(this.listaEnvio, this.listaTarifas);
                    this.$emit('selecionadosEmit', this.listaEnvio);
                }
            },
            addIcono(img){

                let errorCometido = false;
                this.listaIconos.forEach(item => {
                    if(item.image == img.image){
                        errorCometido = true;
                        
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Imagen duplicada!!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        this.parar();
                    }
                }); 

                if(errorCometido == false){

                    this.listaIconos.push(img);

                    Array.prototype.push.apply(this.listaEnvio, this.listaProductos);
                    Array.prototype.push.apply(this.listaEnvio, this.listaIconos);
                    Array.prototype.push.apply(this.listaEnvio, this.listaColores);
                    Array.prototype.push.apply(this.listaEnvio, this.listaSellos);
                    this.$emit('selecionadosEmit', this.listaEnvio);   
                }
            },
            addColor(img){

                let errorCometido = false;
                this.listaColores.forEach(item => {
                    if(item.image == img.image){
                        errorCometido = true;

                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Imagen duplicada!!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        this.parar();
                    }
                }); 

                if(errorCometido == false){

                    this.listaColores.push(img);
                    Array.prototype.push.apply(this.listaEnvio, this.listaProductos);
                    Array.prototype.push.apply(this.listaEnvio, this.listaIconos);
                    Array.prototype.push.apply(this.listaEnvio, this.listaColores);
                    Array.prototype.push.apply(this.listaEnvio, this.listaSellos);
                    this.$emit('selecionadosEmit', this.listaEnvio);
                }
            },
            addSello(img){

                let errorCometido = false;
                this.listaSellos.forEach(item => {
                    if(item.image == img.image){
                        errorCometido = true;

                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Imagen duplicada!!',
                            showConfirmButton: false,
                            timer: 2000
                        });

                    this.parar();
                    }
                }); 

                if(errorCometido == false){

                    this.listaSellos.push(img);
                    Array.prototype.push.apply(this.listaEnvio, this.listaProductos);
                    Array.prototype.push.apply(this.listaEnvio, this.listaIconos);
                    Array.prototype.push.apply(this.listaEnvio, this.listaColores);
                    Array.prototype.push.apply(this.listaEnvio, this.listaSellos);
                    this.$emit('selecionadosEmit', this.listaEnvio);
                }
            },
            addTarifa(img){
                
                let errorCometido = false;

                    if(this.listaTarifas.length >= 1){
                        errorCometido = true;

                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Solo una tarifa!!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        this.parar();
                    }

                if(errorCometido == false){

                    this.listaTarifas.push(img);
                    Array.prototype.push.apply(this.listaEnvio, this.listaProductos);
                    Array.prototype.push.apply(this.listaEnvio, this.listaIconos);
                    Array.prototype.push.apply(this.listaEnvio, this.listaColores);
                    Array.prototype.push.apply(this.listaEnvio, this.listaSellos);
                    Array.prototype.push.apply(this.listaEnvio, this.listaTarifas);

                    console.log('this.listaTarifas');
                    console.log(this.listaTarifas);
                    console.log('this.listaTarifas');

                    this.$emit('selecionadosEmit', this.listaEnvio);
                }

                this.contador = 0
            },
            delProducto(index){
                this.listaProductos.splice(index, 1);
                this.parar();
            },
            delIcono(index){
                this.listaIconos.splice(index, 1);
                this.parar();

            },
            delColor(index){
                this.listaColores.splice(index, 1);
                this.parar();
            },
            delSello(index){
                this.listaSellos.splice(index, 1);
                this.parar();
            },
            delTarifa(index){
                this.listaTarifas.splice(index, 1);
                console.log('this.listaTarifas borrar');
                console.log(this.listaTarifas);
                this.parar();
            }
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin']),
        },
        created(){
            this.loadImagenes();
        },
        mounted() {

            console.log('SelectComponent')
        },
        beforeCreate(){
            
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
