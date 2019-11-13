import languages from 'quasar/lang/index.json'


export default {
  data () {
    return {
      view_tabla:false,
      selected: [],
      fixed:false,
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
          label: 'Resumen',
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
      data_resumen: [ ]
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
      listar(){
          
          axios.get('api/listar_cuenta_detalle/'+this.mes.id+'/'+this.anio.id+'/'+this.cuenta_id.id).then((res)=>{
              if (res.data.estado=='success') {
                 this.tabla = res.data.lista;
                var sumar_i= 0;
                var sumar_e = 0;
                this.tabla.map(function (value, key) {
                  sumar_i = value.monto_ingreso + sumar_i;
                  sumar_e = value.monto_egreso + sumar_e;
                 });


                this.ingresos = sumar_i;
                this.egresos = sumar_e;
                this.data_resumen =[
                  {
                    name:'Ingreso', valor:sumar_i
                  },
                  {
                    name: 'Egreso', valor: sumar_e
                  },
                  {
                    name: 'Total mensual', valor: (sumar_i - sumar_e)
                  }
                ];
                this.view_tabla = true;
                 // this[`loading${dos}`] = false
              }else{
                this.view_tabla = false;
              }
              
            });
      },

      limpiar(){
        this.tabla = [];
        this.view_tabla = false;
      },
      ruta(ruta){
        this.$router.push(ruta);
      }



    // onRequest (props) {

    //    // this.data = [];
    //   let { page, rowsPerPage, rowsNumber, sortBy, descending } = props.pagination
    //   let filter = props.filter

    //   this.loading = true

    //   // emulate server
    //   setTimeout(() => {
    //     // update rowsCount with appropriate value
    //     this.pagination.rowsNumber = this.getRowsNumberCount(filter)

    //     // get all rows if "All" (0) is selected
    //     let fetchCount = rowsPerPage === 0 ? rowsNumber : rowsPerPage

    //     // calculate starting row of data
    //     let startRow = (page - 1) * rowsPerPage

    //     // fetch data from "server"
    //     let returnedData = this.fetchFromServer(startRow, fetchCount, filter, sortBy, descending)

    //     // clear out existing data and add new
    //     this.data.splice(0, this.data.length, ...returnedData)

    //     // don't forget to update local pagination object
    //     this.pagination.page = page
    //     this.pagination.rowsPerPage = rowsPerPage
    //     this.pagination.sortBy = sortBy
    //     this.pagination.descending = descending

    //     // ...and turn of loading indicator
    //     this.loading = false
    //   }, 1500)
    // },

    // fetchFromServer (startRow, count, filter, sortBy, descending) {
    //   let data = []

    //   if (!filter) {
    //     data = this.original.slice(startRow, startRow + count)
    //   }
    //   else {
    //     let found = 0
    //     for (let index = startRow, items = 0; index < this.original.length && items < count; ++index) {
    //       let row = this.original[index]
    //       // match filter?
    //       if (!row['titulo'].includes(filter)) {
    //         // get a different row, until one is found
    //         continue
    //       }
    //       ++found
    //       if (found >= startRow) {
    //         data.push(row)
    //         ++items
    //       }
    //     }
    //   }

    //   // handle sortBy
    //   if (sortBy) {
    //     data.sort((a, b) => {
    //       let x = descending ? b : a
    //       let y = descending ? a : b
    //       if (sortBy === 'desc') {
    //         // string sort
    //         return x[sortBy] > y[sortBy] ? 1 : x[sortBy] < y[sortBy] ? -1 : 0
    //       }
    //       else {
    //         // numeric sort
    //         return parseFloat(x[sortBy]) - parseFloat(y[sortBy])
    //       }
    //     })
    //   }

    //   return data
    // },

    // // emulate 'SELECT count(*) FROM ...WHERE...'
    // getRowsNumberCount (filter) {
    //   if (!filter) {
    //     return this.original.length
    //   }
    //   let count = 0
    //   this.original.forEach((treat) => {
    //     if (treat['titulo'].includes(filter)) {
    //       ++count
    //     }
    //   })
    //   return count
    // }
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