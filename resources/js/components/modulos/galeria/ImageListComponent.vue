<template>

    <div class="mt-5">

         <div class="d-flex justify-content-start">
            <div class="ml-3 mb-5 titulo-listas subrayar-verde"><span v-bind:style="{ color: ds_admin[2].linea }">I</span>mágenes</div>
            <spinner-component :spinner="spinner"></spinner-component>
        </div>

        <div class="alert alert-dismissible mb-5 tablero mt-5 fondo-card texto-blanco">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5 :style="{ borderBottom:  ds_admin[11].border }"><i class="icon fas fa-info"></i> <span v-bind:style="{ color:  ds_admin[11].linea }">I</span>nformación</h5>
            
            Puedes hacer busquedas:
            <ul>
                <li>nombre imagen (buscara imágenes por su nombre)</li>
                <li>visible (buscara imágenes con ficha)</li>
                <li>no visible (busca imágenes sin imagen fisica)</li>
                <li>size (buscara las imágenes mayores a un 1mb)</li>
                <li>icono  (buscara imágenes de tipo icono)</li>
                <li>sello  (buscara imágenes de tipo sello)</li>
                <li>web  (buscara imágenes de tipo web)</li>
                <li>tarifa  (buscara imágenes de tipo tarifa)</li>
                <li>logo  (buscara imágenes de tipo logo)</li>
                <li>producto  (buscara imágenes de tipo producto)</li>
                <li>color  (buscara imágenes de tipo color)</li>
            </ul>
        </div>
       
        <div class="d-flex justify-content-end ml-3 mb-3 mr-3">    
            <btns-component :tipo="3" class="mr-3" v-on:traeEmit="ordenAutomatico"></btns-component>
            <btns-component :tipo="5" class="mr-3" v-on:traeEmit="saveOrden"></btns-component>
            <btns-component :tipo="6" class="mr-3" v-on:traeEmit="nuevo"></btns-component>
            <template v-if="listRolPermisosByUsuario.includes('access.des.img')" class="mr-3" >
                <button type="button" class="btn btn-outline-secondary btn-lg" v-bind:style="{ color: ds_admin[11].linea, border: ds_admin[10].border }" width="10%" @click="catalogarAuto()"><i class="fas fa-cart-arrow-down"></i></button>
            </template>
        </div>

        <hr class="mb-5" style="background-color: #343a40;">

        <div class="d-flex justify-content-center" v-for="img in items" :key="img.id">
            <image-list-item-Component :img="img" v-on:editarEmit="editar(img)" :ultimoOrden="ultimoOrden" v-on:eliminarEmit="eliminar(img)" v-on:SubirEmit="subir"  v-on:BajarEmit="bajar"></image-list-item-Component>
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
                        tipoImagen: [],
                        images: null,
                        tiposPrep: {},
                        orden: 0,
                   }
        },
        methods: {
            ...mapMutations('dsAdmin', ['parar', 'iniciarSpinner', 'pararSpinner']),
            ...mapActions('mdGeneral', ['loadUltimoOrden']),
            getDatos(){
                let url = '/api/images';
                axios.get(url).then(response => {                
                    this.images = response.data;
                });

                this.getTipoImagen();
            },
            getTipoImagen(){

                let urlTipo = '/api/images/tipo';
                axios.post(urlTipo).then(responseTipo => {
                    
                    this.tipoImagen = responseTipo.data;
                    responseTipo.data.forEach(item => {
                        this.tiposPrep[item.id] = item.title;    
                                 
                    });
                });
            },
            nuevo(){
                    
                Swal.mixin({
                input: 'text',
                confirmButtonText: 'Siguiente &rarr;',
                showCancelButton: true,
                progressSteps: ['1', '2', '3', '4', '5', '6', '7']
                    }).queue([
                    {
                        title:'Subir imagen',
                        input:'file',
                        inputAttributes: {
                            'accept': 'image/jpg, png, svg',
                            'aria-label': 'Sube tu imagen'
                        },
                        inputValidator: (value) => {
                            if (!value) {
                                return 'No puedes dejar el campo vacio!';
                            }
                        },
                        
                    },
                    {
                        title:'Descripción de la imagen',
                        input:'text',
                        inputLabel:'Descripción',
                    },  
                    {
                        title:'Link de la imagen',
                        input:'text',
                        inputLabel:'Link',
                    },
                    {
                        title:'Alt de la imagen',
                        input:'text',
                        inputLabel:'Alt',
                    },
                    {
                        title: 'La imagen es Visible?',
                        inputLabel: 'Visibilidad',
                        input:'select',
                        inputOptions: {
                            1: 'Si',
                            0: 'No'
                        },
                    },
                    {
                        title: 'Tipo imagen',
                        inputLabel: 'Pertenece a ...',
                        input:'select',
                        inputOptions: this.tiposPrep,
                    }
                ]).then( async (result) => {
                    if (result.value) {
                 
                        //Creamos el formData
                        var data = new  FormData();

                        // let extension = this.imagen.name.slice((this.imagen.name.lastIndexOf('.') - 1 >>> 0) + 2);
                        // let nombre = this.imagen.name.replace('.'+extension, "");
                        // let nombreConExtension = this.imagen.name;

                        //Añadimos la imagen seleccionada
                        data.append('miImagen', result.value[0]);


                            data.append('image',       result.value[0].name);
                            data.append('description', result.value[1]);
                            data.append('link',        result.value[2]);
                            data.append('alt',         result.value[3]);
                            data.append('visible',     result.value[4]);
                            data.append('tipo_id',     result.value[5]);
                            data.append('orden',       this.orden);

                        //Añadimos el método PUT dentro del formData
                        // Como lo hacíamos desde un formulario simple _(no ajax)_
                        //data.append('_method', 'PUT');
            
                        //Enviamos la petición
                        await axios.post('/api/images/',data)
                        .then(response => {

                                const answers = JSON.stringify(response.data)
                                    Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Imagen guardada!!',
                                    showConfirmButton: false,
                                    timer: 2000
                                });

                                let url1 = ``;
                                if(this.$route.fullPath == '/administracion/images?page=1'){
                                        url1 = `/administracion/images`;
                                }else{
                                        url1 = `/administracion/images?page=1`;
                                }

                                this.parar();
                                this.$router.push(url1).catch(err => {});
                        
                        }).catch(error => {

                                let myError = "";
                                if (error.response.status === 406) {
                                    myError = error.response.data;   
                                }

                                if (error.response.status === 500) {
                                    myError  = error.response.data.message;   
                                }

                                const answers = JSON.stringify(error.response.data.message)
                                        Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: myError,
                                        showConfirmButton: false,
                                        timer: 2000
                                 });
                                 this.parar();
                        });
                        this.parar();
                    }else{
                        this.parar();
                    }
                    })
            },
            eliminar(eliminarImg){

                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: '',
                    text: "Si eliminas la imagen "+ eliminarImg.image +", No podras deshacer el cambio!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then(  (result) => {

                    if (result.isConfirmed) {

                        let url = '/api/images/'+eliminarImg.id;
                        axios.delete(url).then(response => {

                                const answers = JSON.stringify(response.data)
                                    Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: answers,
                                    showConfirmButton: false,
                                    timer: 2000
                                })

                                let url1 = ``;
                                if(this.$route.fullPath == '/administracion/images?page=1'){
                                        url1 = `/administracion/images`;
                                }else{
                                        url1 = `/administracion/images?page=1`;
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
            editar(img){
                
                 let formulario = 

                        '<hr/ class="mb-5" style="background: black;">' +
                        '<input type="file" id="mi_imagen" accept="image/jpg, png, svg" aria-label="Upload" class="swal2-file mb-3" placeholder="" style="display: flex;">' +

                        '<div class="md-form mt-5">' +
                            '<i class="far fa-image prefix mr-2"></i>' +
                            '<label for="inputIconEx2" class="active">Nombre</label>' +   
                            '<input type="text" id="image" class="form-control" disabled>' +
                        '</div>' +

                        '<div class="md-form">' +
                            '<i class="fas fa-pen-alt prefix mr-2 mt-4"></i>' +
                            '<label for="inputIconEx2" class="active">Descripción</label>' + 
                            '<input type="text" id="description" class="form-control">' +
                        '</div>' +

                        '<div class="md-form">' +
                            '<i class="fas fa-link prefix mr-2 mt-4"></i>' +
                            '<label for="inputIconEx2" class="active">Link</label>' +  
                            '<input type="text" id="link" class="form-control">' +
                        '</div>' +

                        '<div class="md-form">' +
                            '<i class="far fa-eye prefix mr-2 mt-4"></i>' +
                            '<label for="inputIconEx2" class="active">Alt</label>' +  
                            '<input type="text" id="alt" class="form-control">' + 
                        '</div>' +

                        '<hr/ class="my-3" style="background: black;">' +

                        '<div id="swal5-content" class="swal2-html-container" style="display: block;">Imagen visible?</div> ' +
                        '<select id="visible" class="swal2-select">' +
                            '<option value="1">Si</option>' +
                            '<option value="0">No</option>' +
                        '</select> ' +

                        '<div id="swal5-content" class="swal2-html-container" style="display: block;">Tipo de imagen?</div> ' +
                        '<select id="tipo" class="swal2-select">';

                        this.tipoImagen.forEach(item => {
                            formulario += '<option value="'+ item.id +'">'+ item.title +'</option>';
                        });

                        formulario +=
                        '</select> ' +
                        '<hr/ class="mb-5" style="background: black;">'; 

                    Swal.fire({
                        title: 'Editar Imagen',
                        showCancelButton: true,
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Guardar',
                        html: formulario,
                        focusConfirm: false,
                        preConfirm: async() => {
                          
                            let nombrefile = document.getElementById('mi_imagen').value;
                            let nfile = nombrefile.slice(12)  ;

                            if(document.getElementById('image').value != nfile && nombrefile !== ""){
                                
                                const answers = JSON.stringify('El nombre de la imagen tiene que ser el mismo!!')
                                            Swal.fire({
                                            position: 'center',
                                            icon: 'warning',
                                            title: answers,
                                            showConfirmButton: false,
                                            timer: 2000
                                            });

                                this.parar();

                            }else{
                            
                                //Creamos el formData
                                var data = new  FormData();
                                const imagefile = document.querySelector('#mi_imagen');
                            
                                data.append("miImagen", imagefile.files[0]);   
                                data.append('id',          img.id);
                                data.append('image',       document.getElementById('image').value);
                                data.append('description', document.getElementById('description').value);
                                data.append('link',        document.getElementById('link').value);
                                data.append('alt',         document.getElementById('alt').value);
                                data.append('visible',     document.getElementById('visible').value);
                                data.append('tipo_id',     document.getElementById('tipo').value);
                                data.append('size',        img.size);

                                data.append('_method', 'PUT');
                                
                                let url = '/api/images/'+img.id;
                                await axios.post(url, data).then(response => {

                                    const answers = JSON.stringify(response.data)
                                    Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: answers,
                                    showConfirmButton: false,
                                    timer: 2000
                                    })

                                    let url1 = ``;
                                    if(this.$route.fullPath == '/administracion/images?page=1'){
                                            url1 = `/administracion/images`;
                                    }else{
                                            url1 = `/administracion/images?page=1`;
                                    }

                                    this.parar();
                                    this.$router.push(url1).catch(err => {});
                                        
                                });
                            }

                            this.parar(); 
                        }
                        
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel) {
                           this.parar();
                        }
                    })

                    document.getElementById('image').value  = img.image;
                    document.getElementById('description').value  = img.description;
                    document.getElementById('link').value  = img.link;
                    document.getElementById('alt').value  = img.alt;
                    document.getElementById('visible').value  = img.visible;
                    document.getElementById('tipo').value  = img.tipo_id;
            },
            catalogarAuto(){

                let url = '/api/images/catalogarAuto';
                axios.post(url).then(response => {
   
                    const answers = JSON.stringify(response.data)
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: answers,
                    showConfirmButton: false,
                    timer: 2000
                    });

                    let url1 = ``;
                    if(this.$route.fullPath == '/administracion/images?page=1'){
                            url1 = `/administracion/images`;
                    }else{
                            url1 = `/administracion/images?page=1`;
                    }

                    this.parar();
                    this.$router.push(url1).catch(err => {});

                });   
            },
            saveOrden(){
                let url = '/api/image/order';
                axios.post(url, this.items).then(response => {

                    const answers = JSON.stringify(response.data)
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Orden guardado!!',
                    showConfirmButton: false,
                    timer: 2000
                     })

                   let url1 = ``;
                    if(this.$route.fullPath == '/administracion/images?page=1'){
                            url1 = `/administracion/images`;
                    }else{
                            url1 = `/administracion/images?page=1`;
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
            ordenAutomatico(){

                let url = '/api/images/ordenar';
                let resp = [];
                axios.post(url).then(response => {    

                    resp = response.data;

                    const answers = JSON.stringify(response.data)
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Orden guardado!!',
                        showConfirmButton: false,
                        timer: 2000
                    })

                    let url1 = ``;
                    if(this.$route.fullPath == '/administracion/images?page=1'){
                            url1 = `/administracion/images`;
                    }else{
                            url1 = `/administracion/images?page=1`;
                    }

                    this.parar();
                    this.$router.push(url1).catch(err => {});
                            
  
                });
            }
        },
        computed: {

            ...mapState('dsAdmin', ['ds_admin', 'spinner']),
            ...mapState('mdGeneral', ['ultimoOrden']),
        },
        mounted (){
            console.log('ImageListComponent');
            this.getTipoImagen();
            
            this.listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
        },
        created(){
            this.loadUltimoOrden('imagenes');
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
 
