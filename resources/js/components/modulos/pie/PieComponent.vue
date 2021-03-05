
<template>

    <div class="container mt-5" v-if="permisos.includes('access.pie')"> 

        <div class="d-flex justify-content-start">
            <div class="ml-3 mb-5" v-bind:style="{ 
                                    fontSize: ds_admin[2].size,
                                    fontWeight: 700,
                                    fontFamily: ds_admin[2].family,
                                    color: ds_admin[2].color,
                                    borderBottom: ds_admin[2].border,
                                    width: ds_admin[2].width,

                                }"><span v-bind:style="{ color: ds_admin[2].linea }">P</span>ie de página</div>
            <spinner-component :spinner="spinner"></spinner-component>
        </div>
       
        <hr class="mb-5" style="background-color: #343a40;">
        
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch">
              <div class="card" :style="{ backgroundColor: ds_admin[4].backgroundColor, color:ds_admin[4].color }">
                <div class="card-header border-bottom-0  d-flex justify-content-end">
                  <span :style="{ color:ds_admin[4].texto }">Última modificación:  {{ fecha_formateada }}</span>
                </div>
                <div class="card-body pt-0">
                    <!-- Form -->
                    <form class="text-left p-3" style="color: #757575;" @submit.prevent="submit" v-bind:style="{ 
                                            color: ds_admin[14].color,
                                            backgroundColor: ds_admin[14].backgroundColor
                                        }">  

                        <!-- Empresa -->
                        <div class="md-form mt-3">
                            <label for="fempresa" class="active d-flex align-items-start">Empresa</label>
                            <input type="text" id="idempresa" class="form-control" v-model="empresa">
                        </div>

                        <!-- Texto-->
                        <div class="md-form mt-4 text-dark">
                            <label for="feditor">Texto</label>
                            <ckeditor :editor="editor" v-model="texto" :config="editorConfig" class="" tag-name="textarea"></ckeditor>
                        </div>

                        <!-- Novedades1-->
                        <div class="md-form mt-4">
                            <label for="fnovedades1" class="active d-flex align-items-start">Novedades 1</label>
                            <input type="text" id="idnovedades1" class="form-control" v-model="novedades1">
                        </div>

                        <!-- Novedades2-->
                        <div class="md-form mt-4">
                            <label for="fnovedades1" class="active d-flex align-items-start">Novedades 2</label>
                            <input type="text" id="idnovedades2" class="form-control" v-model="novedades2">
                        </div>

                        <!-- Novedades3-->
                        <div class="md-form mt-4">
                            <label for="fnovedades3" class="active d-flex align-items-start">Novedades 3</label>
                            <input type="text" id="idnovedades3" class="form-control" v-model="novedades3">
                        </div>

                        <!--Enlace 1-->
                        <div class="md-form mt-4">
                            <label for="fenlace1" class="active d-flex align-items-start">Enlace 1</label>
                            <input type="text" id="idenlace1" class="form-control" v-model="enlace1">
                        </div>

                        <!--Enlace 2-->
                        <div class="md-form mt-4">
                            <label for="fenlace2" class="active d-flex align-items-start">Enlace 2</label>
                            <input type="text" id="idenlace2" class="form-control" v-model="enlace2">
                        </div>

                        <!--Enlace 3-->
                        <div class="md-form mt-4">
                            <label for="fenlace3" class="active d-flex align-items-start">Enlace 3</label>
                            <input type="text" id="idenlace3" class="form-control" v-model="enlace3">
                        </div>

                        <!--Direccion-->
                        <div class="md-form mt-4">
                            <label for="fdireccion" class="active d-flex align-items-start">Dirección</label>
                            <input type="text" id="iddireccion" class="form-control" v-model="direccion">
                        </div>

                        <!--Email-->
                        <div class="md-form mt-4">
                            <label for="femail" class="active d-flex align-items-start">E-mail</label>
                            <input type="text" id="idemail" class="form-control" v-model="email">
                        </div>

                        <!--Telefono-->
                        <div class="md-form mt-4">
                            <label for="ftelefono" class="active d-flex align-items-start">Teléfono</label>
                            <input type="text" id="idtelefono" class="form-control" v-model="telefono">
                        </div>

                        <!--Fax-->
                        <div class="md-form mt-4">
                            <label for="ffax" class="active d-flex align-items-start">Fax</label>
                            <input type="text" id="idfax" class="form-control" v-model="fax">
                        </div>

                        <!--Horario-->
                        <div class="md-form mt-4">
                            <label for="fhorario" class="active d-flex align-items-start">Horario</label>
                            <textarea name="horario" rows="10" id="idhorario" class="form-control" v-model="horario"></textarea>
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
                        empresa: '',
                        texto: '',
                        novedades1: '',
                        novedades2: '',
                        novedades3: '',
                        enlace1: '',
                        enlace2: '',
                        enlace3: '',
                        direccion: '',
                        email: '',
                        telefono: '',
                        fax: '',
                        horario: '',
                        fecha_formateada: '',
                        editor: ClassicEditor,
                        editorConfig: {
                            toolbar: [ 'heading', '|', 'bold', 'italic', 'insertTable', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
                            //removePlugins: [ 'Image', 'Link', 'mediaEmbed' ],   
                            table: {
                                contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
                            }
                            
                        },
                   };
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar', 'iniciarSpinner', 'pararSpinner']),
            ...mapActions('mdGeneral', ['permisosDeUsuario']),
            getDatos(){

                let url = '/api/pie';
                axios.get(url).then(response => {
                    
                    this.empresa =response.data.empresa,
                    this.texto =response.data.texto,
                    this.novedades1 =response.data.novedades1,
                    this.novedades2 =response.data.novedades2,
                    this.novedades3 =response.data.novedades3,
                    this.enlace1 =response.data.enlace1,
                    this.enlace2 =response.data.enlace2,
                    this.enlace3 =response.data.enlace3,
                    this.direccion =response.data.direccion,
                    this.email =response.data.email,
                    this.telefono =response.data.telefono,
                    this.fax =response.data.fax,
                    this.horario =response.data.horario,
                    this.fecha_formateada =response.data.fecha_formateada,
                   
                    this.parar();                               
                });
            },
            enviar(){
                
                let ultimosdatoseditados = {

                    empresa: this.empresa,
                    texto: this.texto,
                    novedades1: this.novedades1,
                    novedades2: this.novedades2,
                    novedades3: this.novedades3,
                    enlace1: this.enlace1,
                    enlace2: this.enlace2,
                    enlace3: this.enlace3,
                    direccion: this.direccion,
                    telefono: this.telefono,
                    fax: this.fax,
                    horario: this.horario
                };

                let url = '/api/pie/1';
                axios.put(url, ultimosdatoseditados).then(response => {

                    const answers = JSON.stringify(response.data)
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Pie de página actualizada!!',
                    showConfirmButton: false,
                    timer: 2000
                    });
                    
                    this.empresa =response.data.empresa,
                    this.texto =response.data.texto,
                    this.novedades1 =response.data.novedades1,
                    this.novedades2 =response.data.novedades2,
                    this.novedades3 =response.data.novedades3,
                    this.enlace1 =response.data.enlace1,
                    this.enlace2 =response.data.enlace2,
                    this.enlace3 =response.data.enlace3,
                    this.direccion =response.data.direccion,
                    this.email =response.data.email,
                    this.telefono =response.data.telefono,
                    this.fax =response.data.fax,
                    this.horario =response.data.horario,
                    this.fecha_formateada =response.data.fecha_formateada,  

                    this.parar();  
                    this.$router.push('/administracion/usuarios').catch(err => {});                          
                });  
            },
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin', 'spinner']),
            ...mapState('mdGeneral', ['permisos']),
        },
        created (){
            this.permisosDeUsuario();
        },
        mounted (){
            console.log('Componente PieComponent'); 
            this.getDatos(); 
             setTimeout(() => {
                this.pararSpinner();
            }, 2000);
        }

    }
</script>
<style lang="scss">    
  
 



                        