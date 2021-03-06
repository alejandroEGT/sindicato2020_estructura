import Outer from './components/outer.vue';
import HomeComponent from './components/Home.vue';
import CreateComponent from './components/Create.vue';
import crearUsuario from './components/usuarios/crearUsuario.vue';
// import EditComponent from './components/EditComponent.vue';


//prestamos
// import CrearPrestamo from './components/auth/prestamos/crear_prestamos.vue';
// import ListarPrestamo from './components/auth/prestamos/listar_prestamos.vue';

//clientes
// import RegistroClientes from './components/auth/clientes/clientes_vue/registroClientes.vue';
// import ListarClientes from './components/auth/clientes/clientes_vue/listarClientes.vue';

//proveedores
// import RegistroProveedor from './components/auth/proveedores/registroProveedor.vue';
// import ListarProveedor from './components/auth/proveedores/listarProveedor.vue';

import Auth from "./components/auth/auth.vue";
import Index from './components/auth/index.vue';
import MiPerfil from './components/auth/perfil.vue';
import NotFound from './components/404.vue';
// import crearCuenta from './components/auth/cuentas/crearCuenta.vue';
// import listarCuenta from './components/auth/cuentas/listarCuenta.vue';

const routes = [
  {
    path: '/',
    component: Outer,
    name: 'Admin',
    redirect: 'home',
    iconCls: 'el-icon-message',
    meta: { auth: false },

    children: [
      {
        name: 'home',
        path: '/',
        component: HomeComponent
      },
      {
        name: 'create',
        path: '/create',
        component: CreateComponent
      },

      {
        path: '/crear-usuario',
        name: 'crearUsuario',
        component: crearUsuario
      },
    ]
  },

  {
    path: '/home',
    component: Auth,
    name: 'Administration',
    redirect: 'index',
    iconCls: 'el-icon-message',
    meta: { auth: true },
    children: [

        { path: '/index', component: Index, name: 'Index' },
        { path: '/mi-perfil', component: MiPerfil, name: 'miPerfil' },

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
    redirect: { path: '/' }
} 

];

export default routes;