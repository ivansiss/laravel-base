<template>
    <div class="container">
        <paginator-component url="/api/permisos" urlLimpia ="/administracion/permisos" nombre_base="access.permissions" component-name="permisos-component"></paginator-component>     
    </div>
</template>

<script>
    export default {
        data(){
            return {
   
            }
        }, 
        mounted() {
            console.log('Componente base usuarios');
        }
    }
</script>
