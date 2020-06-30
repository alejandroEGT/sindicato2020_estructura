export default {

	data(){
		return{
			header_color: "color:white; background: rgb(0,0,0);background: linear-gradient(90deg, rgba(0,0,0,0.7413340336134453) 0%, rgba(4,8,9,1) 9%, rgba(46,39,96,1) 90%);",
		}
	},

	created(){

	},
	methods:{

		url_crear_cuenta(){
          this.$router.push('/crear-cuenta');
        },
        url_listar_cuenta(){
          this.$router.push('/listar-cuenta');
        },
        url_formulario_cuenta(){
        	this.$router.push('/formulario-cuenta');
		},
		ruta(ruta) {
			this.$router.push('/' + ruta);
		},

	}



}