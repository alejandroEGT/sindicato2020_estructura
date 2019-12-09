<template>
    <div class="q-pa-md">
        <q-banner inline-actions class="bg-grey-3">
            <div class="row">
                <div class="col-md-7">
                  
                    <q-icon style="font-size: 3rem;" name="monetization_on" color="primary" />
                 
                    Liquidaciones/formulario
                </div>

                <div class="col-md-5">
                     <!-- boton refrescar -->
                    <div class="row">
                        <div class="col-4 col-md-6">
                            <q-btn
                                    flat
                                    label="Listar Liquidaciones"
                                    icon-right="person_add"
                                    color="green"
                                    @click="url('/listar-liquidaciones')"
                                    
                                />
                        </div>
                        <div class="col-4 col-md-4">
                            <q-btn
                                flat
                                label="VOLVER"
                                icon-right="settings_backup_restore"
                                color="red"
                                @click="url('/modulo-liquidaciones')"
                                
                            />
                        </div>
                    </div>
                </div>

            </div>
        </q-banner>


        <div class="row justify-center">
	    
	      <div class="col-12">

              <q-card class="my-card">
		            <q-card-section class="bg-primary text-white">
		              <div class="text-h6">Formulario</div>
		             
		            </q-card-section>

		             <q-separator />
                    <q-stepper
                        v-model="step"
                        vertical
                        color="primary"
                        animated
                        >
                        <q-step
                            :name="1"
                            title="Seleccione la persona"
                            icon="settings"
                            :done="step > 1"
                        >
                                <!-- cuerpo aqui-->
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
                                            v-model="fecha_nacimiento"
                                            outlined
                                            label="Fecha de ingreso"
                                            stack-label
                                            type="date"
                                            :disable="true"
                                            
                                        />
                                    </div>

                                    <div class="col-12 col-md-3">
                                        <q-input
                                            :loading="loading2"
                                            v-model="puesto_trabajo"
                                            outlined
                                            label="Cargo"
                                            stack-label
                                            type="text"
                                            :disable="true"
                                            
                                        />
                                    </div>
                                </div>

                            <q-stepper-navigation>
                            <q-btn @click="step = 2" v-if="rut!=''" color="primary" label="Continuar" />
                            </q-stepper-navigation>
                        </q-step>

                        <q-step
                            :name="2"
                            title="Datos del mes"
                            icon="create_new_folder"
                            :done="step > 2"
                        >
                           
                            <!-- cuerpo aqui-->
                             <div class="q-pa-md row q-col-gutter-md">
                                 <div class="col-12 col-md-2">
                                    <q-input
                                            outlined
                                            v-model="fecha_emicion"
                                            label="Fecha emición de liquidación"
                                            stack-label
                                            type="date"
                                                      
                                   />
                                 </div>
                                 <div class="col-12 col-md-2">
                                        <q-input
                                            outlined
                                            v-model="sueldo_base_mensual"
                                            label="Sueldo base mensual"
                                            stack-label
                                            type="text"
                                           
                                            
                                        />
                                    </div>  
                             </div>
                             
                                  <div class="q-pa-md row q-col-gutter-md">
                                    <!-- <div class="col-6 col-md-2">Nombre:</div> -->
                                     
                                    <div class="col-12 col-md-2">
                                        <q-input
                                            outlined
                                            v-model="dias_trabajados"
                                            label="Días trabajados"
                                            stack-label
                                            type="text"
                                        
                                            
                                        />
                                    </div>

                                     <div class="col-12 col-md-2">
                                        <q-input
                                            outlined
                                            v-model="horas_extras"
                                            label="Horas extras (Hs)"
                                            stack-label
                                            type="text"
                                         
                                            
                                        />
                                    </div>

                                    <div class="col-12 col-md-2">
                                        <q-input
                                            outlined
                                            v-model="valor_horas_extras"
                                            label="Valor de horas extras"
                                            stack-label
                                            type="text"
                                         
                                            
                                        />
                                    </div>

                                   
                                </div>

                                   <div class="q-pa-md row q-col-gutter-md">
                                    <!-- <div class="col-6 col-md-2">Nombre:</div> -->
                                   

                                    <div class="col-12 col-md-2">
                                        <q-input
                                            outlined
                                            v-model="valor_hora_ordinaria"
                                            label="Valor de hr. ordinarias"
                                            stack-label
                                            type="text"
                                         
                                            
                                        />
                                    </div>

                                    <div class="col-12 col-md-2">
                                            <q-select 
                                            standout="bg-primary text-white" 
                                            v-model="afp" 
                                            :options="afps" 
                                            label="AFP"
                                            option-label="nombre"
                                            option-value="id"
                                            />
                                    </div>
                                        <div class="col-12 col-md-2">
                                        <q-select 
                                            standout="bg-primary text-white" 
                                            v-model="isapre" 
                                            :options="isapres" 
                                            label="Isapre"
                                            option-label="nombre"
                                            option-value="id"
                                        />
                                    </div>
                                    <!-- <div class="col-12 col-md-2">
                                        <q-input
                                            :loading="loading2"
                                            outlined
                                            v-model="fecha_nacimiento"
                                            label="Tasa de impuesto"
                                            stack-label
                                            type="text"
                                           
                                            
                                        />
                                    </div> -->
                                </div>


                            <q-stepper-navigation>
                            <q-btn @click="guardar_liq" color="primary" label="Registrar y Continuar" />
                            <q-btn flat @click="step = 1" color="primary" label="Volver" class="q-ml-sm" />
                            </q-stepper-navigation>
                        </q-step>

                        <q-step
                            :name="3"
                            title="Haberes y descuentos legales"
                            icon="assignment"
                            :done="step > 3"
                            
                        >

                             <q-table
                                title="Listado"
                                :data="tabla"
                                :columns="columns"
                                :separator="'cell'"
                                row-key="name"
                                class="my-sticky-header-table"
                                flat
                                bordered
                                hide-bottom
                                :pagination.sync="pagination"
                                :selected-rows-label="getSelectedString"
                                selection="multiple"
                                :selected.sync="selected"
                        
                            
                            > 
                                <template v-slot:body="props">
                                <q-tr :props="props">
                                    <q-td key="id" :props="props">{{ props.row.id }}</q-td>
                                    <q-td key="tipo" :props="props">{{ props.row.tipo }}</q-td>
                                    <q-td key="concepto" :props="props">{{ props.row.tipo_detalle }}</q-td>
                                    <q-td key="monto" :props="props">
                                    
                                        <q-input
                                                debounce="500"
                                                filled
                                                placeholder="$ Monto.."
                                                icon="attach_money"
                                                @keyup.enter="registrar_detalle_h_d(liquidacion_id,$event, props.row.id)"
                                            />

                                    </q-td>

                                    <q-td>
                                           <q-icon v-if="props.row.verify=='S'" class="text-teal" name="done" />
                                           <q-icon v-if="props.row.verify=='N'" name="close" />
                                       
                                    </q-td>
                                
                                
                                
                                </q-tr>               
                                </template>   
                            </q-table>   
                            <!-- Selected: {{ JSON.stringify(selected) }} -->


                            <q-stepper-navigation>
                             <q-btn @click="step = 4" color="primary" label="Continuar" />
                            <q-btn flat @click="step = 2" color="primary" label="Volver" class="q-ml-sm" />
                            </q-stepper-navigation>
                        </q-step>

                        <q-step
                            :name="4"
                            title="Finalizar"
                            icon="add_comment"
                        >
                            Try out different ad text to see what brings in the most customers, and learn how to
                            enhance your ads using features like ad extensions. If you run into any problems with
                            your ads, find out how to tell if they're running and how to resolve approval issues.

                            <q-stepper-navigation>
                            <q-btn color="primary" label="Finalizar" />
                            <q-btn flat @click="step = 3" color="primary" label="Volver" class="q-ml-sm" />
                            </q-stepper-navigation>
                        </q-step>
                        </q-stepper>
                    
                            
                     





                     <div class="q-pa-md row">
                         <!-- <div class="col-6 col-md-2">Nombre:</div> -->
                         
                     </div>
					
				
		        </q-card>
		   </div>
	      </div>
    </div>
    
</template>

<script src="../liquidaciones_js/formulario_liquidaciones.js"></script>