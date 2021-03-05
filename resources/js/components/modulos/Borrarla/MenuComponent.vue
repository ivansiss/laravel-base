<template>
    
    <div class="container" style="margin-top:7rem;">
        
        <!-- Grid row -->
        <div class="row">

            <!-- Grid column -->
            <div class="col-4 col-sm-4 col-md-3 col-lg-2 mb-3">
                <router-link to="/administracion/usuarios" class="text-dark">
                    <div class="contenedor z-depth-5 p-3 rounded mb-0 bg-coloreando">
                        <i class="fas fa-users px-3 py-2" style="color:white;font-size:2rem;"></i>
                        <div class="centrado font-weight-bold">USUARIOS</div>
                    </div>
                </router-link>
                
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-4 col-sm-4 col-md-3 col-lg-2 mb-3">
                <router-link to="/administracion/roles" class="text-dark">
                    <div class="contenedor z-depth-5 p-3 rounded mb-0 bg-coloreando">
                        <i class="fas fa-unlock-alt px-3 py-2" style="color:white;font-size:2rem;"></i>
                    <div class="centrado font-weight-bold">ROLES</div>
                    </div>
                </router-link>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-4 col-sm-4 col-md-3 col-lg-2 mb-3">

                <router-link to="/administracion/permisos" class="text-dark">
                    <div class="contenedor z-depth-5 p-3 rounded mb-0 bg-coloreando">
                            <i class="fas fa-clipboard-list px-3 py-2" style="color:white;font-size:2rem;"></i>
                        <div class="centrado font-weight-bold">PERMISOS</div>
                    </div>
                </router-link>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-4 col-sm-4 col-md-3 col-lg-2 mb-3">
                <router-link to="/administracion/post" class="text-dark">
                    <div class="contenedor z-depth-5 p-3 rounded mb-0 bg-coloreando">
                        <i class="fas fa-list-alt px-3 py-2" style="color:white;font-size:2rem;"></i>
                    <div class="centrado font-weight-bold">POSTS</div>
                    </div>
                </router-link>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-4 col-sm-4 col-md-3 col-lg-2 mb-3">
                <router-link to="/administracion/image" class="text-dark">
                    <div class="contenedor z-depth-5 p-3 rounded mb-0 bg-coloreando">
                        <i class="fas fa-file-image px-3 py-2" style="color:white;font-size:2rem;"></i>
                    <div class="centrado font-weight-bold p-4">IMAGENES</div>
                    </div>
                </router-link>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-4 col-sm-4 col-md-3 col-lg-2 mb-3">
                <router-link to="/administracion/productos" class="text-dark">
                    <div class="contenedor z-depth-5 p-3 rounded mb-0 bg-coloreando">
                        <i class="fas fa-users px-3 py-2" style="color:white;font-size:2rem;"></i>
                    <div class="centrado font-weight-bold">PRODUCTOS</div>
                    </div>
                </router-link>
            </div>
            <!-- Grid column -->
        </div>
    </div>
    
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style scoped>
    .contenedor{
        position: relative;
        display: inline-block;
        text-align: center;
    }
    
    .texto-encima{
        position: absolute;
        top: 20px;
        left: 20px;
    }
    .centrado{
        position: absolute;
        top: 80%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .bg-coloreando{
        background: #2da0c300;
    }
</style>
