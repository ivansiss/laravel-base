<template>
    <div class="container">
        <paginator-component url="/api/post" urlLimpia ="/administracion/post" nombre_base="access.posts" component-name="post-list-component"></paginator-component>     
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
