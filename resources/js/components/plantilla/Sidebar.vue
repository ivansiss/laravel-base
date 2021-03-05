<template>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-fondo elevation-4" v-if="listPermisos.includes('access.sidebar')">
    
   
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <router-link class="d-block text-white" :to="{name:'access.users'}">{{ usuario['name'] }}</router-link>
          <!-- , params:{id:usuario['id']} -->
        </div>
      </div>

       <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex cerrar-sesion">
        <div class="info">
          <a href="#" class="d-block text-white" @click.prevent="logout">
            <i class="fas fa-sign-out-alt text-white"></i> Cerrar Sesión
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header sidebar-titulos">
            <router-link class="nav-link active" :to="'/administracion/'" v-bind:style="{backgroundColor: 'transparent'}">
                ADMINISTRACIÓN
            </router-link>
          </li>
          <li class="nav-header"></li>
          <li class="nav-item">
            <template v-if="listPermisos.includes('access.users')">
              <router-link class="nav-link" :to="'/administracion/usuarios'">
                <i class="nav-icon far fa-id-card color-icono-sidebar"></i>
                <p class="sidebar-subtitulos">
                  Clientes
                  <span class="badge badge-info right">
                              {{ numeros.clientes }}
                  </span>
                </p>
              </router-link>
            </template>
          </li>
          <li class="nav-item">
            <template v-if="listPermisos.includes('access.roles')">
                  <router-link class="nav-link" :to="'/administracion/roles'">
                    <i class="nav-icon fas fa-user-tag color-icono-sidebar"></i>
                    <p class="sidebar-subtitulos">
                      Roles
                      <span class="badge badge-info right">
                              {{ numeros.roles }}</span>
                    </p>
                  </router-link>
            </template> 
          </li>
          <li class="nav-item">
            <template v-if="listPermisos.includes('access.permissions')">
                <router-link class="nav-link" :to="'/administracion/permisos'">
                  <i class="nav-icon fas fa-lock color-icono-sidebar"></i>
                  <p class="sidebar-subtitulos">
                    Permisos
                    <span class="badge badge-info right">
                              {{ numeros.permisos }}</span>
                  </p>
                </router-link>
            </template> 
          </li>
           <li class="nav-item">
            <template v-if="listPermisos.includes('access.images')">
                <router-link class="nav-link" :to="'/administracion/images'">
                  <i class="fas fa-camera ml-1 mr-2 color-icono-sidebar"></i>
                  <p class="sidebar-subtitulos">
                    Imágenes
                    <span class="badge badge-info right">
                              {{ numeros.imagenes }}</span>
                  </p>
                </router-link>
            </template> 
          </li>
          <li class="nav-item">
            <template v-if="listPermisos.includes('access.posts')">
                <router-link class="nav-link" :to="'/administracion/post'">
                  <i class="fas fa-portrait ml-2 mr-2 color-icono-sidebar"></i>
                  <p class="sidebar-subtitulos">
                    Posts
                    <span class="badge badge-info right">
                              {{ numeros.posts }}</span>
                  </p>
                </router-link>
            </template> 
          </li>
          <li class="nav-item">
            <template v-if="listPermisos.includes('access.products')">
                <router-link class="nav-link" :to="'/administracion/productos'">
                  <i class="fas fa-shopping-bag ml-2 mr-2 color-icono-sidebar"></i>
                  <p class="sidebar-subtitulos">
                    Productos
                    <span class="badge badge-info right">
                              {{ numeros.productos }}</span>
                  </p>
                </router-link>
            </template> 
          </li>
          
          <li class="nav-header sidebar-titulos">CONFIGURACIONES</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-store color-icono-sidebar"></i>
              <p class="sidebar-subtitulos">
                Web
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <template v-if="listPermisos.includes('access.paginas')">
                  <router-link class="nav-link" :to="'/administracion/paginas'">
                    <i class="far fa-circle nav-icon color-icono-sidebar"></i>
                    <p class="sidebar-subtitulos">
                      Mis páginas
                    </p>
                  </router-link>
                </template> 
              </li>
              <li class="nav-item">
                <template v-if="listPermisos.includes('access.menu.sup')">
                  <router-link class="nav-link" :to="'/administracion/menu-superior'">
                    <i class="far fa-circle nav-icon color-icono-sidebar"></i>
                    <p class="sidebar-subtitulos">
                      Menú superior
                    </p>
                  </router-link>
                </template> 
              <li class="nav-item">
                <template v-if="listPermisos.includes('access.videos')">
                  <router-link class="nav-link" :to="'/administracion/videos'">
                    <i class="far fa-circle nav-icon color-icono-sidebar"></i>
                    <p class="sidebar-subtitulos">
                      Videos
                    </p>
                  </router-link>
                </template> 
              </li>
              <li class="nav-item">
                 <template v-if="listPermisos.includes('access.portada')">
                  <router-link class="nav-link" :to="'/administracion/portada'">
                    <i class="far fa-circle nav-icon color-icono-sidebar"></i>
                    <p class="sidebar-subtitulos">
                      Imágen Portada
                    </p>
                  </router-link>
                </template> 
              </li>
              <li class="nav-item">
                <template v-if="listPermisos.includes('access.products')">
                    <router-link class="nav-link" :to="'/administracion/pie'">
                     <i class="far fa-circle nav-icon color-icono-sidebar"></i>
                      <p class="sidebar-subtitulos">
                        Pie de página
                      </p>
                    </router-link>
                </template> 
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-book-open mr-2 color-icono-sidebar"></i>
              <p class="sidebar-subtitulos">
                Generales
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="sidebar-subtitulos">Logo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="sidebar-subtitulos">Datos generales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p class="sidebar-subtitulos">Clases en video</p>
                </a>
              </li>
            </ul>
          </li>
 
          <li class="nav-header sidebar-titulos">
            GRÁFICAS
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="sidebar-subtitulos">Importante</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p class="sidebar-subtitulos">Peligro</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p class="sidebar-subtitulos">Correcto</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

