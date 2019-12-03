export default {
    data() {
        return {
            separator: 'cell',
            loading: false,
            confirm: false,
            filter: '',
            campoUpd: '',
            errores: [],

            visibleColumns: [
                'id',
                'fecha_inicio',
                'titulo',
                'creada_por',
                'created_at',
                'opcion',
            ],
            tabla: [
                { classes: 'ellipsis', name: 'id', align: 'center', label: 'id', field: 'id', sortable: true },
                { classes: 'ellipsis', name: 'fecha_inicio', align: 'center', label: 'Fecha Reunion', field: 'fecha_inicio', sortable: true },
                { classes: 'ellipsis', name: 'titulo', align: 'center', label: 'Titulo', field: 'titulo', sortable: true },
                { classes: 'ellipsis', name: 'creada_por', align: 'center', label: 'Creada por:', field: 'creada_por', sortable: true },
                { classes: 'ellipsis', name: 'created_at', align: 'center', label: 'Creada', field: 'created_at', sortable: true },
                { classes: 'ellipsis', name: 'opcion', align: 'center', label: 'Opciones', field: 'opcion', sortable: true },

            ],
            reuniones: [],

        }
    },

    methods: {
        traerReuniones() {
            axios.get('api/traer_reuniones').then((res) => {
                if (res.data.estado = 'success') {
                    this.reuniones = res.data.reuniones;
                } else {
                    this.$q.notify({
                        color: "red-4",
                        textColor: "white",
                        icon: "cloud_done",
                        message: res.data.mensaje
                    });
                }
            });
        },

    },

    mounted() {
        this.traerReuniones();
    }
}
