<template>
	<div><br>
    	<div class="row justify-center">
	    
	      <div class="col-8">
	          
		          <q-card class="my-card">
		            <q-card-section class="bg-primary text-white">
		              <div class="text-h6">Cuentas/formulario</div>
		             
		            </q-card-section>

		             <q-separator />
					
					<dir class="q-pa-md">
						<div class="row q-col-gutter-md">
				          <div class="col-12 col-md-8">
				        	 	<q-select 
				        	 	  
				        	 	    @input="change_cuenta(2)"
	                                standout="bg-primary text-white" 
	                                v-model="cuenta_id" 
	                                :options="options" 
	                                label="Seleccione cuenta"
	                                :option-label="(item) => item === null ? 'Null value' : item.titulo+' - '+item.descripcion"
	                                option-value="id"
	                            />

				     	  </div>

				     	  <div class="col-12 col-md-4">
				     	  <!-- 	{{ subcuentas }} -->
				        	 	<q-select 
				        	 		:loading="loading2"
	                                standout="bg-primary text-white" 
	                                v-model="subcuenta" 
	                                :options="subcuentas" 
	                                label="Seleccione sub cuenta"
	                                option-label="titulo"
	                                option-value="id"
	                            />
				     	  </div>
				     	</div>
				     	<hr>
						<div class="row q-col-gutter-md">
				         

				     	  <div class="col-12 col-md-3">
				            		<q-input
		                              outlined
		                              v-model="fecha"
		                              label="Fecha"
		                              stack-label
		                              type="date"
		                            />
				          </div>

				          <div class="col-12 col-md-3">
				            		<q-input
		                              outlined
		                              v-model="codigo"
		                              label="Codigo o identificador"
		                              stack-label
		                              type="text"
		                            />
				          </div>

				           <div class="col-12 col-md-3">
				        	 	<q-select 
	                                standout="bg-primary text-white" 
	                                v-model="tipo_monto_id" 
	                                :options="[
											{id:'1', label:'Ingreso'},
											{id:'2', label:'Egreso'}
	                                ]" 
	                                label="tipo de monto"
	                                option-label="label"
	                                option-value="id"
	                            />
				     	  </div>

				     	  <div class="col-12 col-md-3">
				            		<q-input
		                              outlined
		                              v-model="monto"
		                              label="Monto"
		                              stack-label
		                              type="numeric"
		                            />
				          </div>

				        </div>

						<br>


				        <div class="row q-col-gutter-md">
				         

				          <div class="col-12 col-md-12">
				            	<q-input
                                outlined
                                v-model="descripcion"
                                label="Descripcion de cuenta"
                                stack-label
                                type="textarea"
                              />
				          </div>

				        </div>

				        <br>

				        <div class="column">
					        <div class="col self-start">
					          	<q-input
					          		@input="val => { file = val[0] }"
									type="file"
									
					          	/>
					        </div>

					        <div class="col self-end">
					          	<q-btn @click="guardar" color="primary" label="guardar" icon="create" />
					        </div>
				        </div>
				    </dir>
		        </q-card>
		   </div>
		</div>
	</div>
</template>

<script src="../cuentas_js/formulario.js"></script> 



<!--   <dir class="row">
			            	<div class="col-10 col-md-4">
			            		<q-select 
                                standout="bg-primary text-white" 
                                v-model="cuenta_id" 
                                :options="options" 
                                label="Seleccione cuenta"
                                option-label="titulo"
                                option-value="id"
                                 />
			            	</div>
			            	<div class="col-10 col-md-4">
			            		<q-input
	                              outlined
	                              v-model="nombre"
	                              label="Nombre de cuenta"
	                              stack-label
	                              type="text"
	                            />
			            	</div>
			            	<div class="col-10 col-md-4">
			            		<q-input
	                              outlined
	                              v-model="nombre"
	                              label="Nombre de cuenta"
	                              stack-label
	                              type="text"
	                            />
			            	</div>
			            </dir> -->