<template>
<div>
    <div class="container mt-5">

    <!-- Material form contact -->
    <div class="card">

        <div class="d-flex justify-content-start">
            <div class="ml-3 mb-5" v-bind:style="{ 
                                    fontSize: ds_admin[2].size,
                                    fontWeight: 700,
                                    fontFamily: ds_admin[2].family,
                                    color: ds_admin[2].color,
                                    borderBottom: ds_admin[2].border,
                                    width: ds_admin[2].width,

                                }"><span v-bind:style="{ color: ds_admin[2].linea }">N</span>uevo Post</div>
            <spinner-component :spinner="spinner"></spinner-component>
        </div>
        <!--Card content-->
        <div class="card-body px-lg-5 pt-5" :style="{ backgroundColor: ds_admin[12].backgroundColor, color:ds_admin[12].color }">

            <!-- Form -->
            <form class="text-left" style="color: #757575;" @submit.prevent="submit">

                <!-- Categoria -->
                <div class="d-flex flex-column mt-5">
                    <label class="text-left">Categoria</label>
                    <select class="browser-default custom-select mb-4 w-25" id="idcontent"  v-model="category_id" @change="maxImagenes()">
                        <option v-for="cat in categorias" :key="cat.title" :value="cat.id" >{{ cat.title }}</option>
                    </select>
                </div>
                
                <select-component :selecionados="selecionados" :max="max" v-on:selecionadosEmit="vueltaSelect"></select-component>

                <!-- Title -->
                <div class="md-form mt-3">
                    <label for="ftitle" class="active font-weight-bold text-white">Título</label>
                    <input type="text" id="idtitle" class="form-control" v-model="title">
                </div>

                <!-- subtitulo -->
                <div class="md-form mt-5">
                    <label for="fsubtitulo" class="active font-weight-bold text-white">Subtítulo</label>
                    <input type="text" id="idsubtitulo" class="form-control" v-model="subtitulo">
                </div>

                <!-- Url_clean -->
                <div class="md-form mt-5 mb-5">
                    <label for="furl_clean" class="active font-weight-bold text-white">Url limpia</label>
                    <input type="text" id="idurlclean" class="form-control" v-model="url_clean">
                </div>

                <!--Content-->
                <label class="font-weight-bold text-white mt-4">Descripción</label>
                <ckeditor :editor="editor" v-model="content" :config="editorConfig" tag-name="textarea" class="mt-5"></ckeditor>
                
                <!-- Visible -->
                <div class="d-flex justify-content-start mt-3">
                    <label class="font-weight-bold text-white d-flex align-items-center mr-3">Visible</label>
                <select class="browser-default custom-select w-25 d-flex align-items-center" id="idposted"  v-model="posted">
                    <option value="not"> No </option>
                    <option value="yes" > Si </option>

                </select>
                </div>


            </form>
            <!-- Form -->

            <div class="d-flex justify-content-end mt-5">
                <btns-component :tipo="18" v-on:traeEmit="enviar()"></btns-component>
            </div>

        </div>

    </div>
    <!-- Material form contact -->
    </div>
</div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import { mapMutations, mapState, mapActions } from 'vuex';
    export default {
        data () {
            return { 
                        post: [],
                        categorias: [],
                        title: "",
                        subtitulo: "",
                        image: "",
                        url_clean: "",
                        content: "",
                        posted: "yes",
                        category_id: 1,
                        editor: ClassicEditor,
                        editorConfig: {
                            toolbar: [ 'heading', '|', 'bold', 'italic', 'insertTable', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
                            //removePlugins: [ 'Image', 'Link', 'mediaEmbed' ],   
                            table: {
                                contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
                            }
                            
                        },
                        imagen : null,
                        selecionados: [],
                        guardarSelecionados: [],
                        poderEnviar: false,
                        max:1,
                        self: null,
                    };
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar', 'iniciarSpinner', 'pararSpinner']),
            ...mapActions('mdGeneral', ['loadUltimoOrden']),
            enviar: function(){

                this.maxImagenes();
                if(this.poderEnviar){

                    let nuevosDatos = {

                        title:       this.title,
                        orden:       this.ultimoOrden,
                        subtitulo:   this.subtitulo,
                        url_clean:   this.url_clean,
                        content:     this.content,
                        posted:      this.posted,
                        category_id: this.category_id,
                        imagenes: this.guardarSelecionados
                    };

                    let url = '/api/post';
                    axios.post(url, nuevosDatos).then(response => {

                        const answers = JSON.stringify(response.data)
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Post actualizado!!',
                        showConfirmButton: false,
                        timer: 2000
                        });
                    }).catch(error => {

                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors || {};
                            }
                    });
                }
            },
            getImage(event){
                //Asignamos la imagen a  nuestra data
                this.imagen = event.target.files[0];
            },
            vueltaSelect(datos){
                        this.guardarSelecionados = datos;
            },
            maxImagenes(){

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
                    break;

                    case 5: 
                        this.max = 3;
                    break;
                    
                    default:
                        this.max = 1;
                }
                
                 if(this.guardarSelecionados.length > this.max){
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Máximo de imágenes '+ this.max,
                    showConfirmButton: false,
                    timer:10000
                    });
                    this.poderEnviar = false;
                }else{
                    this.poderEnviar = true;
                }

            },
            comprobarCampos(){

                  let msg = "Comprobación correcta!!";
                  if(this.title === ""){
                      msg ="Título vacio";
                  }

                  if(this.subtitulo === ""){
                      msg ="Subtitulo vacio";
                  }

                  if(this.url_clean === ""){
                      msg ="Url clean vacio";
                  }

                  if(this.content === ""){
                      msg ="Contenido vacio";
                  }
                
                if(msg == "Comprobación correcta!!"){
                    const answers = JSON.stringify(msg)
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: answers,
                    showConfirmButton: false,
                    timer: 2000
                    });

                    return true;
                }else{
    
                    const answers = JSON.stringify(msg)
                    Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: answers,
                    showConfirmButton: false,
                    timer: 2000
                    });

                    return false;
                }

            }
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin', 'spinner']),
            ...mapState('mdGeneral', ['ultimoOrden']),
        },
        beforeCreate(){

        },
        created (){

            this.loadUltimoOrden('posts');

            let urlCat = '/api/categorias/';
            
            axios.get(urlCat).then(responseCat => {
            this.categorias = responseCat.data.data;
            });

            setTimeout(() => {
                this.pararSpinner();
            }, 12000);
        },
        mounted(){
            
        }

    }
</script>
<style scoped>    
    prueba_css {
        color:red;
    }
</style>    

