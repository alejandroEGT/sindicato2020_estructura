<template>
    <div class="q-pa-md">
        <div class="row justify-center">
	    
	      <div class="col-12">

              <q-card class="my-card">
		            <q-card-section class="bg-primary text-white">
		              <div class="text-h6">Liquidaciones/formulario</div>
		             
		            </q-card-section>

		             <q-separator />

                     <div class="q-pa-md row q-col-gutter-md">
                         <!-- <div class="col-6 col-md-2">Nombre:</div> -->
                         <div class="col-12 col-md-3">
                             <q-select 
                                outlined v-model="empleado" 
                                :options="options" 
                                option-label="nombre"
                                option-value="id"
                                label="Nombre"

                                filled
                                use-input
                                hide-selected
                                fill-input
                                input-debounce="0"
                                @filter="filterFn"
                                @input='seleccionado'
                             />
                         </div>

                         <div class="col-12 col-md-3">
                             <q-input
                                :loading="loading2"
		                        outlined
		                        v-model="rut"
		                        label="Rut"
		                        stack-label
		                        type="text"
                                :disable="true"
                                
		                     />
                         </div>

                         <div class="col-12 col-md-3">
                             <q-input
                                :loading="loading2"
		                        outlined
		                        v-model="fecha_nacimiento"
		                        label="Fecha de ingreso"
		                        stack-label
		                        type="date"
                                :disable="true"
                                
		                     />
                         </div>
                     </div>

                     <div class="q-pa-md row">
                         <!-- <div class="col-6 col-md-2">Nombre:</div> -->
                         
                     </div>
					
				
		        </q-card>
		   </div>
	      </div>
    </div>
    
</template>

<script src="../liquidaciones_js/formulario_liquidaciones.js"></script>