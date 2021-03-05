<template>
    <div class="container">
        <paginator-component url="/api/usuarios" urlLimpia ="/administracion/usuarios" nombre_base="access.users" component-name="usuarios-component"></paginator-component>     
    </div>
</template>

<script>
    export default {
        data(){
            return {
   
            }
        }, 
        mounted() {
            console.log('Componente BaseUsuariosComponent');
        }
    }
</script>
