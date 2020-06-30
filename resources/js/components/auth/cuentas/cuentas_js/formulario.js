export default{
	data(){
		return{
			header_color: "color:white; background: rgb(0,0,0);background: linear-gradient(90deg, rgba(0,0,0,0.7413340336134453) 0%, rgba(4,8,9,1) 9%, rgba(46,39,96,1) 90%);",
			cuenta_id: '',
			loading2: false,
			fecha:'', codigo:'', descripcion:'', monto:'', file:null,
      		options:[],
      		tipo_monto_id:'',
      		subcuenta:'',
      		subcuentas:[],
			load:false,


		}
	},

	mounted(){
		this.traer();
	},
	created(){

	},
	methods:{
		traer(){

        axios.get('api/traer_cuenta').then((res)=>{
	          this.options = res.data;
	          // this.loading = false;
	          // this.original = res.data;
	          // this.data = res.data;
	      });

      
	    },

	    change_cuenta(dos){
			this[`loading${dos}`] = true
			this.load = true;
	    	axios.get('api/traer_subcuenta/'+this.cuenta_id).then((res)=>{
	          if (res.data.estado=='success') {
	          	 this.subcuentas = res.data.lista;
				   this[`loading${dos}`] = false;
				  this.load = false;
	          }
	          
	      	});
	    },

	    guardar(){
	    	const data = new FormData();
	    	data.append('cuenta_id', this.cuenta_id);
	    	data.append('fecha', this.fecha);
	    	data.append('codigo', this.codigo);
	    	data.append('descripcion', this.descripcion);
	    	data.append('sub_cuenta_id', this.subcuenta);
	    	data.append('tipo_monto_id', this.tipo_monto_id);
	    	data.append('archivo', this.file);
	    	data.append('monto', this.monto);

	    	console.log(data);
	    	axios.post('api/insertar_cuenta_detalle', data).then((res)=>{
	          if (res.data.estado=='success') {
				  this.$q.notify({
					  color: "green-4",
					  textColor: "white",
					  icon: "cloud_done",
					  message: "" + res.data.mensaje + ""
				  });
				  this.limpiar_mdelos();
			  }
			  if (res.data.estado=='failed') {
				  this.$q.notify({
					  color: "danger-4",
					  textColor: "white",
					  icon: "cloud_done",
					  message: "" + res.data.mensaje + ""
				  });
			  }
	          
	      	});
	    	
		},
		
		limpiar_mdelos(){
			this.cuenta_id = '';
			this.fecha = '';
			this.codigo = '';
			this.descripcion = '';
			this.subcuenta = '';
			this.tipo_monto_id = '';
			this.file = null;
			this.monto = '';
		},
		ruta(ruta) {
			this.$router.push('/' + ruta);
		},
	   
	}
}