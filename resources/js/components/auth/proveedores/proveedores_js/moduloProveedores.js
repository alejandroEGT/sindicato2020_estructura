export default {
    methods: {
        crear_reunion() {
            this.$router.push('/ingreso_proveedor');
        },

        traer_reuniones() {
            this.$router.push('/listar_proveedor');
        },

        volver() {
            this.$router.push('/index');
        }

    }

}
