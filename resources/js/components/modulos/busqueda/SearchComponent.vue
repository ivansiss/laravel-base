<template>
    
    <div class="container" v-if="permisos.includes('access.general')">
        <div class="row">
            <div class="col d-flex justify-content-center">
                    <div class="input-group input-group-sm" style="width: 90%;">
                    <input 
                            type="text" 
                            name="table_search" 
                            class="form-control float-right" 
                        placeholder="Buscar" 
                            v-model="consulta"
                            @keyup="DevolverBuscar()">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
        </div>
            </div>
        </div>

    </div>
    
</template>

<script>
    import { mapState, mapActions  } from 'vuex';
    export default {
        data (){
            return{
                consulta: '',
            };          
        },
        methods:{
            ...mapActions('mdGeneral', ['permisosDeUsuario']),
            DevolverBuscar(){
                this.$emit('traeEmit', this.consulta);
            },
        },
        computed: {

            ...mapState('mdGeneral', ['userAuth', 'permisos']),
        },
        created(){
            this.permisosDeUsuario();
        }
    }
</script>
<style lang="scss">   
</style>
