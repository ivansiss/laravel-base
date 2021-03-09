
<template>

    <div class="container mt-5" v-if="permisos.includes('access.menu.sup')"> 
 

        <div class="d-flex justify-content-start">
            <div class="ml-3 mb-5" v-bind:style="{ 
                                    fontSize: ds_admin[2].size,
                                    fontWeight: 700,
                                    fontFamily: ds_admin[2].family,
                                    color: ds_admin[2].color,
                                    borderBottom: ds_admin[2].border,
                                    width: ds_admin[2].width,

                                }"><span v-bind:style="{ color: ds_admin[2].linea }">M</span>enú Superior</div>
   
            <spinner-component :spinner="spinner"></spinner-component>
        </div>

        <div class="card-body px-lg-5 pt-5" :style="{ backgroundColor: ds_admin[12].backgroundColor, color:ds_admin[12].color }">

            <div class="row mb-5">

                <div class="col-md-6">
                    <ul class="list-group">
                        <li 
                                class="list-group-item text-dark d-flex justify-content-between" 
                                :class="{ active: index === activeItem, 'text-white': index === activeItem}" 
                                v-for="(m, index) in menu" :key="m.id" 
                                @click="getMenuHijo(m.id, index)">
                                <p>{{m.btn}}</p>
                                <btns-component :tipo="10" v-on:traeEmit="eliminarDato(m.id)"></btns-component>
                        </li>                        
                    </ul>
                </div>

                <div class="col-md-6">
                    <ul class="list-group" v-if="menu_hijos">
                        <li 
                                class="list-group-item text-dark d-flex justify-content-between" 
                                v-for="(mh, i) in menu_hijos" :key="mh.id"
                                @click="selectHijo(mh.id, i)">
                                <p>{{mh.btn}}</p>
                                <btns-component :tipo="10" v-on:traeEmit="eliminarDato(mh.id)"></btns-component>
                        </li>                        
                    </ul>        
                </div>

            </div>
            
            <!-- Form -->
            <form class="text-left" style="color: #757575;" @submit.prevent="submit">
                
                <div class="d-flex justify-content-between">   
                    <p class="subrayar">{{ estado }} registro - {{ padre }}</p>   
                    <btns-component :tipo="6" v-on:traeEmit="nuevo()"></btns-component>
                </div>

                <p>{{ btn }}</p>
                <div v-if="estado == 'Nuevo'">
                    
                </div>

                <div class="row">
                    <div class="col-md-1">
                        <!-- id -->
                        <div class="md-form">
                            <label for="fid" class="active font-weight-bold text-white">Id</label>
                            <input type="text" id="idid" class="form-control" v-model="id">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- btn -->
                        <div class="md-form">
                            <label for="fbtn" class="active font-weight-bold text-white">Nombre btn</label>
                            <input type="text" id="idbtn" class="form-control" v-model="btn">
                        </div>
                    </div>

                    <div class="col-md-7">
                        <!-- route -->
                        <div>
                            <label class="font-weight-bold text-white">Route</label>
                            <select class="browser-default custom-select w-50 d-flex align-items-center" id="idroute"  v-model="route">
                                <option value="">  </option>
                                <option :value="p" v-for="p in paginas" :key="p" > {{p}} </option>
                            </select>
                        </div>
                    </div>  
                </div>

                 <div class="row mt-3">
                    <div class="col-md-4">
                        <!-- icono -->
                        <div class="md-form">
                            <label for="ficono" class="active font-weight-bold text-white">Icono</label>
                            <input type="text" id="idicono" class="form-control" v-model="icono">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- tipo -->
                        <div>
                            <label class="font-weight-bold text-white">Tipo</label>
                            <select class="browser-default custom-select w-50 d-flex align-items-center" id="idtipo" v-model="tipo">
                                <option value="web"> Web </option>
                                <option value="administracion"> Administración </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- activado -->
                        <div>
                            <label class="font-weight-bold text-white">Activado</label>
                            <select class="browser-default custom-select w-50 d-flex align-items-center" id="idactivado"  v-model="activado">
                                <option value="0"> No </option>
                                <option value="1" > Si </option>
                            </select>
                        </div>
                    </div>
                </div>

            </form>
            <!-- Form -->

            <div class="d-flex justify-content-end mt-5">
            <btns-component :tipo="18" v-on:traeEmit="guardar()"></btns-component>
            </div>

        </div>


    </div>

</template>

