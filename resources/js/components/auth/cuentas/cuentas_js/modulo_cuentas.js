export default {

	data(){
		return{

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
        }

	}



}