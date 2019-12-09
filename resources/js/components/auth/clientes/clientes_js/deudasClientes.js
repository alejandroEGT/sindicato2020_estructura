import Axios from "axios";

export default {
  data() {
    return {
      loading1: false,
      loading2: false,
      loading3: false,
      selectClientes: [],
      selectTipoDeuda: [],
      errores: [],
      clientes: '',
      tipoDeuda: '',
      monto: '',
      descripcion: '',
      fechaTope: '',
      options: []

    }
  },

  methods: {
    simulateProgress(number) {
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
    url_listar_deudas_clientes() {
      this.$router.push('/listar-deudas-clientes');
    },

    mostrar_clientes_deudas() {
      axios.get('api/traer_clientes_deudas').then((response) => {
        this.selectClientes = response.data;
        this.options = this.selectClientes;
      })
        .catch(error => {
          alert(error);

        })
    },

    mostrar_tipo_deudas() {
      axios.get('api/traer_tipo_deuda').then((response) => {
        this.selectTipoDeuda = response.data;
      })
        .catch(error => {
          alert(error);

        })
    },

    registrar_clientes_deudas() {
      const data = {
        'cliente_id': this.clientes.id,
        'tipo_deuda_id': this.tipoDeuda.id,
        'monto': this.monto,
        'descripcion': this.descripcion,
        'fecha': this.fechaTope
      }
      Axios.post('api/registro_cliente_deudas', data).then((response) => {
        if (response.data.estado == 'success') {
          this.$q.notify({
            color: "green-4",
            textColor: "white",
            icon: "cloud_done",
            message: response.data.mensaje
          });

          this.clientes = '';
          this.tipoDeuda = '';
          this.monto = '';
          this.descripcion = '';
          this.fechaTope = '';


        }
        if (response.data.estado == 'failed_v') {
          this.errores = response.data.mensaje;
        }


      });
    },

    filterFn (val, update) {
      console.log(this.filterFn);
      update(() => {
        const needle = val.toLowerCase();
        console.log(needle);
        this.options = this.selectClientes.filter(v => v.cliente_deuda.toLowerCase().indexOf(needle) > -1);
      })
    },
  
  },

  mounted() {
    this.mostrar_clientes_deudas();
    this.mostrar_tipo_deudas();
  },

}