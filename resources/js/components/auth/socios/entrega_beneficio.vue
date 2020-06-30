<template>
    <div>
        <br><br>
        <div class="row justify-center">
           <div class="col-md-12">
                <b-card no-body>
                    <b-card-header :style="header_color" >
                     Beneficio para {{ socio.nombres+' '+socio.apellidos }}
                    </b-card-header>
                    <b-card-body>
                        <div class="row justify-center">
                            <div class="col-md-6">
                                <label for="">Tipo de beneficio</label>
                                 <b-form-select v-model="tipo" :options="tipos" size="sm"></b-form-select>
                            </div>

                            <div class="col-md-6">
                                <label for="">Persona del motivo</label>
                                <b-form-select v-model="persona" 
                                size="sm">
                                    <template v-slot:first>
                                        <b-form-select-option value="" disabled>-- Please select an option --</b-form-select-option>
                                        <b-form-select-option v-for="s in select_familia" :key="s.id" :value="s.id">{{s.nombres+' '+s.apellidos+' - ('+s.tipo_familiar+')'}}</b-form-select-option>
                                    </template>
                                </b-form-select>
                            </div>
                            
                        </div><hr>

                        <div class="row justify-center">
                            <div class="col-md-6">
                                <label for="">Fecha de beneficio</label>
                                <b-form-input v-model="fecha" size="sm" type="date"></b-form-input>
                            </div>

                            <div class="col-md-6">
                                <label for="">Nª de comprobante o transacción</label>
                                <b-form-input v-model="codigo" size="sm" type="text"></b-form-input>
                            </div>
                        </div>
                        <br>
                         <div class="row justify-center">
                            <div class="col-md-6">
                                <label for="">Documento comprobante o transacción(opcional)</label>
                                <b-form-file id="carga" ref="carga"  @change="arch_1"  size="sm"  placeholder="seleccione.."></b-form-file>
                            </div>

                            <div class="col-md-6">
                                 <label for="">Otro documento(opcional)</label>
                                <b-form-file id="carga" ref="carga"  @change="arch_2"  size="sm"  placeholder="seleccione.."></b-form-file>
                            </div>
                        </div>
                        <br>
                        <div class="row justify-center">
                            <div class="col-md-6">
                                <label for="">Monto:</label>
                                <b-form-input v-model="monto" size="sm" type="number"></b-form-input>
                            </div>

                            <div class="col-md-6">
                                <label for="">Detalle del beneficio:</label>
                                <b-form-input v-model="detalle" size="sm" type="text" :value="'Beneficio entregado a '+socio.nombres+' '+socio.apellidos+' por '"></b-form-input>
                            </div>
                        </div>
                        <hr>
                        <b-button size="sm"
                                    @click="formulario"
                                     variant="primary"><i class="fas fa-hand-holding-usd"></i> Entregar beneficio</b-button>
                        
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

            socio_id: this.$route.params.id,
            socio:{},

            //form

            tipo: '',
            tipos: [
            { value: '', text: '-Seleccione tipo-' },
            { value: 'FALLECIMIENTO', text: 'Fallecimiento' },
            { value: 'NACIMIENTO', text: 'Nacimiento' },
            { value: 'GASTO MEDICO', text: 'Gasto medico' },
            // { value: 'd', text: 'This one is disabled', disabled: true }
            ],
            fecha:'',
            persona:'',
            select_familia:{},
            file_1:null,
            file_2:null,
            monto:'',
            codigo:'',
            detalle:''

        }
    },
    created(){
        this.sociox();
        this.familiares();
        console.log("wello")
    },
    methods:{
        sociox(){
            axios.get('api/listar_socio_id/'+this.socio_id).then((res)=>{
                this.socio = res.data.socio;
            });
        },

        familiares(){
           
            axios.get('api/listar_personas/'+this.socio_id).then((res)=>{
                console.log(res.data.estado);
                if (res.data.estado =='success') {
                    this.select_familia = res.data.consulta
                }
            });
        },

         arch_1(event) {
         console.log(event.target.files[0]);
         this.file_1 = event.target.files[0];
        },
        arch_2(event) {
         console.log(event.target.files[0]);
         this.file_2 = event.target.files[0];
        },

        formulario(){
            const data = new FormData();
            data.append('socio', this.socio_id);
            data.append('persona', this.persona);
            data.append('tipo', this.tipo);
            data.append('archivo1', this.file_1);
            data.append('archivo2', this.file_2);
            data.append('fecha', this.fecha);
            data.append('monto', this.monto);
            data.append('numero_comprobante', this.codigo);
            data.append('detalle', this.detalle);
            axios.post('api/entregar_beneficio', data).then((res) => {
                if (res.data.estado == 'success') {
                   
                this.$q.notify({
                    color: "green-4",
                    textColor: "white",
                    icon: "cloud_done",
                    message: "" + res.data.mensaje + ""
                });
                 this.listar();
                }
            });
        }
    }
}
</script>