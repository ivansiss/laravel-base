<template>

    <div class="mt-5">

         <div class="d-flex justify-content-start">
            <div class="ml-3 mb-5" v-bind:style="{ 
                                    fontSize: ds_admin[2].size,
                                    fontWeight: 700,
                                    fontFamily: ds_admin[2].family,
                                    color: ds_admin[2].color,
                                    borderBottom: ds_admin[2].border,
                                    width: ds_admin[2].width,

                                }"><span v-bind:style="{ color: ds_admin[2].linea }">V</span>ideos</div>
            <spinner-component :spinner="spinner"></spinner-component>
        </div>

        <div class="alert alert-dismissible mb-5 tablero mt-5" v-bind:style="{ backgroundColor: ds_admin[11].backgroundColor, color: ds_admin[11].color }">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5 :style="{ borderBottom:  ds_admin[11].border }"><i class="icon fas fa-info"></i> <span v-bind:style="{ color:  ds_admin[11].linea }">I</span>nformación</h5>
            
            Puedes hacer busquedas:
            <ul>
                <li>nombre imagen (buscara imágenes por su nombre)</li>
                <li>visible (buscara imágenes con ficha)</li>
                <li>no visible (busca imágenes sin imagen fisica)</li>
                <li>size (buscara las imágenes mayores a un 1mb)</li>
            </ul>
        </div>
       
        <div class="d-flex justify-content-end ml-3 mb-3 mr-3">    
            <btns-component class="mr-3" :tipo="5" v-on:traeEmit="saveOrden"></btns-component>
            <btns-component class="mr-3" :tipo="6" v-on:traeEmit="nuevo"></btns-component>
        </div>

        <hr class="mb-5" style="background-color: #343a40;">
        <div class="d-flex justify-content-center" v-for="vid in items" :key="vid.id">
            
            <video-list-item-Component :video="vid" v-on:editarEmit="editar(vid)" :ultimoOrden="ultimoOrden" v-on:eliminarEmit="eliminar(vid)" v-on:SubirEmit="subir"  v-on:BajarEmit="bajar"></video-list-item-Component>
        </div>

    </div>
    
</template>
<script>

