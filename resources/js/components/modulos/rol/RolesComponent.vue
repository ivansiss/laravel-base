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

                            }"><span v-bind:style="{ color: ds_admin[2].linea }">R</span>oles</div>
       
        <div class="d-flex justify-content-end ml-3 mb-3 mr-3">    
            <btns-component :tipo="6" v-on:traeEmit="nuevoDato"></btns-component>
        </div>
        <hr class="mb-5" style="background-color: #343a40;">

            <div class="row">
                <div class="col-12 col-sm-12 col-md-6 d-flex align-items-stretch" v-for="card_rol in items" :key="card_rol.name">
                    <div class="card fondo-card">
                        <div class="card-header border-bottom-0 d-flex justify-content-end">
                            <span class="color-texto">Última modificación: {{ card_rol.fecha_formateada }}</span>
                        </div>
                        <div class="card-body pt-0 color-texto">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="lead linea-debajo-texto"><b class="color-texto-expecial">{{ card_rol.orden }}.- {{ card_rol.name}}</b></h2>
                                    <p class="text-md">Rol: {{ card_rol.slug }}</p>
                                    <ul class="ml-4 mb-0 fa-ul">
                                        <li class="text-md"><span class="fa-li"><i class="fas fa-user-tag"></i></span> Descripción: {{ card_rol.description }}</li>
                                        <li class="text-md mt-2"><span class="fa-li"><i class="far fa-clock"></i></span>Acceso total: {{ card_rol.full_access }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <div class="d-flex justify-content-center">
                                    <btns-component :tipo="9" v-on:traeEmit="editarDato(card_rol)"></btns-component>
                                    <btns-component :tipo="10" v-on:traeEmit="eliminarDato(card_rol)"></btns-component>
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
                        roles: null,
                        permisos: null,
                        mensaje: '',
                        idCheckbox: [],
                        listRolPermisosByUsuario: [],
                        authUser: {},
                    };
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar']),
            ...mapActions('mdGeneral', ['loadUltimoOrden']),
            nuevoDato(){

                let check ='';
                this.permisos.forEach((permiso) => {

                       this.idCheckbox.push(permiso.id);
                       check += 
                            '<div class="form-check">'+
                                '<input type="checkbox" class="form-check-input" id="materialUnchecked'+ permiso.id +'" value="'+ permiso.id +'">'+
                                '<label class="form-check-label" for="materialUnchecked'+ permiso.id +'">'+ permiso.description +'</label>'+
                            '</div>';
                });

                    Swal.mixin({
                    input: 'text',
                    confirmButtonText: 'Next &rarr;',
                    showCancelButton: true,
                    progressSteps: ['1', '2', '3', '4']
                    }).queue([
                    {
                        title:'Nombre del rol',
                        input:'text',
                        inputLabel: 'Nombre',
                        inputPlaceholder: 'Super, Admin, User, etc..',
                        inputValidator: (value) => {
                            if (!value) {
                                return 'No puedes dejar el campo vacio!';
                            }
                        }
                    },
                    {
                        title:'Describe el rol',
                        input:'text',
                        inputLabel: 'Descripción',
                        inputPlaceholder: 'Es el administrador de la web, etc',
                        inputValidator: (value) => {
                            if (!value) {
                                return 'No puedes dejar el campo vacio!';
                            }
                        }
                    },  
                    {
                        title: 'Tendra acceso total?',
                        inputLabel: 'Acceso total',
                        input:'select',
                        inputOptions: {
                            yes: 'yes',
                            no: 'no'
                        },
                        inputValidator: (value) => {
                            if (!value) {
                                return 'No puedes dejar el campo vacio!';
                            }
                        }
                    },
                    {
                        title: 'Seleciona permisos para el rol',
                        html: check,
                        focusConfirm: false,
                        preConfirm: () => {
                            
                            let isCheck = false;
                            let isValue = [];
                            this.idCheckbox.forEach((id) => {
                                isCheck = document.getElementById('materialUnchecked' + id).checked;
                
                                if(isCheck == true){
                                    isValue.push(document.getElementById('materialUnchecked' + id).value);
                                }
                            });

                            return isValue;

                        }
                    }

                    ]).then( async (result) => {
                    if (result.value) {
               
                        let slug = result.value[0].replace(/[^A-Z0-9]+/ig, "-");
                            slug = slug.toLowerCase();  

                        let datos = {
                            name: result.value[0].replace(/\b\w/g, l => l.toUpperCase()),
                            slug: slug,
                            description: result.value[1],
                            full_access: result.value[2],
                            orden: this.ultimoOrden + 1,
                            permisos: result.value[3],
                        } 
                        
                        let url = '/api/role';
                        let msg = "";
                        await axios.post(url, datos).then(response => {

                            console.log(response.data);

                            if(response.data == 'Datos guardados correctamente!!'){
                                
                                this.actualizaSideBar();
                                
                                this.msg = response.data;

                                let url1 = ``;
                                if(this.$route.fullPath == '/administracion/roles?page=1'){
                                        url1 = `/administracion/roles`;
                                }else{
                                        url1 = `/administracion/roles?page=1`;
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
                        });
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
                text: "Si eliminas el usuario "+ r.name +", No podras deshacer el cambio!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then( async (result) => {


                if (result.isConfirmed) {
                    
                    let url = '/api/role/'+r.id;
                    await axios.delete(url).then(response => {

                        console.log(response.data);
                        const answers = JSON.stringify(response.data)
                            Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: answers,
                            showConfirmButton: false,
                            timer: 2000
                        });

                        this.actualizaSideBar();
                        
                        let url1 = ``;
                        if(this.$route.fullPath == '/administracion/roles?page=1'){
                                url1 = `/administracion/roles`;
                        }else{
                                url1 = `/administracion/roles?page=1`;
                        }

                        this.parar();
                        this.$router.push(url1).catch(err => {});
                    });

                } 
                else if (result.dismiss === Swal.DismissReason.cancel) {
                   
                   const answers = JSON.stringify(result.dismiss)
                        Swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: 'Operación cancelada',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    this.parar();
                }})
            },
            editarDato(card_rol){

                let formulario = 
                        '<hr class="bg-primary">' +
                        '<div id="swal1-content" class="swal2-html-container" style="display: block;"><b>Nombre</b></div> ' +
                        '<input id="name" class="swal2-input" placeholder="" type="text" style="display: flex;"> ' +

                        '<div id="swal2-content" class="swal2-html-container" style="display: block;"><b>Descripción</b></div> ' +
                        '<input id="description" class="swal2-input" placeholder="nombre imagen" type="text" style="display: flex;"> ' +

                        '<div id="swal5-content" class="swal2-html-container" style="display: block;"><b>Total acceso?</b></div> ' +
                        '<select id="full_access" class="swal2-select"><option value="yes">Si</option><option value="no">No</option></select> ';
                
                //Aqui tengo todos los ids de los permisos que tiene este Card_rol
                let permisosCardRol = [];
                for (let index = 0; index < card_rol.permisos.length; index++) {
                     permisosCardRol.push(card_rol.permisos[index]['id']);
                }

                if(permisosCardRol){

                    this.permisos.forEach((permiso) => {

                        //guardo todos los id="materialUnchecked'+ permiso.id
                        this.idCheckbox.push(permiso.id);
                        let ischeck = false;

                        //
                        for (let index = 0; index < permisosCardRol.length; index++) {
                            if(permisosCardRol[index] == permiso.id){
                                formulario += 
                                    '<div class="form-check">'+
                                        '<input type="checkbox" checked class="form-check-input" id="materialUnchecked'+ permiso.id +'" value="'+ permiso.id +'">'+
                                        '<label class="form-check-label" for="materialUnchecked'+ permiso.id +'">'+ permiso.description +'</label>'+
                                    '</div>';
                                ischeck = true;
                            }
                        }

                        if(ischeck == false){
                            formulario += 
                                '<div class="form-check">'+
                                    '<input type="checkbox" class="form-check-input" id="materialUnchecked'+ permiso.id +'" value="'+ permiso.id +'">'+
                                    '<label class="form-check-label" for="materialUnchecked'+ permiso.id +'">'+ permiso.description +'</label>'+
                                '</div>';
                        }
                        
                    }); 
                }

                    Swal.fire({
                        title: 'EDITAR ROLE',
                        showCancelButton: true,
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Guardar',
                        html: formulario,
                        focusConfirm: false,
                        preConfirm: async() => {

                            let isCheck = false;
                            let isValue = [];
                            this.idCheckbox.forEach((id) => {
                                isCheck = document.getElementById('materialUnchecked' + id).checked;
                
                                if(isCheck == true){
                                    isValue.push(document.getElementById('materialUnchecked' + id).value);
                                }
                            });

                            console.log(isValue);

                            let slug = document.getElementById('name').value.replace(/[^A-Z0-9]+/ig, "-");
                            slug = slug.toLowerCase();  

                            let ultimosdatoseditados = {

                                name:       document.getElementById('name').value,
                                slug:       slug,
                                description:   document.getElementById('description').value,
                                full_access:     document.getElementById('full_access').value,
                                permisos: isValue,
                            };

                            let url = '/api/role/'+card_rol.id;
                            await axios.put(url, ultimosdatoseditados).then(response => {

                                const answers = JSON.stringify(response.data)
                                Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Rol actualizado!!',
                                showConfirmButton: false,
                                timer: 2000
                            })

                                let url1 = ``;
                                if(this.$route.fullPath == '/administracion/roles?page=1'){
                                        url1 = `/administracion/roles`;
                                }else{
                                        url1 = `/administracion/roles?page=1`;
                                }

                                this.parar();
                                this.$router.push(url1).catch(err => {});
                                    
                            });
                            this.parar();
                            this.$router.push('/administracion/roles').catch(err => {}); 
                            this.actualizarPermisosByUsuario();
                        }
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel) {
                           this.parar();
                        }
                    })

                    document.getElementById('name').value        = card_rol.name;
                    document.getElementById('description').value = card_rol.description;
                    document.getElementById('full_access').value = card_rol.full_access;
            }, 
            getRefrescarUsuarioAutenticado(){

                let url = '/authenticate/getRefrescarUsuarioAutenticado';
                axios.get(url).then(response => {
                    this.authUser = response.data;
                    EventBus.$emit('verifyAuthenticatedUser', response.data);
                });
            },
            actualizarPermisosByUsuario(){

                 let enviar = {
                    'id': this.authUser.id
                }

                console.log('auth: ');
                console.log(this.authUser);

                let url = '/api/usuarios/getListarPermisosByUsuario';
                axios.post(url, enviar).then(response => {

                    this.listRolPermisosByUsuario = JSON.stringify(response.data);
                    EventBus.$emit('actualizaPermisosUsuario', this.listRolPermisosByUsuario);
                    sessionStorage.setItem('listRolPermisosByUsuario', this.listRolPermisosByUsuario);

                });
            },
            getTodosPermisos(){

                let url = '/api/permisos';
                axios.get(url).then(response => {

                    console.log('permisos');
                    console.log(response.data.data);
                    this.permisos = response.data.data;
                    
                });
            },
            actualizaSideBar(){
                EventBus.$emit('actualizaSideBarNumeros', true);
            },
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin']),
            ...mapState('mdGeneral', ['ultimoOrden']),
        },
        created (){

            //this.actualizarPermisosByUsuario();
            this.getTodosPermisos();
            this.getRefrescarUsuarioAutenticado();
        },
        mounted (){
            console.log('Componente roles');
            this.loadUltimoOrden('roles');

            this.listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
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