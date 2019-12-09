export default {
    methods: {
        crear_reunion() {
            this.$router.push('/crear-reunion');
        },

        traer_reuniones(){
            this.$router.push('/traer-reuniones');
        },

        volver() {
            this.$router.push('/index');
          }

    }

}