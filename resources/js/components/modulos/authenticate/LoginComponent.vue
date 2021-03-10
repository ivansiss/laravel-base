
<template>

    <div>
        
        <!-- .login -->
        <div class="card login">
            <div class="card-body">

                <p class="login-box-msg"><b class="subrayar">Iniciar sesión</b></p>

                <form method="post">

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" v-model="fillLogin.cEmail">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Clave" v-model="fillLogin.cContrasena">
                        
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-7">
                    </div>
                    <!-- /.col -->
                    <div class="col-5 text-right">
                        <btns-component class="mybtn_login" :tipo="0" v-on:traeEmit="login"></btns-component>
                    </div>
                    <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

</template>

<script>
    import { mapMutations, mapState } from 'vuex';
    export default {
        data () {
            return { 
                    fillLogin: {
                                    cEmail: '',
                                    cContrasena: '',                           
                    },

                    listRolPermisosByUsuario: [],
                   };
        },
        methods:{
            ...mapMutations('dsAdmin', ['parar']),
            login(){

                if(this.validarLogin()){
                    this.parar();
                    return;
                }

                let datos = {

                            cEmail     : this.fillLogin.cEmail,
                           cContrasena : this.fillLogin.cContrasena
                };

                let url = '/administracion/authenticate/login';
                axios.post(url, datos).then(response => {

                    if(response.data.code == 401){
            
                        this.loginFailed();
                    }

                    if(response.data.code == 200){
                        
                        this.getListarRolPermisosByUsuario(response.data.authUser);

                    }
                });
            },
            getListarRolPermisosByUsuario(UserAutenticado){

                let enviar = {
                    'id': UserAutenticado.id
                }

                let url = '/api/usuarios/getListarPermisosByUsuario';
                axios.post(url, enviar).then(response => {

                    this.listRolPermisosByUsuario = JSON.stringify(response.data);

                    sessionStorage.setItem('listRolPermisosByUsuario', JSON.stringify(response.data));
                    sessionStorage.setItem('UserAutenticado', JSON.stringify(UserAutenticado));

                    this.loginSuccess();
                });
            },
            validarLogin(){

                let error = 0;
                let mensajeError = [];

                if(this.validarEmail(this.fillLogin.cEmail) == false){
                    mensajeError.push('No es un correo electrónico valido!! ');
                }
                if(!this.fillLogin.cContrasena){
                    mensajeError.push('La constraseña es un campo obligatorio!! ');
                }
                if(!this.fillLogin.cEmail){
                    mensajeError.push('El correo electronico es un campo obligatorio!! ');
                }

                if(mensajeError.length){
                   error = 1;
                }

                if(error == 1){

                    mensajeError.forEach(item => {
    
                        Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: item,
                        showConfirmButton: false,
                        timer: 5000
                        })
                    })

                    return true;
                }else{
                    return false;
                }

            },
            loginFailed(){
                
                let error = 0;
                let mensajeError = [];

                mensajeError.push(' Estas credenciales no coinciden con nuestros registros ');
            
                if(mensajeError.length){
                   error = 1;
                }

                this.fillLogin.cContrasena = "";

                Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: mensajeError,
                showConfirmButton: false,
                timer: 5000
                })

                this.parar();
                return error;
            },
            loginSuccess(){
                
                this.parar();
                this.$router.push({name:'access.users'});
                location.reload();
            },
            errorLogin(msgError){

                    const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })

            },
            validarEmail: function(email){
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            }
        },
        computed: {
            ...mapState('dsAdmin', ['cargando', 'btn_id', 'ds_admin']),
        },
        mounted (){
            console.log('componente LoginComponent'); 
        }
        
    }
</script>
<style lang="scss">   
    .card-error {
        margin-left: 0rem !important;
        margin-top: 2rem;
    }
    .ancho-letra{
            font-weight: 100;
    }

    .cajon{
        position:absolute;
    }

    .linea-punteada{
        border-bottom: dotted 1px white
    }

    
</style>    