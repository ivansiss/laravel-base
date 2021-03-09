

require('./bootstrap');

window.Vue = require('vue');

import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use( CKEditor );

import VueMask from 'v-mask';
Vue.use( VueMask );

export const EventBus = new Vue();
window.EventBus = EventBus;


Vue.component('btns-component', require('./components/plantilla/Btns.vue').default);
Vue.component('spinner-component', require('./components/plantilla/Spinner.vue').default);

Vue.component('App', require('./components/App.vue').default);
Vue.component('Auth', require('./components/Auth.vue').default);

Vue.component('example-component', require('./components/modulos/ExampleComponent').default);

Vue.component('usuarios-base-component', require('./components/modulos/cliente/BaseUsuariosComponent').default);
Vue.component('usuarios-component', require('./components/modulos/cliente/UsuariosComponent').default);
Vue.component('login-component', require('./components/modulos/authenticate/LoginComponent').default);


Vue.component('roles-base-component', require('./components/modulos/rol/BaseRolesComponent').default);
Vue.component('roles-component', require('./components/modulos/rol/RolesComponent').default);

Vue.component('permisos-base-component', require('./components/modulos/permiso/BasePermisosComponent').default);
Vue.component('permisos-component', require('./components/modulos/permiso/PermisosComponent').default);

Vue.component('imagenes-base-component', require('./components/modulos/galeria/ImagenesBaseComponent').default);
Vue.component('image-list-component', require('./components/modulos/galeria/ImageListComponent').default);
Vue.component('image-new-component', require('./components/modulos/galeria/ImageNewComponent').default);
Vue.component('image-list-item-Component', require('./components/modulos/galeria/ImageListItemComponent').default);

Vue.component('videos-base-component', require('./components/modulos/videos/VideosBaseComponent').default);
Vue.component('video-list-component', require('./components/modulos/videos/VideoListComponent').default);
Vue.component('video-list-item-Component', require('./components/modulos/videos/VideoListItemComponent').default);

Vue.component('search-component', require('./components/modulos/busqueda/SearchComponent').default);
Vue.component('pagination-link', require('./components/modulos/PaginationLinksComponent').default);
Vue.component('paginator-component', require('./components/modulos/PaginatorComponent').default);

Vue.component('paginas-list-component', require('./components/modulos/paginas/PaginasListComponent').default);
Vue.component('tipo-pag-component', require('./components/modulos/paginas/PagComponent').default);
Vue.component('tipo-pag-una-component', require('./components/modulos/paginas/PagUnaComponent').default);
Vue.component('tipo-pag-tres-component', require('./components/modulos/paginas/PagTresComponent').default);
Vue.component('tipo-pag-slider-component', require('./components/modulos/paginas/PagSliderComponent').default);
Vue.component('tipo-pag-grid-component', require('./components/modulos/paginas/PagGridComponent').default);


Vue.component('post-list-component', require('./components/modulos/post/PostListComponent').default);
Vue.component('post-new-component', require('./components/modulos/post/PostNewComponent').default);
Vue.component('tipo-post-component', require('./components/modulos/post/PostComponent').default);
Vue.component('tipo-post-una-component', require('./components/modulos/post/PostUnaComponent').default);
Vue.component('tipo-post-tres-component', require('./components/modulos/post/PostTresComponent').default);
Vue.component('tipo-post-slider-component', require('./components/modulos/post/PostSliderComponent').default);
Vue.component('tipo-post-grid-component', require('./components/modulos/post/PostGridComponent').default);
Vue.component('modal-post', require('./components/modulos/post/PostModalComponent').default);
Vue.component('select-component', require('./components/modulos/post/SelectComponent').default);

Vue.component('product-list-component', require('./components/modulos/producto/ProductListComponent').default);
Vue.component('product-list-item-component', require('./components/modulos/producto/ProductListItemComponent').default);
Vue.component('product-base-component', require('./components/modulos/producto/ProductosBaseComponent').default);
Vue.component('product-new-component', require('./components/modulos/producto/ProductoNewComponent').default);
Vue.component('select-producto-component', require('./components/modulos/producto/SelectProductoComponent').default);

Vue.component('pie-component', require('./components/modulos/pie/PieComponent').default);

Vue.component('seo-component', require('./components/modulos/seo/SeoComponent').default);
Vue.component('seo-new-component', require('./components/modulos/seo/SeoNuevoComponent').default);
Vue.component('seo-edit-component', require('./components/modulos/seo/SeoEditComponent').default);


Vue.component('error404Component', require('./components/modulos/Error404Component').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import router from './router.js';
import store from './store/index';

const app = new Vue({
    el: '#app',
    router,
    store
});
