<template>
    <div class="container">
        <paginator-component url="/api/images" urlLimpia ="/administracion/images" nombre_base ="access.images" component-name="image-list-component"></paginator-component>     
    </div>
</template>

<script>
    export default {
        data(){
            return {

           
            }
        },
        mounted() {
             console.log('Componente base imagenes');
        }
    }
</script>