</template>

<script>
export default {
    props: ['ruta', 'usuario', 'listPermisos', 'numeros'],
    data () {
            return { 
                        btn_estado: 0,
                        tm: {
                                btn_login:{},
                                btn_save: {},
                                btn_new: {},
                                btn_edit: {},
                                btn_orden: {},
                                btn_save_orden: {},
                                cprimario: {},
                                csecundario: {},
                                cpuente: {},
                                titulo: {},
                                btn_del: {},
                                btn_subir: {},
                                btn_bajar: {},
                                neutro: {},
                        },
                    };
        },
    methods: {
      tema(){
                    
                    let url = '/api/config/tema';
                    axios.post(url).then(response => {             
    
                            this.tm.btn_login = response.data[0];
                            this.tm.btn_save = response.data[1];
                            this.tm.btn_new = response.data[2];
                            this.tm.btn_edit = response.data[3];
                            this.tm.btn_orden = response.data[4];
                            this.tm.btn_save_orden = response.data[5];
                            this.tm.cprimario = response.data[6];
                            this.tm.csecundario = response.data[7];
                            this.tm.cpuente = response.data[8];               
                            this.tm.titulo = response.data[9];               
                            this.tm.btn_del = response.data[10];               
                            this.tm.btn_subir = response.data[11];               
                            this.tm.btn_bajar = response.data[12];               
                            this.tm.neutro = response.data[13];               
                           
                    });
      },
      logout(){
          console.log('logout');
          let url = '/administracion/authenticate/logout';
          axios.post(url).then(response => {
            
            if(response.data.code == 204){
                console.log('cierre session');
                sessionStorage.removeItem('UserAutenticado');
                this.$router.push({name: 'start.login'});
                location.reload();
            }                  
          });

      }
    },
    mounted () {
      console.log('componente sideBar');
      this.tema();
    },

}
</script>

<style lang="scss">    
  .badge-info {
    color: #fff;
    background-color: #1bc6ff;
  }
</style>