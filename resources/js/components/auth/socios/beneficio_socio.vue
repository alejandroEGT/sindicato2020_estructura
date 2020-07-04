<template>
    <div>
        <br><br>
        <b-container >
      <b-row>
        <b-col cols="12" md="12">
                <b-card no-body>
                    <b-card-header :style="header_color" >
                    LISTAR SOCIOS
                    </b-card-header>
                    <b-card-body>
                          <form  enctype="multipart/form-data">
                         <b-row>
                            <b-col cols="12" md="12">
                                <label for="">Rut o nombre completo del socio:</label>
                                 <b-form-input size="sm" v-model="buscar" placeholder="Buscar por nombre o apellido"></b-form-input>
                            </b-col>
                         </b-row>
                         <br>
                         <b-row class="justify-content-md-center">
                             <b-col cols="12" md="4">
                                  <b-button variant="dark" size="sm" @click="listar"><i class="fas fa-search"></i> Buscar</b-button>
                                  <b-button @click="buscar='';listar()" size="sm" variant="info"><i class="fas fa-sync-alt"></i> Refrezcar</b-button>
                                  <b-button  size="sm"  @click="ruta('socios')"><i class="fas fa-undo-alt"></i> Volver</b-button>
                             </b-col>
                             
                         </b-row>

                         
                        <br>
                        <b-row class="justify-content-md-center" v-if="condicion">
                            <b-col cols="12" md="10">
                                <table class="table table-striped table-bordered" >
                                    <tr :style="header_color">
                                        <td colspan="8"><center>Resultado de busqueda del socio</center></td>
                                    </tr>
                                <tr >
                                    <td style="color:#1F618D">Nombre:</td>
                                    <td style="#CCD1D1">
                                        {{ nombre }}
                                    </td>
                                    <td style="color:#1F618D">Rut:</td>
                                    <td style="#CCD1D1">
                                        {{ g_rut }}
                                    </td>
                                    <!-- <td style="color:#1F618D">Email:</td>
                                    <td style="#CCD1D1">
                                        {{ socio.email }}
                                    </td> -->

                                    <td style="color:#1F618D">Vista:</td>
                                    <td style="#CCD1D1">
                                        <b-button @click="url_params('personas_socios',{id:socio_id})" size="sm" variant="info"><i class="fas fa-list-alt"></i> Personas asociadas</b-button>
                                        <hr>
                                        <b-button @click="url_params('lista_beneficio',{id:socio_id})" size="sm" variant="info"><i class="fas fa-list-alt"></i> Beneficios</b-button>
                                    </td>

                                    <td style="color:#1F618D">Entrega:</td>
                                    <td style="#CCD1D1">
                                         <b-button @click="url_params('entrega_beneficio',{id:socio_id})" size="sm"
                                     variant="primary"><i class="fas fa-hand-holding-usd"></i> Beneficio</b-button>
                                    </td>
                                </tr>
                                <!-- <tr :style="header_color">
                                    <td>Rut</td>
                                    <td style="color:black;background:white">
                                        {{ rut }}
                                    </td>
                                </tr> -->
                                </table>
                            </b-col>
                        </b-row>

                         <hr>

                         <label for="">Formulario de persona asociada:</label>

                         <b-form-select 
                            v-model="fam" 
                            :options="f"
                            value-field="id"
                            text-field="nombre"
                            size="sm"
                            @change="familiar_cambio"
                            >
                            <template  v-slot:first>
                                <b-form-select-option :value="''">--Seleccione tipo de familiar--</b-form-select-option>
                            </template>

                        </b-form-select>
                        <hr>
                        <div v-if="fam!=''">
                          <div class="row">
                            <div class="col-md-6">
                                <label for="">Nombres:</label>
                                <b-form-input size="sm" v-model="nombres" placeholder="Ingrese nombres"></b-form-input>
                            </div>
                            <div class="col-md-6">
                                <label for="">Apellidos:</label>
                                <b-form-input size="sm" v-model="apellidos" placeholder="Ingrese apellidos"></b-form-input>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Rut (sin puntos ni guion):</label>
                                <b-form-input size="sm" v-model="rut" placeholder="Ingrese rut"></b-form-input>
                            </div>
                            <div class="col-md-6">
                                <label for="">Fecha de naciemiento:</label>
                                <b-form-input size="sm" type="date" v-model="fecha_nacimiento" placeholder="Ingrese fecha"></b-form-input>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Direccion:</label>
                                <b-form-input size="sm"  v-model="direccion" placeholder="Dirección"></b-form-input>
                            </div>

                            <div class="col-md-6">
                                <label for="">Celular:</label>
                                <b-form-input size="sm" v-model="celular" placeholder="Celular"></b-form-input>
                            </div>
                    
                        </div>
                        <br>
                        <div class="row">
                            <div v-if="fam=='1'" class="col-md-6">
                                <label for="">Certificado matrimonial o pareja:</label>
                                <b-form-file ref="cony" id="cony" @change="arch_cony" size="sm"  placeholder="Certificado conyuge"></b-form-file>
                            </div>

                            <div v-if="fam!=''" class="col-md-6">
                                <label for="">¿Esta persona es beneficiario(a) y/o carga?:</label>
                                <b-form-checkbox-group 
                                    v-model="becana" 
                                    @input="checking"
                                    :options="be_ca_na"
                                    name="flavour-2">

                                
                                </b-form-checkbox-group>
                            </div>

                            <!-- <div class="col-md-6">
                                <label for="">Celular:</label>
                                <b-form-input size="sm" v-model="celular" placeholder="Celular"></b-form-input>
                            </div> -->
                    
                        </div>
                        <br>
                        <div class="row" v-if="exist_checked">
                            <div class="col-md-6" v-if="exist_ch_benefic">
                                
                                <label for="">Prioridad de beneficiario:</label>
                                <!-- v-model="beneficio" :options="beneficios" -->
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

                            <div class="col-md-6" v-if="exist_ch_carga"> 
                                 <label for="">Certificado de la carga:</label>
                                <b-form-file id="carga" ref="carga"  @change="arch_carga"  size="sm"  placeholder="seleccione certificado de la carga"></b-form-file>
                            <!-- {{certificado_carga}} -->
                            </div>
                        
                        </div>
                        <hr>
                       
                        <b-button @click="crear(socio_id)" size="sm" variant="primary"><i class="fas fa-save"></i> Registrar</b-button>
                        <b-button  size="sm" @click="ruta('socios')"><i class="fas fa-undo-alt"></i> Volver</b-button>
                        </div>
                          </form>
                    </b-card-body>
                </b-card>
        
        </b-col>
      </b-row>
 </b-container>

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
            tabla:[],
            fam:'',
            f:[],
            socio:[],
            socio_id:'',
            nombre:'',
            rut:'',
            g_rut:'',
            condicion:false,

            exist_checked:false,
            exist_ch_carga:false,
            exist_ch_benefic:false,

            becana:[],
            be_ca_na:[
                
                { text: 'Beneficiario', value: '2', disabled: false },
                { html: 'Carga', value: '3', disabled: false },
               
                ],
                beneficio:'',
                beneficios:[
                
                { text: 'Primario', value: '1', disabled: false },
                { text: 'Secundario', value: '2', disabled: false },
                { text: 'Terciario', value: '3', disabled: false },
               
                ],
            

            //datos de personas
            nombres:'', apellidos:'', rut:'',direccion:'',fecha_nacimiento:'',celular:'',
            //cony
            certificado_matrimonio:null,
            certificado_carga:null
           
        }
    },
    created(){
        this.familiar();
    },
    methods:{
        arch_carga(event){
            console.log(event.target.files[0]);
            this.certificado_carga = event.target.files[0];
        },
        arch_cony(event){
            console.log(event.target.files[0]);
            this.certificado_matrimonio = event.target.files[0];
        },
        ruta(ruta){
            this.$router.push('/'+ruta);
        },
         url_params(name, json){
    		this.$router.push({name:name, params:json}).catch(error => {
			  if (error.name != "NavigationDuplicated") {
			    throw error;
			  }
			});
        },

        listar(){
            this.condicion = false;
            axios.get('api/listar_socio/'+this.buscar).then((res)=>{
                console.log(res.data.estado);
                if (res.data.estado =='success') {
                    this.socio = res.data.tabla;
                    this.nombre = this.socio.nombres+' '+this.socio.apellidos;
                    this.g_rut = this.socio.rut;
                    this.condicion = true;
                    this.socio_id = this.socio.socio_id;

                }
            });
        },

        familiar(){
           
            axios.get('api/entorno_familiar').then((res)=>{
                console.log(res.data.estado);
                // if (res.data.estado =='success') {
                    this.f = res.data;
                // }
            });
        },

        checking(){
            

            if(this.becana.length > 0){
                this.exist_checked = true;

                if (this.becana.length == 1) {
                    if (this.becana[0] == '2') {
                        this.exist_ch_benefic = true;
                        this.exist_ch_carga = false;
                    }
                    if (this.becana[0] == '3') {
                        this.exist_ch_carga = true;
                        this.exist_ch_benefic = false;
                    }
                    return false;
                }
                if (this.becana.length == 2) {
                    this.exist_ch_benefic = true;
                    this.exist_ch_carga = true;
                    return false;
                }
                
                    // for (let index = 0; index < this.becana.length; index++) {
                    //     if (this.becana[index] == '2') {
                    //         this.exist_ch_benefic = true;
                    //         this.exist_ch_carga = false;
                    //     }
                    //     if (this.becana[index] == '3') {
                    //         this.exist_ch_carga = true;
                    //     }
                       
                        
                    // }
                
                return false;
            }else{
                this.exist_checked = false;
                this.exist_ch_benefic = false;
                this.exist_ch_carga = false;
                return false;
            }
            
            console.log(this.becana);
        },
        crear(socio_id){//registrar persona
            console.log(this.certificado_carga);
            
            const data = new FormData();
            data.append('socio_id', this.socio_id);
            data.append('familiar', this.fam);
            data.append('nombres', this.nombres);
            data.append('apellidos', this.apellidos);
            data.append('rut', this.rut);
            data.append('direccion', this.direccion);
            data.append('fecha_nacimiento', this.fecha_nacimiento);
            data.append('celular', this.celular);
            data.append('certificado_matrimonio',this.certificado_matrimonio);
            data.append('certificado_carga', this.certificado_carga);
            data.append('orden_beneficio', this.beneficio);
            data.append('becana', this.becana);

           
            axios.post("api/crear_persona", data).then((res)=>{
                if(res.data.estado == 'success'){
                    this.$q.notify({
                        color: "green-4",
                        textColor: "white",
                        icon: "cloud_done",
                        message: ""+res.data.mensaje+""
                    });

                    this.fam ='';
                    this.limpiar();
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
        familiar_cambio(){
            console.log("limpiando..")
            this.certificado_carga =null;
            this.certificado_matrimonio =null;

           
            $("#cony").val(null).clone(true);;
            $("#carga").val(null).clone(true);;

            this.$refs.carga.reset();
            // this.$refs.cony.reset();
            // this.$refs.carga.reset();
        },

        limpiar(){
            this.certificado_carga =null;
            this.certificado_matrimonio =null;
            // this.socio_id = '';
            this.fam = '';
            this.nombres = '';
            this.apellidos = '';
            this.rut = '';
            this.direccion = '';
            this.fecha_nacimiento = '';
            this.celular = '';
            this.beneficio = '';
            this.becana = [];
        }
    }
}
</script>