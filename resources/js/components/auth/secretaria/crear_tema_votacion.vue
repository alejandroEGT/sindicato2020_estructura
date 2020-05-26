<template>
    <div>
        <br><br>
        <div class="row justify-center">
           <div class="col-md-7">
                <b-card no-body>
                    <b-card-header :style="header_color" >
                    CREAR UN TEMA DE VOTACIÓN
                    </b-card-header>
                    <b-card-body>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Titulo del tema:</label>
                                <b-form-input size="sm" v-model="titulo" placeholder="Ingrese titulo del tema"></b-form-input>
                            </div>
                            <!-- <div class="col-md-6">
                                <label for="">Apellidos:</label>
                                <b-form-input v-model="apellidos" placeholder="Ingrese apellidos"></b-form-input>
                            </div> -->
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Detalle del tema (Pequeño detalle, pregunta, algo para ve si los socios estan de acuerdo):</label>
                                <b-form-textarea 
                                size="sm"
                                    rows="5"
                                    max-rows="6" 
                                    v-model="detalle"
                                    placeholder="Detalle del tema (Pequeño detalle, pregunta, algo para ve si los socios estan de acuerdo)">
                                    </b-form-textarea>
                            </div>
                            <!-- <div class="col-md-6">
                                <label for="">Fecha de naciemiento:</label>
                                <b-form-input type="date" v-model="fecha_nacimiento" placeholder="Ingrese fecha"></b-form-input>
                            </div> -->
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Fecha de creación:</label>
                                <b-form-input size="sm" type="date" v-model="fecha_ingreso" placeholder="Ingrese fecha"></b-form-input>
                            </div>

                            <div class="col-md-6">
                                <label for="">Hora de creación:</label>
                                <b-form-input size="sm" type="time" v-model="hora_ingreso" placeholder="Ingrese fecha"></b-form-input>
                            </div>
                    
                        </div>
                        <hr>
                        <b-button @click="crear" size="sm" variant="primary"><i class="fas fa-save"></i> Registrar</b-button>
                        <b-button  size="sm" @click="ruta('secretaria')"><i class="fas fa-undo-alt"></i> Volver</b-button>
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
            header_color:"color:white; background: rgb(0,0,0);background: linear-gradient(90deg, rgba(0,0,0,0.7413340336134453) 0%, rgba(4,8,9,1) 9%, rgba(46,39,96,1) 90%);",
            titulo:'',
            detalle:'',
            fecha_ingreso:'',
            hora_ingreso:''
        }
    },
    methods:{
        ruta(ruta){
            this.$router.push('/'+ruta);
        },

        crear(){
            const data = {
                titulo: this.titulo,
                detalle:this.detalle,
                fecha_ingreso:this.fecha_ingreso,
                hora_ingreso:this.hora_ingreso
            };
            axios.post('api/insertar_tema_votacion', data).then((res)=>{
                console.log(res.data.estado);
                if (res.data.estado =='success') {
                    this.titulo = ''
                    this.detalle = ''
                    this.fecha_ingreso = ''
                    this.hora_ingreso = ''

                    alert(res.data.mensaje)
                }
            });
        }
    }
}
</script>