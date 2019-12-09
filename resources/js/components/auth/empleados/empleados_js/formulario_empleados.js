export default{
    data(){
        return{
            empleado:{},
            loading1:false,
        }
    },
    methods:{
        ingresar_empleado(){
            this.loading1=true;
            axios.post('api/insertar_empleado', this.empleado).then((res)=>{

                if (res.data.estado == 'success') {
                    this.$q.notify({
                        color: "green-4",
                        textColor: "white",
                        icon: "cloud_done",
                        message: "" + res.data.mensaje + ""
                    });
                    this.loading1 = false;
                }else{
                    this.$q.notify({
                       // color: "green-4",
                        textColor: "white",
                        icon: "cloud_done",
                        message: "" + res.data.mensaje + ""
                    });
                    this.loading1 = false;
                }
            }).catch ((error) => {
                this.$q.notify({
                    // color: "green-4",
                    textColor: "white",
                    icon: "cloud_done",
                    message: "Algo salió mal, revise bien sus campos"
                });
                this.loading1 = false;
            });
        }
    },

    created(){

    }
}