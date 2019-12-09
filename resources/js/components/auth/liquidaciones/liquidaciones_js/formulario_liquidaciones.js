// const stringOptions = [
//   'Google', 'Facebook', 'Twitter', 'Apple', 'Oracle'
// ]
export default{
    data(){
        return{
            step:1,
            loading2:false,
            empleado:'',
            options: [],
            stringOptions:[],
            rut:'',
            fecha_nacimiento:'',
            puesto_trabajo:'',
            cargo:'',
            cargos:[
                {'id':'1','nombre':'Informatica'},
                {'id': '2','nombre': 'Informatica 2' },
            ],
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
                { name: 'monto', align: 'center' }

            ],

            afp:'', afps:[],
            isapre:'', isapres:[],
            fecha_emicion:'',
            sueldo_base_mensual:'',
            dias_trabajados:'',
            horas_extras:'',
            valor_horas_extras:'',
            valor_hora_ordinaria:'',
            liquidacion_id:''
        }
    },
    created(){
        this.select_nombre();
        this.listar();
        this.afp_y_isapre();
    },
    methods:{
        select_nombre(){
            axios.get('api/select_nombre').then((res)=>{
                this.stringOptions = res.data;
                this.options = this.stringOptions;
                console.log(this.options)
            })
        },

        filterFn(val, update, abort) {
            update(() => {
                const needle = val.toLowerCase()
                console.log(needle);
                //console.log(this.stringOptions.filter(v => v.nombre.toLowerCase()))
                this.options = this.stringOptions.filter(v => v.nombre.toLowerCase().indexOf(needle) > -1)
            })
        },

        seleccionado(){
            this.loading2 = true;
            console.log(this.empleado.id);
            axios.get('api/traer_datos_persona/' + this.empleado.id).then((res)=>{
                this.rut = res.data.rut;
                this.fecha_nacimiento = res.data.fecha_contrato;
                this.puesto_trabajo = res.data.puesto_trabajo
                console.log(res.data);
                this.loading2 = false;
            });
        },

        listar() {
            axios.get('api/listar_hh_dd').then((res) => {
                this.tabla = res.data;
            });
        },

        afp_y_isapre(){
            axios.get('api/afp_y_isapre').then((res)=>{
                this.afps = res.data.afp;
                this.isapres = res.data.isapre;
            });
        },

        guardar_liq(){
            
            const data = {
                'empleado_id': this.empleado.id,
                'puesto_trabajo': this.puesto_trabajo,
                'fecha_emicion': this.fecha_emicion,
                'sueldo_base_mensual':this.sueldo_base_mensual,
                'dias_trabajados': this.dias_trabajados,
                'horas_extras': this.horas_extras,
                'valor_horas_extras': this.valor_horas_extras,
                'valor_hora_ordinaria': this.valor_hora_ordinaria,
                'afp':this.afp.id,
                'isapre':this.isapre.id
            };
            axios.post('api/guardar_liquidacion_datos_basicos', data).then((res)=>{
                if (res.data.estado == 'success') {
                    this.liquidacion_id = res.data.liquidacion_id;
                    alert(res.data.mensaje);
                    this.step = 3;
                }else{
                    alert(res.data.mensaje);
                }
                 
              
            });
            
        },
        registrar_detalle_h_d(id, $this, id_h_d){

            const data = {
                'liquidacion_id' : id,
                'monto': $this.target.value,
                'id_h_d': id_h_d
            };
            axios.post('api/guardar_liquidacion_detalle', data).then((res) => {
                if(res.data.estado == 'success'){
                    this.tabla = res.data.listar;
                }
            });
        },

        getSelectedString() {
            return this.selected.length === 0 ? '' : `${this.selected.length} record${this.selected.length > 1 ? 's' : ''} selected of ${this.data.length}`
        },
        url(url) {
            this.$router.push(url);
        }
       
    }
}