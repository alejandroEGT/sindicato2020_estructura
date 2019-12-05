import NotFound from '../components/404.vue'
//loged

import Auth from "../components/auth/auth.vue";
import ModuloCuentas from "../components/auth/cuentas/cuentas_vue/modulo_cuentas.vue";
import CrearCuenta from "../components/auth/cuentas/cuentas_vue/crear_cuenta.vue";
import ListarCuenta from "../components/auth/cuentas/cuentas_vue/listar_cuenta.vue";
import Formulario from "../components/auth/cuentas/cuentas_vue/formulario.vue";
import Liquidaciones from "../components/auth/liquidaciones/liquidaciones_vue/modulo_liquidaciones.vue";
import FormularioLiq from "../components/auth/liquidaciones/liquidaciones_vue/formulario_liquidaciones.vue";
import Detalle_H_D from "../components/auth/liquidaciones/liquidaciones_vue/detalle_haberes_descuentos.vue";
import ListarLiqu from "../components/auth/liquidaciones/liquidaciones_vue/listar.vue"

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
        { path: '/modulo-liquidaciones', component: Liquidaciones, name: 'Liquidaciones' },
        //aqui las rutas con permiso de auth
        { path: '/crear-cuenta', component: CrearCuenta, name: 'CrearCuenta' },
        { path: '/listar-cuenta', component: ListarCuenta, name: 'ListarCuenta' },
        { path: '/formulario-cuenta', component: Formulario, name: 'Formulario' },
        { path: '/formulario-liquidaciones', component: FormularioLiq, name: 'FormularioLiq' },
        { path: '/detalle-haberes-descuentos', component: Detalle_H_D, name: 'Detalle_H_D' },
        { path: '/listar-liquidaciones', component: ListarLiqu, name: 'ListarLiqu' },
        
       
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