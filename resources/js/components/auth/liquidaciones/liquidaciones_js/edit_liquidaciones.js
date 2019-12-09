export default {
    data() {
        return {
            
            loading1:false,
            url_id: this.$route.params.id,
            url_desc: this.$route.params.desc,
            splitterModel: 50,
            selected: this.$route.params.desc,
            stringOptions:[],
            list: [],
            liquidacion:this.$route.params.desc,


            afps:'',
            isapres:'',
            //datos
            nombre:'',
            rut:'',
            fehca_contrato:'',
            cargo:'',

            fecha_emicion:'',
            sueldo_base_mensual:'',
            dias_trabajados:'',
            valor_hora_ordinaria:'',
            horas_extras:'',
            valor_horas_extras:'',
            afp:'',
            isapre:'',


            tabla: [],
            selected: [],
            pagination: {
                page: 1,
                rowsPerPage: 0 // 0 means all rows    
            },
            columns: [

                { name: 'id', align: 'center', label: 'Id', field: 'id', sortable: true, headerClasses: 'bg-primary text-white' },
                { name: 'tipo', align: 'center', label: 'Tipo', field: 'tipo', sortable: true, headerClasses: 'bg-primary text-white' },
                { name: 'concepto', align: 'center', label: 'Concepto', field: 'tipo_detalle', sortable: true, headerClasses: 'bg-primary text-white' },
                { name: 'monto',label:'Monto', align: 'center' },
                { name: 'estado', label: 'Estado', align: 'center' },
                { name: 'opcion', label: 'Opcion', align: 'center' }

            ],
        }
    },

    methods:{
        listar_liq(){
            console.log(this.simple)
            axios.get('api/listar_liquidaciones_edit').then((res)=>{
                this.stringOptions = res.data.tabla;
                this.list = this.stringOptions;
            });
        },
        filterFn(val, update, abort) {
            update(() => {
                const needle = val.toLowerCase()
                console.log(needle);
                //console.log(this.stringOptions.filter(v => v.nombre.toLowerCase()))
                this.list = this.stringOptions.filter(v => v.label.toLowerCase().indexOf(needle) > -1)
            })
        },
        traer_afp_isapre(){
            axios.get('api/afp_y_isapre').then((res)=>{
                this.afps = res.data.afp;
                this.isapres = res.data.isapre;
            });
        },
        traer_datos_liq(liq_id){
            axios.get('api/datos_liqu_edit/'+liq_id).then((res)=>{
                this.nombre = res.data.empleado
                this.rut = res.data.rut
                this.fehca_contrato = res.data.fecha_contrato
                this.cargo = res.data.puesto_trabajo

                this.fecha_emicion = res.data.fecha_emicion
                this.sueldo_base_mensual = res.data.sueldo_base_mensual
                this.dias_trabajados = res.data.dias_trabajados
                this.valor_hora_ordinaria = res.data.valor_horas_ordinarias
                this.horas_extras = res.data.horas_extras
                this.valor_horas_extras = res.data.valor_horas_extras
                this.afp = {
                    id: res.data.afp_id,
                    nombre: res.data.afp,
                    
                };
               // res.data.afp_id
                this.isapre = {
                    id: res.data.isapre_id,
                    nombre: res.data.isapre,
                    
                };//res.data.isapre_id
            });
        },
        traer_datos_h_d(liq_id){
            
            axios.get('api/tabla_haberes_descuentos_edit/' + liq_id).then((res) => {
                this.tabla = res.data
            });
        },
        registrar_detalle_h_d(id, $this, id_h_d) {

            const data = {
                'liquidacion_id': id,
                'monto': $this.target.value,
                'id_h_d': id_h_d
            };
            axios.post('api/guardar_liquidacion_detalle', data).then((res) => {
                if (res.data.estado == 'success') {
                    this.tabla = res.data.listar;
                }
            });
        },

          
        
    },
    created(){
        this.traer_afp_isapre();
        this.traer_datos_liq(this.url_id);
        this.listar_liq();
        this.traer_datos_h_d(this.url_id);
    }
}