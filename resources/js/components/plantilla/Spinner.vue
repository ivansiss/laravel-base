<template>
    <div>
        <div class="spinner-border text-info mr-2" :style="{ color: '#1ac6ff !important' }" v-if="spinner == 1" role="status" aria-hidden="true">
            <span class="sr-only ml-2">Cargando...&nbsp;&nbsp;</span>
        </div>
    </div>
</template>

<script>
export default {
    props: [ 'spinner' ],
        data () {
            return { 
                        color_link: "green",
                    };
        },
        methods:{
        },
        mounted (){
            console.log('Cargado spinner...');
        }
}
</script>

<style lang="scss">   

</style>    