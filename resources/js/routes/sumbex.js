import NotFound from '../components/404.vue'
//loged


import Auth from "../components/auth/auth.vue";
import ModuloProveedores from "../components/auth/proveedores/proveedores_vue/modulo_proveedor.vue";

let routes_sumbex = [

{
    path: '/home',
    component: Auth,
    name: 'Administration',
    redirect: 'index',
    iconCls: 'el-icon-message',
    meta: { auth: true },
    children: [
        { path: '/modulo-proveedor', component: ModuloProveedores, name: 'ModuloProveedores' },
        //aqui las rutas con permiso de auth
    ]
},
{
    path: '/404',
    component: NotFound,
    name: '',
    hidden: true
},
{
    path: '*',
    hidden: true,
    redirect: { path: '/404' }
}     


];

export default routes_sumbex;