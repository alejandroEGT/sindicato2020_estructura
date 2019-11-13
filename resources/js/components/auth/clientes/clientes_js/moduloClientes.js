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
        }

    }

}