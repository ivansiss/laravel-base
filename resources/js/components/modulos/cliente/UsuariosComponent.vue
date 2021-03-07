
<template>

    <div class="container mt-5" v-if="permisos.includes('access.users')"> 
 

        <div class="d-flex justify-content-start">
            <div class="ml-3 mb-5" v-bind:style="{ 
                                    fontSize: ds_admin[2].size,
                                    fontWeight: 700,
                                    fontFamily: ds_admin[2].family,
                                    color: ds_admin[2].color,
                                    borderBottom: ds_admin[2].border,
                                    width: ds_admin[2].width,

                                }"><span v-bind:style="{ color: ds_admin[2].linea }">C</span>lientes</div>
            <spinner-component :spinner="spinner"></spinner-component>
        </div>
       
        <div class="d-flex justify-content-end ml-3 mb-3 mr-3">    
            
            <btns-component :tipo="3" class="mr-3" v-on:traeEmit="ordenAutomatico"></btns-component>
            <btns-component :tipo="5" class="mr-3" v-on:traeEmit="saveOrden"></btns-component>
            <btns-component :tipo="6" v-on:traeEmit="nuevoDato"></btns-component>

        </div>
        <hr class="mb-5" style="background-color: #343a40;">

         
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 d-flex align-items-stretch" v-for="user in items" :key="user.name">
              <div class="card fondo-card">
                <div class="card-header border-bottom-0 d-flex justify-content-end">
                  <span class="color-texto">Última modificación: {{ user.fecha_formateada }}</span>
                </div>
                <div class="card-body pt-0 color-texto">
                  <div class="row">
                    <div class="col-12">
                      <h2 class="lead linea-debajo-texto"><b class="color-texto-expecial">{{ user.orden }}.- {{ user.name}}</b></h2>
                      <p class="text-md">{{ user.email }}</p>
                      <ul class="ml-4 mb-0 fa-ul">
                        <li class="text-md"><span class="fa-li"><i class="fas fa-user-tag"></i></span> Rol: {{ user.rol[0]['name'] }}</li>
                        <li class="text-md mt-2"><span class="fa-li"><i class="far fa-clock"></i></span> V-Email: {{ user.verif_email }}</li>
                      </ul>
                    </div>
                   
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <li class="d-flex justify-content-end mt-4">
                        <btns-component  v-if="user.orden != 0" :tipo="7" v-on:traeEmit="subir(user)"></btns-component>
                        <btns-component   v-if="user.orden != ultimoOrden" :tipo="8" v-on:traeEmit="bajar(user)"></btns-component>
                    </li>
                     <div class="d-flex justify-content-left">
                        <btns-component class="mr-3" :tipo="9" v-on:traeEmit="editarDato(user)"></btns-component>
                        <btns-component class="mr-3" :tipo="10" v-on:traeEmit="eliminarDato(user)"></btns-component>
                        <btns-component class="mr-3" :tipo="20" v-on:traeEmit="restablecer_pass(user)"></btns-component>

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
                        optionsRoles: null,
                    };
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar', 'iniciarSpinner', 'pararSpinner']),
            ...mapActions('mdGeneral', ['loadUltimoOrden', 'permisosDeUsuario']),
            nuevoDato(){

                    Swal.mixin({
                    input: 'text',
                    confirmButtonText: 'Siguiente &rarr;',
                    showCancelButton: true,
                    progressSteps: ['1', '2', '3']
                    }).queue([
                    {
                        title:'NUEVO CLIENTE',
                        input:'text',
                        inputLabel: 'Nombre',
                        inputPlaceholder: 'Nombre usuario',
                        inputValidator: (value) => {
                            if (!value) {
                                return 'No puedes dejar el campo vacio!';
                            }
                        }
                    },
                    {
                        title:'NUEVO CLIENTE',
                        input:'text',
                        inputLabel:'Email',
                        inputPlaceholder: 'Email',
                        inputValidator: (value) => {

                             if(!value){
                                return 'El email no puede estar vacio!';
                            }

                            if(!this.validarEmail(value)){
                                return 'El email tiene que ser correcto!';
                            }
                        }
                        
                    },  
                    {
                        title: 'NUEVO CLIENTE',
                        inputLabel: 'Rol',
                        inputValue: '3',
                        input:'select',
                        inputOptions: this.optionsRoles,
                        inputValidator: (value) => {
                            if (!value ) {
                                return 'No puedes dejar el campo vacio!';
                            }
                        }
                    }

                    ]).then( async (result) => {

                        if (result.value) {
                        
                            let datos = {
                                name: result.value[0].replace(/\b\w/g, l => l.toUpperCase()),
                                email: result.value[1].toLowerCase(),
                                role_id: result.value[2],
                                password: '12345678',
                                orden: this.ultimoOrden + 1,
                                estado: 1
                            };

                            let url = '/api/usuarios';
                            let msg = "";
                            await axios.post(url, datos).then(response => {
                                
                                if(response.data == 'Datos guardados correctamente!!'){

                                    this.actualizaSideBar();
                                    
                                    this.msg = response.data;

                                    let url1 = ``;
                                    if(this.$route.fullPath == '/administracion/usuarios?page=1'){
                                            url1 = `/administracion/usuarios`;
                                    }else{
                                            url1 = `/administracion/usuarios?page=1`;
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
            eliminarDato(user){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-mysuccess',
                    cancelButton: 'btn btn-mydanger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: '',
                text: "Si eliminas el usuario "+ user.name +", No podras deshacer el cambio!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then( async (result) => {

                if (result.isConfirmed) {

                    let urlUsuario = '/api/usuarios/'+user.id;
                    await axios.delete(urlUsuario).then(response => {

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
                            if(this.$route.fullPath == '/administracion/usuarios?page=1'){
                                    url1 = `/administracion/usuarios`;
                            }else{
                                    url1 = `/administracion/usuarios?page=1`;
                            }

                            this.parar();
                            this.$router.push(url1).catch(err => {});
                    });

                   
                } else if (result.dismiss === Swal.DismissReason.cancel) {

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
                })
            },
            editarDato(user){
                
                let formulario = 

                        '<hr class="color-letra">' +
                        '<div id="swal1-content" class="swal2-html-container" style="display: block;"><b>Nombre</b></div> ' +
                        '<input id="name" class="swal2-input" placeholder="" type="text" style="display: flex;"> ' +
                        
                        '<div id="swal2-content" class="swal2-html-container" style="display: block;"><b>E-mail</b></div> ' +
                        '<input id="email" class="swal2-input" placeholder="email" type="text" style="display: flex;"> ';


                    if(this.permisos.includes('access.super')){

                    formulario += 

                        '<div id="swal5-content" class="swal2-html-container" style="display: block;"><b>Rol</b></div> ' +
                        '<select id="roless" class="swal2-select">';

                        this.roles.forEach((rol) => {
                        
                            if(user.roles[0]['id'] == rol.id){
                                formulario += '<option value="'+rol.id+'" selected>'+ rol.name +'</option>';
                            }else{
                            if(rol.name != 'Super'){
                                formulario += '<option value="'+rol.id+'">'+ rol.name +'</option>';
                            }    
                            }
                        });
                     }
                    

                    formulario += '</select>';

                    let estado = '';
                    if(user.estado == 1){
                        estado = 'checked';
                    }else{
                        estado = '';

                    }
                    formulario += '<div class="form-check">' +
                                  '<input class="form-check-input" type="checkbox"' + estado + ' id="estado">' +
                                  '<label class="form-check-label">Usuario Activo</label>' +
                                  '</div>';

                    Swal.fire({
                        title: 'EDITAR CLIENTE',
                        showCancelButton: true,
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Guardar',
                        html: formulario,
                        focusConfirm: false,
                        preConfirm: async() => {

                            let ultimosdatoseditados = {

                                name: document.getElementById('name').value,
                                email: document.getElementById('email').value,
                                role_id: document.getElementById('roless').value,
                                estado: document.getElementById('estado').checked
                            };

                            let urlUsuario = '/api/usuarios/'+user.id;
                            await axios.put(urlUsuario, ultimosdatoseditados).then(response => {

                                this.getRefrescarUsuarioAutenticado();
                                this.actualizaSideBar();
                                
                                let url1 = ``;
                                if(this.$route.fullPath == '/administracion/usuarios?page=1'){
                                        url1 = `/administracion/usuarios`;
                                }else{
                                        url1 = `/administracion/usuarios?page=1`;
                                }

                                this.parar();
                                this.$router.push(url1).catch(err => {});
                                    
                            });
                            
                            this.parar();
                            this.$router.push('/administracion/usuarios').catch(err => {  
                            })
    
                        }
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel) {
                           this.parar();
                        }
                    })
                   
                    document.getElementById('name').value  = user.name;
                    document.getElementById('email').value = user.email;
   
            },
            validarEmail: function(email){
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            getRefrescarUsuarioAutenticado(){

                let url = '/authenticate/getRefrescarUsuarioAutenticado'
                axios.get(url).then(response => {
                    
                    EventBus.$emit('verifyAuthenticatedUser', response.data);

                    const answers = JSON.stringify(response.data)
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Usuario refrescado!!',
                            showConfirmButton: false,
                            timer: 2000
                        })
                 });
            },
            actualizaSideBar(){
                EventBus.$emit('actualizaSideBarNumeros', true);
            },
            subir(user){

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
                       
                    if(user.orden != lista.orden){         
                        detras = lista;
                    }

                    if(user.orden == lista.orden){    
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
            bajar(user){
                
                let siguiente = false;
                let contador = 0;
                this.items.forEach(lista => {
                    
                    if(user.orden != lista.orden && siguiente == false){
                       
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


                    if(user.orden == lista.orden && pasa == 0){
                  
                        lista.orden = contador + 1;
             
                        siguiente = true;
        
                    } 
                });

                this.items = this.items.sort((a,b) => a.orden - b.orden);
                this.parar();
            },
            saveOrden(){

                let url = '/api/usuarios/order';
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
                    if(this.$route.fullPath == '/administracion/usuarios?page=1'){
                            url1 = `/administracion/usuarios`;
                    }else{
                            url1 = `/administracion/usuarios?page=1`;
                    }

                    this.parar();
                    this.$router.push(url1).catch(err => {});
                        
                });
            },
            ordenAutomatico(){

                let url = '/api/usuarios/ordenar';
                axios.post(url, this.items).then(response => {    

                        const answers = JSON.stringify(response.data)
                        Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Orden generado!!',
                        showConfirmButton: false,
                        timer: 2000
                    })

                    let url1 = ``;
                        if(this.$route.fullPath == '/administracion/usuarios?page=1'){
                                url1 = `/administracion/usuarios`;
                        }else{
                                url1 = `/administracion/usuarios?page=1`;
                        }

                        this.parar();
                        this.$router.push(url1).catch(err => {});
                            
                });
            },
            restablecer_pass(user){

                let data = {
                    email: user.email
                }

                console.log('data');
                console.log(data);

                let url = '/password/email';
                axios.post(url, data).then(response => {    

                        const answers = JSON.stringify(response.data)
                        Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Email enviado!!',
                        showConfirmButton: false,
                        timer: 2000
                    })

                    let url1 = ``;
                        if(this.$route.fullPath == '/administracion/usuarios?page=1'){
                                url1 = `/administracion/usuarios`;
                        }else{
                                url1 = `/administracion/usuarios?page=1`;
                        }

                        this.parar();
                        //this.$router.push(url1).catch(err => {});
                            
                });
            }
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin', 'spinner']),
            ...mapState('mdGeneral', ['ultimoOrden', 'userAuth', 'permisos']),
        },
        created (){

            let opciones = "";
            let urlRoles = '/api/role';
            
            axios.get(urlRoles).then(responseRoles => {

                this.roles = responseRoles.data.data;

                let options = {};
                $.map(this.roles,
                    function(o) {
                        if(o.name != 'Super'){
                            options[o.id] = o.name;  
                        }
                                 
                });

                this.optionsRoles = options;
                
            });
            this.loadUltimoOrden('usuarios');
            this.permisosDeUsuario();

            setTimeout(() => {
                this.pararSpinner();
            }, 2000);
        },
        mounted (){
            console.log('Componente UsuariosComponent'); 
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