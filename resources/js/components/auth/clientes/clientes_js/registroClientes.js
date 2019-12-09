import Axios from "axios";
import { all } from "q";

export default {
  data() {
    return {
      loading1: false,
      loading2: false,
      loading3: false,
      progress: false,
      showing: false,
      fechaNac: '',
      rut: '',
      nombres: '',
      aPaterno: '',
      aMaterno: '',
      errores: [ ],

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

    url_listado_clientes() {
      this.$router.push('/listar-clientes');
    },

    registrar_clientes() {
      const data = {
        'fecha_nacimiento': this.fechaNac,
        'rut': this.rut,
        'nombres': this.nombres,
        'apellido_paterno': this.aPaterno,
        'apellido_materno': this.aMaterno
      }
      Axios.post('api/crear_cliente', data).then((response) => {
        if (response.data.estado == 'success') {
          this.$q.notify({
            color: "green-4",
            textColor: "white",
            icon: "cloud_done",
            message: response.data.mensaje
          });

          this.fechaNac = '';
          this.rut = '';
          this.nombres = '';
          this.aPaterno = '';
          this.aMaterno = '';
          this.errores = '';

        }

        if ( response.data.estado == 'failed_v') {
          this.errores = response.data.mensaje;
        }

        if (response.data.estado == 'failed') {
          this.$q.notify({
            color: "red-4",
            textColor: "white",
            icon: "delete_forever",
            message:  response.data.mensaje
          });
          this.errores = '';
        }

      });
    },

  }

}