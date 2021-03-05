<template>
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

                                    }"><span v-bind:style="{ color: ds_admin[2].linea }">N</span>uevo Producto</div>
                <spinner-component :spinner="spinner"></spinner-component>
            </div>

            <!--Card content-->
            <div class="card-body">

                <select-producto-component 
                                                :listaProductos="listaProductos" 
                                                :listaIconos="listaIconos" 
                                                :listaColores="listaColores" 
                                                :listaSellos="listaSellos"
                                                :listaTarifas="listaTarifas"

                                                max="50" 
                                                v-on:selecionadosEmit="vueltaSelect">
                </select-producto-component>

                <!-- Form -->
                <form class="text-left mt-5 p-5" @submit.prevent="submit" v-bind:style="{ 
                                        color: ds_admin[14].color,
                                        backgroundColor: ds_admin[14].backgroundColor
                                    }">  

                    <!-- Title -->
                    <div class="md-form mt-3">
                        <label for="ftitulo" class="active">Título</label>
                        <input type="text" id="idtitulo" class="form-control" v-model="titulo">
                    </div>

                    <!-- subtitulo-->
                    <div class="md-form mt-3">
                        <label for="fsubtitulo" class="active">Subtitulo</label>
                        <input type="text" id="idsubtitulo" class="form-control" v-model="subtitulo">
                    </div>

                    <!-- reseña-->
                    <div class="md-form mt-3">
                        <label for="fresena" class="active">Reseña</label>
                        <input type="text" id="idresena" class="form-control" v-model="resena">
                    </div>

                    <!--Content-->
                    <div class="md-form mt-3">
                        <label for="fcontent" class="active">Contenido</label>
                        <ckeditor :editor="editor" v-model="content" :config="editorConfig" tag-name="textarea"></ckeditor>
                    </div>

                    <!-- slug-->
                    <div class="md-form mt-3">
                        <label for="fslug" class="active">enlace</label>
                        <input type="text" id="idslug" class="form-control" v-model="slug">
                    </div>
                    
                    <!--Visible-->
                    <div class="d-flex flex-column mt-3">
                        <!-- Visible -->
                        <label class="mt-4 w-25 text-left">Visible</label>
                        <select class="browser-default custom-select mb-4 w-25" id="idestado" v-model="visible">
                            <option value="not"> No </option>
                            <option value="yes" > Si </option>

                        </select>
                    </div>

                    <!-- Subir pdf -->
                    <div class="p-2">
                        <div class="md-form pt-3">
                            <label for="furl_clean" class="active py-2 myfile">Subir pdf</label>
                            <input type="file" id="sbpdf" class="form-control" name="pdf" @change="getPdf" accept=".pdf" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-5">
                        <btns-component :tipo="18" v-on:traeEmit="enviar()"></btns-component>  
                    </div>

                </form>

            </div>

        </div>
        <!-- Material form contact -->
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import { mapMutations, mapState, mapActions } from 'vuex';
    export default {
        data () {
            return { 
                        titulo: "",
                        resena: '',
                        subtitulo: '',
                        content: "",
                        slug:"",
                        pdf: '',
                        visible: 'yes',

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
                        ultimoProducto: 0,
                        nombrePdf: '',

                        listaProductos: [],
                        listaIconos: [],
                        listaColores: [],
                        listaSellos: [],
                        listaTarifas: [],
        
                    };
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar', 'iniciarSpinner', 'pararSpinner']),
            ...mapActions('mdGeneral', ['loadUltimoOrden']),
            comprobarCampos(){

                  let msg = "Comprobación correcta!!";
                  if(this.titulo === ""){
                      msg ="Título vacio";
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

            },
            enviar: function(){

                if(this.comprobarCampos() == true){

                //Creamos el formData
                var data = new  FormData();
                data.append('miPdf', this.pdf);

                let stringIds = "";
                this.guardarSelecionados.forEach(item => {
                    stringIds += item.id + ' ';
                });
            
                data.append('imagenes', stringIds);

                    data.append('titulo',      this.titulo);
                    data.append('resena',      this.resena);
                    data.append('subtitulo',   this.subtitulo);
                    data.append('contenido',   this.content);
                    data.append('slug',        this.slug);
                    data.append('pdf',         this.pdf);
                    data.append('orden',       this.ultimoProducto);
                    data.append('estado',      this.visible);

                    let url = '/api/productos';
                    axios.post(url, data).then(response => {

                        const answers = JSON.stringify(response.data)
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Producto guardado!!',
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
            getPdf(event){

                //Asignamos la imagen a  nuestra data
                if(typeof event.target.files[0] !== 'undefined'){
                    this.pdf = event.target.files[0];
                    let extension = this.pdf.name.slice((this.pdf.name.lastIndexOf('.') - 1 >>> 0) + 2);
                    this.nombrePdf = this.pdf.name;
                }else{
                    this.pdf = "";
                    this.nombrePdf = "";
                }
                
            },
            vueltaSelect(datos){

                this.guardarSelecionados = datos;
                this.parar();
                console.log(this.guardarSelecionados);
            },
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin', 'spinner']),
            ...mapState('mdGeneral', ['ultimoOrden']),
        },
        created (){

            this.loadUltimoOrden('productos');
            setTimeout(() => {
                this.pararSpinner();
            }, 4000);
        },
        mounted (){
            console.log('ProductoNewComponent');
        },
    }
</script>
<style scoped>    
    prueba_css {
        color:red;
    }
</style>    

