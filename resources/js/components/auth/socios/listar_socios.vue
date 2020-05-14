<template>
    <div>
        <br><br>
        <div class="row justify-center">
           <div class="col-md-12">
                <b-card no-body>
                    <b-card-header :style="header_color" >
                    LISTAR SOCIOS
                    </b-card-header>
                    <b-card-body>
                       <div class="table-responsive" style="height:550px;">
                           <table class="table" >
                           <tr :style="header_color">
                               <td colspan="2" >
                                   
                                    <b-form-input size="sm" v-model="buscar" placeholder="Buscar por nombre o apellido"></b-form-input>
                               </td>
                               <td>
                                   <b-button variant="dark" size="sm" @click="listar"><i class="fas fa-search"></i> Buscar</b-button>
                               </td>
                               <td>
                                   <b-button @click="buscar='';listar()" size="sm" variant="info"><i class="fas fa-sync-alt"></i> Refrezcar</b-button>
                               </td>
                               <td>
                                   <b-button size="sm" @click="ruta('socios')"><i class="fas fa-undo-alt"></i> Volver</b-button>
                               </td>
                               <td colspan="3"></td>
                           </tr>
                           <tr :style="header_color">
                               <td>Nº</td>
                               <td>Nombre completo</td>
                               <td>Rut</td>
                               <td>Email</td>
                               <td>Fecha nacimiento</td>
                               <td>Fecha ingreso</td>
                               <td>Fecha egreso</td>
                               <td>Opción</td>
                           </tr>

                           <tr :style="tr_style" v-for="(t,i) in tabla" :key='t.id' >
                               <td :style="border" style="background:#D5DBDB">{{ i+1 }}</td>
                               <td :style="border" style="background:#D5DBDB">{{ t.nombres+' '+t.apellidos }}</td>
                               <td :style="border">{{ t.rut }}</td>
                               <td :style="border">{{ t.email }}</td>
                               <td :style="border">{{ t.fecha_nacimiento }}</td>
                               <td :style="border">{{ t.fecha_ingreso }}</td>
                               <td :style="border">{{ t.fecha_egreso }}</td>
                               <td :style="border">
                                   <b-button size="sm" pill ><i class="fas fa-pencil-alt"></i> Editar</b-button>
                               </td>
                           </tr>
                       </table>
                       </div>
                       

                        <b-button @click="ruta('socios')"><i class="fas fa-undo-alt"></i> Volver</b-button>
                    </b-card-body>
               </b-card>
           </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            header_color:"border:1px solid #A6ACAF; color:white; background: rgb(0,0,0);background: linear-gradient(90deg, rgba(0,0,0,0.7413340336134453) 0%, rgba(4,8,9,1) 9%, rgba(46,39,96,1) 90%);",
            body_color:"background: rgb(23,26,84);background: linear-gradient(170deg, rgba(23,26,84,1) 0%, rgba(160,163,187,1) 11%, rgba(251,254,255,1) 25%, rgba(251,254,255,0.15309873949579833) 59%, rgba(190,193,209,1) 94%, rgba(23,26,84,1) 100%);",
            tr_style:"background:#EAEDED; border:1px solid #A6ACAF",
            border:'border:1px solid #A6ACAF',
            
            buscar:'',
            tabla:[]
        }
    },
    created(){
        this.listar();
    },
    methods:{
        ruta(ruta){
            this.$router.push('/'+ruta);
        },

        listar(){
           
            axios.get('api/listar_socios/'+this.buscar).then((res)=>{
                console.log(res.data.estado);
                if (res.data.estado =='success') {
                    this.tabla = res.data.tabla
                }
            });
        }
    }
}
</script>