<template>
	 <div>
        <br><br>
        <div class="row justify-center">
           <div class="col-md-8">
                <b-card no-body>
                    <b-card-header :style="header_color" >
                    CREAR SOCIO
                    </b-card-header>

					 <b-card-body>
						<div class="row q-col-gutter-md">
				          <div class="col-12 col-md-7">
				        	 	
								<b-form-select 
									v-model="cuenta_id" 
									:options="options"
									value-field="id"
									text-field="titulo"
									size="sm"
									@change="change_cuenta(2)"
									>
									<template  v-slot:first>
										<b-form-select-option :value="''">--Seleccione cuenta--</b-form-select-option>
									</template>

								</b-form-select>

				     	  </div>

				     	  <div class="col-12 col-md-5">
				     	  <!-- 	{{ subcuentas }} -->
				        	 	
								<b-spinner v-if="load==true" small></b-spinner>
								<b-form-select 
									v-if="load==false"
								   :loading="loading2"
									v-model="subcuenta" 
									:options="subcuentas"
									value-field="id"
									text-field="titulo"
									size="sm"
								
									>
									<template  v-slot:first>
										<b-form-select-option :value="''">--Seleccione sub cuenta--</b-form-select-option>
									</template>

								</b-form-select>
				     	  </div>
				     	</div>
				     	<hr>
						<div class="row">
				         

				     	  <div class="col-12 col-md-3">
				            	<b-form-input 
									size="sm" 
									type="date" 
									v-model="fecha" 
									placeholder="Ingrese fecha">
								</b-form-input>
				          </div>

				          <div class="col-12 col-md-3">
				            		
									<b-form-input 
									    size="sm" 
										v-model="codigo" 
										placeholder="Codigo o identificador">
									</b-form-input>
				          </div>

				           <div class="col-12 col-md-3">
				        	 	<!-- <q-select 
	                                standout="bg-primary text-white" 
	                                v-model="tipo_monto_id" 
	                                :options="[
											{id:'1', label:'Ingreso'},
											{id:'2', label:'Egreso'}
	                                ]" 
	                                label="tipo de monto"
	                                option-label="label"
	                                option-value="id"
	                            /> -->

								<b-form-select 
									v-model="tipo_monto_id" 
									:options="[
											{id:'1', label:'Ingreso'},
											{id:'2', label:'Egreso'}
	                                ]"
									value-field="id"
									text-field="label"
									size="sm"
								
									>
									<template  v-slot:first>
										<b-form-select-option :value="''">--Tipo de monto--</b-form-select-option>
									</template>

								</b-form-select>
				     	  </div>

				     	  <div class="col-12 col-md-3">
				            		<!-- <q-input
		                              outlined
		                              v-model="monto"
		                              label="Monto"
		                              stack-label
		                              type="numeric"
		                            /> -->
									<b-form-input 
									    type="number"
									    size="sm" 
										v-model="monto"
										placeholder="$ Monto">
									</b-form-input>
				          </div>

				        </div>

						<br>


				        <div class="row q-col-gutter-md">
				         

				          <div class="col-12 col-md-12">
				            	<!-- <q-input
                                outlined
                                v-model="descripcion"
                                label="Descripcion de cuenta"
                                stack-label
                                type="textarea"
                              /> -->

							  <b-form-textarea
								id="textarea"
								v-model="descripcion"
								placeholder="Descripcion de cuenta..."
								rows="3"
								max-rows="6"
							  ></b-form-textarea>
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
					          	<b-button @click="guardar" size="sm" variant="primary"><i class="fas fa-save"></i> Registrar</b-button>
                        <b-button  size="sm" @click="ruta('modulo-cuentas')"><i class="fas fa-undo-alt"></i> Volver</b-button>
								  <!-- <q-btn @click="guardar" color="primary" label="guardar" icon="create" /> -->
					        </div>
				        </div>
					</b-card-body>
				</b-card>
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