
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

                                }"><span v-bind:style="{ color: ds_admin[2].linea }">S</span>eo</div>
            <spinner-component :spinner="spinner"></spinner-component>
        </div>
       
        <div class="d-flex justify-content-end ml-3 mb-3 mr-3">    

            <router-link class="btn btn-lg myboton" :to="{name: 'access.new.seo'}">
                <i :class="ds_admin[6].icono" class="myicono fa-2x"></i>
            </router-link>

        </div>
        <hr class="mb-5" style="background-color: #343a40;"> 

        <ul class="list-group fondo-card" v-if="items">
            <li class="list-group-item d-flex justify-content-between align-items-center fondo-card" v-for="value in items" :key="value.id">
                <div class="text-white">
                    {{ value.id }} - Página: {{ value.pagina }}
                </div> 
                <div>
                    <router-link class="btn btn-lg myboton mr-3" :to="{name: 'access.edit.seo', params: { id: value.id }}">
                        <i :class="ds_admin[9].icono" class="myicono fa-2x"></i>
                    </router-link>
                    <btns-component :tipo="10" class="mr-3" v-on:traeEmit="eliminarDato(value)"></btns-component>
                </div>
            </li>
        </ul>

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
            
            eliminarDato(seo){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-mysuccess',
                    cancelButton: 'btn btn-mydanger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: '',
                text: "Si eliminas el seo de la página "+ seo.pagina +", No podras deshacer el cambio!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
                }).then( async (result) => {

                if (result.isConfirmed) {

                    let urlSeo = '/api/seo/'+seo.id;
                    await axios.delete(urlSeo).then(response => {

                            const answers = JSON.stringify(response.data)
                                Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: answers,
                                showConfirmButton: false,
                                timer: 2000
                            });

                            let url1 = ``;
                            if(this.$route.fullPath == '/administracion/seo?page=1'){
                                    url1 = `/administracion/seo`;
                            }else{
                                    url1 = `/administracion/seo?page=1`;
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
        },
        computed: {
            ...mapState('dsAdmin', ['ds_admin', 'spinner']),
            ...mapState('mdGeneral', ['ultimoOrden', 'userAuth', 'permisos']),
        },
        created (){
            
            this.loadUltimoOrden('seo');

            setTimeout(() => {
                this.pararSpinner();
            }, 2000);
        },
        mounted (){
            console.log('Componente SeoComponent'); 
        }

    }
</script>
<style lang="scss">    
  
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