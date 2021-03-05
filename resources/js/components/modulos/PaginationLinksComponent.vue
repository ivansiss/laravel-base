<template>
    <div>
        <div class="d-flex justify-content-center mt-5"> 
            <nav aria-label="Page navigation example text-center">

            <ul class="pagination pg-blue" v-if="pagination.last_page > 1">

                <li :class="setAnterior()" class="page-item">
                     <router-link class="page-link" :to="{ 
                        name: nombre_base, 
                        query: { page: pagina_actual-1 }
                        }">
                        Anterior
                     </router-link>
                </li>

                <li class="page-item" v-for="page in pagination.last_page" :key="page.current_page">
                    <router-link :class="getActiveClass(page)" :to="{ 
                        name: nombre_base, 
                        query: { page: page }
                    }" class="page-link">
                    {{ page }}
                    </router-link>
                </li>
                
                <li class="page-item" :class="setSiguiente()">
                     <router-link class="page-link" :to="{ 
                        name: nombre_base, 
                        query: { page: pagina_actual+1 }
                        }">
                        Siguiente
                     </router-link>
                </li>
               
            </ul>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['pagination', 'nombre_base', 'pagina_actual'],
        data(){
            return { 
   
                    }
        },
        methods: {
            getActiveClass(page){
                return [
                    !this.pagination.current_page && page == 1 ? 'active' : ''
                ];
            },
            setAnterior(){
                return [
                    this.pagina_actual > 1 ? '' : 'disabled'
                ];
            },
            setSiguiente(){
                return [
                    this.pagina_actual == this.pagination.last_page ? 'disabled' : ''
                ];
            }
        },
        watch: {
           
        },
        mounted() {
           console.log('PaginationLinksComponent');
        }
    }
</script>