import { mapMutations, mapState, mapActions } from 'vuex';
export default {
        props:['items'],
        data(){
            return { 
                        listRolPermisosByUsuario: [],
                        tiposVideos: [],
                        selectVideos:[],
                        videos: null,
                        orden: 0,
                   }
        },
        methods: {
            ...mapMutations('dsAdmin', ['parar', 'iniciarSpinner', 'pararSpinner']),
            ...mapActions('mdGeneral', ['loadUltimoOrden']),
            getDatos(){
                let url = '/api/videos';
                axios.post(url).then(response => {                
                    this.video = response.data;
                });
            },
            getTipoVideo(){

                let urlTipo = '/api/videos/tipos';
                axios.post(urlTipo).then(responseTipo => {
                    
                    this.tiposVideos = responseTipo.data;
                    responseTipo.data.forEach(item => {
                        this.selectVideos[item.id] = item.title;    
                    });
                    console.log('tipo video:');
                    console.log(this.selectVideos);
                });
            },
            nuevo(){
                    
                Swal.mixin({
                input: 'text',
                confirmButtonText: 'Next &rarr;',
                showCancelButton: true,
                progressSteps: ['1', '2', '3', '4', '5', '6']
                    }).queue([
                    {
                        title:'Subir video',
                        input:'file',
                        inputAttributes: {
                            'accept': 'video/*',
                            'aria-label': 'Sube tu video'
                        },
                        inputValidator: (value) => {
                            if (!value) {
                                return 'No puedes dejar el campo vacio!';
                            }
                        },
                    },
                    {
                        title:'Título',
                        input:'text',
                        inputLabel:'Título',
                        inputValidator: (value) => {
                            if (!value) {
                                return 'No puedes dejar el campo vacio!';
                            }
                        },
                    },
                    {
                        title:'Descripción del video',
                        input:'textarea',
                        inputLabel:'Descripción',
                    },
                    {
                        title: 'El video es Visible?',
                        inputLabel: 'Visibilidad',
                        input:'select',
                        inputOptions: {
                            0: 'No',
                            1: 'Si'
                        },
                    },
                    {
                        title: 'Tipo video',
                        inputLabel: 'Pertenece a ...',
                        input:'select',
                        inputOptions: this.selectVideos,
                    },
                    {
                        title:'Url limpia',
                        input:'text',
                        inputLabel:'Con guion -',
                        inputValidator: (value) => {
                            if (!value) {
                                return 'No puedes dejar el campo vacio!';
                            }
                        },
                    }

                ]).then( async (result) => {
                    if (result.value) {
                 
                        //Creamos el formData
                        var data = new  FormData();

                        // let extension = this.imagen.name.slice((this.imagen.name.lastIndexOf('.') - 1 >>> 0) + 2);
                        // let nombre = this.imagen.name.replace('.'+extension, "");
                        // let nombreConExtension = this.imagen.name;

                        //Añadimos la imagen seleccionada
                        data.append('miVideo', result.value[0]);

                            data.append('titulo',      result.value[1]);
                            data.append('descripcion', result.value[2]);
                            data.append('visible',     result.value[3]);
                            data.append('tipo_id',     result.value[4]);
                            data.append('miniatura',   result.value[5]);
                            data.append('orden',       this.ultimoOrden + 1);


                        //Añadimos el método PUT dentro del formData
                        // Como lo hacíamos desde un formulario simple _(no ajax)_
                        //data.append('_method', 'PUT');
            
                        //Enviamos la petición
                        await axios.post('/api/videos/guardar', data)
                        .then(response => {

                                const answers = JSON.stringify(response.data)
                                    Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Video guardado!!',
                                    showConfirmButton: false,
                                    timer: 2000
                                });

                                let url1 = ``;
                                if(this.$route.fullPath == '/administracion/videos?page=1'){
                                        url1 = `/administracion/videos`;
                                }else{
                                        url1 = `/administracion/videos?page=1`;
                                }

                                this.getDatos();

                                this.parar();
                                this.$router.push(url1).catch(err => {});
                        
                        }).catch(error => {

                                const answers = JSON.stringify(error.response.data)
                                        Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: answers,
                                        showConfirmButton: false,
                                        timer: 20000
                                 });
                                 this.parar();
                        });
                        this.parar();
                    }else{
                        this.parar();
                    }
                    })
            },
            eliminar(vid){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: '',
                    text: "Si eliminas el video "+ vid.titulo +", No podras deshacer el cambio!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then(  (result) => {

                    if (result.isConfirmed) {

                        let url = '/api/videos/'+vid.id;
                        axios.delete(url).then(response => {

                                const answers = JSON.stringify(response.data)
                                    Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: answers,
                                    showConfirmButton: false,
                                    timer: 2000
                                })

                                let url1 = ``;
                                if(this.$route.fullPath == '/administracion/videos?page=1'){
                                        url1 = `/administracion/videos`;
                                }else{
                                        url1 = `/administracion/videos?page=1`;
                                }

                                this.parar();
                                this.$router.push(url1).catch(err => {});
                        });

                    
                    } else if (result.dismiss === Swal.DismissReason.cancel) {

                    const answers = JSON.stringify(result.dismiss)
                            Swal.fire({
                            position: 'center',
                            icon: 'info',
                            title: 'Operación cancelada',
                            showConfirmButton: false,
                            timer: 2000
                        });

                        this.parar();
                    }
                });
            },
            editar(vid){
                
                 let formulario = 

                        '<hr/ class="mb-5" style="background: white;">' +
                       
                        '<div class="md-form mt-5">' +
                            '<i class="far fa-image prefix mr-2"></i>' +
                            '<label for="inputIconEx2" class="active">Título</label>' +   
                            '<input type="text" id="titulo" class="form-control">' +
                        '</div>' +

                        '<div class="md-form">' +
                            '<i class="fas fa-pen-alt prefix mr-2 mt-4"></i>' +
                            '<label for="exampleFormControlTextarea1" class="active">Descripción</label>' + 
                            '<textarea type="text" id="descripcion" class="form-control rounded-0" rows="10"></textarea>' +
                        '</div>' +

                        '<hr/ class="my-3" style="background: white;">' +

                        '<div id="swal5-content" class="swal2-html-container" style="display: block;">Video visible?</div> ' +
                        '<select id="visible" class="swal2-select">' +
                            '<option value="1">Si</option>' +
                            '<option value="0">No</option>' +
                        '</select> ' +

                        '<div id="swal5-content" class="swal2-html-container" style="display: block;">Tipo de video?</div> ' +
                        '<select id="tipo" class="swal2-select">';
                         
                        this.selectVideos.forEach(function callback(item, index){
                            formulario += '<option value="'+ index +'">'+ item +'</option>';
                        });

                        formulario +=
                        '</select> ' +

                        '<hr/ class="mb-5" style="background: white;">' +
                        '<div class="md-form mt-5">' +
                            '<i class="fas fa-link pr-1 mr-2"></i>' +
                            '<label for="inputIconEx2" class="active">Url limpia</label>' +   
                            '<input type="text" id="miniatura" class="form-control">' +
                        '</div>'; 

                    Swal.fire({
                        title: 'Editar Video',
                        showCancelButton: true,
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Guardar',
                        html: formulario,
                        focusConfirm: false,
                        preConfirm: async() => {

                            var data = new  FormData();

                            data.append('titulo',      document.getElementById('titulo').value);
                            data.append('descripcion', document.getElementById('descripcion').value);
                            data.append('visible',     document.getElementById('visible').value);
                            data.append('tipo_id',     document.getElementById('tipo').value);
                            data.append('miniatura',   document.getElementById('miniatura').value);
                            data.append('_method', 'PUT');
                                
                                let url = '/api/videos/'+vid.id;
                                await axios.post(url, data).then(response => {

                                    const answers = JSON.stringify(response.data)
                                    Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: answers,
                                    showConfirmButton: false,
                                    timer: 2000
                                    })

                                    let url1 = ``;
                                    if(this.$route.fullPath == '/administracion/videos?page=1'){
                                            url1 = `/administracion/videos`;
                                    }else{
                                            url1 = `/administracion/videos?page=1`;
                                    }

                                    this.parar();
                                    this.$router.push(url1).catch(err => {});
                                        
                                });

                            this.parar(); 
                        }
                        
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel) {
                           this.parar();
                        }
                    })

                    document.getElementById('titulo').value  = vid.titulo;
                    document.getElementById('descripcion').value  = vid.descripcion;
                    document.getElementById('visible').value  = vid.visible;
                    document.getElementById('miniatura').value  = vid.miniatura;
                    document.getElementById('tipo').value  = vid.tipo_id;

            },
            saveOrden(){
                let url = '/api/videos/order';
                axios.post(url, this.items).then(response => {

                    const answers = JSON.stringify(response.data)
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Orden guardado!!',
                    showConfirmButton: false,
                    timer: 2000
                     })

                   let url1 = ``;
                    if(this.$route.fullPath == '/administracion/videos?page=1'){
                            url1 = `/administracion/videos`;
                    }else{
                            url1 = `/administracion/videos?page=1`;
                    }

                    this.parar();
                    this.$router.push(url1).catch(err => {});
                        
                });
            },
            subir(img){

                let detras = {};

                let contador = 0;
                let pasaDelante = false;

                let gDetras = {};
                let gIguales = {};
                let gDelante = {};

                this.items.forEach(lista => {

                    if(pasaDelante == true){
                        gDelante = lista;
                        pasaDelante = false;
                    }
                       
                    if(img.orden != lista.orden){         
                        detras = lista;
                    }

                    if(img.orden == lista.orden){    
                        gDetras = detras;
                        gIguales = lista;
                        pasaDelante = true;
                    } 

                    lista.orden = contador;
                    contador++;
                });

                let i = gIguales.orden;
                let d = gDetras.orden;
                gIguales.orden =  d;
                gDetras.orden = i;
    
                this.items = this.items.sort((a,b) => a.orden - b.orden);
                this.parar();
            },
            bajar(img){
                
                let siguiente = false;
                let contador = 0;
                this.items.forEach(lista => {
                    
                    if(img.orden != lista.orden && siguiente == false){
                       
                        lista.orden = contador++;     
                        contador = lista.orden+1;
     
                    }

                    let pasa = 0;
                    if(siguiente == true){
          
                        lista.orden = contador;
       
                        contador = contador +2;
           
                        siguiente = false;
         
                        pasa = 1;
                    }


                    if(img.orden == lista.orden && pasa == 0){
                  
                        lista.orden = contador + 1;
             
                        siguiente = true;
        
                    } 
                });

                this.items = this.items.sort((a,b) => a.orden - b.orden);
                this.parar();
            },
        },
        computed: {

            ...mapState('dsAdmin', ['ds_admin', 'spinner']),
            ...mapState('mdGeneral', ['ultimoOrden']),
        },
        mounted (){
            console.log('VideosListComponent');

            
            this.listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
        },
        created(){
            this.loadUltimoOrden('videos');
            this.getTipoVideo();
            this.getDatos();
            setTimeout(() => {
                this.pararSpinner();
            }, 2000);
        }
    }
</script>

<style lang="scss">  

    .tablero{
        width: 95%;
        margin-left: 1%;
    }
    .card {
        background-color: #f6f9fc;
        width: 260px;
        margin-bottom: 1rem;
    }

    .ancho-pantalla{
         width: 100%;
    }

    .panel-principal{
        position: relative;
    }

    .panel-posicion{
        position: absolute !important;
        top: -20px !important;
        left: 40px !important;
    }

    .swal2-content {
        font-size: 1em;
    }

    .swal2-progress-steps {
        font-size: .9rem;
    }

    .winter-neva-gradient {
        background-image: linear-gradient(120deg, #268ca2 0%, #c2e9fb 100%);
    }

    .mdb-color.lighten-3 {
    background-color: #1e90ff !important;
    }

    .tamaño-letra{
        font-size:33px;
        font-weight: 700;
    }

    .h5{
        font-size:33px;
        font-weight: 700;
    }
    

</style>   
 
