export default {
    data() {
      return {
        loading1: false,
        loading2: false,
        loading3: false,
        progress: false,
        showing: false,
        codigo: null,
        rut: null,
        giro: null,
        select_giro: [],
        razon_social: null,
        fono_emp: null,
        pagina: null,
        correo_emp: null,
        direccion: null,
        ciudad: null,
        nombres: null,
        apellidos: null,
        correo_con: null,
        fono_con: null,
        id: this.$route.params.id,
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
          'codigo': this.codigo,
          'rut': this.rut,
          'giro': this.giro.id,
          'razon_social': this.razon_social,
          'fono_emp': this.fono_emp,
          'pagina': this.pagina,
          'correo_emp': this.correo_emp,
          'direccion': this.direccion,
          'ciudad': this.ciudad,
          'nombres': this.nombres,
          'apellidos': this.apellidos,
          'correo_con': this.correo_con,
          'fono_con': this.fono_con
        }
        console.log(data);
  
        axios.post('api/ingresar_proveedor', data).then((res) => {
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
  
      traerGiros(){
        axios.get('api/traer_giros').then((res) => {
          this.select_giro = res.data;
        });
      },
  
      limpiar() {
        this.codigo = '';
        this.rut = '';
        this.giro = '';
        this.razon_social = '';
        this.fono_emp = '';
        this.pagina = '';
        this.correo_emp = '';
        this.direccion = '';
        this.ciudad = '';
        this.nombres = '';
        this.apellidos = '';
        this.correo_con = '';
        this.fono_con = '';
      },
  
      volver() {
        this.$router.push('/listar_proveedor');
      }
  
    },
  
    mounted() {
      this.traerGiros();
      console.log(this.id);
    }
  }
  