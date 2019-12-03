import Axios from "axios";
import { METHODS } from "http";

export default {

    data() {
        return {
            separator: 'cell',
            loading: false,
            confirm: false,
            filter: '',
            campoUpd: '',
            errores: [],
            buscadorCliente: '',
            rutCliente: '',
            nombreCliente: '',
            idCliente: '',

            visibleColumns: [
                'id',
                'tipo',
                'descripcion',
                'monto',
                'fecha',
                'opcion'
            ],

            clientes: [
                { classes: 'ellipsis', name: 'id', align: 'center', label: 'id', field: 'id', sortable: true },
                { classes: 'ellipsis', name: 'tipo', align: 'center', label: 'Tipo de Deuda', field: 'deuda', sortable: true },
                { classes: 'ellipsis', name: 'descripcion', align: 'center', label: 'Descripcion', field: 'descripcion', sortable: true },
                { classes: 'ellipsis', name: 'monto', align: 'center', label: 'Monto', field: 'monto', sortable: true },
                { classes: 'ellipsis', name: 'fecha', align: 'center', label: 'Fecha de Tope', field: 'fecha', sortable: true },
                { classes: 'ellipsis', name: 'opcion', align: 'center', label: 'Opcion', field: 'opcion', sortable: true },

            ],
            listarDeudaCliente: [],

        }
    },

    methods: {

        url_volver2() {
            this.$router.push('/modulo-clientes');
        },
        url_registro() {
            this.$router.push('/deudas-clientes');
        },

        traer_cliente() {
            axios.get('api/buscar_cliente/' + this.buscadorCliente).then((response) => {

                if(this.buscadorCliente == ''){
                    this.$q.notify({
                        color: "red-4",
                        textColor: "white",
                        icon: "error_outline",
                        message: "El campo no puede quedar vacio, ingrese un rut porfavor."
                    });
                }else{

                if (response.data.estado == 'success') {

                    this.rutCliente = response.data.cliente['rut'];
                    this.nombreCliente = response.data.cliente['cliente_deuda'];
                    this.idCliente = response.data.cliente['id'];
                    this.listar_deudas_cliente();
                    this.$q.notify({
                        color: "green-4",
                        textColor: "white",
                        icon: "cloud_done",
                        message: "Este cliente si posee deudas, se estan cargando la informacion."
                    });
                    
                } else {
                    this.$q.notify({
                        color: "red-4",
                        textColor: "white",
                        icon: "error_outline",
                        message: response.data.mensaje
                    });

                }
            }

            })
                .catch(error => {
                    alert(error);
                    this.loading = false
                })
        },

        listar_deudas_cliente() {
            this.loading = true;
            axios.get('api/deudas_cliente/' + this.idCliente).then((response) => {

                if (response.data.estado == 'success') {
                    this.listarDeudaCliente = response.data.cliente;
                    this.buscadorCliente = '';

                } else {
                    this.$q.notify({
                        color: "red-4",
                        textColor: "white",
                        icon: "error_outline",
                        message: response.data.mensaje
                    });

                    this.rutCliente = '';
                    this.nombreCliente = '';
                    this.idCliente = '';
                    this.listarDeudaCliente = [];

                }
                this.loading = false;
            })
                .catch(error => {
                    alert(error);
                    this.loading = false
                })

        },


        onRefresh() {
            this.loading = true;
            this.rutCliente = '';
            this.nombreCliente = '';
            this.idCliente = '';
            this.listarDeudaCliente = [];
            this.$q.notify({
                color: "green-4",
                textColor: "white",
                icon: "cloud_done",
                message: "Datos limpiados, si desea ver un nuevo cliente ingrese nuevamente el rut correspondiente."
            });
            

            setTimeout(() => {
                this.loading = false;
            }, 5000)
        },

    },

    mounted() {

    }
}