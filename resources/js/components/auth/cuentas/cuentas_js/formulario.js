export default{
	data(){
		return{
			cuenta_id: null,
			loading2: false,
			fecha:'', codigo:'', descripcion:'', monto:'', file:null,
      		options:[],
      		tipo_monto_id:'',
      		subcuenta:'',
      		subcuentas:[],



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
	    	axios.get('api/traer_subcuenta/'+this.cuenta_id.id).then((res)=>{
	          if (res.data.estado=='success') {
	          	 this.subcuentas = res.data.lista;
	          	 this[`loading${dos}`] = false
	          }
	          
	      	});
	    },

	    guardar(){
	    	const data = new FormData();
	    	data.append('cuenta_id', this.cuenta_id.id);
	    	data.append('fecha', this.fecha);
	    	data.append('codigo', this.codigo);
	    	data.append('descripcion', this.descripcion);
	    	data.append('sub_cuenta_id', this.subcuenta.id);
	    	data.append('tipo_monto_id', this.tipo_monto_id.id);
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
	          
	      	});
	    	
		},
		
		limpiar_mdelos(){
			this.cuenta_id = null;
			this.fecha = '';
			this.codigo = '';
			this.descripcion = '';
			this.subcuenta = '';
			this.tipo_monto_id = '';
			this.file = null;
			this.monto = '';
		}
	   
	}
}