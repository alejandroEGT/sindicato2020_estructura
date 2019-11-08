import languages from 'quasar/lang/index.json'


export default {
  data () {
    return {
      selected: [],
      columns: [
        
        { name: 'id', align: 'center', label: 'Id', field: 'id', sortable: true },
        { name: 'nombre', label: 'Nombre', field: 'titulo', sortable: true },
        { name: 'descripcion', label: 'Descripcion', field: 'descripcion' },
        
      ],
      pagination: {
        sortBy: 'name',
        descending: false,
        page: 1,
        rowsPerPage: 3,
        rowsNumber: 10
      },
      data: [],
      original:[],
      lang: this.$q.lang.isoName,

      filter: '',
      loading: false,
    }
  },
  methods: {
    getSelectedString () {
      return this.selected.length === 0 ? '' : `${this.selected.length} record${this.selected.length > 1 ? 's' : ''} selected of ${this.data.length}`
    },
    traer(){

        axios.get('api/traer_cuenta').then((res)=>{
          this.loading = false;
          this.original = res.data;
      });
    },


    onRequest (props) {
      let { page, rowsPerPage, rowsNumber, sortBy, descending } = props.pagination
      let filter = props.filter

      this.loading = true

      // emulate server
      setTimeout(() => {
        // update rowsCount with appropriate value
        this.pagination.rowsNumber = this.getRowsNumberCount(filter)

        // get all rows if "All" (0) is selected
        let fetchCount = rowsPerPage === 0 ? rowsNumber : rowsPerPage

        // calculate starting row of data
        let startRow = (page - 1) * rowsPerPage

        // fetch data from "server"
        let returnedData = this.fetchFromServer(startRow, fetchCount, filter, sortBy, descending)

        // clear out existing data and add new
        this.data.splice(0, this.data.length, ...returnedData)

        // don't forget to update local pagination object
        this.pagination.page = page
        this.pagination.rowsPerPage = rowsPerPage
        this.pagination.sortBy = sortBy
        this.pagination.descending = descending

        // ...and turn of loading indicator
        this.loading = false
      }, 1500)
    },

    fetchFromServer (startRow, count, filter, sortBy, descending) {
      let data = []

      if (!filter) {
        data = this.original.slice(startRow, startRow + count)
      }
      else {
        let found = 0
        for (let index = startRow, items = 0; index < this.original.length && items < count; ++index) {
          let row = this.original[index]
          // match filter?
          if (!row['titulo'].includes(filter)) {
            // get a different row, until one is found
            continue
          }
          ++found
          if (found >= startRow) {
            data.push(row)
            ++items
          }
        }
      }

      // handle sortBy
      if (sortBy) {
        data.sort((a, b) => {
          let x = descending ? b : a
          let y = descending ? a : b
          if (sortBy === 'desc') {
            // string sort
            return x[sortBy] > y[sortBy] ? 1 : x[sortBy] < y[sortBy] ? -1 : 0
          }
          else {
            // numeric sort
            return parseFloat(x[sortBy]) - parseFloat(y[sortBy])
          }
        })
      }

      return data
    },

    // emulate 'SELECT count(*) FROM ...WHERE...'
    getRowsNumberCount (filter) {
      if (!filter) {
        return this.original.length
      }
      let count = 0
      this.original.forEach((treat) => {
        if (treat['titulo'].includes(filter)) {
          ++count
        }
      })
      return count
    }
  },
  watch: {
    lang (lang) {
      // dynamic import, so loading on demand only
      import(`quasar/lang/${lang}`).then(lang => {
        this.$q.lang.set(lang.default)
      })
    }
  },
  created(){
    this.langOptions = languages.map(lang => ({
      label: lang.nativeName, value: lang.isoName
    }));
    this.traer();
  },
   mounted () {
    // get initial data from server (1st page)
    this.onRequest({
      pagination: this.pagination,
      filter: undefined
    })
  },
}