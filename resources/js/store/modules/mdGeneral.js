import axios from "axios";

export default{
    namespaced:true,
    state:{
        ultimoOrden: 0,
        userAuth: {},
        permisos: [],
    },
    mutations:{

        setUltimoOrden(state, data){
            
            state.ultimoOrden = data;
        },
        setUserAuth(state, user){
   
            if(user == ''){
                
                state.userAuth = 'no logueado';

            }else{
                state.userAuth = user;
            }
        },
        setPermisos(state, permisos){

            state.permisos = permisos;
        }
        
    },
    actions:{

        async loadUltimoOrden ({commit}, nombre){

            let dato = { name: nombre };
            let url = '/api/general';

            await axios.post(url, dato).then(res => {

                    commit('setUltimoOrden', res.data);

            }).catch(error => console.log(error));
        },

        permisosDeUsuario ( {commit} ){

            let url = '/authenticate/getRefrescarUsuarioAutenticado';
            axios.get(url).then(respUser => {

                if(respUser.data == ''){
                    let url = '/administracion/authenticate/logout';
                    axios.post(url).then(response => {
                    
                        if(response.data.code == 204){
                            console.log('cierre session');
                            sessionStorage.removeItem('UserAutenticado');
                            sessionStorage.removeItem('listRolPermisosByUsuario');
                            this.$router.push({name: 'start.login'}).catch(err => {});
                            location.reload();
                        }                  
                    });

                }else{
                    let enviar = { 'id': respUser.data.id };
                    let url = '/api/usuarios/getListarPermisosByUsuario';
                    axios.post(url, enviar).then(respPermisos => {

                        commit('setUserAuth', respUser.data);
                        commit('setPermisos', respPermisos.data);

                    }).catch(error => console.log(error));
                }
                
            }).catch(error => console.log(error));    
            
        }
    },
    getters:{
        
    }
};

