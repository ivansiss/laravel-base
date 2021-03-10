<template>
<div>
    <div v-if="post" class="container mt-5">

    <!-- Material form contact -->
    <div class="card">

            <div class="d-flex justify-content-start">
                <div class="d-flex justify-content-start">
                <div class="ml-3 mb-5 titulo-listas subrayar-verde"><span v-bind:style="{ color: ds_admin[2].linea }">P</span>ost Editar</div>
                <spinner-component :spinner="spinner"></spinner-component>
            </div>
        </div>
        <!--Card content-->
        <div class="card-body px-lg-5 pt-5 fondo-card">

            <!-- Form -->
            <form class="text-left text-dark" @submit.prevent="submit">
                
                <!-- Categoria -->
                <div class="d-flex justify-content-start ">
                    <label class="font-weight-bold d-flex align-items-center mr-3 texto-tarjeta">Categoria</label>
                    <select class="browser-default custom-select d-flex align-items-center" id="idcontent" v-model="category_id" @change="maxImagenes()">
                        <option v-for="cat in categorias" :key="cat.title" :value="cat.id" >{{ cat.title }}</option>
                    </select>
                </div>
                
                <select-component :selecionados="selecionados" :max="max" v-on:selecionadosEmit="vueltaSelect"></select-component>

                <!-- Title -->
                <div class="md-form mt-3">
                    <label for="ftitle" class="active texto-tarjeta">Título</label>
                    <input type="text" id="idtitle" class="form-control" v-model="title">
                </div>

                <!-- subtitulo -->
                <div class="md-form mt-5">
                    <label for="fsubtitulo" class="active texto-tarjeta">Subtítulo</label>
                    <input type="text" id="idsubtitulo" class="form-control" v-model="subtitulo">
                </div>

                <!-- Url_clean -->
                <div class="md-form mt-5 mb-5">
                    <label for="furl_clean" class="active texto-tarjeta">Url limpia</label>
                    <input type="text" id="idurlclean" class="form-control" v-model="url_clean">
                </div>

                <!--Content-->
                <label class="mt-4 texto-tarjeta">Descripción</label>
                <ckeditor :editor="editor" v-model="content" :config="editorConfig" tag-name="textarea" class="mt-5"></ckeditor>
                
                <!-- Visible -->
                <div class="d-flex justify-content-start mt-3">
                    <label class="d-flex align-items-center mr-3 texto-tarjeta">Visible</label>
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
    <div v-else>
        <h1>El post no existe</h1>
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
                        idrecibido: null,
                        orden: 0,
                        title: "",
                        subtitulo: "",
                        url_clean: "",
                        content: "Sin contenido",
                        posted: null,
                        category_id: "",
                        editor: ClassicEditor,
                        editorConfig: {
                            toolbar: [ 'heading', '|', 'bold', 'italic', 'insertTable', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
                            //removePlugins: [ 'Image', 'Link', 'mediaEmbed' ],   
                            table: {
                                contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
                            }
                            
                        },

                        imagenes: {},
                        selecionados: [],
                        guardarSelecionados: [],
                        max:1,
                        poderEnviar: false,
                    };
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar', 'pararSpinner']),
            ...mapActions('mdGeneral', ['loadUltimoOrden']),
            getPost: function(){
                
                let url = '/api/post/'+this.idrecibido;
                axios.get(url).then(response => {

                        this.orden = response.data.orden;
                        this.title = response.data.title;
                        this.subtitulo = response.data.subtitulo;
                        this.url_clean = response.data.url_clean;
                        
                        if(response.data.content == null){
                            this.content = "";
                        }else{
                            this.content = response.data.content;
                        }

                        this.posted = response.data.posted;
                        this.category_id = response.data.category_id;

                        this.post = response.data;
                        this.selecionados = this.post['images'];
                        this.maxImagenes();
                });
            },
            vueltaSelect(datos){
                        this.guardarSelecionados = datos;
                        console.log('llego');
                        this.parar();
            },
            enviar: function(){

                this.maxImagenes();
                if(this.poderEnviar){

                    let ultimosdatoseditados = {

                        id:          this.post.id,
                        orden:       this.orden,
                        title:       this.title,
                        subtitulo:   this.subtitulo,
                        url_clean:   this.url_clean,
                        content:     this.content,
                        posted:      this.posted,
                        category_id: this.category_id,
                        imagenes: this.guardarSelecionados
                    };

                    let url = '/api/post/'+this.idrecibido;
                    axios.put(url, ultimosdatoseditados).then(response => {

                        const answers = JSON.stringify(response.data)
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Post actualizado!!',
                        showConfirmButton: false,
                        timer: 2000
                        });

                        let url1 = ``;
                                if(this.$route.fullPath == '/administracion/post?page=1'){
                                        url1 = `/administracion/post`;
                                }else{
                                        url1 = `/administracion/post?page=1`;
                                }

                                this.$router.push(url1).catch(err => {});

                    }).catch(error => {

                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors || {};
                            }
                    });
                }
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
                        this.max = 12;
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

            }
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin', 'spinner']),
            ...mapState('mdGeneral', ['ultimoOrden']),
        },
        created (){

            this.loadUltimoOrden('imagenes');
            this.idrecibido = this.$route.params.id;

            let opciones = "";
            let urlCat = '/api/categorias/';
            
            axios.get(urlCat).then(responseCat => {
            this.categorias = responseCat.data.data;
            });

            this.getPost();

            setTimeout(() => {
                this.pararSpinner();
            }, 12000);

        },
        mounted (){
            console.log('PostDetailComponent');
        },
    }
</script>
<style lang="scss">  

    .swal2-title{
        font-size: 1.2em;
    }
</style>    

