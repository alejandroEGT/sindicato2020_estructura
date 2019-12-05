import NotFound from '../components/404.vue'
//loged

import Auth from "../components/auth/auth.vue";
import ModuloPrestamos from "../components/auth/prestamos/prestamos_vue/modulo_prestamos.vue";
import PagoPrestamo from "../components/auth/prestamos/pagoPrestamo/pagoPrestamo.vue"

let routes_empa = [

{
    path: '/home',
    component: Auth,
    name: 'Administration',
    redirect: 'index',
    iconCls: 'el-icon-message',
    meta: { auth: true },
    children: [
        { path: '/modulo-prestamos', component: ModuloPrestamos, name: 'ModuloPrestamos' },
        { path: '/pago-prestamos', component: PagoPrestamo, name: 'PagoPrestamo'}
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

export default routes_empa;