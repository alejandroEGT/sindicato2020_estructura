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
            idCliente: '0',
            selectTipoDeuda: [],
            tipoDeuda: '',
            traerDeudas: 'todos',
            listarDeudaCliente: [],




            visibleColumns: [
                'id',
                'rut',
                'cliente',
                'tipo',
                'descripcion',
                'monto',
                'fecha',
                'opcion',
                'estado_deuda'
            ],

            clientes: [
                { classes: 'ellipsis', name: 'id', align: 'center', label: 'ID', field: 'id', sortable: true },
                { classes: 'ellipsis', name: 'rut', align: 'center', label: 'Rut', field: 'rut', sortable: true },
                { classes: 'ellipsis', name: 'cliente', align: 'center', label: 'Cliente', field: 'cliente', sortable: true },
                { classes: 'ellipsis', name: 'tipo', align: 'center', label: 'Tipo de Deuda', field: 'tipo', sortable: true },
                { classes: 'ellipsis', name: 'descripcion', align: 'center', label: 'Descripción', field: 'descripcion', sortable: true },
                { classes: 'ellipsis', name: 'monto', align: 'center', label: 'Monto', field: 'monto', sortable: true },
                { classes: 'ellipsis', name: 'fecha', align: 'center', label: 'Fecha de Tope', field: 'fecha', sortable: true },
                { classes: 'ellipsis', name: 'opcion', align: 'center', label: 'Opcion', field: 'opcion', sortable: true },
                { classes: 'ellipsis', name: 'estado_deuda', align: 'center', label: 'Estado de Deuda', field: 'estado_deuda', sortable: true },

            ],
        }
    },

    methods: {

        url_volver2() {
            this.$router.push('/modulo-clientes');
        },
        url_registro() {
            this.$router.push('/deudas-clientes');
        },
        url_registro_nuevo_cliente() {
            this.$router.push('/registro-clientes');
        },

        traer_cliente() {
            axios.get('api/buscar_cliente/' + this.buscadorCliente).then((response) => {

                if (this.buscadorCliente == '') {
                    this.$q.notify({
                        color: "orange-8",
                        textColor: "white",
                        icon: "error_outline",
                        message: "El campo no puede quedar vacio, ingrese un rut porfavor."
                    });
                } else {

                    if (response.data.estado == 'success') {

                        this.rutCliente = response.data.cliente['rut'];
                        this.nombreCliente = response.data.cliente['cliente_deuda'];
                        this.idCliente = response.data.cliente['id'];
                        this.listar_deudas_cliente();

                    }
                    else {

                        if (response.data.estado == 'failed_c') {

                            this.$q.notify({
                                color: "orange-8",
                                textColor: "white",
                                icon: "error_outline",
                                message: response.data.mensaje
                            });

                        } else {
                            if (response.data.estado == 'failed') {
                                this.$q.notify({
                                    color: "orange-8",
                                    textColor: "white",
                                    icon: "error_outline",
                                    message: response.data.mensaje,
                                    timeout: 10000,
                                    actions:
                                        [{
                                            label: 'Ingresar Cliente',
                                            color: 'white',
                                            handler: () => {
                                                this.url_registro_nuevo_cliente()
                                            }
                                        }]


                                });
                            }


                        }
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
            axios.get('api/deudas_cliente/' + this.idCliente + '/' + this.traerDeudas).then((response) => {

                if (response.data.estado == 'success') {
                    this.listarDeudaCliente = response.data.cliente;
                    this.buscadorCliente = '';

                } else {
                    this.$q.notify({
                        color: "red-4",
                        textColor: "white",
                        icon: "error_outline",
                        message: response.data.mensaje,
                        actions:
                                        [{
                                            label: 'refrescando...',
                                            color: 'white',
                                            handler: ( this.onRefresh())
                                        }]
                    });

                    this.rutCliente = '';
                    this.nombreCliente = '';
                    this.idCliente = '';
                    this.listarDeudaCliente = [];
                    // this.onRefresh();

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
                if (response.data.estado == 'failed_p') {
                    this.$q.notify({
                        color: "orange-8",
                        textColor: "white",
                        icon: "info",
                        message: response.data.mensaje
                    });
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

        pagar_deuda(id) {

            const data = {
                'id': id,
            }
            this.loading = true;
            axios.post('api/pagar_deuda', data).then((response) => {
                if (response.data.estado == 'success') {
                    this.$q.notify({
                        color: "green-4",
                        textColor: "white",
                        icon: "cloud_done",
                        message: response.data.mensaje
                    });
                    this.loading = false;
                    this.listar_deudas_cliente();
                }
                if (response.data.estado == 'failed') {
                    this.$q.notify({
                        color: "red-4",
                        textColor: "white",
                        icon: "delete_forever",
                        message: response.data.mensaje
                    });
                    this.loading = false;
                }
                if (response.data.estado == 'failed_p') {
                    this.$q.notify({
                        color: "orange-8",
                        textColor: "white",
                        icon: "info",
                        message: response.data.mensaje
                    });
                    this.loading = false;
                }

            })
                .catch(error => {
                    alert(error);

                })
        },


        onRefresh() {
            this.loading = true;
            this.rutCliente = '';
            this.nombreCliente = '';
            this.idCliente = '0';
            this.traerDeudas = 'todos',
                this.listarDeudaCliente = [];
            this.errores = [];
            this.listar_deudas_cliente();

            setTimeout(() => {
                this.loading = false;
            }, 5000)
        },

        show(modal) {
            this.$modal.show(modal);
        },

        hide(modal) {
            this.$modal.hide(modal);
        },

        formatPrice(value) {
            let val = (value / 1).toFixed(0).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },

        formateaRut(rut) {

            var actual = rut.replace(/^0+/, "");
            if (actual != '' && actual.length > 1) {
                var sinPuntos = actual.replace(/\./g, "");
                var actualLimpio = sinPuntos.replace(/-/g, "");
                var inicio = actualLimpio.substring(0, actualLimpio.length - 1);
                var rutPuntos = "";
                var i = 0;
                var j = 1;
                for (i = inicio.length - 1; i >= 0; i--) {
                    var letra = inicio.charAt(i);
                    rutPuntos = letra + rutPuntos;
                    if (j % 3 == 0 && j <= inicio.length - 1) {
                        rutPuntos = "." + rutPuntos;
                    }
                    j++;
                }
                var dv = actualLimpio.substring(actualLimpio.length - 1);
                rutPuntos = rutPuntos + "-" + dv;
            }
            return rutPuntos;
        },

    },

    mounted() {
        this.actualizar_tipo_deudas();
        this.listar_deudas_cliente();
    }
}