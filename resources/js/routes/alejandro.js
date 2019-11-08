import NotFound from '../components/404.vue'
//loged

import Auth from "../components/auth/auth.vue";
import ModuloCuentas from "../components/auth/cuentas/cuentas_vue/modulo_cuentas.vue";
import CrearCuenta from "../components/auth/cuentas/cuentas_vue/crear_cuenta.vue";
import ListarCuenta from "../components/auth/cuentas/cuentas_vue/listar_cuenta.vue";


let routes_empa = [

{
    path: '/home',
    component: Auth,
    name: 'Administration',
    redirect: 'index',
    iconCls: 'el-icon-message',
    meta: { auth: true },
    children: [
        { path: '/modulo-cuentas', component: ModuloCuentas, name: 'ModuloCuentas' },
        //aqui las rutas con permiso de auth
        { path: '/crear-cuenta', component: CrearCuenta, name: 'CrearCuenta' },
        { path: '/listar-cuenta', component: ListarCuenta, name: 'ListarCuenta' },
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