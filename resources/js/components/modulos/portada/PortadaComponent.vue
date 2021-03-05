
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

                                }"><span v-bind:style="{ color: ds_admin[2].linea }">I</span>mágen Portada</div>
            <spinner-component :spinner="spinner"></spinner-component>
        </div>
       
        <hr class="mb-5" style="background-color: #343a40;">
        
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch">
              <div class="card" :style="{ backgroundColor: ds_admin[4].backgroundColor, color:ds_admin[4].color }">
                <div class="card-body pt-0">
                    
                    <h5 class="mt-5">La portada web tiene que tener unas medidas de:</h5>
                    <h6 class="mb-5">1397 x 787 pixel</h6>

                    <h5>La portada para movil tiene que tener unas medidas de:</h5>
                    <h6 class="mb-5">480 x 787 pixel</h6>

                    <div class="d-flex justify-content-end mt-5">
                        <btns-component :tipo="9" v-on:traeEmit="editar()"></btns-component>  
                    </div>

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
                      
                   };
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar', 'iniciarSpinner', 'pararSpinner']),
            ...mapActions('mdGeneral', ['permisosDeUsuario']),
            editar(img){
                
                 let formulario = 

                        '<hr/ class="mb-5" style="background: black;">' +
                        '<input type="file" id="mi_imagen_w" accept="image/jpg, png, svg" aria-label="Upload" class="swal2-file mb-3" placeholder="Imágen versión web" style="display: flex;">' +
                        '<input type="file" id="mi_imagen_m" accept="image/jpg, png, svg" aria-label="Upload" class="swal2-file mb-3" placeholder="Imágen version movil" style="display: flex;">';

                    Swal.fire({
                        title: 'Editar Imágen Portada',
                        showCancelButton: true,
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Guardar',
                        html: formulario,
                        focusConfirm: false,
                        preConfirm: async() => {
                          
                            let nombrefile_w = document.getElementById('mi_imagen_w').value;
                            let nombrefile_m = document.getElementById('mi_imagen_m').value;
                            let nfile_w = nombrefile_w.slice(12);
                            let nfile_m = nombrefile_m.slice(12);

                                

                                //Creamos el formData
                                var data = new  FormData();
                                const imagefile_w = document.querySelector('#mi_imagen_w');
                                const imagefile_m = document.querySelector('#mi_imagen_m');
                            
                                data.append("miImagen_w", imagefile_w.files[0]);   
                                data.append("miImagen_m", imagefile_m.files[0]);  
                                
                                let url = '/api/image/portada';
                                await axios.post(url, data).then(response => {

                                    const answers = JSON.stringify(response.data)
                                    Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: answers,
                                    showConfirmButton: false,
                                    timer: 2000
                                    })

                                    let url1 = ``;
                                    if(this.$route.fullPath == '/administracion/portada?page=1'){
                                            url1 = `/administracion/portada`;
                                    }else{
                                            url1 = `/administracion/portada?page=1`;
                                    }

                                    this.parar();
                                    this.$router.push(url1).catch(err => {});
                                        
                                });
                            

                            this.parar(); 
                        }
                        
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel) {
                           this.parar();
                        }
                    })
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
             setTimeout(() => {
                this.pararSpinner();
            }, 2000);
        }

    }
</script>
<style lang="scss">    
  
 



                        