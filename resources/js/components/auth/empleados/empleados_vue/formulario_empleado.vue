<template>
    <div>
    
        <div class="q-pa-md">
		<div class="row justify-center">

            <div class="col-12 col-md-12">
				<q-card class="my-card">
			      <q-card-section class="bg-primary text-white">
			        <div class="text-h6">Empleados/formulario</div>
			        <!-- <div class="text-subtitle2">by John Doe</div> -->
			      </q-card-section>

			      <q-separator />

			      <div class="q-pa-md">
			        <div class="row q-col-gutter-md">
			        	<div class="col-12 col-md-2">
			        		<q-input
		                              outlined
		                              v-model="empleado.nombre"
		                              label="Nombre"
		                              stack-label
		                              type="text"
		                            />
			        	</div>
			        	<div class="col-12 col-md-2">
			        		<q-input
		                              outlined
		                              v-model="empleado.apellido_paterno"
		                              label="Apellido paterno"
		                              stack-label
		                              type="text"
		                            />
			        	</div>
                        <div class="col-12 col-md-2">
			        		<q-input
		                              outlined
		                              v-model="empleado.apellido_materno"
		                              label="Apellido materno"
		                              stack-label
		                              type="text"
		                            />
			        	</div>
                        <div class="col-12 col-md-2">
			        		<q-input
		                              outlined
		                              v-model="empleado.rut"
		                              label="Rut"
		                              stack-label
		                              type="text"
		                            />
			        	</div>
                         <div class="col-12 col-md-2">
			        		
			        	</div>
			        	<!-- <div class="col-12 col-md-2">
			        		<q-btn @click="" color="primary" class="block" icon="attach_file" label="Formulario" />
			        	</div> -->
			        </div>
                    <br>
                    <div class="row q-col-gutter-md">
                        <div class="col-12 col-md-2">
                            <q-input
		                              outlined
		                              v-model="empleado.direccion"
		                              label="Dirección"
		                              stack-label
		                              type="text"
		                            />
                        </div>
                        <div class="col-12 col-md-2">
                            <q-input
		                              outlined
		                              v-model="empleado.telefono"
		                              label="Teléfono"
		                              stack-label
		                              type="text"
		                            />
                        </div>

                        <div class="col-12 col-md-2">
                            <q-input
		                              outlined
		                              v-model="empleado.fecha_contrato"
		                              label="Fecha de contrato"
		                              stack-label
		                              type="date"
		                            />
                        </div>

                        <div class="col-12 col-md-2">
                            <q-select
                                v-model="empleado.departamento"
                                label="Dpto"
                                outlined
                                :options="[
                                        {id:1,nombre:'Finanzas'},
                                        {id:2,nombre:'Informatica'},
                                        {id:3,nombre:'Gestión'},
                                ]"
                                option-value="id"
                                option-label="nombre"
                            />
                        </div>

                        <div class="col-12 col-md-2">
                             <q-select
                                v-model="empleado.categoria"
                                label="Categoria"
                                outlined
                                :options="[
                                        {id:1,nombre:'Tecnico'},
                                        {id:2,nombre:'Ingeniero'},
                                        {id:3,nombre:'Comercial'},
                                ]"
                                option-value="id"
                                option-label="nombre"
                            />
                        </div>

                    </div>

                    <br>
                    <div class="row">
                        <div class="col-12 col-md-10">
                             <q-input
		                              outlined
		                              v-model="empleado.puesto_trabajo"
		                              label="Puesto de trabajo"
		                              stack-label
		                              type="text"
		                            />
                        </div>
                    </div>
                    
			      </div>

                  <q-separator />

			      <div class="q-pa-md">
			        <div class="row q-col-gutter-md">
			        	<div class="col-12 col-md-3">
			        		<q-btn
								class="full-width"
								:loading="loading1"
								color="secondary"
								@click="ingresar_empleado()"
								icon-right="send"
								label="ingresar"
							>
								<template v-slot:loading>
								<q-spinner-facebook />
								</template>
							</q-btn>
			        	</div>
			        	
			        	<!-- <div class="col-12 col-md-2">
			        		<q-btn @click="" color="primary" class="block" icon="attach_file" label="Formulario" />
			        	</div> -->
			        </div>
			      </div>

            <!-- botones -->
      
                <!-- <button @click="ingresar_empleado">clickme</button> -->
             

              
           
			    </q-card>
			</div>
		</div>
	</div>

    </div>
</template>

<script src="../empleados_js/formulario_empleados.js"></script> 