export default {
    data() {
        return {
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
                { classes: 'ellipsis', name: 'id', align: 'center', label: 'ID', field: 'id', sortable: true },
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
            this.$router.push('/registro-clientes');
        },

        traer_clientes() {
            this.loading = true;
            axios.get('api/listar_cliente').then((res) => {
                this.listarClientes = res.data[0];
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
            axios.post('api/actualizar_campo_cliente', data).then((response) => {
                if (response.data.estado == 'success') {
                    this.$q.notify({
                      color: "green-4",
                      textColor: "white",
                      icon: "cloud_done",
                      message: response.data.mensaje
                    });
                    this.campoUpd = '';
                    this.loading = false
                    this.traer_clientes();
                }
                if (response.data.estado == 'failed') {
                    this.$q.notify({
                      color: "red-4",
                      textColor: "white",
                      icon: "cloud_done",
                      message: response.data.mensaje
                    });
                    this.campoUpd = '';
                    this.errores = [];
                    this.loading = false
                }
                if (response.data.estado == 'failed_v') {
                    this.$q.notify({
                        color: "red-4",
                        textColor: "white",
                        icon: "cloud_done",
                        message: response.data.mensaje.input[0]
                      });
                    // this.errores = response.data.mensaje;
                    this.campoUpd = '';
                    this.loading = false;
                  }
                })
                .catch(error => {
                    // alert("El Campo no puede quedar vacio.");
                    alert(error);
                    this.loading = false;
                })
        },

        eliminar_cliente_estado(id){

            const data = {
                'id': id,
            }
            this.loading = true;
            axios.post('api/eliminar_cliente',data).then((response) => {
                if (response.data.estado == 'success') {
                    this.$q.notify({
                      color: "green-4",
                      textColor: "white",
                      icon: "delete_forever",
                      message: response.data.mensaje
                    });
                    this.loading = false;
                    this.traer_clientes();
                }else{
                    this.$q.notify({
                        color: "red-4",
                        textColor: "white",
                        icon: "delete_forever",
                        message: response.data.mensaje
                      });
                      this.loading = false;
                }
                
            })
        },

        show (modal) {
            this.$modal.show(modal);
            },
            hide (modal) {
              this.$modal.hide(modal);
            },

        onRefresh() {
            this.loading = true;
            this.traer_clientes();
            this.errores = [];
            setTimeout(() => {
                this.loading = false;
            }, 5000)
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
        this.traer_clientes();
    },

}
