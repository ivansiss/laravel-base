export default{
    namespaced:true,
    state:{
        cargando: false,
        btn_id: 0,
        spinner: 1,
        ds_admin: [
                    {   
                        //0
                        nombre: 'bt_login',   
                        color: 'white',
                        linea: '#1ac6ff',
                        border: 'dotted 1px #1ac6ff',
                        backgroundColor: 'transparent',
                        texto: 'Entrar',
                    },
                    {   
                        //1
                        nombre: 'card_login',   
                        color: '#1ac6ff',
                        linea: '#1ac6ff',
                        border: '',
                        backgroundColor: '#343a40',
                        texto: 'Iniciar sesión',
                    },
                    {   
                        //2
                        nombre: 'TituloPagina',
                        color: 'black',
                        linea: '#1ac6ff',
                        border: 'dotted 1px #1ac6ff',
                        backgroundColor: '',
                        texto: 'Clientes',
                        icono: '',
                        size: '28px',
                        family: 'lato',
                        width: '230px'
                    },
                    {   
                        //3
                        nombre: 'bt_ordenar',
                        color: '#1ac6ff',
                        linea: '#1ac6ff',
                        border: 'dotted 1px #1ac6ff',
                        backgroundColor: 'transparent !important',
                        texto: '',
                        icono: 'fas fa-sort-alpha-down',
                        size: '33px',
                    },
                    {   
                        //4
                        nombre: 'card clientes',
                        color: 'white',
                        linea: '#1ac6ff',
                        border: 'dotted 1px #1ac6ff',
                        backgroundColor: '#343a40',
                        texto: '',
                        icono: ''
                    },
                    {   
                        //5
                        nombre: 'bt_ordenar_guardar',
                        color: '#1ac6ff',
                        border: 'dotted 1px #1ac6ff',
                        backgroundColor: 'transparent !important',
                        texto: '',
                        icono: 'fas fa-sort-alpha-down mr-2',
                        icono2: 'far fa-save',
                        size: '33px',
                    },
                    {   
                        //6
                        nombre: 'bt_new',
                        color: '#1ac6ff',
                        border: 'dotted 1px #1ac6ff',
                        backgroundColor: 'transparent !important',
                        texto: '',
                        icono: 'far fa-plus-square',
                        icono2: '',
                        size: '33px',
                    },
                    {   
                        //7
                        nombre: 'bt_subir',
                        color: '#1ac6ff',
                        border: 'dotted 1px #1ac6ff',
                        backgroundColor: 'transparent !important',
                        texto: '',
                        icono: 'fas fa-sort-amount-up',
                        icono2: '',
                        size: '33px',
                    },
                    {   
                        //8
                        nombre: 'bt_bajar',
                        color: '#1ac6ff',
                        border: 'dotted 1px #1ac6ff',
                        backgroundColor: 'transparent !important',
                        texto: '',
                        icono: 'fas fa-sort-amount-down',
                        icono2: '',
                        size: '33px',
                    },
                    {   
                        //9
                        nombre: 'bt_editar',
                        color: '#1ac6ff',
                        border: 'dotted 1px #1ac6ff',
                        backgroundColor: 'transparent !important',
                        texto: '',
                        icono: 'far fa-edit',
                        icono2: '',
                        size: '33px',
                    },
                    {   
                        //10
                        nombre: 'bt_eliminar',
                        color: '#d32f2f',
                        border: 'dotted 1px #d32f2f',
                        backgroundColor: 'transparent !important',
                        texto: '',
                        icono: 'far fa-trash-alt',
                        icono2: '',
                        size: '33px',
                    },
                    {   
                        //11
                        nombre: 'imagenes_tablero_info',
                        color: 'white',
                        linea: '#1ac6ff',
                        border: 'dotted 1px white',
                        backgroundColor: '#343a40 !important',
                        texto: '',
                        icono: '',
                        icono2: '',
                        size: '28px',
                    },
                    {   
                        //12
                        nombre: 'card post',
                        color: 'white',
                        linea: '#1ac6ff',
                        border: 'dotted 1px #1ac6ff',
                        backgroundColor: '#343a40 !important',
                        texto: 'white',
                        icono: '',
                    },
                    {   
                        //13
                        nombre: 'badge',
                        color: 'white',
                        linea: '#1ac6ff',
                        border: 'dotted 1px #1ac6ff',
                        backgroundColor: '#343a40 !important',
                        texto: 'white',
                        icono: 'far fa-eye',
                    },
                    {   
                        //14
                        nombre: 'card producto',
                        color: 'white',
                        linea: '#1ac6ff',
                        border: 'dotted 1px #1ac6ff',
                        backgroundColor: '#343a40 !important',
                        texto: 'white',
                        icono: '',
                        size: '28px',
                        family: 'lato',
                    },
                    {   
                        //15
                        nombre: 'card sellos producto',
                        color: 'white',
                        linea: '#1ac6ff',
                        border: 'dotted 1px #1ac6ff',
                        backgroundColor: 'transparent !important',
                        texto: 'white',
                        icono: '',
                    },
                    {   
                        //16
                        nombre: 'selectComponent bt_transpasar',
                        color: '#1ac6ff',
                        size: '22px',
                        border: 'dotted 1px #1ac6ff',
                        backgroundColor: 'transparent !important',
                        texto: '',
                        icono: 'fas fa-file-import',
                    },
                    {   
                        //17
                        nombre: 'selectComponent bt_eliminar',
                        color: '#d32f2f',
                        border: 'dotted 1px #d32f2f',
                        backgroundColor: 'transparent !important',
                        texto: '',
                        icono: 'far fa-trash-alt',
                        icono2: '',
                        size: '22px',
                    },
                    {   
                        //18
                        nombre: 'bt_guardar',
                        color: '#1ac6ff',
                        border: 'dotted 1px #1ac6ff',
                        backgroundColor: 'transparent !important',
                        texto: '',
                        icono: 'far fa-save',
                        icono2: '',
                        size: '33px',
                    },
                    {   
                        //19
                        nombre: 'bt_spinner',
                        color: '#1ac6ff',
                        border: 'dotted 1px #1ac6ff',
                        backgroundColor: 'transparent !important',
                        texto: '',
                        icono: '',
                        icono2: '',
                        size: '33px',
                    },
                    {   
                        //20
                        nombre: 'bt_restablecer_pass',
                        color: '#ffeb3b',
                        border: 'dotted 1px #ffeb3b',
                        backgroundColor: 'transparent !important',
                        texto: '',
                        icono: 'far fa-paper-plane',
                        icono2: '',
                        size: '33px',
                    },



        ]
    },
    mutations:{
        iniciar:function(state){
            state.cargando = true;
            console.log('bt spinner iniciado');
        },
        parar:function(state){
            state.cargando = false;
            console.log('bt spinner parado');

        },
        addId:function(state, id){
            state.btn_id = id;
        },
        iniciarSpinner:function(state){
            state.spinner = 1;
            console.log('spinner iniciado');
        },
        pararSpinner:function(state){
            state.spinner = 0;
            console.log('spinner parado');

        },
    },
    actions:{

    },
    getters:{
        
    }
};