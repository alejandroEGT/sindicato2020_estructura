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
            selectTipoDeuda: [],
            tipoDeuda: '',



            visibleColumns: [
                'id',
                'tipo',
                'descripcion',
                'monto',
                'fecha',
                'opcion'
            ],

            clientes: [
                { classes: 'ellipsis', name: 'id', align: 'center', label: 'ID', field: 'id', sortable: true },
                { classes: 'ellipsis', name: 'tipo', align: 'center', label: 'Tipo de Deuda', field: 'tipo', sortable: true },
                { classes: 'ellipsis', name: 'descripcion', align: 'center', label: 'Descripción', field: 'descripcion', sortable: true },
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

        actualizar_dato(id, campo, input) {
            const data = {
                'id': id,
                'campo': campo,
                'input': input,
            }
            this.loading = true;
            axios.post('api/modificar_campo_deuda', data).then((response) => {
                if (response.data.estado == 'success') {
                    this.$q.notify({
                      color: "green-4",
                      textColor: "white",
                      icon: "cloud_done",
                      message: response.data.mensaje
                    });
                    this.campoUpd = '';
                    this.errores = [];
                    this.loading = false
                    this.listar_deudas_cliente();
                }
                if (response.data.estado == 'failed_v') {
                    this.errores = response.data.mensaje;
                    this.campoUpd = '';
                    this.loading = false;
                  }
                })
                .catch(error => {
                    alert(error);
                    this.loading = false;
                })
        },

        actualizar_tipo_deudas() {
            axios.get('api/traer_tipo_deuda').then((response) => {
              this.selectTipoDeuda = response.data;
            })
              .catch(error => {
                alert(error);
      
              })
          },


        onRefresh() {
            this.loading = true;
            this.rutCliente = '';
            this.nombreCliente = '';
            this.idCliente = '';
            this.listarDeudaCliente = [];
            this.errores = [];

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
        this.actualizar_tipo_deudas();
    }
}