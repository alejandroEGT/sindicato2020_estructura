export default {
    data() {
        return {
            columns: [
                {
                    name: 'id',
                    align: 'center',
                    label: 'ID',
                    field: 'id',
                    sortable: true
                },
                {
                    name: 'fecha_inicio',
                    align: 'center',
                    label: 'Fecha Reunion',
                    field: 'fecha_inicio',
                    sortable: true
                },
                { name: 'titulo', align: 'center', label: 'Titulo', field: 'titulo', sortable: true },
                { name: 'creada_por', align: 'center', label: 'Creada por', field: 'creada_por', sortable: true },
                {
                    name: 'created_at',
                    align: 'center',
                    label: 'Creada',
                    field: 'created_at',
                    sortable: true
                },
                {
                    name: 'opciones',
                    align: 'center',
                    label: 'Opciones',
                    field: 'opciones',
                    sortable: true
                },
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
