<template>
    <div class="container mt-5">
        <div class="card">

            <div class="d-flex justify-content-start">
                <div class="ml-3 mb-5 titulo-listas subrayar-verde"><span v-bind:style="{ color: ds_admin[2].linea }">P</span>roductos Edición</div>
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
                <form class="text-left p-3 fondo-principal text-white" @submit.prevent="submit">  

                    <!-- Title -->
                    <div class="md-form mt-3">
                        <label for="ftitulo" class="active d-flex align-items-start">Título</label>
                        <input type="text" id="idtitulo" class="form-control" v-model="titulo">
                    </div>

                    <!-- reseña-->
                    <div class="md-form mt-4">
                        <label for="fresena" class="active d-flex align-items-start">Reseña</label>
                        <textarea type="text" rows="10" id="idresena" class="form-control" v-model="resena"></textarea>
                    </div>

                    <!-- subtitulo-->
                    <div class="md-form mt-4">
                        <label for="fsubtitulo" class="active d-flex align-items-start">Subtitulo</label>
                        <input type="text" id="idsubtitulo" class="form-control" v-model="subtitulo">
                    </div>

                    <!--Content-->
                    <div class="md-form mt-4 text-dark">
                        <label for="feditor">Contenido</label>
                        <ckeditor :editor="editor" v-model="contenido" :config="editorConfig" class="" tag-name="textarea"></ckeditor>
                    </div>

                    <!-- slug-->
                     <div class="md-form mt-3">
                        <label for="fslug" class="active d-flex align-items-start">Enlace</label>
                        <input type="text" id="idslug" class="form-control" v-model="slug">
                    </div>

                    <div class="d-flex flex-column mt-5">
                        <!-- Visible -->
                        <label class="mt-4 w-25 text-left">Visible</label>
                        <select class="browser-default custom-select mb-4 w-25" id="idestado" v-model="visible">
                            <option value="not"> No </option>
                            <option value="yes" > Si </option>

                        </select>
                    </div>

                    <!-- Subir pdf -->
                    <div class="md-form pt-3">
                        <div class="d-flex justify-content-start flex-wrap align-items-center">
                            <btns-component :tipo="10" v-on:traeEmit="delPdf(pdf)" class="mr-3"></btns-component>
                            {{ nombrePdf }}    
                        </div>
                        <label for="furl_clean" class="active pt-3 myfile">Subir pdf</label>
                        <input type="file" id="sbpdf" class="form-control p-0" name="pdf" @change="getPdf" accept=".pdf">
                    </div>

                    <div class="d-flex justify-content-end mt-5">
                        <btns-component :tipo="18" v-on:traeEmit="enviar()"></btns-component>  
                    </div>

                </form>
                <!-- Form -->
            </div>
        </div>
    </div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import { mapMutations, mapState } from 'vuex';
    export default {
        data () {
            return { 
                        titulo: "",
                        resena: '',
                        subtitulo: '',
                        contenido: "",
                        slug: "",
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
                        guardarSelecionados: [],
                        nombrePdf: '',
                        btnEliminarPdf: false,
                        listaProductos: [],
                        listaIconos: [],
                        listaColores: [],
                        listaSellos: [],
                        listaTarifas: [],
                        idrecibido: 0,
                    };
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar', 'iniciarSpinner', 'pararSpinner']),
            getProd(){

                console.log('getProd()');
                let url = '/api/productos/'+this.idrecibido;
                axios.get(url).then(response => {

                        this.titulo = response.data.titulo;
                        this.resena = response.data.resena;
                        this.subtitulo = response.data.subtitulo;
                        this.contenido = response.data.contenido;
                        this.slug = response.data.slug;
                        this.pdf = response.data.pdf;
                        this.visible = response.data.estado;

                        this.reparteImagenes(response.data.images);

                        if(this.pdf !=""){
                            this.btnEliminarPdf = true;
                            this.nombrePdf = this.pdf;
                            document.getElementById('sbpdf').value = "";
                        }else{
                             this.btnEliminarPdf = false;
                             this.nombrePdf = "";
                              document.getElementById('sbpdf').value = "";
                        }

                        console.log('producto: ');
                        console.log(response.data);
                });
            },
            vueltaSelect(imagenes){
                this.guardarSelecionados = imagenes;
                this.parar();
            },
            enviar: function(){

                let size = true;
                if(this.pdf.size >= 8388608){

                    let msg = 'El pdf no puede pasar de '+8388608/1024/1024 + 'mb';
                    const answers = JSON.stringify(msg)
                        Swal.fire({
                        position: 'center',
                            icon: 'warning',
                            title: answers,
                            showConfirmButton: false,
                            timer: 2000
                    });

                    size = false;
                }

                if(this.comprobarCampos() == true && size == true){

                    //Creamos el formData
                    var data = new  FormData();
                    console.log('size');
                    console.log(this.pdf.size);
                    data.append('miPdf', this.pdf);

                    let stringIds = "";
                    this.listaProductos.forEach(item => {
                        stringIds += item.id + ' ';
                    });
                    this.listaIconos.forEach(item1 => {
                        stringIds += item1.id + ' ';
                    });
                    this.listaColores.forEach(item2 => {
                        stringIds += item2.id + ' ';
                    });
                    this.listaSellos.forEach(item3 => {
                        stringIds += item3.id + ' ';
                    });

                     this.listaTarifas.forEach(item4 => {
                        stringIds += item4.id + ' ';
                    });
                
                    data.append('imagenes', stringIds);

                        data.append('id',          this.idrecibido);
                        data.append('titulo',      this.titulo);
                        data.append('resena',      this.resena);
                        data.append('subtitulo',   this.subtitulo);
                        data.append('contenido',   this.contenido);
                        data.append('slug',        this.slug);
                        data.append('pdf',         this.nombrePdf);
                        data.append('estado',      this.visible);
                        data.append('_method', 'PUT');

                        let url = '/api/productos/'+this.idrecibido;
                        axios.post(url, data).then(response => {

                            const answers = JSON.stringify(response.data)
                            Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Producto actualizado!!',
                            showConfirmButton: false,
                            timer: 2000
                            });
                            
                            let url1 = ``;
                            if(this.$route.fullPath == '/administracion/productos?page=1'){
                                    url1 = `/administracion/productos`;
                            }else{
                                    url1 = `/administracion/productos?page=1`;
                            }

                            this.$router.push(url1).catch(err => {});
                            this.parar();

                        }).catch(error => {

                                if (error.response.status === 422) {
                                    this.errors = error.response.data.errors || {};
                                }

                                const answers = JSON.stringify(error.response.data)
                                Swal.fire({
                                position: 'center',
                                    icon: 'warning',
                                    title: answers,
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                this.parar();
                        });
                }
            },
            comprobarCampos(){

                  let msg = "Comprobación correcta!!";
                  if(this.title === ""){
                      msg ="Título vacio";
                  }
                
                if(msg == "Comprobación correcta!!"){
                    return true;
                }else{
    
                    const answers = JSON.stringify(msg)
                    Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: answers,
                    showConfirmButton: false,
                    timer: 2000
                    });

                    return false;
                }

            },
            getPdf(event){

                if(typeof event.target.files[0] !== 'undefined'){
                    this.pdf = event.target.files[0];
                    let extension = this.pdf.name.slice((this.pdf.name.lastIndexOf('.') - 1 >>> 0) + 2);
                    this.nombrePdf = this.pdf.name;
                }else{
                    this.pdf = "";
                    this.nombrePdf = "";
                }
                
            },
            delPdf(pdf){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Estas Seguro?',
                text: "Si eliminas "+ pdf +", No podras deshacer el cambio!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, eliminalo!',
                cancelButtonText: 'No, cancela!',
                reverseButtons: true
                }).then(  (result) => {

                if (result.isConfirmed) {

                    let envioPdf = { 
                                            id: this.idrecibido,
                                        nombre: pdf 
                                   };

                    let url = '/api/productos/eliminar/pdf';
                    axios.post(url, envioPdf).then(response => {

                            const answers = JSON.stringify(response.data)
                                Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: answers,
                                showConfirmButton: false,
                                timer: 2000
                            })

                            this.nombrePdf = "";
                            this.btnEliminarPdf = false;
                            document.getElementById('sbpdf').value = "";
                            this.$emit('refrescarEmit');
                    });

                   
                } else if (result.dismiss === Swal.DismissReason.cancel) {

                   const answers = JSON.stringify(result.dismiss)
                        Swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: 'Operación cancelada',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
                })
            },
            reparteImagenes(imagenes){

                imagenes.forEach(item => {
                    if(item.tipo_id == 1){
                        this.listaProductos.push(item);
                    }
                    if(item.tipo_id == 5){
                        this.listaIconos.push(item);
                    }
                    if(item.tipo_id == 6){
                        this.listaColores.push(item);
                    }
                    if(item.tipo_id == 7){
                        this.listaSellos.push(item);
                    }
                    if(item.tipo_id == 3){
                        
                        this.listaTarifas.push(item);
                    }

                     this.parar();
                });    
            }
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin', 'spinner']),
        },
        created (){

            setTimeout(() => {
                this.pararSpinner();
            }, 4000);

            

        },
        mounted (){
            console.log('ProductoDetailComponent');
            this.idrecibido = this.$route.params.id;
            this.getProd();
        },
        beforeCreate(){
            
        }
    }
</script>
<style lang="scss">    
 
</style>    

