
//window.Vue = require('v/ue');
import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter);

export default new VueRouter({
     mode: 'history',
     routes: [

          { 
                    path: '/administracion/login', 
                    name:'start.login', 
               component: require('./components/modulos/authenticate/LoginComponent').default, 
                   props: true 
          },    
          { 
                    path: '/administracion', 
                    name:'tablero.index', 
               component: require('./components/modulos/tablero/TableroComponent').default, 
                   props: true,
               beforeEnter: (to, from, next) =>{
                    
                    let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                    if(usuarioAutenticado){
                         
                         let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                         if(listRolPermisosByUsuario.includes(to.name)){
                              next();
                         }else{
                              next(from.path + 'administracion/login');
                         }

                    }else{
                         next(from.path + 'administracion/login');                          
                    }
               }
          },
          { 
                         path: '/administracion/usuarios',
                         name:'access.users',
                    component: require('./components/modulos/cliente/BaseUsuariosComponent').default,
                        props: true,
                  beforeEnter: (to, from, next) =>{

                    let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                    if(usuarioAutenticado){

                         console.log('El usuario esta autenticado');
                         let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                         if(listRolPermisosByUsuario.includes(to.name)){
                              console.log('si');
                              next();
                         }else{
                             next(from.path + 'administracion/login');           
                         }

                    }else{
                         next(from.path + 'administracion/login');                          
                    }
                         
               }
          },
          { 
                         path: '/administracion/roles', 
                         name:'access.roles', 
                    component: require('./components/modulos/rol/BaseRolesComponent').default, 
                    props: false,
               beforeEnter: (to, from, next) =>{
                    console.log(from);
                         let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                         if(usuarioAutenticado){
                              console.log('El usuario esta autenticado');
                              let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                              if(listRolPermisosByUsuario.includes(to.name)){
                                   next();
                              }else{
                                  next(from.path + 'administracion/login');           
                              }
     
                         }else{
                              next(from.path + 'administracion/login');                          
                         }
               }
          },
          { 
                     path: '/administracion/permisos', 
                     name:'access.permissions', 
                component: require('./components/modulos/permiso/BasePermisosComponent').default, 
                    props: false,
              beforeEnter: (to, from, next) =>{
                         
                         let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                         if(usuarioAutenticado){
                              console.log('El usuario esta autenticado');
                              let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                              if(listRolPermisosByUsuario.includes(to.name)){
                                   next();
                              }else{
                                  next(from.path + 'administracion/login');           
                              }
     
                         }else{
                              next(from.path + 'administracion/login');                          
                         }
               }
          },
          
          { 
                     path: '/administracion/images', 
                     name:'access.images', 
                component: require('./components/modulos/galeria/ImagenesBaseComponent').default, 
                    props: false,
              beforeEnter: (to, from, next) =>{
                               
                         let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                         if(usuarioAutenticado){
                              console.log('El usuario esta autenticado');
                              let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                              if(listRolPermisosByUsuario.includes(to.name)){
                                   next();
                              }else{
                                  next(from.path + 'administracion/login');           
                              }
     
                         }else{
                              next(from.path + 'administracion/login');                          
                         }
          
               }
          },
          { 
                     path: '/administracion/image-new', 
                     name:'access.new.images', 
                component: require('./components/modulos/galeria/ImageNewComponent').default, 
                    props: false,
              beforeEnter: (to, from, next) =>{
                                      
                         let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                         if(usuarioAutenticado){
                              console.log('El usuario esta autenticado');
                              let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                              if(listRolPermisosByUsuario.includes(to.name)){
                                   next();
                              }else{
                                  next(from.path + 'administracion/login');           
                              }
     
                         }else{
                              next(from.path + 'administracion/login');                          
                         }
                 
               } 
          },
          { 
                         path: '/administracion/post', 
                         name:'access.posts', 
                    component: require('./components/modulos/post/PostsBaseComponent').default, 
                    props: false,
               beforeEnter: (to, from, next) =>{
                                                  
                    let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                    if(usuarioAutenticado){
                         console.log('El usuario esta autenticado');
                         let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                         if(listRolPermisosByUsuario.includes(to.name)){
                              next();
                         }else{
                             next(from.path + 'administracion/login');           
                         }

                    }else{
                         next(from.path + 'administracion/login');                          
                    }
                    
               }  
          },
          { 
                         path: '/administracion/post/new', 
                         name:'access.new.posts', 
                    component: require('./components/modulos/post/PostNewComponent').default, 
                        props: false,
                        beforeEnter: (to, from, next) =>{
                                                           
                             let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                             if(usuarioAutenticado){
                                  console.log('El usuario esta autenticado');
                                  let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                                  if(listRolPermisosByUsuario.includes(to.name)){
                                       next();
                                   }else{
                                       next(from.path + 'administracion/login');           
                                   }
          
                              }else{
                                   next(from.path + 'administracion/login');                          
                              }
                        }  
          },
          { 
                          path: '/administracion/post/detail/:id', 
                          name:'access.detalle.posts', 
                     component: require('./components/modulos/post/PostDetailComponent').default, 
                         props: false,
                         beforeEnter: (to, from, next) =>{
                                                            
                              let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                              if(usuarioAutenticado){
                                   console.log('El usuario esta autenticado');
                                   let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                                   if(listRolPermisosByUsuario.includes(to.name)){
                                        next();
                                   }else{
                                       next(from.path + 'administracion/login');           
                                   }
          
                              }else{
                                   next(from.path + 'administracion/login');                          
                              }
                              
                         }   
          },
          { 
                          path: '/administracion/productos', 
                          name:'access.products', 
                     component: require('./components/modulos/producto/ProductosBaseComponent').default, 
                         props: false,
                         beforeEnter: (to, from, next) =>{
                                                            
                              let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                              if(usuarioAutenticado){
                                   console.log('El usuario esta autenticado');
                                   let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                                   if(listRolPermisosByUsuario.includes(to.name)){
                                        next();
                                   }else{
                                       next(from.path + 'administracion/login');           
                                   }
          
                              }else{
                                   next(from.path + 'administracion/login');                          
                              }
                              
                         }   
          },
          { 
                          path: '/administracion/producto/new/:ultimoOrden', 
                          name:'access.new.products', 
                     component: require('./components/modulos/producto/ProductoNewComponent').default, 
                         props: false,
                         beforeEnter: (to, from, next) =>{
                                                            
                              let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                              if(usuarioAutenticado){
                                   console.log('El usuario esta autenticado');
                                   let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                                   if(listRolPermisosByUsuario.includes(to.name)){
                                        next();
                                   }else{
                                       next(from.path + 'administracion/login');           
                                   }
          
                              }else{
                                   console.log('El usuario NO esta autenticado');
                                   next(from.path + 'administracion/login');                          
                              }
                              
                         }   
          },
          { 
                          path: '/administracion/producto/edit/:id', 
                          name:'access.edit.products', 
                     component: require('./components/modulos/producto/ProductoEditComponent').default, 
                         props: false,
                         beforeEnter: (to, from, next) =>{
                                                            
                              let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                              if(usuarioAutenticado){
                                   console.log('El usuario esta autenticado');
                                   let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                                   if(listRolPermisosByUsuario.includes(to.name)){
                                        next();
                                   }else{
                                       next(from.path + 'administracion/login');           
                                   }
          
                              }else{
                                   next(from.path + 'administracion/login');                          
                              }
                              
                         }   
          },
          { 
                          path: '/administracion/pagination-links', 
                          name:'paginationlinks', 
                     component: require('./components/modulos/PaginationLinksComponent').default, 
                         props: false,
                         beforeEnter: (to, from, next) =>{
                                                            
                              let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                              if(usuarioAutenticado){
                                   console.log('El usuario esta autenticado');
                                   let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                                   if(listRolPermisosByUsuario.includes(to.name)){
                                        next();
                                   }else{
                                       next(from.path + 'administracion/login');           
                                   }
          
                              }else{
                                   next(from.path + 'administracion/login');                          
                              }
                              
                         }   
          },
          { 
                          path: '/administracion/paginatorComponent', 
                          name:'paginator', 
                     component: require('./components/modulos/PaginatorComponent').default, 
                         props: false,
                         beforeEnter: (to, from, next) =>{
                                                            
                              let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                              if(usuarioAutenticado){
                                   console.log('El usuario esta autenticado');
                                   let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                                   if(listRolPermisosByUsuario.includes(to.name)){
                                        next();
                                   }else{
                                       next(from.path + 'administracion/login');           
                                   }
          
                              }else{
                                   next(from.path + 'administracion/login');                          
                              }
                              
                         }   
          },
          { 
               path: '/administracion/pie', 
               name:'access.pie', 
          component: require('./components/modulos/pie/PieComponent').default, 
              props: false,
              beforeEnter: (to, from, next) =>{
                                                 
                   let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                   if(usuarioAutenticado){
                        console.log('El usuario esta autenticado');
                        let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                        if(listRolPermisosByUsuario.includes(to.name)){
                             next();
                         }else{
                             next('/administracion/login');           
                         }

                    }else{
                         next('/administracion/login');                          
                    }
              }  
          },
          { 
               path: '/administracion/paginas', 
               name:'access.paginas', 
          component: require('./components/modulos/paginas/PaginasBaseComponent').default, 
              props: false,
              beforeEnter: (to, from, next) =>{
                                                 
                   let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                   if(usuarioAutenticado){
                        console.log('El usuario esta autenticado');
                        let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                        if(listRolPermisosByUsuario.includes(to.name)){
                             next();
                         }else{
                             next('/administracion/login');           
                         }

                    }else{
                         next('/administracion/login');                          
                    }
              }  
          },
          { 
                          path: '/administracion/pagina/detail/:id', 
                          name:'access.edit.paginas', 
                     component: require('./components/modulos/paginas/PaginaDetailComponent').default, 
                         props: false,
                         beforeEnter: (to, from, next) =>{
                                                            
                              let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                              if(usuarioAutenticado){
                                   console.log('El usuario esta autenticado');
                                   let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                                   if(listRolPermisosByUsuario.includes(to.name)){
                                        next();
                                   }else{
                                       next('/administracion/login');           
                                   }
          
                              }else{
                                   next('/administracion/login');                          
                              }
                              
                         }   
          },
          { 
                          path: '/administracion/pagina/new', 
                          name:'access.new.pagina', 
                     component: require('./components/modulos/paginas/PaginaNewComponent').default, 
                         props: false,
                         beforeEnter: (to, from, next) =>{
                                                            
                              let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                              if(usuarioAutenticado){
                                   console.log('El usuario esta autenticado');
                                   let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                                   if(listRolPermisosByUsuario.includes(to.name)){
                                        next();
                                   }else{
                                       next('/administracion/login');           
                                   }
          
                              }else{
                                   next('/administracion/login');                          
                              }
                              
                         }   
          },
          { 
                          path: '/administracion/menu-superior', 
                          name:'access.menu.sup', 
                     component: require('./components/modulos/menu/MenuSupComponent').default, 
                         props: false,
                         beforeEnter: (to, from, next) =>{
                                                            
                              let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                              if(usuarioAutenticado){
                                   console.log('El usuario esta autenticado');
                                   let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                                   if(listRolPermisosByUsuario.includes(to.name)){
                                        next();
                                   }else{
                                       next('/administracion/login');           
                                   }
          
                              }else{
                                   next('/administracion/login');                          
                              }
                              
                         }   
          },
          { 
               path: '/administracion/videos', 
               name:'access.videos', 
          component: require('./components/modulos/videos/VideosBaseComponent').default, 
              props: false,
              beforeEnter: (to, from, next) =>{
                                                 
                   let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                   if(usuarioAutenticado){
                        console.log('El usuario esta autenticado');
                        let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                        if(listRolPermisosByUsuario.includes(to.name)){
                             next();
                        }else{
                            next('/administracion/login');           
                        }

                   }else{
                        next('/administracion/login');                          
                   }
                   
              }   
          },
          { 
               path: '/administracion/portada', 
               name:'access.portada', 
          component: require('./components/modulos/portada/PortadaComponent').default, 
              props: false,
              beforeEnter: (to, from, next) =>{
                                                 
                   let usuarioAutenticado = JSON.parse(sessionStorage.getItem('UserAutenticado'));
                   if(usuarioAutenticado){
                        console.log('El usuario esta autenticado');
                        let listRolPermisosByUsuario = JSON.parse(sessionStorage.getItem('listRolPermisosByUsuario'));
                        if(listRolPermisosByUsuario.includes(to.name)){
                             next();
                        }else{
                            next('/administracion/login');           
                        }

                   }else{
                        next('/administracion/login');                          
                   }
                   
              }   
          },
          { 
                          path: '*', 
                     component: require('./components/modulos/Error404Component').default, 
                         props: false },

          ]
});