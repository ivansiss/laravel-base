
<template>

    <div class="container mt-5" v-if="permisos.includes('access.new.seo')"> 

        <div class="d-flex justify-content-start">
            <div class="ml-3 mb-5" v-bind:style="{ 
                                    fontSize: ds_admin[2].size,
                                    fontWeight: 700,
                                    fontFamily: ds_admin[2].family,
                                    color: ds_admin[2].color,
                                    borderBottom: ds_admin[2].border,
                                    width: ds_admin[2].width,

                                }"><span v-bind:style="{ color: ds_admin[2].linea }">N</span>uevo SEO</div>
            <spinner-component :spinner="spinner"></spinner-component>
        </div>
       
        <hr class="mb-5" style="background-color: #343a40;">
        
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch">
              <div class="card" :style="{ backgroundColor: ds_admin[4].backgroundColor }">
                <div class="card-body pt-0">
                    <!-- Form -->
                    <form class="text-left p-3" @submit.prevent="submit" v-bind:style="{
                                                backgroundColor: ds_admin[14].backgroundColor
                                            }">  

                        <!-- pagina -->
                        <div class="alert alert-info alert-dismissible mt-5">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5 class="d-flex align-items-center">
                                <i class="fas fa-info-circle fa-2x p-3 mr-1 float-left black-text" aria-hidden="true"></i>
                                Página
                            </h5>
                            
                            <h6 class=" white-text mb-0 py-3 mt-1">
                                <p class="card-text">-Selecciona la página</p>
                                <select class="custom-select form-control-border" v-model="pagina" id="exampleSelectBorder">
                                    <option></option>
                                    <option :value="pag.pagina" v-for="pag in paginas" :key="pag.id">{{ pag.pagina }}</option>
                                </select>
                            </h6>
                        </div>
                        <div class="md-form mt-3">
                            <input type="text" id="idpagina" class="form-control" v-model="pagina">
                        </div>

                        <!-- titulo -->
                        <div class="alert alert-info alert-dismissible mt-5">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5 class="d-flex align-items-center">
                                <i class="fas fa-info-circle fa-2x p-3 mr-1 float-left black-text" aria-hidden="true"></i>
                                Título
                            </h5>
                            
                            <h6 class=" white-text mb-0 py-3 mt-1">
                                <p class="card-text">-Título de la pestaña, de la página</p>
                            </h6>
                        </div>
                        <div class="md-form mt-3">
                            <input type="text" id="idtitulo" class="form-control" v-model="titulo">
                        </div>

                        <!-- title -->
                        <div class="alert alert-info alert-dismissible mt-5">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5 class="d-flex align-items-center">
                                <i class="fas fa-info-circle fa-2x p-3 mr-1 float-left black-text" aria-hidden="true"></i>
                                Title
                            </h5>
                            
                            <h6 class=" white-text mb-0 py-3 mt-1">
                                <p class="card-text">-Es el titulo que google pondra</p>
                                <p class="card-text">-<span class="text-danger font-weight-bold">Max 50 - 60</span> caracteres</p>
                                <p class="card-text">-La primera palabra es la keyword principal</p>
                                <p class="card-text">-Cada título tiene que ser unico y representar el contenido de la página</p>
                            </h6>
                        </div>
                        <div class="md-form mt-3" v-if="title">
                            <input type="text" id="idtitle" class="form-control" v-model="title">
                            <div class="d-flex justify-content-end">
                                <p class="marco mr-2" :style="{ color: contadorTitle > 60 ? 'red' : 'white' }"> Caracteres: {{ contadorTitle }} {{ title.length >= 0 ? contadorCaracteresTitle() : ''}}</p>
                                <p class="text-white marco"> Palabras: {{numeroPalabrasTitle}}</p>
                        </div>
                        </div>

                        <!--description-->
                        <div class="alert alert-info alert-dismissible mt-5">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5 class="d-flex align-items-center">
                                <i class="fas fa-info-circle fa-2x p-3 mr-1 float-left black-text" aria-hidden="true"></i>
                                Description
                            </h5>
                            
                            <h6 class=" white-text mb-0 py-3 mt-1">
                                <p class="card-text">-Cada description es unica no devemos repetirla entre páginas</p>
                                <p class="card-text">-La descripción es lo que vemos en el buscador de google después del título</p>
                                <p class="card-text">-<span class="text-danger font-weight-bold">Max 140 - 160</span> caracteres manejar este rango incluyendo signos y espacios</p>
                            </h6>
                        </div>

                        <ckeditor :editor="editor" v-model="description" :config="editorConfig" tag-name="textarea" class="mt-5"></ckeditor>
                        <div class="d-flex justify-content-end">
                            <p class="marco mr-2" :style="{ color: contadorDescription > 160 ? 'red' : 'white' }"> Caracteres: {{ contadorDescription }} {{ description.length >= 0 ? contadorCaracteres() : ''}}</p>
                            <p class="text-white marco"> Palabras: {{numeroPalabras}}</p>
                        </div>
                        
                         <!-- autor -->
                         <div class="alert alert-info alert-dismissible mt-5">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5 class="d-flex align-items-center">
                                <i class="fas fa-info-circle fa-2x p-3 mr-1 float-left black-text" aria-hidden="true"></i>
                                Autor
                            </h5>
                            
                            <h6 class=" white-text mb-0 py-3 mt-1">
                                <p class="card-text">-Nombre del autor de la página</p>
                            </h6>
                        </div>
                        <div class="md-form mt-3">
                            <input type="text" id="idautor" class="form-control" v-model="autor">
                        </div>

                        <!-- canonical -->
                        <div class="alert alert-info alert-dismissible mt-5">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5 class="d-flex align-items-center">
                                <i class="fas fa-info-circle fa-2x p-3 mr-1 float-left black-text" aria-hidden="true"></i>
                                Canonical
                            </h5>

                            <h6 class=" white-text mb-0 py-3 mt-1">
                                <p class="card-text">-Indicamos que la página es contenido original, no repetido</p>
                            </h6>
                        </div>
                        <div class="md-form mt-3">
                            <input type="text" id="idcanonical" class="form-control" v-model="canonical">
                        </div>

                         <!-- h1 -->
                         <div class="alert alert-info alert-dismissible mt-5">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5 class="d-flex align-items-center">
                                <i class="fas fa-info-circle fa-2x p-3 mr-1 float-left black-text" aria-hidden="true"></i>
                                H1
                            </h5>
                            
                            <h6 class=" white-text mb-0 py-3 mt-1">
                                <p class="card-text">Título para indicar a los usuarios de que trata la página</p>
                                <p class="card-text">Título principal</p>
                            </h6>
                        </div>
                        <div class="md-form mt-3">
                            <input type="text" id="idh1" class="form-control" v-model="h1">
                        </div>

                         <!-- h2 -->
                         <div class="alert alert-info alert-dismissible mt-5">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5 class="d-flex align-items-center">
                                <i class="fas fa-info-circle fa-2x p-3 mr-1 float-left black-text" aria-hidden="true"></i>
                                H2
                            </h5>
                            
                            <h6 class=" white-text mb-0 py-3 mt-1">
                                <p class="card-text">Subtitulos para indicar a los usuarios los apartados</p>
                                <p class="card-text">Subtitulos menos importantes que el h1</p>
                            </h6>
                        </div>
                        <div class="md-form mt-3">
                            <input type="text" id="idh2" class="form-control" v-model="h2">
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <btns-component :tipo="18" v-on:traeEmit="enviar()"></btns-component>  
                        </div>

                    </form>
                    <!-- Form -->
                </div>
              </div>
            </div>
        </div>
    </div>
    
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import { mapMutations, mapState, mapActions  } from 'vuex';
    export default {
        data () {
            return { 
                        pagina: '',
                        titulo: '',
                        title: '',
                        description: '',
                        autor: '',
                        h1: '',
                        h2: '',
                        canonical: '',
                        contadorDescription: 0,
                        numeroPalabras: 0,
                        contadorTitle: 0,
                        numeroPalabrasTitle: 0,
                        editor: ClassicEditor,
                        editorConfig: {
                            toolbar: [ 'heading', '|', 'bold', 'italic', 'insertTable', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
                            //removePlugins: [ 'Image', 'Link', 'mediaEmbed' ],   
                            table: {
                                contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
                            }
                            
                        }
                   };
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar', 'iniciarSpinner', 'pararSpinner']),
            ...mapActions('mdGeneral', ['loadUltimoOrden', 'permisosDeUsuario']),
            enviar(){

                let validacion =  false;
                if(this.pagina != ''){
                    validacion = true;
                }
                
                if(validacion ==  true){

                    let ultimosdatoseditados = {

                        pagina: this.pagina,
                        titulo: this.titulo,
                        title: this.title,
                        description: this.description,
                        autor: this.autor,
                        h1: this.h1,
                        h2: this.h2,
                        extra: this.canonical,
                        orden: this.ultimoOrden,
                    };

                    let url = '/api/seo';
                    axios.post(url, ultimosdatoseditados).then(response => {

                        const answers = JSON.stringify(response.data)
                        Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Seo actualizado!!',
                        showConfirmButton: false,
                        timer: 2000
                        });
                        
                        this.pagina =response.data.pagina,
                        this.titulo =response.data.titulo,
                        this.title =response.data.title,
                        this.description =response.data.description,
                        this.autor =response.data.autor,
                        this.h1 =response.data.h1,
                        this.h2 =response.data.h2,
                        this.canonical =response.data.extra,

                        this.parar();  
                        this.$router.push('/administracion/seo').catch(err => {});                          
                    });  

                }else{
                    this.parar();
                    alert('El campo Página es obligatorio!!');
                }
            },
            contadorCaracteres(){

                let cuantos = this.description.length;

                let numeroEspacios = (this.description.split('&nbsp;').length - 1); // 3
                if(numeroEspacios > 0){

                    let numeroEspaciosTotales = numeroEspacios * 5;

                    if(numeroEspaciosTotales > 0){
                        cuantos = cuantos - numeroEspaciosTotales;
                    }
                }else{
                    numeroEspacios = 0;
                }

                let numeroP =  this.description.split('<p>').length -1;
                console.log('numeroP');
                console.log(numeroP);
                if(numeroP >= 0){   

                    let numeroPTotales = numeroP * 7;
                    if(numeroPTotales > 0){
                        cuantos = cuantos - numeroPTotales;
                    }
                }else{
                    numeroP = 0;
                }

                let palabras = this.description.split(' ').length;
                if(this.description == ''){ palabras = 0;}

                if(numeroP > 1){ 
                    let addP = palabras + (numeroP-1);
                    this.numeroPalabras = addP; 
                }else{
                    this.numeroPalabras = palabras; 
                }

                this.contadorDescription = cuantos;
                
            },
            contadorCaracteresTitle(){

                let cuantos = this.title.length;

                let numeroEspacios = (this.title.split('&nbsp;').length - 1); // 3
                if(numeroEspacios > 0){

                    let numeroEspaciosTotales = numeroEspacios * 5;

                    if(numeroEspaciosTotales > 0){
                        cuantos = cuantos - numeroEspaciosTotales;
                    }
                }else{
                    numeroEspacios = 0;
                }

                let numeroP =  this.title.split('<p>').length -1;
                console.log('numeroP');
                console.log(numeroP);
                if(numeroP >= 0){   

                    let numeroPTotales = numeroP * 7;
                    if(numeroPTotales > 0){
                        cuantos = cuantos - numeroPTotales;
                    }
                }else{
                    numeroP = 0;
                }

                let palabras = this.title.split(' ').length;
                if(this.title == ''){ palabras = 0;}

                if(numeroP > 1){ 
                    let addP = palabras + (numeroP-1);
                    this.numeroPalabrasTitle = addP; 
                }else{
                    this.numeroPalabrasTitle = palabras; 
                }

                this.contadorTitle = cuantos;
                
            },
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin', 'spinner']),
            ...mapState('mdGeneral', ['ultimoOrden', 'permisos']),
        },
        created (){
            this.permisosDeUsuario();
            let url = '/api/paginas';
            axios.get(url).then(response => {                 

                let hash = {};
                this.paginas = response.data.data.filter(o => hash[o.pagina] ? false : hash[o.pagina] = true);

            });
        },
        mounted (){
            console.log('Componente SeoNuevoComponent'); 

             setTimeout(() => {
                this.pararSpinner();
            }, 2000);
        }

    }
</script>
<style lang="scss">  

 .marco{
     border-left: dotted 1px red;
     border-right: dotted 1px red;
     border-bottom: dotted 1px red;
     padding: 8px;
 }
</style>   
  
 



                        