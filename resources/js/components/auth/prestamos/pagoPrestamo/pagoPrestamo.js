import Axios from 'axios';

export default {
  data() {
    return {
      //VARIABLE PARA ALMACENAR LOS PRESTAMOS DEL CLIENTE
      prestamos: '',
      step: 1,
      rut: '',
      monto: null,
      cuotas: null,
      idPrestamo: '1',
      interes: null,
      valorConInteres: 0,
      fecha: '',
      //variable para almacenar las cuotas pagadas
      cuotasPagadas: '',
      //variable para resultados de confirmacion
      montoMenosCuota: null,
      //VARIABLES QUE RESCATAN AL USUARIO
      usuario: '',
      //variable modal
      confirm: false,
      //VARIABLES PARA EL RESUMEN A PAGAR
      totalCuotas: '',
      restantePorPagar: ''
    }
  },
  methods: {
    getUsuario() {
      Axios.get('api/getClientePrestamo/' + this.rut).then((response) => {
        if (response.data.estado == 'failed' || response.data.estado == 'failed_v') {
          alert(response.data.mensaje);
        } else if (response.data.estado == 'failed_unr') {
          this.confirm = true;
        } else {
          this.usuario = response.data.cliente;
          console.log(response);
        }
      });
    },

    procesarDatos(){
      switch (this.step) {
        case 1:
          this.getPrestamosPorCliente();
          break;
        
        case 2:
          this.getDetallePrestamoPorPrestamo();
          break;

        case 3:
          this.montoMenosCuota = this.restantePorPagar - this.monto;
          break;

        case 4:
          this.montoMenosCuota = this.restantePorPagar - this.monto;
          this.setPagoPrestamo();
          break;

        default:
          break;
      }
    },

    getPrestamosPorCliente() {
      Axios.get('api/getPrestamoPorCliente/' + this.usuario.id).then((response) => {
        if (response.data.estado == 'failed' || response.data.estado == 'failed_v') {
          alert(response.data.mensaje);
        } else {
          this.prestamos = response.data;
          console.log(this.prestamos);
        }
      });
    },

    getDetallePrestamoPorPrestamo(){
      Axios.get('api/getDetallePrestamosPorPrestamo/' + this.idPrestamo).then((response) => {
        if(response.data.estado == 'failed' || response.data.estado == 'failed_v'){
          alert(response.data.mensaje);
        }else{
          this.cuotasPagadas = response.data.cuotasPagadas;
          this.totalCuotas = response.data.totalCuotas;
          this.restantePorPagar = response.data.restante;
        }
      });
    },

    setPagoPrestamo(){

      const data = {
        'fecha': this.fecha,
        'monto': this.monto,
        'idPrestamo': this.idPrestamo
      }

      console.log(data);

      Axios.post('api/setPagoPrestamo', data).then((response) => {
        if(response.data.estado == 'failed' || response.data.estado == 'failed_v'){
          alert(response.data.mensaje);
        }else{
          alert(response.data.mensaje);
        }
      });
    },

    //RUTAS DE DIRECCIONAMIENTO
    url_crear_cliente2() {
      this.$router.push('/registro-clientes');
    },

    formatPrice(value) {
      let val = (value / 1).toFixed(0).replace('.', ',')
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    },

    formateaRut(rut) {

      var actual = rut.replace(/^0+/, "");
      if (actual != '' && actual.length > 1) {
        var sinPuntos = actual.replace(/\./g, "");
        var actualLimpio = sinPuntos.replace(/-/g, "");
        var inicio = actualLimpio.substring(0, actualLimpio.length - 1);
        var rutPuntos = "";
        var i = 0;
        var j = 1;
        for (i = inicio.length - 1; i >= 0; i--) {
          var letra = inicio.charAt(i);
          rutPuntos = letra + rutPuntos;
          if (j % 3 == 0 && j <= inicio.length - 1) {
            rutPuntos = "." + rutPuntos;
          }
          j++;
        }
        var dv = actualLimpio.substring(actualLimpio.length - 1);
        rutPuntos = rutPuntos + "-" + dv;
      }
      return rutPuntos;
    }
  },
};