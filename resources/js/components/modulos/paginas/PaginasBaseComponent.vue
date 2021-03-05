<template>
    <div class="container">
        <paginator-component url="/api/pagina" urlLimpia ="/administracion/paginas" nombre_base="access.paginas" component-name="paginas-list-component"></paginator-component>     
    </div>
</template>

<script>
    export default {
        data(){
            return {

            }
        }, 
        mounted() {
    
        }
    }
</script>
