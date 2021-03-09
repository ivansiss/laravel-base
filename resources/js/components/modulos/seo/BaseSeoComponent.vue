<template>
    <div class="container">
        <paginator-component url="/api/seo" urlLimpia ="/administracion/seo" nombre_base="access.seo" component-name="seo-component"></paginator-component>     
    </div>
</template>

<script>
    export default {
        data(){
            return {
   
            }
        }, 
        mounted() {
            console.log('Componente BaseSeoComponent');
        }
    }
</script>
