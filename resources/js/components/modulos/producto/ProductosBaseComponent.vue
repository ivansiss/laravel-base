<template>
    <div class="container">
        <paginator-component url="/api/productos" urlLimpia ="/administracion/productos" nombre_base="access.products" component-name="product-list-component"></paginator-component></paginator-component>     
    </div>
</template>

<script>
    export default {
        data(){
            return {
              
            }
        }, 
        mounted() {
            console.log('ProductosBaseComponent');
        }
    }
</script>
