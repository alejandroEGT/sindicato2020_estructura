export default {
  data() {
    return {
      nombreCuenta: null,
      descripcionCuenta: null,

      accept: false,

      text: '',
      ph: '',

      dense: false,

      nombre:'', descripcion:''
    };
  },

  methods: {
    onSubmit() {
      const data = {
        'nombre': this.nombre,
        'descripcion': this.descripcion
      }

      axios.post('api/crear_cuenta', data).then((res)=>{
          if (res.data.estado = 'success') {
            this.$q.notify({
            color: "green-4",
            textColor: "white",
            icon: "cloud_done",
            message: "Cuenta creada"
          });

            this.nombre ='';
            this.descripcion = '';

          }

      });
    },

    onReset() {
      this.nombreCuenta = null;
      this.descripcionCuenta = null;
      this.accept = false;
    }
  },

  crear(){

      
  }
};