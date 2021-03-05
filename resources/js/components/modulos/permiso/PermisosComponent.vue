<template>

<div class="container mt-5">

        <h2 class="altura-linea"></h2>
        <div class="ml-3" v-bind:style="{ 
                                fontSize: ds_admin[2].size,
                                fontWeight: 700,
                                fontFamily: ds_admin[2].family,
                                color: ds_admin[2].color,
                                borderBottom: ds_admin[2].border,
                                width: ds_admin[2].width,

                            }"><span v-bind:style="{ color: ds_admin[2].linea }">P</span>ermisos</div>
       
        <div class="d-flex justify-content-end ml-3 mb-3 mr-3">   
            <btns-component :tipo="3" class="mr-3" v-on:traeEmit="ordenAutomatico"></btns-component>
            <btns-component :tipo="5" class="mr-3" v-on:traeEmit="saveOrden"></btns-component>
            <btns-component :tipo="6" v-on:traeEmit="nuevoDato"></btns-component>
        </div>

        <hr class="mb-5" style="background-color: #343a40;">
         
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch" v-for="perm in items" :key="perm.name">
                <div class="card fondo-card">
                    <div class="card-header border-bottom-0 d-flex justify-content-end">
                    <span class="color-texto">Última modificación: {{ perm.fecha_formateada }}</span>
                    </div>
                    <div class="card-body pt-0 color-texto">
                        <div class="row">
                            <div class="col-12">
                        <h2 class="lead linea-debajo-texto"><b class="color-texto-expecial">{{ perm.orden}}.- {{ perm.name}}</b></h2>
                        <p class="text-md mt-3">Tipo acceso: {{ perm.slug }}</p>
                        <ul class="ml-4 mb-0 fa-ul">
                            <li class="text-md mt-2"><span class="fa-li"><i class="far fa-clock"></i></span> Descripción: {{ perm.description }}</li>
                        </ul>
                        </div>
                    </div>

                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <li class="d-flex justify-content-end mt-4">
                                <btns-component  v-if="perm.orden != 0" :tipo="7" v-on:traeEmit="subir(perm)"></btns-component>
                                <btns-component   v-if="perm.orden != ultimoOrden" :tipo="8" v-on:traeEmit="bajar(perm)"></btns-component>
                            </li>
                            <div class="d-flex justify-content-left">
                                <btns-component :tipo="9" v-on:traeEmit="editarDato(perm)"></btns-component>
                                <btns-component :tipo="10" v-on:traeEmit="eliminarDato(perm)"></btns-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

</template>

