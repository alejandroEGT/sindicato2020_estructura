<template>
    <div>
        <br><br>
        <div class="row justify-center">
           <div class="col-md-7">
                <b-card no-body>
                    <b-card-header :style="header_color" >
                    CREAR SOCIO
                    </b-card-header>
                    <b-card-body>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Nombres:</label>
                                <b-form-input v-model="nombres" placeholder="Ingrese nombres"></b-form-input>
                            </div>
                            <div class="col-md-6">
                                <label for="">Apellidos:</label>
                                <b-form-input v-model="apellidos" placeholder="Ingrese apellidos"></b-form-input>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Rut (sin puntos ni guion):</label>
                                <b-form-input v-model="rut" placeholder="Ingrese rut"></b-form-input>
                            </div>
                            <div class="col-md-6">
                                <label for="">Fecha de naciemiento:</label>
                                <b-form-input type="date" v-model="fecha_nacimiento" placeholder="Ingrese fecha"></b-form-input>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Fecha de ingreso al sindicato:</label>
                                <b-form-input type="date" v-model="fecha_ingreso" placeholder="Ingrese fecha"></b-form-input>
                            </div>
                    
                        </div>
                        <hr>
                        <b-button @click="crear" size="sm" variant="primary"><i class="fas fa-save"></i> Registrar</b-button>
                        <b-button  size="sm" @click="ruta('socios')"><i class="fas fa-undo-alt"></i> Volver</b-button>
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
            nombres:'',
            apellidos:'',
            rut:'',
            fecha_nacimiento:'',
            fecha_ingreso:''
        }
    },
    methods:{
        ruta(ruta){
            this.$router.push('/'+ruta);
        },

        crear(){
            const data = {
                nombres: this.nombres,
                apellidos:this.apellidos,
                rut:this.rut,
                fecha_nacimiento:this.fecha_nacimiento,
                fecha_ingreso:this.fecha_ingreso
            };
            axios.post('api/insertar_socio', data).then((res)=>{
                console.log(res.data.estado);
                if (res.data.estado =='success') {
                    this.nombres = ''
                    this.apellidos = ''
                    this.rut = ''
                    this.fecha_nacimiento = ''
                    this.fecha_ingreso = ''

                    alert(res.data.mensaje)
                }
            });
        }
    }
}
</script>