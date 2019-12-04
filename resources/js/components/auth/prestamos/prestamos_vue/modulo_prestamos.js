import Axios from "axios";

export default {
  data() {
    return {
      //VARIABLES PARA EL STEPPER FORMULARIO
      step: 1,
      rut: '',
      monto: null,
      tipo: '1',
      interes: null,
      valorConInteres: 0,
      fecha: '',
      //VARIABLES QUE RESCATAN AL USUARIO
      usuario: ''
    };
  },
  methods: {
    calcularIntereses() {
      console.log(this.monto, this.interes);
      this.valorConInteres = parseInt(this.monto) + parseInt(this.monto * (this.interes / 100));
      console.log(this.valorConInteres);
      console.log('step: ' + this.step);
    },

    getUsuario() {
      Axios.get('api/getClientePrestamo/' + this.rut).then((response) => {
        if (response.data.estado == 'failed' || response.data.estado == 'failed_v') {
          alert(response.data.mensaje);
        } else if (response.data.estado == 'failed_unr') {
          this.$q.notify({
            color: "green-4",
            textColor: "white",
            icon: "cloud_done",
            message: response.data.mensaje
          });
        } else {
          this.usuario = response.data.cliente;
          console.log(response);
        }
      });
    },

    setPrestamo() {
      this.calcularIntereses();

      const data = {
        'idCliente': this.usuario.id,
        'idTipo': this.tipo,
        'fecha': this.fecha,
        'montoSolicitado': this.monto,
        'totalInteres': this.valorConInteres
      }

      Axios.post('api/setPrestamo', data).then((response) => {
        if (response.data.estado == 'failed' || response.data.estado == 'failed_v') {
          this.$q.notify({
            color: "red-4",
            textColor: "white",
            icon: "cloud_done",
            message: response.data.mensaje
          });
        } else {
          this.$q.notify({
            color: "green-4",
            textColor: "white",
            icon: "cloud_done",
            message: response.data.mensaje
          });
        }
      });
    }
  },
};