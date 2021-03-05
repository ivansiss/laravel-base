<template>
<div>
    <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{post.title}}</h5>
                <button type="button" class="close"  @click="clean" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{post.content}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="clean">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ["post"],
    created(){
        // setTimeout(function(){ 
        //     $("#postModal").modal("show");
        // },4000);
    },
    methods: {
        clean: function(){
        this.$emit('closeModalPost');
        }
    },
    watch: {
      post: function(newVal, oldVal){
        if(typeof(newVal) == 'object')
          console.log('boton modal pulsado');
          $("#postModal").modal("show");
      }
  }
}
</script>
<style scoped>    
    prueba_css {
        color:red;
    }
</style>    