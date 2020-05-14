<template>
<!-- style="height:80em; overflow:scroll;" -->
    <div >
        <br><br>
       <div class="row justify-center">
           <div class="col-md-6">
               <b-card no-body>
                    <b-card-header :style="header_color" >
                    SOCIOS
                    </b-card-header>
                    <b-card-body>
                        
                            <b-list-group>
                            <b-list-group-item>
                                <b-button @click="ruta('crear_socios')" variant="light"><i class="fas fa-address-card"></i> Crear socio</b-button>
                            </b-list-group-item>
                            <b-list-group-item>
                                <b-button @click="ruta('listar_socios')" variant="light"> <i class="fas fa-list"></i> Listar socio</b-button>
                            </b-list-group-item>
                            <b-list-group-item>
                                <b-button @click="ruta('beneficio_socios')" variant="light"><i class="fas fa-grin-squint-tears"></i> Beneficios del socio</b-button>
                            </b-list-group-item>
                            </b-list-group><br>
                             <b-button class="float-right" @click="ruta('index')"><i class="fas fa-undo-alt"></i> Volver</b-button>
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
        }
    },
    methods:{
        ruta(ruta){
            this.$router.push('/'+ruta);
        },
    }
}
</script>