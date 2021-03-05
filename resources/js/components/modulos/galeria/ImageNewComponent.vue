<template>
<div>
    <div class="container mt-5">

        <!-- Material form contact -->
        <div class="card">

            <h5 class="card-header text-center py-4">
                <strong>Nueva Imagen </strong>
            </h5>

            <!--Card content-->
            <div class="card-body px-lg-5 pt-0">

                <!-- Form -->
                <form class="" style="color: #757575;" @submit.prevent="submit">

                     <!-- Subir imagen -->
                    <div class="p-2">
                        <div class="md-form pt-5">
                            <input type="file" id="sbimagen" class="form-control" name="image" @change="getImage" accept="image/*" required>
                            <label for="furl_clean" class="active py-2 myfile">Subir imagen</label>
                        </div>
                    </div>

                    <!-- image -->
                    <div class="md-form mt-3">
                        <input type="text" id="idimage" class="form-control" v-model="image">
                        <label for="fimage" class="active">Imagen con extensión</label>
                    </div>

                    <!-- description -->
                    <div class="md-form">
                        <input type="text" id="iddescription" class="form-control" v-model="description">
                        <label for="fdescription" class="active">Descripción de la imagen</label>
                    </div>

                    <!-- link -->
                    <div class="md-form">
                        <input type="text" id="idlink" class="form-control" v-model="link">
                        <label for="flink" class="active">Link</label>
                    </div>

                    <!-- alt -->
                    <div class="md-form">
                        <input type="text" id="idalt" class="form-control" v-model="alt">
                        <label for="falt" class="active">Alt</label>
                    </div>
                    
                    <!-- Visible -->
                    <label>Visible</label>
                    <select class="browser-default custom-select mb-4" id="idposted"  v-model="visible" style="max-width:150px;">
                        <option value="0"> No </option>
                        <option value="1" selected> Si </option>
                    </select>

                    <!-- tipo -->
                    <label style="text-align: left !important;">Tipo</label>
                    <select class="browser-default custom-select mb-4" id="idtipo"  v-model="tipo" style="max-width:150px;">
                        <option value="tipo.id" v-for="tipo in imageTipo" :key="tipo.id">{{ tipo.title }}</option>
                    </select>

                </form>
                <!-- Form -->

                <button @click="enviar()" class="btn btn-outline-primary waves-effect text-right">Guardar</button>

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
                       imgSelected: "",
                       images: null,
                       mensaje: '',

                       image:"",
                       description:"",
                       link:"",
                       alt:"",
                       visible: 1,
                       tipo:"web",
                       imageTipo: [],
                    };
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar', 'iniciarSpinner', 'pararSpinner']),
            ...mapActions('mdGeneral', ['loadUltimoOrden']),
            getTipoImagen(){

                    let urlTipo = '/api/images/tipo';
                    axios.post(urlTipo).then(responseCat => {
                
                    this.imageTipo = responseCat.data.data;
                    console.log(this.imageTipo);
                    });
            },
            getImage(event){

                //Asignamos la imagen a  nuestra data
                if(typeof event.target.files[0] !== 'undefined'){
                    this.imagen = event.target.files[0];
                    let extension = this.imagen.name.slice((this.imagen.name.lastIndexOf('.') - 1 >>> 0) + 2);
                    this.image = this.imagen.name;
                }else{
                    this.imagen = "";
                    this.image = "";
                }
                
            },
            enviar: function(){
                
                //Creamos el formData
                var data = new  FormData();

                // let extension = this.imagen.name.slice((this.imagen.name.lastIndexOf('.') - 1 >>> 0) + 2);
                // let nombre = this.imagen.name.replace('.'+extension, "");
                // let nombreConExtension = this.imagen.name;

                //Añadimos la imagen seleccionada
                data.append('miImagen', this.imagen);


                    data.append('image',      this.image);
                    data.append('description', this.description);
                    data.append('link',        this.link);
                    data.append('alt',         this.alt);
                    data.append('visible',     this.visible);
                    data.append('tipo',        this.tipo);
                    data.append('orden',       this.ultimoOrden);


                //Añadimos el método PUT dentro del formData
                // Como lo hacíamos desde un formulario simple _(no ajax)_
                //data.append('_method', 'PUT');
    
                //Enviamos la petición
                axios.post('/api/images/',data)
                .then(response => {

                        const answers = JSON.stringify(response.data)
                            Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Imagen guardada!!',
                            showConfirmButton: false,
                            timer: 2000
                        });

                        this.$router.push('image');
                
                }).catch(error => {

                        let myError = "";
                        if (error.response.status === 406) {
                            myError = error.response.data;   
                        }

                        if (error.response.status === 500) {
                            myError  = error.response.data.message;   
                        }

                        const answers = JSON.stringify(error.response.data.message)
                                Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: myError,
                                showConfirmButton: false,
                                timer: 2000
                            });

                            //this.$router.push('image');
                });

            }
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin', 'spinner']),
            ...mapState('mdGeneral', ['ultimoOrden']),
        },
        created (){
            this.loadUltimoOrden('imagenes');
        },
        mounted (){

        },
    }
</script>
<style scoped>    
    .md-form label myfile {
        top: -30px;
    }
</style>    

