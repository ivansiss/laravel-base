<template>
    <div class="container">
        <paginator-component url="/api/rol"  urlLimpia ="/administracion/roles" nombre_base="access.roles" component-name="roles-component"></paginator-component>     
    </div>
</template>

<script>
    export default {
        data(){
            return {
   
            }
        }, 
        mounted() {
            console.log('Componente base roles');
        }
    }

</script>
