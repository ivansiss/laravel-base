<template>
    <div class="container mt-5">

        <div class="d-flex justify-content-start">
            <div class="ml-3 mb-5" v-bind:style="{ 
                                    fontSize: ds_admin[2].size,
                                    fontWeight: 700,
                                    fontFamily: ds_admin[2].family,
                                    color: ds_admin[2].color,
                                    borderBottom: ds_admin[2].border,
                                    width: ds_admin[2].width,

                                }"><span v-bind:style="{ color: ds_admin[2].linea }">P</span>áginas web</div>
            <spinner-component :spinner="spinner"></spinner-component>
        </div>


        <div class="d-flex justify-content-end ml-3 mb-3 mr-3">    

            <btns-component :tipo="5" v-on:traeEmit="saveOrden"></btns-component>
            <router-link 
                            class="btn btn-lg ml-3" 
                           :style="{ border: ds_admin[6].border }" 
                              :to="{name: 'access.new.pagina', params: {ultimoOrden:ultimoOrden}}"
                            v-if="permisos.includes('access.super')">

                            <i :class="ds_admin[6].icono" :style="{color: ds_admin[6].color}"></i>
            </router-link>
        </div>

            <ul class="list-unstyled">
                <li class="media shadow-lg mb-5" v-for="pag in items" :key="pag.id">

                    <tipo-pag-component :permisos="permisos" :pag="pag" :ultimoOrden="ultimoOrden" v-if="pag.category_id == 1" v-on:pagSubirEmit="pagSubir"  v-on:eliminarDatoEmit="eliminarDato(pag)" v-on:pagBajarEmit="pagBajar"></tipo-pag-component>
                    <tipo-pag-una-component :permisos="permisos" :pag="pag" :ultimoOrden="ultimoOrden" v-if="pag.category_id == 3" v-on:pagSubirEmit="pagSubir"  v-on:eliminarDatoEmit="eliminarDato(pag)" v-on:pagBajarEmit="pagBajar"></tipo-pag-una-component>
                    <tipo-pag-tres-component :permisos="permisos" :pag="pag" :ultimoOrden="ultimoOrden" v-if="pag.category_id == 5" v-on:pagSubirEmit="pagSubir"  v-on:eliminarDatoEmit="eliminarDato(pag)" v-on:pagBajarEmit="pagBajar"></tipo-pag-tres-component>
                    <tipo-pag-slider-component :permisos="permisos" :pag="pag" :ultimoOrden="ultimoOrden" v-if="pag.category_id == 2" v-on:pagSubirEmit="pagSubir"  v-on:eliminarDatoEmit="eliminarDato(pag)" v-on:pagBajarEmit="pagBajar"></tipo-pag-slider-component>
                    <tipo-pag-grid-component :permisos="permisos" :pag="pag" :ultimoOrden="ultimoOrden" v-if="pag.category_id == 4" v-on:pagSubirEmit="pagSubir"  v-on:eliminarDatoEmit="eliminarDato(pag)" v-on:pagBajarEmit="pagBajar"></tipo-pag-grid-component>

                </li>
            </ul>
  
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
            ...mapActions('mdGeneral', ['loadUltimoOrden', 'permisosDeUsuario']),
            closeModalPost: function() {
                this.postSelected = "";
            },
            getDatos(){
                let url = '/api/paginas';
                axios.get(url).then(response => {                 
                    this.paginas = response.data.data;
                });
            },
            eliminarDato(pag){
 
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title:'',
                text: "Si eliminas la página No podras deshacer el cambio!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then( async (result) => {


                if (result.isConfirmed) {
                    
                    let url = '/api/paginas/' + pag.id;
                    console.log('id');
                    console.log(url);
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
                            if(this.$route.fullPath == '/administracion/paginas?page=1'){
                                    url1 = `/administracion/paginas`;
                            }else{
                                    url1 = `/administracion/paginas?page=1`;
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
                let url = '/api/pagina/order';
                axios.post(url, this.items).then(response => {

                    const answers = JSON.stringify(response.data)
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Página actualizada!!',
                    showConfirmButton: false,
                    timer: 2000
                })

                    let url1 = ``;
                    if(this.$route.fullPath == '/administracion/paginas?page=1'){
                            url1 = `/administracion/paginas`;
                    }else{
                            url1 = `/administracion/paginas?page=1`;
                    }

                    this.parar()
                    this.$router.push(url1).catch(err => {});
                        
                });
            },
            pagSubir(pag){

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
                       
                    if(pag.orden != lista.orden){         
                        detras = lista;
                    }

                    if(pag.orden == lista.orden){    
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
            pagBajar(pag){
                
                let siguiente = false;
                let contador = 0;
                this.items.forEach(lista => {
                    
                    if(pag.orden != lista.orden && siguiente == false){
                       
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


                    if(pag.orden == lista.orden && pasa == 0){
                  
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
            ...mapState('mdGeneral', ['ultimoOrden', 'permisos']),
        },
        created (){

            let opciones = "";
            let urlCat = '/api/categorias/';
            
            axios.get(urlCat).then(responseCat => {

                this.categorias = responseCat.data.data;
                   
            });

            this.permisosDeUsuario();

            setTimeout(() => {
                this.pararSpinner();
            }, 2000);
            
        },
        mounted (){  
            console.log('PaginasListComponent');
            this.loadUltimoOrden('paginas');   
            
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


