import NotFound from '../components/404.vue'
//loged


import Auth from "../components/auth/auth.vue";
import ModuloProveedores from "../components/auth/proveedores/proveedores_vue/modulo_proveedor.vue";
import RegistroProveedor from "../components/auth/proveedores/proveedores_vue/registro_proveedores.vue";
import TablaProveedor from "../components/auth/proveedores/proveedores_vue/tabla_proveedor.vue";
import VerProveedor from "../components/auth/proveedores/proveedores_vue/ver_proveedor.vue";

//Reuniones
import ModuloReunion from "../components/auth/reuniones/reuniones_vue/modulo_reuniones.vue";
import CrearReunion from "../components/auth/reuniones/reuniones_vue/crear_reunion.vue";
import TraerReuniones from "../components/auth/reuniones/reuniones_vue/traer_reuniones.vue";

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
            { path: '/ingreso_proveedor', component: RegistroProveedor, name: 'RegistroProveedor' },
            { path: '/listar_proveedor', component: TablaProveedor, name: 'TablaProveedor' },
            { path: '/modulo-reunion', component: ModuloReunion, name: 'ModuloReunion' },
            { path: '/crear-reunion', component: CrearReunion, name: 'CrearReunion' },
            { path: '/traer-reuniones', component: TraerReuniones, name: 'TraerReuniones' },
            { path: '/ver-provedor', component: VerProveedor, name: 'VerProveedor' },
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