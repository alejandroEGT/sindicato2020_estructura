<template>
<div>
    <q-select 
        outlined 
        v-model="liquidacion" 
        :options="list" 
        option-label="label"
        option-value="id"
        label="Liquidaciones"

        filled
        use-input
        hide-selected
        fill-input
        input-debounce="0"
         @filter="filterFn"
         
    />


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
			        <div class="q-pa-md row q-col-gutter-md">
			        	<div class="col-12 col-md-3">
			        		<q-input
		                              outlined
		                             v-model="nombre"
		                              label="Nombre completo"
		                              stack-label
		                              type="text"
                                      :disable="true"
		                            />
			        	</div>
			        	<div class="col-12 col-md-3">
			        		<q-input
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
		                              outlined
		                              v-model="fehca_contrato"
		                              label="Fecha ingreso"
		                              stack-label
		                              type="date"
                                      :disable="true"
		                            />
			        	</div>
                        <div class="col-12 col-md-3">
			        		<q-input
		                              outlined
		                              v-model="cargo"
		                              label="Cargo"
		                              stack-label
		                              type="text"
                                      :disable="true"
		                            />
			        	</div>
                         <div class="col-12 col-md-3">
			        		
			        	</div>
			        	<!-- <div class="col-12 col-md-2">
			        		<q-btn @click="" color="primary" class="block" icon="attach_file" label="Formulario" />
			        	</div> -->
			        </div>
                     <q-separator />
                    <!-- cuerpo aqui-->
              <div class="q-pa-md row q-col-gutter-md">
                    <div class="col-12 col-md-3">
                        <q-input
                                 outlined
                                 v-model="fecha_emicion"
                                 label="Fecha emición de liquidación"
                                 stack-label
                                 type="date"                            
                        />
                    </div>
                    <div class="col-12 col-md-3">
                         <q-input
                             outlined
                             v-model="sueldo_base_mensual"
                            label="Sueldo base mensual"
                             stack-label
                            type="text"
  
                        />
                    </div>  

                    <div class="col-12 col-md-3">
                        <q-input
                             outlined
                             v-model="dias_trabajados"
                             label="Días trabajados"
                             stack-label
                             type="text"
                                        
                                            
                        />
                     </div>
                     <div class="col-12 col-md-3">
                          <q-input
                              outlined
                              v-model="valor_hora_ordinaria"
                              label="Valor de hr. ordinarias"
                              stack-label
                              type="text"
                                         
                                            
                          />
                      </div>
              </div>
                             
              <div class="q-pa-md row q-col-gutter-md">
                                    <!-- <div class="col-6 col-md-2">Nombre:</div> -->
                                     

                     <div class="col-12 col-md-3">
                         <q-input
                             outlined
                             v-model="horas_extras"
                             label="Horas extras (Hs)"
                             stack-label
                             type="text"
                                         
                                            
                        />
                     </div>

                     <div class="col-12 col-md-3">
                         <q-input
                             outlined
                             v-model="valor_horas_extras"
                             label="Valor de horas extras"
                             stack-label
                             type="text"
                                         
                                            
                         />
                     </div>

                      <div class="col-12 col-md-3">
                           <q-select 
                             outlined 
                             v-model="afp" 
                             :options="afps" 
                             label="AFP"
                             option-label="nombre"
                             option-value="id"
                           />
                     </div>
                     <div class="col-12 col-md-3">
                        <q-select 
                            outlined 
                            v-model="isapre" 
                            :options="isapres" 
                            label="Isapre"
                            option-label="nombre"
                            option-value="id"
                         />
                     </div>

                                   
              </div>

              

                    
			      </div>

                  <q-separator />

            <!-- botones -->
            <q-card-actions align="right">
                <!-- <button @click="ingresar_empleado">clickme</button> -->
              <q-btn
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

              
            </q-card-actions>

            <q-separator/>

              <div class="q-pa-md row">
                <div class="col-md-12">
                    <q-table
                                title="Listadode haberes y descuentos"
                                :data="tabla"
                                :columns="columns"
                                :separator="'cell'"
                                row-key="name"
                                class="my-sticky-header-table"
                                flat
                                bordered
                                hide-bottom
                                :pagination.sync="pagination"
                            
                                :selected.sync="selected"
                        
                            
                            > 
                                <template v-slot:body="props">
                                <q-tr :props="props">
                                    <q-td key="id" :props="props">{{ props.row.id }}</q-td>
                                    <q-td key="tipo" :props="props">{{ props.row.tipo }}</q-td>
                                    <q-td key="concepto" :props="props">{{ props.row.tipo_detalle }}</q-td>
                                    <q-td key="monto" :props="props">
                                    
                                        <q-input
                                               
                                                :value="props.row.monto"
                                                debounce="500"
                                                filled
                                                placeholder="$ Monto.."
                                                icon="attach_money"
                                                @keyup.enter="registrar_detalle_h_d(url_id,$event, props.row.id)"
                                            />

                                    </q-td>

                                    <q-td key="estado">
                                           <q-icon v-if="props.row.verify=='S'" class="text-teal" name="done" />
                                           <q-icon v-if="props.row.verify=='N'" name="close" />
                                       
                                    </q-td>
                                    <q-td key="opcion">
                                           <q-btn v-if="props.row.verify=='S'" class="text-teal" label="borrar" name="done" />
                                           <b v-if="props.row.verify=='N'" >--</b>
                                       
                                    </q-td>
                                
                                
                                
                                </q-tr>               
                                </template>   
                   </q-table>  
                </div>
              </div>
			    </q-card>
			</div>
		</div>
	</div>

    </div>
</div>
</template>

<script src="../liquidaciones_js/edit_liquidaciones.js"></script>