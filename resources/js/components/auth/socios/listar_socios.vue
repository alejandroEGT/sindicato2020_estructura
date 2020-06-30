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
                                    <b-button 
                                   @click="nombres= t.nombres;
                                                        apellidos=t.apellidos;
                                                        rut=t.rut;
                                                        fecha_nacimiento=t.fecha_nacimiento_e;
                                                        email=t.email;
                                                        fecha_ingreso=t.fecha_ingreso_e;
                                                        fecha_egreso=t.fecha_egreso_e
                                   "  v-b-modal="'graf'+t.socio_id" variant="light">Editar</b-button>
                                   
                                   <b-modal 
                                   header-bg-variant="dark"
                                   header-text-variant="white"
                                   hide-footer 
                                   size="lg" :id="'graf'+t.socio_id" :title="'Editar persona con ID '+(i+1)">
                                    
                                        
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
                                                        @click="editar(t.socio_id,'nombres', nombres)"
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
                                                        @click="editar(t.socio_id,'apellidos', apellidos)"
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
                                                        @click="editar(t.socio_id,'rut', rut)"
                                                          variant="dark"
                                                        ><i class="fas fa-pen-alt"></i>
                                                        </b-button>
                                                </div>
                                            </div>

                                            <div class="row justify-center">
                                                <div class="col-10 col-md-10">
                                                     <label for="">Email</label>
                                                     <b-form-input 
                                                          v-model="email"
                                                          size="sm">
                                                    </b-form-input>
                                                </div>
                                                <div class="col-2 col-md-2">
                                                        <br>
                                                        <b-button 
                                                        size="sm"
                                                        @click="editar(t.socio_id,'email', email)"
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
                                                        @click="editar(t.socio_id,'fecha_nacimiento', fecha_nacimiento)"
                                                          variant="dark"
                                                        ><i class="fas fa-pen-alt"></i>
                                                        </b-button>
                                                </div>
                                            </div>

                                            <div class="row justify-center">
                                                <div class="col-10 col-md-10">
                                                     <label for="">Fecha ingreso</label>
                                                     <b-form-input 
                                                          v-model="fecha_ingreso"
                                                          size="sm"  type="date">
                                                    </b-form-input>
                                                </div>
                                                <div class="col-2 col-md-2">
                                                        <br>
                                                        <b-button 
                                                        size="sm"
                                                        @click="editar(t.socio_id,'fecha_ingreso', fecha_ingreso)"
                                                          variant="dark"
                                                        ><i class="fas fa-pen-alt"></i>
                                                        </b-button>
                                                </div>
                                            </div>

                                            <div class="row justify-center">
                                                <div class="col-10 col-md-10">
                                                     <label for="">fecha egreso</label>
                                                     <b-form-input 
                                                          v-model="fecha_egreso"
                                                          size="sm"  type="date">
                                                    </b-form-input>
                                                </div>
                                                <div class="col-2 col-md-2">
                                                        <br>
                                                        <b-button 
                                                        size="sm"
                                                        @click="editar(t.socio_id,'fecha_egreso', fecha_egreso)"
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
            header_color:"border:1px solid #A6ACAF; color:white; background: rgb(0,0,0);background: linear-gradient(90deg, rgba(0,0,0,0.7413340336134453) 0%, rgba(4,8,9,1) 9%, rgba(46,39,96,1) 90%);",
            body_color:"background: rgb(23,26,84);background: linear-gradient(170deg, rgba(23,26,84,1) 0%, rgba(160,163,187,1) 11%, rgba(251,254,255,1) 25%, rgba(251,254,255,0.15309873949579833) 59%, rgba(190,193,209,1) 94%, rgba(23,26,84,1) 100%);",
            tr_style:"background:#EAEDED; border:1px solid #A6ACAF",
            border:'border:1px solid #A6ACAF',
            
            buscar:'',
            tabla:[],

            //datos socio
            nombres:'',
            apellidos:'',
            fecha_nacimiento:'',
            rut:'',
            email:'',
            fecha_ingreso:'',
            fecha_egreso:'',
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
        },

        editar(id, nombre, valor) {
        
            const data = new FormData();
            data.append('id', id);
            data.append('nombre',nombre);
            data.append('valor',valor);
            axios.post('api/actualizar_socio', data).then((res) => {
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