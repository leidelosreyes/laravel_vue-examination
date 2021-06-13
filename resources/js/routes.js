import AllProducts from './components/admin/IndexComponent';
import Vue from 'vue';
import CreateProducts from './components/admin/CreateProduct';
import EditProducts from './components/admin/EditProduct';
import VideoPlayer from './components/admin/VideoPlayer';
import VueRouter from 'vue-router';
Vue.use(VueRouter)

const routes = [
    {
        name: '/',
        path: '/',
        component:AllProducts
    },
    {
        name: 'create',
        path: '/create',
        component:CreateProducts
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component:EditProducts
    },
    {
        name: 'video_player',
        path: '/videoplayer',
        component:VideoPlayer
    }
];
export default new VueRouter({routes});