<template>
    <div class="container">
        <paginator-component url="/api/videos" urlLimpia ="/administracion/videos" nombre_base ="access.videos" component-name="video-list-component"></paginator-component>     
    </div>
</template>

<script>
    export default {
        data(){
            return {

           
            }
        },
        mounted() {
             console.log('Componente base videos');
        }
    }
</script>
