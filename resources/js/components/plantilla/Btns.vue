
<template>

   <button  type="submit" :id="id" class="btn btn-outline-secondary myboton" @click.prevent="enviar(id)">

        <div class="spinner-border text-info mr-2" v-if="cargando == true && btn_id == id" role="status" aria-hidden="true">
            <span class="sr-only ml-2">Cargando...&nbsp;&nbsp;</span>
        </div>
        {{ ds_admin[tipo].texto }}
        <i :class="ds_admin[tipo].icono" v-bind:style="{ fontSize: ds_admin[tipo].size }"></i>
        <i :class="ds_admin[tipo].icono2" v-bind:style="{ fontSize: ds_admin[tipo].size }"></i>

    </button>

</template>
<script>
import { mapMutations, mapState } from 'vuex';
export default {
    props: [ 'tipo'],
    data () {
            return {   
                        id:null,
                   }
        },
        methods:{
            ...mapMutations('dsAdmin', ['iniciar', 'addId']),
            enviar: function (id) {

                            this.addId(id);
                            this.iniciar();
                            this.$emit('traeEmit', '');
            },
             
            
        },
        mounted (){
            console.log('Cargando todos los btns');
            this.id = this._uid;
        },
        computed: {
            ...mapState('dsAdmin', ['cargando', 'btn_id', 'ds_admin']),
        },


}
</script>


<style lang="scss">   
  .bt-basico{
      width: 125% !important;
      margin-right: 2rem;
  }
  .myboton{
      color:#9ccc65;
      background-color: transparent !important;
      border: dotted 1px #9ccc65;
  }

  .myicono{
      color:#9ccc65;
  }
  
</style>  
