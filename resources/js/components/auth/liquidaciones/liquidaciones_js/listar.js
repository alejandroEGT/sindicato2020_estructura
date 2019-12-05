export default{
    data(){
        return{
            tabla:[],
            columns: [

                { name: 'id', align: 'center', label: 'Id Liq.', field: 'id', sortable: true, headerClasses: 'bg-primary text-white' },
                { name: 'fecha', align: 'center', label: 'Fecha', field: 'fecha', sortable: true, headerClasses: 'bg-primary text-white' },
                // { name: 'empleado', align: 'center', label: 'Empleado', field: 'tipo_detalle', sortable: true, headerClasses: 'bg-primary text-white' },
                // { name: 'rut empleado', align: 'center', label: 'Empleado', field: 'tipo_detalle', sortable: true, headerClasses: 'bg-primary text-white' },
                { name: 'empresa', align: 'center', label: 'Empleado', field: 'empresa', sortable: true, headerClasses: 'bg-primary text-white' },

            ],
        }
    },

    methods:{
        listar_t(){
            axios.get('api/listar_liquidaciones').then((res)=>{
                if (res.data.estado=='success') {
                    this.tabla = res.data.tabla;
                }
            });
        }
    },
    created(){
        this.listar_t();
    }
}