<script>
    import { mapMutations, mapState, mapActions  } from 'vuex';
    export default {
        props:['items'],
        data () {
            return { 
                        permisos: null,
                        mensaje: '',
                    };
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar']),
            ...mapActions('mdGeneral', ['loadUltimoOrden']),
            nuevoDato(){

                Swal.mixin({
                input: 'text',
                confirmButtonText: 'Next &rarr;',
                showCancelButton: true,
                progressSteps: ['1', '2', '3', '4']
                    }).queue([
                    {
                        title:'Nombre del permiso',
                        input:'text',
                        inputLabel: 'Nombre',
                        inputPlaceholder: 'Lista Roles, Ver Rol, etc..',
                        inputValidator: (value) => {
                            if (!value) {
                                return 'No puedes dejar el campo vacio!';
                            }
                        }
                    },
                    {
                        title:'Slug',
                        input:'text',
                        inputLabel: 'Slug',
                        inputPlaceholder: 'Ejem: role.create = modelo.metodo controlador',
                        inputValidator: (value) => {
                            if (!value) {
                                return 'No puedes dejar el campo vacio!';
                            }
                        }
                    },  
                    {
                        title:'Describe el permiso',
                        input:'text',
                        inputLabel: 'Descripción',
                        inputPlaceholder: 'Ejem: Un usuario puede crear un rol',
                        inputValidator: (value) => {
                            if (!value) {
                                return 'No puedes dejar el campo vacio!';
                            }
                        }
                    }

                    ]).then( async (result) => {
                    if (result.value) {

                        let slug = result.value[1].toLowerCase();  

                        let datos = {
                            name: result.value[0].replace(/\b\w/g, l => l.toUpperCase()),
                            slug: slug,
                            description: result.value[2],
                            orden: this.ultimoOrden + 1
                        } 
                        
                        let url = '/api/permisos';
                        let msg = "";
                        await axios.post(url, datos).then(response => {

                            if(response.data == 'Datos guardados correctamente!!'){
                                
                                this.actualizaSideBar();
                                
                                this.msg = response.data;

                                let url1 = ``;
                                if(this.$route.fullPath == '/administracion/permisos?page=1'){
                                        url1 = `/administracion/permisos`;
                                }else{
                                        url1 = `/administracion/permisos?page=1`;
                                }

                                this.parar();
                                this.$router.push(url1).catch(err => {});

                            }else{
                                this.parar();
                                this.msg = "Los datos NO han sido guardados!!";
                            }
                            
                        });

                        const answers = JSON.stringify(result.value)
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: this.msg,
                            showConfirmButton: false,
                            timer: 2000
                        })
                        this.parar();
                    }else{
                        this.parar();
                    }
                })
            },
            eliminarDato(r){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-mysuccess',
                    cancelButton: 'btn btn-mydanger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: '',
                text: "Si eliminas el "+ r.name +", No podras deshacer el cambio!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then( async (result) => {


                if (result.isConfirmed) {
                    
                    let url = '/api/permisos/'+r.id;
                    await axios.delete(url).then(response => {

                        this.actualizaSideBar();
                                
                        let url1 = ``;
                        if(this.$route.fullPath == '/administracion/permisos?page=1'){
                                url1 = `/administracion/permisos`;
                        }else{
                                url1 = `/administracion/permisos?page=1`;
                        }

                        this.parar();
                        this.$router.push(url1).catch(err => {});    
                    });

                }  else if (result.dismiss === Swal.DismissReason.cancel) {

                   const answers = JSON.stringify(result.dismiss)
                        Swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: 'Operación cancelada',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    this.parar();
                   }

                this.parar();
                })
            },
            editarDato(r){
                

                 let formulario = 

                        '<div id="swal1-content" class="swal2-html-container" style="display: block;">Nombre</div> ' +
                        '<input id="name" class="swal2-input" placeholder="" type="text" style="display: flex;"> ' +

                        '<div id="swal1-content" class="swal2-html-container" style="display: block;">Slug</div> ' +
                        '<input id="slug" class="swal2-input" placeholder="" type="text" style="display: flex;"> ' +

                        '<div id="swal2-content" class="swal2-html-container" style="display: block;">Descripción</div> ' +
                        '<input id="description" class="swal2-input" placeholder="Ejem: Un usuario puede eliminar un rol" type="text" style="display: flex;"> ';

                        

                    Swal.fire({
                        title: 'Editar Permiso',
                        showCancelButton: true,
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Guardar',
                        html: formulario,
                        focusConfirm: false,
                        preConfirm: async() => {

                            let slug = document.getElementById('slug').value;
                            slug = slug.toLowerCase();  

                            let ultimosdatoseditados = {

                                name: document.getElementById('name').value,
                                slug: slug,
                                description: document.getElementById('description').value,

                            };

                            let url = '/api/permisos/'+r.id;
                            await axios.put(url, ultimosdatoseditados).then(response => {

                                const answers = JSON.stringify(response.data)
                                Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Rol actualizado!!',
                                showConfirmButton: false,
                                timer: 2000
                            })

                                this.actualizaSideBar();
                                
                                let url1 = ``;
                                if(this.$route.fullPath == '/administracion/permisos?page=1'){
                                        url1 = `/administracion/permisos`;
                                }else{
                                        url1 = `/administracion/permisos?page=1`;
                                }

                                this.parar();               
                                this.$router.push(url1).catch(err => {});
                                    
                            });    
                        }
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel) {
                           this.parar();
                        }
                    })

                    document.getElementById('name').value        = r.name;
                    document.getElementById('slug').value        = r.slug;
                    document.getElementById('description').value = r.description;
                    this.parar();
                    
            },
            actualizaSideBar(){
                EventBus.$emit('actualizaSideBarNumeros', true);
            },
            subir(perm){

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
                       
                    if(perm.orden != lista.orden){         
                        detras = lista;
                    }

                    if(perm.orden == lista.orden){    
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
            bajar(perm){
                
                let siguiente = false;
                let contador = 0;
                this.items.forEach(lista => {
                    
                    if(perm.orden != lista.orden && siguiente == false){
                       
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


                    if(perm.orden == lista.orden && pasa == 0){
                  
                        lista.orden = contador + 1;
             
                        siguiente = true;
        
                    } 
                });

                this.items = this.items.sort((a,b) => a.orden - b.orden);
                this.parar();
            },
            saveOrden(){

                let url = '/api/permisos/order';
                axios.post(url, this.items).then(response => {

                    const answers = JSON.stringify(response.data)
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Orden guardado!!',
                    showConfirmButton: false,
                    timer: 2000
                    })

                   let url1 = ``;
                    if(this.$route.fullPath == '/administracion/permisos?page=1'){
                            url1 = `/administracion/permisos`;
                    }else{
                            url1 = `/administracion/permisos?page=1`;
                    }

                    this.parar();
                    this.$router.push(url1).catch(err => {});
                        
                });
            },
            ordenAutomatico(){

                let url = '/api/permisos/ordenar';
                axios.post(url, this.items).then(response => {    

                        const answers = JSON.stringify(response.data)
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Orden generado!!',
                        showConfirmButton: false,
                        timer: 2000
                    })

                    let url1 = ``;
                        if(this.$route.fullPath == '/administracion/permisos?page=1'){
                                url1 = `/administracion/permisos`;
                        }else{
                                url1 = `/administracion/permisos?page=1`;
                        }
                        
                        this.parar();
                        this.$router.push(url1).catch(err => {});
                            
                });
            }
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin']),
            ...mapState('mdGeneral', ['ultimoOrden']),
        },
        created (){
            this.loadUltimoOrden('permisos');
        },
        mounted (){
            console.log('Componente permisos');
        }
    }
</script>
<style lang="scss">    
  
   .fondo-card{
       background-color: #343a40 !important;
   }
   .color-texto{
       color:white;
   }

   .color-texto-expecial{
       color: #789bd6;
   }

    .linea-debajo-texto{
        border-bottom: dotted 1px #778a46;
    }

</style>    