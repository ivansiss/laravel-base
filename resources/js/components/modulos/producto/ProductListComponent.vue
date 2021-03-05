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

                                    }"><span v-bind:style="{ color: ds_admin[2].linea }">P</span>roductos</div>
                <spinner-component :spinner="spinner"></spinner-component>
            </div>
            <div class="d-flex justify-content-end ml-3 mb-3 mr-3">    
                <btns-component :tipo="3" v-on:traeEmit="ordenAutomatico"></btns-component>
                <btns-component :tipo="5" v-on:traeEmit="saveOrden"></btns-component>
                <router-link class="btn btn-lg" :style="{ border: ds_admin[6].border }" :to="{name: 'access.new.products', params: {ultimoOrden:ultimoOrden}}">
                    <i :class="ds_admin[6].icono" :style="{color: ds_admin[6].color}"></i>
                </router-link>
            </div>

            <ul class="list-unstyled" v-if="items">
                <li class="media shadow-lg mb-5" v-for="item in items" :key="item.titulo">
                    <product-list-item-component :ultimoOrden="ultimoOrden" :item="item" v-on:editarEmit="editar(item)" v-on:eliminarEmit="eliminar(item)" v-on:SubirEmit="subir"  v-on:BajarEmit="bajar"></product-list-item-component>
                </li>
            </ul>
  
    </div>
    
</template>

<script>
    import { mapMutations, mapState, mapActions } from 'vuex';
    export default {
        props: [ 'items'],
        data () {
            return { 
                        productos: null,
                        categorias: null,                                 
                    };
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar', 'iniciarSpinner', 'pararSpinner']),
            ...mapActions('mdGeneral', ['loadUltimoOrden']),
            getDatos(){
                let url = '/api/productos';
                axios.get(url).then(response => {

                    console.log('productListComponen getDatos() resp');
                    console.log(response.data);
                    this.productos = response.data;
                    
                });
            },
            eliminar(prod){

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
                
                    let url = '/api/productos/'+prod.id;
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
                            if(this.$route.fullPath == '/administracion/productos?page=1'){
                                    url1 = `/administracion/productos`;
                            }else{
                                    url1 = `/administracion/productos?page=1`;
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
                let url = '/api/productos/order';
                axios.post(url, this.items).then(response => {

                    const answers = JSON.stringify(response.data)
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Orden del producto guardado!!',
                    showConfirmButton: false,
                    timer: 2000
                })

                    let url1 = ``;
                    if(this.$route.fullPath == '/administracion/productos?page=1'){
                            url1 = `/administracion/productos`;
                    }else{
                            url1 = `/administracion/productos?page=1`;
                    }

                    this.parar()
                    this.$router.push(url1).catch(err => {});
                        
                });
            },
            subir(prod){

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
                       
                    if(prod.orden != lista.orden){         
                        detras = lista;
                    }

                    if(prod.orden == lista.orden){    
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
            bajar(prod){
                
                let siguiente = false;
                let contador = 0;
                this.items.forEach(lista => {
                    
                    if(prod.orden != lista.orden && siguiente == false){
                       
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


                    if(prod.orden == lista.orden && pasa == 0){
                  
                        lista.orden = contador + 1;
             
                        siguiente = true;
        
                    } 
                });

                this.items = this.items.sort((a,b) => a.orden - b.orden);
                this.parar();
            },
            ordenAutomatico(){

                let url = '/api/productos/order-auto';
                let resp = [];
                axios.post(url).then(response => {    

                    resp = response.data;

                    const answers = JSON.stringify(response.data)
                        Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Orden guardado!!',
                        showConfirmButton: false,
                        timer: 2000
                    })

                    let url1 = ``;
                    if(this.$route.fullPath == '/administracion/productos?page=1'){
                            url1 = `/administracion/productos`;
                    }else{
                            url1 = `/administracion/productos?page=1`;
                    }

                    this.parar();
                    this.$router.push(url1).catch(err => {});
                            
  
                });
            }
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin', 'spinner']),
            ...mapState('mdGeneral', ['ultimoOrden']),
        },
        created (){
            console.log('items');
            this.loadUltimoOrden('imagenes');

            setTimeout(() => {
                this.pararSpinner();
            }, 4000);
        },
        mounted (){
            console.log('ProductListComponent');
     
        }
    }
</script>
<style lang="scss">    
  
</style>    


