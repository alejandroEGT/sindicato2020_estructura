export default{
    data(){
        return{
            detalle:'',
            concepto:'',

            detalles:[],

            tabla:[],
            columns: [

                { name: 'id', align: 'center', label: 'Id', field: 'id', sortable: true, headerClasses: 'bg-primary text-white' },
                { name: 'tipo', align: 'center', label: 'Tipo', field: 'tipo', sortable: true, headerClasses: 'bg-primary text-white' },
                { name: 'tipo_detalle', align: 'center', label: 'Concepto', field: 'tipo_detalle', sortable: true, headerClasses: 'bg-primary text-white' },
                { name:'opcion', align:'center'}

            ],
        }
    },
    methods:{
        ingresar(){
            const data = {
                'detalle' : this.detalle.id,
                'concepto' : this.concepto
            }
            axios.post('api/ingresar_detalle', data).then((res)=>{
                if (res.data.estado == 'success') {
                    this.$q.notify({
                        color: "green-4",
                        textColor: "white",
                        icon: "cloud_done",
                        message: "" + res.data.mensaje + ""
                    });
                    this.detalle='';
                    this.concepto='';   
                    this.listar();
                }
            });
        },
        listar(){
            axios.get('api/listar_detalle').then((res)=>{
                this.tabla = res.data;
            });
        },
        eliminar(id){
            axios.get('api/eliminar_detalle_hd/'+id).then((res)=>{
                if(res.data.estado=='success'){
                    this.$q.notify({
                        color: "green-4",
                        textColor: "white",
                        icon: "cloud_done",
                        message: "" + res.data.mensaje + ""
                    });

                    this.listar();
                }
            });
        },

        show(component) {
            console.log(this.$refs);
            this.$refs[''+component+''].show()
        },

        onDialogHide() {
            // required to be emitted
            // when QDialog emits "hide" event
            this.$emit('hide')
        },

        select_detalles(){
            axios.get('api/detalle_h_d').then((res)=>{
                this.detalles = res.data;
            });
        }
    },
    created(){
        this.listar();
        this.select_detalles();
    }
}