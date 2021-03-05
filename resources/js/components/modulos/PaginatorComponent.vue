<template>
    <div class="mt-5">
        <search-component v-on:traeEmit="resultadosBusqueda"></search-component>
        <component :is="componentName" :items="items"></component>
        <pagination-link :pagination="pagination" :nombre_base=nombre_base :pagina_actual="pagina_actual">></pagination-link>
    </div>
</template>

<script>
    export default {
        props:['url', 'urlLimpia', 'nombre_base', 'componentName'],
        data(){
            return {
                pagination: {},
                items: [],
                pagina_actual: 1,
                consulta: "",
                setTimeoutBuscador: '',
            }
        }, 
        methods: {
            envioConsulta(){

                let url = `${this.url}/search?page=${ this.pagina_actual || 1}`;
                let enviar = { consulta:this.consulta };

                axios.post(url, enviar).then(response => {

                    if(response.data.data != ""){
                        
                        if(response.data.data != undefined){

                            this.pagination = response.data;        
                            this.items = response.data.data;
                            this.pagina_actual = this.pagination.current_page;
                
                            delete this.pagination.data; 
                        }
                        
                    }
                }).catch(error => {

                    if (error.response.status === 405) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            },
            resultadosBusqueda(recibir){

                //Quiero que me devuelvas la pagina 1
                this.pagina_actual = 1;
                
                let url1 = `${this.urlLimpia}?page=${ this.pagina_actual || 1}`;

                //Pon en la URL la url1
                this.$router.push(url1).catch(err => {});

                this.consulta = recibir;

                clearTimeout(this.setTimeoutBuscador);

                this.setTimeoutBuscador = setTimeout(this.envioConsulta(), 360);
            
            },     
        },
        watch: {
            $route(nuevoValor, valorAnterior){
                
                 this.pagina_actual = this.$route.query.page;

                 clearTimeout(this.setTimeoutBuscador);
                 this.setTimeoutBuscador = setTimeout(this.envioConsulta(), 360);
            },
     
        },
        mounted() {
            console.log('PaginatorComponent');

            //Si no estoy en la pagina 1
            if(this.$route.query != 1){
                
                //indico la pagina actual
                this.pagina_actual = this.$route.query.page;
            }
            this.envioConsulta();
        }
    }
</script>
<style lang="scss">   

.pagination{
        .page-item {

            .router-link-exact-active {
                background-color:  #929fba !important;
                color: white !important;
            }
        }
    }

</style>
    
    
    

