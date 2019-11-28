// const stringOptions = [
//   'Google', 'Facebook', 'Twitter', 'Apple', 'Oracle'
// ]
export default{
    data(){
        return{
            loading2:false,
            empleado:'',
            options: [],
            stringOptions:[],
            rut:'',
            fecha_nacimiento:''
        }
    },
    created(){
        this.select_nombre();
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
                this.fecha_nacimiento = res.data.fecha_nacimiento
                console.log(res.data);
                this.loading2 = false;
            });
        }
       
    }
}