export default {
    data () {
      return {
        loading1: false,
        loading2: false,
        loading3: false,
        progress: false,
        showing: false,
        fechaNac: '',
        rut:'',
        nombres: '',
        aPaterno: '',
        aMaterno:''
      }
    },
  
    methods: {
      simulateProgress (number) {
        // we set loading state
        this[`loading${number}`] = true
        // simulate a delay
        setTimeout(() => {
          // we're done, we reset loading state
          this[`loading${number}`] = false
        }, 3000)
      },

      url_volver() {
        this.$router.push('/modulo-clientes');
    },
    url_listado_clientes() {
      this.$router.push('/listar-clientes');
  },

    }

  }