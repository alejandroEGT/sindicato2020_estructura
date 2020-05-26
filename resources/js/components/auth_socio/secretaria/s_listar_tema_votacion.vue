<template>
    <div>
        <br><br>
        <div class="row justify-center">
           <div class="col-md-12">
                <b-card no-body>
                    <b-card-header :style="header_color" >
                    LISTAR TEMAS DE VOTACION
                    </b-card-header>
                    <b-card-body>
                       <div class="table-responsive" style="height:550px;">
                           <table class="table" >
                           <tr :style="header_color">
                               <td colspan="2" >
                                    <b-form-select style="font-size:12px" v-model="select_tema" :options="[
                                        { value: '', text: '-Seleccione tema-' },
                                        { value: '1', text: 'ABIERTA' },
                                        { value: '2', text: 'CERRADA' },
                                    ]"></b-form-select>
                                    <!-- <b-form-input size="sm" v-model="buscar" placeholder="Buscar por nombre o apellido"></b-form-input> -->
                               </td>
                               <td>
                                   <b-form-select style="font-size:12px" v-model="select_votacion" :options="[
                                        { value: '', text: '-Seleccione votacion-' },
                                        { value: '1', text: 'ABIERTA' },
                                        { value: '2', text: 'APROBADA' },
                                        { value: '3', text: 'RECHAZADA' },
                                        { value: '4', text: 'ME ABSTENGO' },
                                    ]"></b-form-select>
                                   <!-- <b-button variant="dark" size="sm" @click="listar"><i class="fas fa-search"></i> Buscar</b-button> -->
                               </td>
                               <td>
                                   <!-- <b-button @click="buscar='';listar()" size="sm" variant="info"><i class="fas fa-sync-alt"></i> Refrezcar</b-button> -->
                               </td>
                               <td>
                                   <b-button size="sm" @click="ruta('secretaria')"><i class="fas fa-undo-alt"></i> Volver</b-button>
                               </td>
                               <td colspan="3"></td>
                           </tr>
                           <tr :style="header_color">
                               <!-- <td>Nº</td> -->
                               <td>Fecha y hora</td>
                               <td>Titulo</td>
                               <td>Detalle</td>
                               <td>Estado Tema</td>
                               <td>Estado Votacion</td>
                              
                               <td>Opción</td>
                           </tr>

                           <tr :style="tr_style" v-for="(t,i) in tabla" :key='t.id' >
                               <!-- <td :style="border" style="background:#D5DBDB">{{ i+1 }}</td> -->
                               <td :style="border" style="background:#D5DBDB">
                                   <label style="color:#566573">{{ t.fecha+' '+t.hora }}</label>
                                   </td>
                               <td :style="border">{{ t.titulo }}</td>
                               <td :style="border">{{ t.detalle }}</td>
                               <td :style="border">
                                   <center><label :style="(t.estado_tema==1)?'color:green; font-size:12px':'color:red; font-size:12px'">
                                       <i v-if="t.estado_tema==1" class="fas fa-lock-open"></i>
                                       <i v-if="t.estado_tema==2"  class="fas fa-lock"></i>
                                       {{t.tema }}</label></center>
                               </td>
                               <td :style="border">
                                   <label style="font-size:12px">
                                       <center>
                                           <i v-if="t.estado_votacion==1" style="color:orange" class="fas fa-shield-alt"></i>
                                           <i v-if="t.estado_votacion==2" style="color:green" class="fas fa-shield-alt"></i>
                                           <i v-if="t.estado_votacion==3" style="color:red" class="fas fa-shield-alt"></i>
                                           <i v-if="t.estado_votacion==4" style="color:blue" class="fas fa-shield-alt"></i>
                                       </center>
                                       {{ t.votacion }}</label></td>
                               <!--   <td :style="border">{{ t.fecha_egreso }}</td> -->
                               <td :style="border">
                                   <p><b-button v-if="t.estado_tema==1" v-b-modal="'lol'+i" size="sm" variant="light"><i class="fas fa-thumbs-up"></i> Votar</b-button></p>
                                   <p><b-button @click="fillData(t.id)" size="sm" variant="light" v-b-modal="'graf'+i"><i class="fas fa-chart-pie"></i> Estado</b-button></p>

                                   
                                   <!-- {{ t.certificado_carga }} -->
                                   <b-modal hide-footer size="lg" :id="'lol'+i" :title="t.titulo">
                                       <label> Detalle: {{ t.detalle }}</label>
                                       <hr>
                                       <center>
                                           <b-button @click="votar('aprobar','A', t.id)" size="sm" variant="success"><i class="fas fa-thumbs-up"></i> Apruebo </b-button>
                                           <b-button @click="votar('rechazar','R', t.id)" size="sm" variant="danger"><i class="fas fa-thumbs-down"></i> Rechazo</b-button>
                                           <b-button @click="votar('abstener','MA', t.id)" size="sm" variant="secondary"><i class="fas fa-hand-rock"></i> Me abstengo</b-button>
                                       </center>
                                    </b-modal>

                                    <b-modal hide-footer size="md" :id="'graf'+i" :title="t.titulo">
                                         <line-chart :chart-data="datacollection"></line-chart>

                                    </b-modal>
                               </td>
                           </tr>
                       </table>
                       </div>
                       

                        <b-button @click="ruta('secretaria')"><i class="fas fa-undo-alt"></i> Volver</b-button>
                    </b-card-body>
               </b-card>
           </div>
        </div>
    </div>
