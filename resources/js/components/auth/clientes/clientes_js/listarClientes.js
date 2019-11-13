export default {
    data() {
        return {
            separator: 'cell',
            loading: false,
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
            columns: [
                { name: 'id', align: 'center', label: 'id', field: 'id', sortable: true },
                { name: 'fecha_nacimiento', align: 'center', label: 'Fecha de Nacimiento', field: 'fecha_nacimiento', sortable: true },
                { name: 'rut', align: 'center', label: 'Rut', field: 'rut', sortable: true },
                { name: 'nombres', align: 'center', label: 'Nombres', field: 'nombres', sortable: true },
                { name: 'apellido_paterno', align: 'center', label: 'Apellido Paterno', field: 'apellido_paterno', sortable: true },
                { name: 'apellido_materno', align: 'center', label: 'Apellido Materno', field: 'apellido_materno', sortable: true },
                { name: 'opcion', align: 'center', label: 'Opcion', field: 'opcion', sortable: true },

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
            //   console.log(data);
            //   return false;
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
                if (response.data.estado == 'failed_v') {
                    this.errores = response.data.mensaje;
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

        onRefresh() {
            this.loading = true;
            this.traer_clientes();
            setTimeout(() => {
                this.loading = false;
            }, 5000)
        },

    },

    mounted() {
        this.traer_clientes();
    },

}
