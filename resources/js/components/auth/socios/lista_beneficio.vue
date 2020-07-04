<template>
    <div>
        <br><br>
        <div class="row justify-center">
           <div class="col-md-12">
                <b-card no-body>
                    <b-card-header :style="header_color" >
                    Beneficios asociados a {{ socio.nombres+' '+socio.apellidos }}
                    </b-card-header>
                    <b-card-body>
                       <div class="table-responsive" style="height:550px;">
                           <table class="table" >
                           <tr :style="header_color">
                               
                               <td colspan="2">
                                   <b-button size="sm" @click="ruta('beneficio_socios')"><i class="fas fa-undo-alt"></i> Volver</b-button>
                               </td>
                               <td colspan="11" >
                                   
                               </td>
                               
                           </tr>
                           <tr :style="header_color">
                               <td>Nº</td>
                               <td>Tipo</td>
                               <td>Persona motivo</td>
                               <td>Fecha</td>
                               <td>Detalle</td>
                               <td>Monto entregado</td>
                              
                               <td>Documento 1</td>
                                <td>Documento 2</td>
                               
                           </tr>

                           <tr :style="tr_style" v-for="(t,i) in tabla" :key='t.id' >
                               <td :style="border" style="background:#D5DBDB">{{ i+1 }}</td>
                               <td :style="border" style="background:#D5DBDB">{{ t.tipo }}</td>
                               <td :style="border" style="background:#D5DBDB">{{ t.persona }}</td>
                               <td :style="border">{{ t.fecha }}</td>
                               <td :style="border">{{ t.detalle }}</td>
                               <td :style="border">{{ t.monto }}</td>
                              
                               <td :style="border">
                                   
                                   <b-button variant="light" v-if="t.certificado_conyuge!='--'" size="sm" v-b-modal="'lol'+i"><i class="fas fa-file-alt"></i> Archivo</b-button>
                                   <!-- {{ t.certificado_carga }} -->
                                   <b-modal size="lg" 
                                   header-bg-variant="dark"
                                   header-text-variant="white"
                                   hide-footer 
                                   :id="'lol'+i" 
                                   title="Certificado de conyuge">
                                        <iframe :src="t.archivo_1" id="iframeRight" style="width:100%; height:500px;" frameborder="0">

                                        </iframe>
                                    </b-modal>
                                </td>
                              
                                <td :style="border">
                                   
                                   <b-button variant="light" v-if="t.certificado_conyuge!='--'" size="sm" v-b-modal="'lol2'+i"><i class="fas fa-file-alt"></i> Archivo</b-button>
                                   <!-- {{ t.certificado_carga }} -->
                                   <b-modal size="lg" 
                                   header-bg-variant="dark"
                                   header-text-variant="white"
                                   hide-footer 
                                   :id="'lol2'+i" 
                                   title="Certificado de conyuge">
                                        <iframe :src="t.archivo_2" id="iframeRight" style="width:100%; height:500px;" frameborder="0">

                                        </iframe>
                                    </b-modal>
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

            beneficio:'',
            beneficios:[
                
                { text: 'Primario', value: '1', disabled: false },
                { text: 'Secundario', value: '2', disabled: false },
                { text: 'Terciario', value: '3', disabled: false },
               
                ],
            
            buscar:'',
            tabla:[],

            //datos de la persona
            nombres:'',
            apellidos:'',
            rut:'',
            fecha_nacimiento:'',
            direccion:'',
            celular:'',
            file_car:null,
            file_con:null
        }
    },
    created(){
        this.sociox();
        this.listar();
    },
    methods:{
        ruta(ruta){
            this.$router.push('/'+ruta);
        },
        sociox(){
            axios.get('api/listar_socio_id/'+this.socio_id).then((res)=>{
                this.socio = res.data.socio;
            });
        },

        listar(){
           
            axios.get('api/listar_beneficios_dados/'+this.socio_id).then((res)=>{
                console.log(res.data.estado);
                if (res.data.estado =='success') {
                    this.tabla = res.data.consulta
                }
            });
        },

        arch_carga(event) {
         console.log(event.target.files[0]);
         this.file_car = event.target.files[0];
        },
        arch_cony(event) {
         console.log(event.target.files[0]);
         this.file_con = event.target.files[0];
        },

        editar_archivo_cony(id, nombre){
            const data = new FormData();
            data.append('id', id);
            data.append('nombre', nombre);
            data.append('valor', this.file_con);
            axios.post('api/actualizar_archivo_con', data).then((res) => {
                if (res.data.estado == 'success') {
                   
                this.$q.notify({
                    color: "green-4",
                    textColor: "white",
                    icon: "cloud_done",
                    message: "" + res.data.mensaje + ""
                });
                 this.listar();
                }

                if (res.data.estado=='failed'){
                    this.$q.notify({
                    color: "danger-4",
                    textColor: "white",
                    icon: "cloud_done",
                    message: "" + res.data.mensaje + ""
                });
                }
                
            });
        },
        
        editar_archivo_car(id, nombre){
            const data = new FormData();
            data.append('id', id);
            data.append('nombre', nombre);
            data.append('valor', this.file_car);
            axios.post('api/actualizar_archivo_car', data).then((res) => {
                if (res.data.estado == 'success') {
                this.$q.notify({
                    color: "green-4",
                    textColor: "white",
                    icon: "cloud_done",
                    message: "" + res.data.mensaje + ""
                });
                 this.listar();
                }
                if (res.data.estado=='failed'){
                    this.$q.notify({
                    color: "danger-4",
                    textColor: "white",
                    icon: "cloud_done",
                    message: "" + res.data.mensaje + ""
                });
                }
            });
        },

        editar(id, nombre, valor) {
        // console.log(id,
        //   nombre,
        //   valor);
        const data = new FormData();
        data.append('id', id);
        data.append('nombre',nombre);
        data.append('valor',valor);
        axios.post('api/actualizar_persona', data).then((res) => {
            if (res.data.estado == 'success') {
            this.$q.notify({
                color: "green-4",
                textColor: "white",
                icon: "cloud_done",
                message: ""+res.data.mensaje+""
            });
             this.listar();
            }
        });
        },
    }
}
</script>