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
                                   <b-button size="sm" @click="ruta('beneficio_socios')"><i class="fas fa-undo-alt"></i> Volver</b-button>
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
                                   
                                   <b-button variant="light" v-if="t.certificado_conyuge!='--'" size="sm" v-b-modal="'lol'+i"><i class="fas fa-file-alt"></i> Archivo</b-button>
                                   <!-- {{ t.certificado_carga }} -->
                                   <b-modal size="lg" 
                                   header-bg-variant="dark"
                                   header-text-variant="white"
                                   hide-footer 
                                   :id="'lol'+i" 
                                   title="Certificado de conyuge">
                                        <iframe :src="t.certificado_conyuge" id="iframeRight" style="width:100%; height:500px;" frameborder="0">

                                        </iframe>
                                    </b-modal>
                                </td>
                               <td :style="border">{{ t.beneficiario }}</td>
                               <td :style="border">{{ t.orden_beneficiario }}</td>
                               <td :style="border">{{ t.carga }}</td>
                               <td :style="border">
                                 <b-button variant="light" v-if="t.carga=='SI'" size="sm" v-b-modal="'kkck'+i"><i class="fas fa-file-alt"></i> Archivo</b-button>
                                   <!-- {{ t.certificado_carga }} -->
                                   <b-modal 
                                   header-bg-variant="dark"
                                   header-text-variant="white"
                                   hide-footer 
                                   size="lg" 
                                   :id="'kkck'+i" 
                                   title="Certificado de carga">
                                        <iframe :src="t.certificado_carga" id="iframeRight" style="width:100%; height:500px;" frameborder="0">

                                        </iframe>
                                    </b-modal>
                               </td>
                               <td :style="border">
                                   <b-button 
                                   @click="nombres= t.nombres;
                                                        apellidos=t.apellidos;
                                                        rut=t.rut;
                                                        fecha_nacimiento=t.fecha_nacimiento_e;
                                                        direccion=t.direccion;
                                                        celular=t.celular;
                                                        beneficio=t.orden_beneficiario
                                   "  v-b-modal="'graf'+t.id" variant="light">Editar</b-button>
                                   
                                   <b-modal 
                                   header-bg-variant="dark"
                                   header-text-variant="white"
                                   hide-footer 
                                   size="lg" :id="'graf'+t.id" :title="'Editar persona con ID '+(i+1)">
                                    
                                        
                                            <div class="row justify-center">
                                                <div class="col-10 col-md-10">
                                                     <label for="">Nombres</label>
                                                     <b-form-input 
                                                          v-model="nombres"
                                                          size="sm">
                                                    </b-form-input>
                                                </div>
                                                <div class="col-2 col-md-2">
                                                        <br>
                                                        <b-button 
                                                        size="sm"
                                                        @click="editar(t.id,'nombres', nombres)"
                                                          variant="dark"
                                                        ><i class="fas fa-pen-alt"></i>
                                                        </b-button>
                                                </div>
                                            </div>
                                            <div class="row justify-center">
                                                <div class="col-10 col-md-10">
                                                     <label for="">Apellidos</label>
                                                     <b-form-input 
                                                          v-model="apellidos"
                                                          size="sm">
                                                    </b-form-input>
                                                </div>
                                                <div class="col-2 col-md-2">
                                                        <br>
                                                        <b-button 
                                                        size="sm"
                                                        @click="editar(t.id,'apellidos', apellidos)"
                                                          variant="dark"
                                                        ><i class="fas fa-pen-alt"></i>
                                                        </b-button>
                                                </div>
                                            </div>

                                            <div class="row justify-center">
                                                <div class="col-10 col-md-10">
                                                     <label for="">Rut</label>
                                                     <b-form-input 
                                                          v-model="rut"
                                                          size="sm">
                                                    </b-form-input>
                                                </div>
                                                <div class="col-2 col-md-2">
                                                        <br>
                                                        <b-button 
                                                        size="sm"
                                                        @click="editar(t.id,'rut', rut)"
                                                          variant="dark"
                                                        ><i class="fas fa-pen-alt"></i>
                                                        </b-button>
                                                </div>
                                            </div>

                                            <div class="row justify-center">
                                                <div class="col-10 col-md-10">
                                                     <label for="">Fecha nacimiento</label>
                                                     <b-form-input
                                                        v-model="fecha_nacimiento" 
                                                        size="sm" 
                                                        type="date">
                                                      </b-form-input>
                                                </div>
                                                <div class="col-2 col-md-2">
                                                        <br>
                                                        <b-button 
                                                        size="sm"
                                                        @click="editar(t.id,'fecha_nacimiento', fecha_nacimiento)"
                                                          variant="dark"
                                                        ><i class="fas fa-pen-alt"></i>
                                                        </b-button>
                                                </div>
                                            </div>

                                            <div class="row justify-center">
                                                <div class="col-10 col-md-10">
                                                     <label for="">Dirección</label>
                                                     <b-form-input 
                                                          v-model="direccion"
                                                          size="sm">
                                                    </b-form-input>
                                                </div>
                                                <div class="col-2 col-md-2">
                                                        <br>
                                                        <b-button 
                                                        size="sm"
                                                        @click="editar(t.id,'direccion', direccion)"
                                                          variant="dark"
                                                        ><i class="fas fa-pen-alt"></i>
                                                        </b-button>
                                                </div>
                                            </div>

                                            <div class="row justify-center">
                                                <div class="col-10 col-md-10">
                                                     <label for="">Celular</label>
                                                     <b-form-input 
                                                          v-model="celular"
                                                          size="sm">
                                                    </b-form-input>
                                                </div>
                                                <div class="col-2 col-md-2">
                                                        <br>
                                                        <b-button 
                                                        size="sm"
                                                        @click="editar(t.id,'celular', celular)"
                                                          variant="dark"
                                                        ><i class="fas fa-pen-alt"></i>
                                                        </b-button>
                                                </div>
                                            </div>
                                            

                                            <div v-if="t.tipo_familiar_id ==1" class="row justify-center">
                                                <div class="col-2 col-md-10">
                                                     <label for="">Certificado matrimonial o pareja:</label>
                                                     <b-form-file ref="cony" id="cony" @change="arch_cony" size="sm"  placeholder="Certificado conyuge"></b-form-file>
                                                     <!-- <label for="">Archivo</label>
                                                      <b-form-file id="carga" ref="carga"  @change="arch_carga"  size="sm"  placeholder="seleccione archivo"></b-form-file> -->
                                                </div>
                                                <div class="col-2 col-md-2">
                                                    <br>
                                                    <b-button 
                                                        size="sm"
                                                        @click="editar_archivo_cony(t.id,'archivo_cony')"
                                                          variant="dark"
                                                        ><i class="fas fa-pen-alt"></i>
                                                        </b-button>
                                                </div>
                                            </div>

                                            <div v-if="t.beneficiario =='SI'" class="row justify-center">
                                                <div class="col-10 col-md-10">
                                                     <label for="">Beneficiario </label>
                                                     <b-form-select 
                                                        v-model="beneficio" 
                                                        :options="beneficios"
                                                        
                                                        size="sm"
                                                        >
                                                        <template  v-slot:first>
                                                            <b-form-select-option :value="''" disabled>--Seleccione tipo de familiar--</b-form-select-option>
                                                        </template>

                                                    </b-form-select>
                                                </div>
                                                <div class="col-2 col-md-2">
                                                        <br>
                                                        <b-button 
                                                        size="sm"
                                                        @click="editar(t.id,'orden_beneficio', beneficio)"
                                                          variant="dark"
                                                        ><i class="fas fa-pen-alt"></i>
                                                        </b-button>
                                                </div>
                                            </div>
                                            


                                            <div v-if="t.carga=='SI'" class="row justify-center">
                                                <div class="col-10 col-md-10">
                                                     <label for="">Certificado de la carga:</label>
                                                    <b-form-file id="carga" ref="carga"  @change="arch_carga"  size="sm"  placeholder="seleccione certificado de la carga"></b-form-file>
                                             
                                                </div>

                                                <div class="col-10 col-md-2">
                                                    <br>
                                                    <b-button 
                                                        size="sm"
                                                        @click="editar_archivo_car(t.id,'archivo_car')"
                                                          variant="dark"
                                                        ><i class="fas fa-pen-alt"></i>
                                                        </b-button>
                                                </div>
                                            </div>

                                        

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
           
            axios.get('api/listar_personas/'+this.socio_id).then((res)=>{
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