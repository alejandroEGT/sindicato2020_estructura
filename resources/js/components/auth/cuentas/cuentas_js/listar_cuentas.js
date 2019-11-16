import languages from 'quasar/lang/index.json'


export default {
  data () {
    return {
      monto_inicio:'',
      arrastre:0,
      view_tabla:false,
      selected: [],
      fixed:false,
      modal_ic:false,
      cuenta_id: '',
      options:[],
      columns: [
        
        { name: 'id', align: 'center', label: 'Id', field: 'id', sortable: true ,  headerClasses: 'bg-primary text-white'},
        { name: 'titulo', align: 'center', label: 'Titulo', field: 'titulo', sortable: true ,  headerClasses: 'bg-primary text-white'},
        { name: 'fecha', align: 'center', label: 'Fecha', field: 'fecha', sortable: true ,  headerClasses: 'bg-primary text-white'},
        { name: 'archivo', align: 'center',label: 'Archivo', field: 'archivo', sortable: true ,  headerClasses: 'bg-primary text-white'},
        { name: 'descripcion', align: 'center',label: 'Descripcion', field: 'descripcion',  headerClasses: 'bg-primary text-white' },
        { name: 'ingreso', align: 'center',label: 'Ingreso', field: 'monto_ingreso', sortable: true ,  headerClasses: 'bg-primary text-white'},
        { name: 'egreso', align: 'center',label: 'Egreso', field: 'monto_egreso', sortable: true,  headerClasses: 'bg-primary text-white' },
        // { name: 'view', label: 'View', field: 'view', sortable: true ,  headerClasses: 'bg-primary text-white'},
        
      ],
      mes:'',
      meses:[
        { 'id':'1', 'label':'Enero' },
        { 'id':'2', 'label':'Febrero' },
        { 'id':'3', 'label':'Marzo' },
        { 'id':'4', 'label':'Abril' },
        { 'id':'5', 'label':'Mayo' },
        { 'id':'6', 'label':'Junio' },
        { 'id':'7', 'label':'Julio' },
        { 'id':'8', 'label':'Agosto' },
        { 'id':'9', 'label':'Septiembre' },
        { 'id':'10', 'label':'Octubre' },
        { 'id':'11', 'label':'Noviembre' },
        { 'id':'12', 'label':'Diciembre' },
      ],

      anio:'',
      anios:[
        { 'id':'2019', 'label':'2019' },
        { 'id':'2020', 'label':'2020' },
        { 'id':'2021', 'label':'2021' },
        { 'id':'2022', 'label':'2022' },
      ],
      tabla:[],
      ingresos:0,
      egresos:0,

      columns_resumen: [
        {
          name: 'name',
          required: true,
          label: 'Resumen del mes',
          align: 'left',
          field: row => row.name,
          format: val => `${val}`,
          sortable: true,
          classes: 'bg-grey-2 ellipsis',
          style: 'max-width: 100px',
          headerClasses: 'bg-primary text-white'
        },
        { name: 'valor', align: 'center', label: 'Valor', field: 'valor', sortable: true },
        
      ],
      data_resumen: [ ],

      columns_acumulado: [
        {
          name: 'name',
          required: true,
          label: 'Resumen acumulado',
          align: 'left',
          field: row => row.name,
          format: val => `${val}`,
          sortable: true,
          classes: 'bg-grey-2 ellipsis',
          style: 'max-width: 100px',
          headerClasses: 'bg-primary text-white'
        },
        { name: 'valor', align: 'center', label: 'Valor', field: 'valor', sortable: true },

      ],
      data_acumulado: [
        {name:'', valor:''},
      ]
    }
  },
  methods: {
      getSelectedString () {
        return this.selected.length === 0 ? '' : `${this.selected.length} record${this.selected.length > 1 ? 's' : ''} selected of ${this.data.length}`
      },
      traer(){

          axios.get('api/traer_cuenta').then((res)=>{
            this.options = res.data;
            // this.loading = false;
            // this.original = res.data;
            // this.data = res.data;
        });
      },
    listar() {

      axios.get('api/listar_cuenta_detalle/' + this.mes.id + '/' + this.anio.id + '/' + this.cuenta_id.id).then((res) => {
        if (res.data.estado == 'success') {
          this.tabla = res.data.lista;
          var sumar_i = 0;
          var sumar_e = 0;

          for (var i = 0; i < this.tabla.length; i++) {
            sumar_i += Number(this.tabla[i].monto_ingreso);
            sumar_e += Number(this.tabla[i].monto_egreso);
          }



          this.ingresos = sumar_i;
          this.egresos = sumar_e;
          this.data_resumen = [
            {
              name: 'Ingreso', valor: sumar_i
            },
            {
              name: 'Egreso', valor: sumar_e
            },
            {
              name: 'Total mensual', valor: (sumar_i - sumar_e)
            }
          ];

          this.traer_inicio_mensual(this.mes.id,this.anio.id,this.cuenta_id.id);
          this.view_tabla = true;
          // this[`loading${dos}`] = false
        } else {
          this.view_tabla = false;
        }

      });
    },

    ingresar_inicio_mes(){
        const data = {
        'cuenta_id': this.cuenta_id.id,
        'anio': this.anio.id,
        'mes': this.mes.id,
        'monto_inicio':  this.monto_inicio
        };
        axios.post('api/ini_cie_ingresar', data).then((res) => {
          if (res.data.estado == 'success') {
            this.$q.notify({
              color: "green-4",
              textColor: "white",
              icon: "cloud_done",
              message: "" + res.data.mensaje + ""
            });
          }else{
            
              this.$q.notify({
                color: "red-4",
                textColor: "white",
                icon: "cloud_done",
                message: ""+res.data.mensaje+""
              });
            
          }
        });
    },
    traer_inicio_mensual(mes, anio, cuenta){
      axios.get('api/traer_inicio_mensual/'+mes+'/'+anio+'/'+cuenta).then((res) => {
        this.monto_inicio = res.data.inicio_mensual;
      
        });
    },

    limpiar(){
        this.tabla = [];
        this.view_tabla = false;
    },
    ruta(ruta){
        this.$router.push(ruta);
    }



    
  },
  watch: {
    // lang (lang) {
    //   // dynamic import, so loading on demand only
    //   import(`quasar/lang/${lang}`).then(lang => {
    //     this.$q.lang.set(lang.default)
    //   })
    // }
  },
  created(){
    
    
  },
   mounted () {
    // get initial data from server (1st page)
    this.traer();
    
    // this.onRequest({
    //   pagination: this.pagination,
    //   filter: undefined
    // })
  },
}