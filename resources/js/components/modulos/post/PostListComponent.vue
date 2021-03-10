<template>
    <div class="container mt-5">

        <div class="d-flex justify-content-start">
            <div class="ml-3 mb-5 titulo-listas subrayar-verde"><span v-bind:style="{ color: ds_admin[2].linea }">P</span>osts</div>
            <spinner-component :spinner="spinner"></spinner-component>
        </div>

        <div class="d-flex justify-content-end ml-3 mb-3 mr-3">    

            <btns-component :tipo="5" class="mr-3" v-on:traeEmit="saveOrden"></btns-component>
            <router-link class="btn btn-lg myboton" :to="{name: 'access.new.posts', params: {ultimoOrden:ultimoOrden}}">
                <i :class="ds_admin[6].icono" class="myicono"></i>
            </router-link>
        </div>

            <ul class="list-unstyled">
                <li class="media shadow-lg mb-5" v-for="post in items" :key="post.id">

                    <tipo-post-component :post="post" :ultimoOrden="ultimoOrden" v-if="post.category_id == 1" v-on:postSubirEmit="postSubir"  v-on:eliminarDatoEmit="eliminarDato(post)" v-on:postBajarEmit="postBajar"></tipo-post-component>
                    <tipo-post-una-component :post="post" :ultimoOrden="ultimoOrden" v-if="post.category_id == 3" v-on:postSubirEmit="postSubir"  v-on:eliminarDatoEmit="eliminarDato(post)" v-on:postBajarEmit="postBajar"></tipo-post-una-component>
                    <tipo-post-tres-component :post="post" :ultimoOrden="ultimoOrden" v-if="post.category_id == 5" v-on:postSubirEmit="postSubir"  v-on:eliminarDatoEmit="eliminarDato(post)" v-on:postBajarEmit="postBajar"></tipo-post-tres-component>
                    <tipo-post-slider-component :post="post" :ultimoOrden="ultimoOrden" v-if="post.category_id == 2" v-on:postSubirEmit="postSubir"  v-on:eliminarDatoEmit="eliminarDato(post)" v-on:postBajarEmit="postBajar"></tipo-post-slider-component>
                    <tipo-post-grid-component :post="post" :ultimoOrden="ultimoOrden" v-if="post.category_id == 4" v-on:postSubirEmit="postSubir"  v-on:eliminarDatoEmit="eliminarDato(post)" v-on:postBajarEmit="postBajar"></tipo-post-grid-component>

                </li>
            </ul>
            <modal-post :ultimoOrden='ultimoOrden' @closeModalPost="closeModalPost" :post="postSelected"></modal-post>
  
    </div>
    
</template>

<script>
    import { mapMutations, mapState, mapActions } from 'vuex';
    export default {
        props:['items'],
        data () {
            return { 
                        postSelected: "",
                        categorias: null,
                    }
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar', 'iniciarSpinner', 'pararSpinner']),
            ...mapActions('mdGeneral', ['loadUltimoOrden']),
            closeModalPost: function() {
                this.postSelected = "";
            },
            getDatos(){
                let url = '/api/post';
                axios.get(url).then(response => {                 
                    this.posts = response.data.data;
                });
            },
            eliminarDato(post){
 
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title:'',
                text: "Si eliminas el POST No podras deshacer el cambio!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then( async (result) => {


                if (result.isConfirmed) {
                    
                    let url = '/api/post/'+post.id;
                    await axios.delete(url).then(response => {

                      const answers = JSON.stringify(response.data)
                                Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: answers,
                                showConfirmButton: false,
                                timer: 2000
                            })

                            let url1 = ``;
                            if(this.$route.fullPath == '/administracion/post?page=1'){
                                    url1 = `/administracion/post`;
                            }else{
                                    url1 = `/administracion/post?page=1`;
                            }

                            this.$router.push(url1).catch(err => {});
                            this.parar();
                    });

                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    
                   this.parar();
                   const answers = JSON.stringify(result.dismiss)
                        Swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: 'Operación cancelada',
                        showConfirmButton: false,
                        timer: 2000
                    })
                     
                }
                    this.parar();

                })
            },
            saveOrden(){
                let url = '/api/post/order';
                axios.post(url, this.items).then(response => {

                    const answers = JSON.stringify(response.data)
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Post actualizado!!',
                    showConfirmButton: false,
                    timer: 2000
                })

                    let url1 = ``;
                    if(this.$route.fullPath == '/administracion/post?page=1'){
                            url1 = `/administracion/post`;
                    }else{
                            url1 = `/administracion/post?page=1`;
                    }

                    this.parar()
                    this.$router.push(url1).catch(err => {});
                        
                });
            },
            postSubir(post){

                let detras = {};

                let contador = 0;
                let pasaDelante = false;

                let gDetras = {};
                let gIguales = {};
                let gDelante = {};

                this.items.forEach(lista => {

                    if(pasaDelante == true){
                        gDelante = lista;
                        pasaDelante = false;
                    }
                       
                    if(post.orden != lista.orden){         
                        detras = lista;
                    }

                    if(post.orden == lista.orden){    
                        gDetras = detras;
                        gIguales = lista;
                        pasaDelante = true;
                    } 

                    lista.orden = contador;
                    contador++;
                });

                let i = gIguales.orden;
                let d = gDetras.orden;
                gIguales.orden =  d;
                gDetras.orden = i;
    
                this.items = this.items.sort((a,b) => a.orden - b.orden);
                this.parar();
            },
            postBajar(post){
                
                let siguiente = false;
                let contador = 0;
                this.items.forEach(lista => {
                    
                    if(post.orden != lista.orden && siguiente == false){
                       
                        lista.orden = contador++;
                        contador = lista.orden+1;
     
                    }

                    let pasa = 0;
                    if(siguiente == true){
          
                        lista.orden = contador;
       
                        contador = contador +2;
           
                        siguiente = false;
         
                        pasa = 1;
                    }


                    if(post.orden == lista.orden && pasa == 0){
                  
                        lista.orden = contador + 1;
             
                        siguiente = true;
        
                    } 
                });

                this.items = this.items.sort((a,b) => a.orden - b.orden);
                this.parar();
            }
        },
        computed: {     
            ...mapState('dsAdmin', ['ds_admin', 'spinner']),
            ...mapState('mdGeneral', ['ultimoOrden']),
        },
        created (){

            let opciones = "";
            let urlCat = '/api/categorias/';
            
            axios.get(urlCat).then(responseCat => {

                this.categorias = responseCat.data.data;
                   
            });

            setTimeout(() => {
                this.pararSpinner();
            }, 2000);
            
        },
        mounted (){  
            console.log('PostListComponent');
            this.loadUltimoOrden('posts');   
        }
    }
</script>
<style lang="scss">    
    @import url('https://fonts.googleapis.com/css2?family=Big+Shoulders+Inline+Display&display=swap');

/* Color Theme Swatches in Hex */
    $gris-oscuro: #A1A5A3;
    $gris-claro: #acb1ab;
    $primario: #17a2b8;
    $puente: #17a2b847;
    $complementario: #ffc10757;
    $texto-boton: white;

  
</style>    


