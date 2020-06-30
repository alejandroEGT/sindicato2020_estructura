
<template>
<!-- style="height:80em; overflow:scroll;" -->
    <div >
        <br><br>
       <div class="row justify-center">
           <div class="col-md-6">
               <b-card no-body>
                    <b-card-header :style="header_color" >
                    Cuentas
                    </b-card-header>
                    <b-card-body>
                            <b-list-group>
                            <b-list-group-item>
                                <b-button @click="url_crear_cuenta" variant="light"><i class="fas fa-address-card"></i> Crear cuenta</b-button>
                            </b-list-group-item>
                            <b-list-group-item>
                                <b-button @click="url_listar_cuenta" variant="light"> <i class="fas fa-list"></i> Listar cuentas</b-button>
                            </b-list-group-item>
                            <b-list-group-item>
                                <b-button @click="url_formulario_cuenta" variant="light"><i class="fas fa-grin-squint-tears"></i> Formulario de cuentas</b-button>
                            </b-list-group-item>
                            </b-list-group><br>
                             <b-button size="sm" class="float-right" @click="ruta('index')"><i class="fas fa-undo-alt"></i> Volver</b-button>
                    </b-card-body> 
                 </b-card>
   
            </div>
       </div>
    </div>
</template>

<script src="../cuentas_js/modulo_cuentas.js"></script>