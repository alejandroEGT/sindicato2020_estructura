export default {
  data() {
    return {
      loading1: false,
      loading2: false,
      loading3: false,
      progress: false,
      showing: false,
      fecha: null,
      hora: null,
      titulo: null,
      cuerpo: null,
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

    guardar() {
      const data = {
        'fecha': this.fecha,
        'hora': this.hora,
        'titulo': this.titulo,
        'cuerpo': this.cuerpo
      }

      axios.post('api/ingresar_reunion', data).then((res) => {
        if (res.data.estado = 'success') {
          this.limpiar();
          this.$q.notify({
            color: "green-4",
            textColor: "white",
            icon: "cloud_done",
            message: res.data.mensaje
          });
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

    limpiar() {
      this.fecha = '';
      this.hora = '';
      this.titulo = '';
      this.cuerpo = '';
    },

    traer_reuniones() {
      this.$router.push('/traer-reuniones');
    }

  }
}