</template>

<script>
import LineChart from './LineChart.js'
export default {
    components: {
      LineChart
    },
    data(){
        return{
            header_color:"border:1px solid #A6ACAF; color:white; background: rgb(0,0,0);background: linear-gradient(90deg, rgba(0,0,0,0.7413340336134453) 0%, rgba(4,8,9,1) 9%, rgba(46,39,96,1) 90%);",
            body_color:"background: rgb(23,26,84);background: linear-gradient(170deg, rgba(23,26,84,1) 0%, rgba(160,163,187,1) 11%, rgba(251,254,255,1) 25%, rgba(251,254,255,0.15309873949579833) 59%, rgba(190,193,209,1) 94%, rgba(23,26,84,1) 100%);",
            tr_style:"background:#EAEDED; border:1px solid #A6ACAF",
            border:'border:1px solid #A6ACAF',
            
            select_tema:'',
            select_votacion:'',
            buscar:'',
            tabla:[],
            tema_id:'',
            datacollection: null

            
        }
    },
    created(){
        this.listar();
        // this.fillData();
    },
    methods:{
        ruta(ruta){
            this.$router.push('/'+ruta);
        },

        listar(){
           
            axios.get('api/listar_tema_votacion/'+this.buscar).then((res)=>{
                console.log(res.data.estado);
                if (res.data.estado =='success') {
                    this.tabla = res.data.tabla
                }
            });
        },
        votar(txt, voto, t_v_id){

            var r = confirm("Vas a "+txt+', ¿desea continuar?');
            if (r == true) {
                axios.post('api/votar',{
                    'voto':voto,
                    'tema_votacion_id': t_v_id
                }).then((res)=>{
                    if (res.data.estado=='success') {
                        this.$q.notify({
                            color: "green-4",
                            textColor: "white",
                            icon: "cloud_done",
                            position:'top',
                            message: ""+res.data.mensaje+""
                        });
                    }else{
                        this.$q.notify({
                        color: "red-4",
                        textColor: "white",
                        icon: "cloud_done",
                        position:'top',
                        message: ""+res.data.mensaje+""
                    });
                    }
                });
            } else {
                alert("proceso cancelado");
            }
            
        },

        fillData (id) {
       
        
        axios.get('api/obtener_votos/'+id).then((res)=>{
            this.datacollection = res.data
            console.log(this.datacollection);
        })
      },
      getRandomInt () {
        return Math.floor(Math.random() * (50 - 5 + 1)) + 5
      }
    }
}
</script>

<style>
.chart {
  width: 100%;
  height: 300px;
}
</style>