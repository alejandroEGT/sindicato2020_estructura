<template>
    <div>
        <br><br>
        <div class="row justify-center">
           <div class="col-md-12">
                <b-card no-body>
                    <b-card-header :style="header_color" >
                    Personas asociadas a {{ socio.nombres+' '+socio.apellidos }}
                    </b-card-header>
                    <b-card-body>
                       <div class="table-responsive" style="height:550px;">
                           <table class="table" >
                           <tr :style="header_color">
                               
                               <td colspan="2">
                                   <b-button size="sm" @click="ruta('socios')"><i class="fas fa-undo-alt"></i> Volver</b-button>
                               </td>
                               <td colspan="11" >
                                   
                               </td>
                               
                           </tr>
                           <tr :style="header_color">
                               <td>Nº</td>
                               <td>Nombre completo</td>
                               <td>Rut</td>
                               <td>Relación</td>
                               <td>Fecha nacimiento</td>
                               <td>dirección</td>
                               <td>Celular</td>
                               <td>Certificado conyuge?</td>
                               <td>Beneficiario</td>
                               <td>Orden beneficio</td>

                                <td>Carga</td>
                               <td>Certificado carga</td>
                               <td>Opción</td>
                           </tr>

                           <tr :style="tr_style" v-for="(t,i) in tabla" :key='t.id' >
                               <td :style="border" style="background:#D5DBDB">{{ i+1 }}</td>
                               <td :style="border" style="background:#D5DBDB">{{ t.nombres+' '+t.apellidos }}</td>
                               <td :style="border">{{ t.rut }}</td>
                               <td :style="border">{{ t.tipo_familiar }}</td>
                               <td :style="border">{{ t.fecha_nacimiento }}</td>
                               <td :style="border">{{ t.direccion }}</td>
                               <td :style="border">{{ t.celular }}</td>
                               <td :style="border">
                                   
                                   <b-button v-if="t.certificado_conyuge!='--'" size="sm" v-b-modal="'lol'+i">crt.conyuge</b-button>
                                   <!-- {{ t.certificado_carga }} -->
                                   <b-modal size="lg" :id="'lol'+i" title="BootstrapVue">
                                        <iframe :src="t.certificado_conyuge" id="iframeRight" style="width:100%; height:500px;" frameborder="0">

                                        </iframe>
                                    </b-modal>
                                </td>
                               <td :style="border">{{ t.beneficiario }}</td>
                               <td :style="border">{{ t.orden_beneficiario }}</td>
                               <td :style="border">{{ t.carga }}</td>
                               <td :style="border">
                                 <b-button v-if="t.carga==3" size="sm" v-b-modal="'kkck'+i">crt.carga</b-button>
                                   <!-- {{ t.certificado_carga }} -->
                                   <b-modal size="lg" :id="'kkck'+i" title="BootstrapVue">
                                        <iframe :src="t.certificado_carga" id="iframeRight" style="width:100%; height:500px;" frameborder="0">

                                        </iframe>
                                    </b-modal>
                               </td>
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
            socio_id: this.$route.params.id,
            socio:{},

            header_color:"border:1px solid #A6ACAF; color:white; background: rgb(0,0,0);background: linear-gradient(90deg, rgba(0,0,0,0.7413340336134453) 0%, rgba(4,8,9,1) 9%, rgba(46,39,96,1) 90%);",
            body_color:"background: rgb(23,26,84);background: linear-gradient(170deg, rgba(23,26,84,1) 0%, rgba(160,163,187,1) 11%, rgba(251,254,255,1) 25%, rgba(251,254,255,0.15309873949579833) 59%, rgba(190,193,209,1) 94%, rgba(23,26,84,1) 100%);",
            tr_style:"background:#EAEDED; border:1px solid #A6ACAF",
            border:'border:1px solid #A6ACAF',
            
            buscar:'',
            tabla:[]
        }
    },
    created(){
        this.sociox();
        this.listar();
    },
    methods:{
        sociox(){
            axios.get('api/listar_socio_id/'+this.socio_id).then((res)=>{
                this.socio = res.data.socio;
            });
        },

        listar(){
           
            axios.get('api/listar_personas/'+this.socio_id).then((res)=>{
                console.log(res.data.estado);
                if (res.data.estado =='success') {
                    this.tabla = res.data.consulta
                }
            });
        }
    }
}
</script>