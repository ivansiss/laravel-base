<template>
    <div>
        <Navbar :ruta="ruta"></Navbar>
        
        <Sidebar :ruta="ruta" :usuario="authUser" :listPermisos="listRolPermisosByUsuario" :numeros="nDatos"></Sidebar>
        
        <div class="content-wrapper">
            <transition name="slide-fade" mode="out-in">
                <router-view></router-view>
            </transition>
        </div>

        <Footer :ruta="ruta"></Footer>
        
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
</template>

<script>

    import Navbar from './plantilla/Navbar'
    import Sidebar from './plantilla/Sidebar'
    import Content from './plantilla/Content'
    import Footer from './plantilla/Footer'

    export default {
        props: ['ruta', 'usuario'],
        components: {Navbar, Sidebar, Content, Footer},
        data () {
            return { 
                        authUser: this.usuario,
                        listRolPermisosByUsuario: [],
                        datos: '',
                        nDatos:{
                            clientes: 0,
                            roles: 0,
                            permisos: 0,
                            imagenes: 0,
                            post: 0,
                            productos: 0,
                        },
                   };
        },
        methods:{
           actualizarNumerosSideBar(){
                
                let url = '/api/cuantos';
                axios.post(url).then(response => {

                     sessionStorage.setItem('nClientes', JSON.stringify(response.data));
                     this.nDatos = response.data;
                        
                });
           },
           logout(){
                console.log('logout');
                let url = '/administracion/authenticate/logout';
                axios.post(url).then(response => {
                    
                    if(response.data.code == 204){
                        console.log('cierre session');
                        sessionStorage.removeItem('UserAutenticado');
                        this.$router.push({name: 'start.login'});
                        location.reload();
                    }                  
                });
            }
        },
        created (){

         
        },
        mounted (){
            console.log('componente App.vue');
            EventBus.$on('verifyAuthenticatedUser', data => {
                console.log('Evento ejecutado desde el componente App.vue');
                this.authUser = data;
            });

            EventBus.$on('actualizaPermisosUsuario', data => {
                console.log('Evento ejecutado desde el componente App.vue 2');
                this.listRolPermisosByUsuario = data;
            });

            EventBus.$on('actualizaSideBarNumeros', data => {
                this.actualizarNumerosSideBar();
            });

            this.actualizarNumerosSideBar();
            this.listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));

            this.$nextTick(()=>{
           
                    if(this.authUser.estado = 1){

                        if(this.listRolPermisosByUsuario.includes('access.users')){

                        }else{
                                this.logout();
                        }
                        
                    }else{
                            this.logout();
                    }
            });
        }
    }
</script>
<style lang="scss">    
    @import url('https://fonts.googleapis.com/css2?family=Big+Shoulders+Inline+Display&display=swap'); 

</style>    