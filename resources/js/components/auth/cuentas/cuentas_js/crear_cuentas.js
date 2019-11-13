

export default {
  
  data() {
    return {
      model: null,
      
      nombreCuenta: null,
      descripcionCuenta: null,

      accept: false,

      text: '',
      ph: '',

      fixed:false,

      dense: false,

      nombre:'', descripcion:'',
      options: [
        'Google', 'Facebook', 'Twitter', 'Apple', 'Oracle'
      ],



      cuenta_id:'',
      nombre_s:'',
      descripcion_s:''
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
    },

    traer(){
      
        axios.get('api/traer_cuenta').then((res)=>{
          this.options = res.data;
      });
    },

    guardar_subcuenta(){
      const data ={
          'nombre':this.nombre_s,
          'descripcion':this.descripcion_s,
          'cuenta_id':this.cuenta_id.id 
      };

      axios.post('api/ingresar_subcuenta',data).then((res)=>{
          // this.options = res.data;
          if (res.data.estado == 'success') {
              this.$q.notify({
              color: "green-4",
              textColor: "white",
              icon: "cloud_done",
              message: "Subcuenta creada"
            });
          }
      });
    }

  },
  created(){
      this.traer();
      
  },

  mounted(){
      // this.traer();
      
  }
};