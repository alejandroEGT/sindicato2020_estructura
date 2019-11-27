import NotFound from '../components/404.vue'
//loged

import Auth from "../components/auth/auth.vue";
import ModuloClientes from "../components/auth/clientes/clientes_vue/modulo_clientes.vue";

//clientes
import RegistroClientes from '../components/auth/clientes/clientes_vue/registroClientes.vue';
import ListarClientes from '../components/auth/clientes/clientes_vue/listarClientes.vue';
import DeudasClientes from '../components/auth/clientes/clientes_vue/deudasClientes.vue';

let routes_empa = [

    {
        path: '/home',
        component: Auth,
        name: 'Administration',
        redirect: 'index',
        iconCls: 'el-icon-message',
        meta: { auth: true },
        children: [
            { path: '/modulo-clientes', component: ModuloClientes, name: 'ModuloClientes' },

            {
                path: '/registro-clientes',
                name: 'registroClientes',
                component: RegistroClientes
            },

            {
                path: '/listar-clientes',
                name: 'listarClientes',
                component: ListarClientes
            },
            {
                path: '/deudas-clientes',
                name: 'deudasClientes',
                component: DeudasClientes
            },

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