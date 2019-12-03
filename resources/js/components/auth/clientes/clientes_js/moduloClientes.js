export default {

    data() {
        return {
            //variables
        }
    },

    methods: {
        url_registro_clientes() {
            this.$router.push('/registro-clientes');
        },
        url_listado_clientes() {
            this.$router.push('/listar-clientes');
        },
        url_index() {
            this.$router.push('/index');
        },
        url_deudas_clientes() {
            this.$router.push('/deudas-clientes');
        },
        url_listado_deudas_clientes() {
            this.$router.push('/listar-deudas-clientes');
        }

    }

}