export default{
    data(){
        return{
            tabla:[],
            columns: [

                { name: 'id', align: 'center', label: 'Id Liq.', field: 'id', sortable: true, headerClasses: 'bg-primary text-white' },
                { name: 'fecha', align: 'center', label: 'Fecha', field: 'fecha', sortable: true, headerClasses: 'bg-primary text-white' },
                // { name: 'empleado', align: 'center', label: 'Empleado', field: 'tipo_detalle', sortable: true, headerClasses: 'bg-primary text-white' },
               
                { name: 'empresa', align: 'center', label: 'Empleado', field: 'empresa', sortable: true, headerClasses: 'bg-primary text-white' },
                { name: 'empleado', align: 'center', label: 'Empleado', field: 'empleado', sortable: true, headerClasses: 'bg-primary text-white' },
                { name: 'editar', align: 'center', label: 'editar', sortable: true, headerClasses: 'bg-primary text-white' },
                { name: 'ver', align: 'center', label: 'ver', sortable: true, headerClasses: 'bg-primary text-white' },

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
        },
        url(url) {
            this.$router.push(url);
        },
        url_params(name,param) {
            this.$router.push({
                name: name, params: param
            });
        }
    },
    created(){
        this.listar_t();
    }
}