<script>
    import { mapMutations, mapState, mapActions } from 'vuex';
    export default {
        data () {
            return { 
                paginas: [],
                estado: 'Nuevo',
                item_select: 0,
                menu:{},
                menu_hijos:{},
                activeItem: null,
                id: '',
                btn: '',
                route: '',
                padre: 0,
                icono: '',
                orden: '',
                activado: 1,
                tipo: 'web'
            }                  
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar', 'pararSpinner']),
            ...mapActions('mdGeneral', ['loadUltimoOrden', 'permisosDeUsuario']),
            
            getMenu: function(){
                
                let url = '/api/menu-sup';
                axios.get(url).then(response => {

                    this.menu = response.data;
                    this.item_select = this.menu[0].id;
                    this.activeItem = 0;
                    this.estado = 'Nuevo';
                });
            },
            getMenuHijo: function(id, index){

                this.estado = 'Editando';
                this.activeItem = index;
                this.item_select = id;
                this.getMenuById(id);
                
                let url = '/api/menu-sup-hijo/'+id;
                axios.get(url).then(response => {

                    this.menu_hijos = response.data;
                });
            },
            getMenuById: function(id){
                
                let url = '/api/menu-sup/'+id;
                axios.get(url).then(response => {

                    this.id = response.data.id;
                    this.btn = response.data.btn;
                    this.route = response.data.route;
                    this.padre = response.data.padre;
                    this.icono = response.data.icono;
                    this.orden = response.data.orden;
                    this.activado = response.data.activado;
                    this.tipo = response.data.tipo;

                    this.item_select = this.id;
                });
            },
            selectHijo(id, i){
                this.estado = 'Editando';
                this.item_select = id;

                this.getMenuById(id);
            },
            nuevo(){

                    if(this.item_select == 1){
                        this.padre = 0;
                    }else{
                        this.padre = this.item_select;
                    }

                    this.estado = 'Nuevo';

                    this.id = '';
                    this.btn = '';
                    this.route = '';
                    this.icono = '';
                    this.orden = '';
                    this.activado = 1;
                    this.tipo = 'web';

                    this.parar();
            },
            guardar(){

                let envio = {
                    btn: this.btn,
                    route: this.route,
                    padre: this.padre,
                    icono: this.icono,
                    orden: this.orden,
                    activado: this.activado,
                    tipo: this.tipo
                }

                if(this.estado == 'Nuevo'){

                    let url = '/api/menu-sup';
                    axios.post(url, envio).then(response => {

                        const answers = JSON.stringify(response.data)
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Menu guardado!!',
                        showConfirmButton: false,
                        timer: 2000
                        });

                        this.parar();
                        this.$router.push(`/administracion/menu-superior`).catch(err => {});

                    }).catch(error => {

                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors || {};
                            }
                    });

                }else{

                    let url = '/api/menu-sup/'+this.id;
                    axios.put(url, envio).then(response => {

                        const answers = JSON.stringify(response.data)
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Menu guardado!!',
                        showConfirmButton: false,
                        timer: 2000
                        });

                        this.parar();
                        this.$router.push(`/administracion/menu-superior`).catch(err => {});

                    }).catch(error => {

                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors || {};
                            }
                    });
                }

            },
            eliminarDato(id){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title:'',
                text: "Si eliminas el botón No podras deshacer el cambio!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then( async (result) => {


                if (result.isConfirmed) {
                    
                    let url = '/api/menu-sup/'+id;
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
                            if(this.$route.fullPath == '/administracion/menu-superior'){
                                    url1 = `/administracion/menu-superior/`;
                            }else{
                                    url1 = `/administracion/menu-superior`;
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
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin', 'spinner']),
            ...mapState('mdGeneral', ['ultimoOrden', 'permisos']),
        },
        created (){

            this.permisosDeUsuario();
            this.loadUltimoOrden('menusup');
         
            this.getMenu();

            setTimeout(() => {
                this.pararSpinner();
            }, 12000);
        },
        mounted (){
            console.log('MenuSupComponent');

            let url = '/api/pagina/filtro';
            axios.post(url).then(response => {     
                console.log(response.data);
                this.paginas = response.data;
            });
        },
    }
</script>
<style lang="scss">  

    .swal2-title{
        font-size: 1.2em;
    }
    .subrayar{
        border-bottom: dotted 1px white !important;
        margin-bottom: 3rem;
    }

</style>    

