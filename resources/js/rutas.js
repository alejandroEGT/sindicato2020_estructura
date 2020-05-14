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
import Socios from './components/auth/socios/socios.vue';
import crear_socios from './components/auth/socios/crear_socio.vue';
import listar_socios from './components/auth/socios/listar_socios.vue';
import beneficio_socios from './components/auth/socios/beneficio_socio.vue';
// import crearCuenta from './components/auth/cuentas/crearCuenta.vue';
// import listarCuenta from './components/auth/cuentas/listarCuenta.vue';

// beneficio_sociossocio
import AuthSocio from "./components/auth_socio/auth_socio.vue";
import IndexSocio from "./components/auth_socio/index_socio.vue";

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

  //PORTAL ADMINISTRATIVO
  {
    path: '/home',
    component: Auth,
    name: 'Administration',
    redirect: 'index',
    iconCls: 'el-icon-message',
    meta: { auth: ['1','3'] },
    children: [

        { path: '/index', component: Index, name: 'Index' },
        { path: '/mi-perfil', component: MiPerfil, name: 'miPerfil' },
      //socios
      { path: '/socios', component: Socios, name: 'socios' },
      { path: '/crear_socios', component: crear_socios, name: 'crear_socios' },
      { path: '/listar_socios', component: listar_socios, name: 'listar_socios' },
      { path: '/beneficio_socios', component: beneficio_socios, name: 'beneficio_socios' },

    ]
  },

 //PORTAL SOCIO
  {
    path: '/inicio',
    component: AuthSocio,
    name: 'Socio',
    redirect: 'index',
    iconCls: 'el-icon-message',
    meta: { auth: ['2','3'] },
    children: [

      { path: '/index_socio', component: IndexSocio, name: 'IndexSocio' },
      { path: '/mi-perfil', component: MiPerfil, name: 'miPerfil' },
      //socios
      { path: '/socios_xx', component: Socios, name: 'socios' },
      { path: '/crear_socios', component: crear_socios, name: 'crear_socios' },
      

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