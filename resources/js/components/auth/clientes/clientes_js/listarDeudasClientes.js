import Axios from "axios";
import { METHODS } from "http";

export default{

    data(){
        return{
            separator: 'cell',
            loading: false,
            confirm: false,
            filter: '',
            campoUpd: '',
            errores: [ ],

            visibleColumns: [
                'id',
                'fecha_nacimiento',
                'rut',
                'nombres',
                'apellido_paterno',
                'apellido_materno',
                'opcion'
            ],

            clientes: [
                { classes: 'ellipsis', name: 'id', align: 'center', label: 'id', field: 'id', sortable: true },
                { classes: 'ellipsis', name: 'fecha_nacimiento', align: 'center', label: 'Fecha de Nacimiento', field: 'fecha_nacimiento', sortable: true },
                { classes: 'ellipsis', name: 'rut', align: 'center', label: 'Rut', field: 'rut', sortable: true },
                { classes: 'ellipsis', name: 'nombres', align: 'center', label: 'Nombres', field: 'nombres', sortable: true },
                { classes: 'ellipsis', name: 'apellido_paterno', align: 'center', label: 'Apellido Paterno', field: 'apellido_paterno', sortable: true },
                { classes: 'ellipsis', name: 'apellido_materno', align: 'center', label: 'Apellido Materno', field: 'apellido_materno', sortable: true },
                { classes: 'ellipsis', name: 'opcion', align: 'center', label: 'Opcion', field: 'opcion', sortable: true },

            ],
            listarClientes: [],

        }
    },

    methods: {

        url_volver2() {
            this.$router.push('/modulo-clientes');
        },
        url_registro() {
            this.$router.push('/deudas-clientes');
        },

        onRefresh() {
            this.loading = true;
            this.traer_clientes();
            setTimeout(() => {
                this.loading = false;
            }, 5000)
        },

    },

    mounted() {

    }
}