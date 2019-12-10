<template>
  <div><br>
    <div class="row justify-center">

      <div class="col-10">
          
          <q-card class="my-card">
            <q-card-section class="bg-primary text-white">
              <div class="row">
                <div class="col-12 col-md-9">
                  <div class="text-h6">Cuentas/listar cuenta</div>
                </div>
                <div class="col-12 col-md-2">
           
                    <q-btn-dropdown color="primary" icon="build" label="Opciones">
                      <q-list>
                        <q-item clickable @click="modal_ic = true" >
                          <q-item-section>
                             <q-avatar icon="monetization_on" color="primary" text-color="white" />
                          </q-item-section>
                              <q-item-section>
                       
                               <q-item-label >Inicio y cierre mensual</q-item-label>
                                <!-- full-width full-height -->
                                <q-dialog full-width v-model="modal_ic" :no-backdrop-dismiss="true">
                              <!-- <vue-friendly-iframe :src="'../'+props.row.archivo"></vue-friendly-iframe> -->
                            
                                  <q-card>
                                  <q-card-section>
                                    <div class="row">
                                      <div class="col-10 col-md-11">
                                          <div class="text-h6">Archivo</div>
                                      </div>
                                      <div class="col-10 col-md-1">
                                        <q-btn label="Volver" icon="keyboard_backspace" flat v-close-popup />
                                          <!-- <q-btn class="text-right" flat v-close-popup round dense icon="close" /> -->
                                      </div>
                                    </div>
                                    
                                  </q-card-section>

                                  <div>
                                    
                                        <div class="q-pa-md">
                                          <div class="row q-col-gutter-md">
                                            <div class="col-12 col-md-2">
                                              <q-select 
                                                standout="bg-primary text-white" 
                                                v-model="cuenta_id" 
                                                :options="options" 
                                                label="Seleccione cuenta"
                                                option-label="titulo"
                                                option-value="id"
                                                />
                                            </div>
                                            <div class="col-12 col-md-2">
                                              <q-select 
                                                standout="bg-primary text-white" 
                                                v-model="anio" 
                                                :options="anios" 
                                                label="Seleccione año"
                                                option-label="label"
                                                option-value="id"
                                                />
                                            </div>
                                            <div class="col-12 col-md-2">
                                              <q-select 
                                                standout="bg-primary text-white" 
                                                v-model="mes" 
                                                :options="meses" 
                                                label="Seleccione mes"
                                                option-label="label"
                                                option-value="id"
                                                />
                                            </div>
                                            <div class="col-12 col-md-2">
                                              <q-input v-model="monto_inicio" label="Monto inicial" />
                                            </div>
                                            <div class="col-12 col-md-2">
                                              <q-btn label="Calcular" />
                                            </div>
                                            <div class="col-12 col-md-2">
                                              <q-btn @click="ingresar_inicio_mes" label="Guardar" />
                                            </div>
                                          </div>
                                        </div>


                                  </div>
                                  
                     

                                </q-card>
                              </q-dialog>
                          
                          </q-item-section>
                        </q-item>

                      
                      </q-list>
                    </q-btn-dropdown>
                  
                </div>
              </div>   
            </q-card-section>

            <q-separator />
            <div class="col-6">

                     
                         
              <template>
						  <div class="q-pa-md">
                <div class="row q-col-gutter-md">
                  <div class="col-12 col-md-6">
                     <q-select 
                      standout="bg-primary text-white" 
                      v-model="cuenta_id" 
                      :options="options" 
                      label="Seleccione cuenta"
                      option-label="titulo"
                      option-value="id"
                       />
                  </div>
                  <div class="col-12 col-md-3">
                     <q-select 
                      standout="bg-primary text-white" 
                      v-model="anio" 
                      :options="anios" 
                      label="Seleccione año"
                      option-label="label"
                      option-value="id"
                       />
                  </div>
                  <div class="col-12 col-md-3">
                     <q-select 
                      standout="bg-primary text-white" 
                      v-model="mes" 
                      :options="meses" 
                      label="Seleccione mes"
                      option-label="label"
                      option-value="id"
                       />
                  </div>

                </div>

						   
						  <q-list>
						    <q-item v-for="s in selected" :key="s.id">
						      {{s.name}}
						    </q-item>                 
						  </q-list>
                <br>
                <div class="row justify-center">
                   <div class="col-12 col-md-2">
                      
                     <q-btn  class="full-width" @click="listar" label="Buscar" icon="search" />
                  </div>

                  <div class="col-12 col-md-2">
                      
                     <q-btn  class="full-width" @click="limpiar" label="Limpiar" icon="clear" />
                  </div>

                  <div class="col-12 col-md-2">
                      
                     <q-btn  class="full-width" @click="ruta('/modulo-cuentas')" label="Volver" icon="keyboard_backspace" />
                  </div>
                </div>
						    <!-- <div class="q-mt-md">
						      Selected: {{ JSON.stringify(selected) }}
						    </div> -->
						  </div>
						</template>
                
            

           <div v-if="view_tabla">
            <div class="q-pa-md">
                <q-table
                :title=" cuenta_id.titulo+', '+mes.label+' del '+anio.label "
                :data="tabla"
                :columns="columns"
                :separator="'cell'"
                row-key="name"
                class="my-sticky-header-table"
                flat
                bordered
                :pagination.sync="pagination"
              
                binary-state-sort
              
              > 
                <template v-slot:body="props">
                  <q-tr :props="props">
                    <q-td key="id" :props="props">{{ props.row.id }}</q-td>
                    <q-td key="titulo" :props="props">{{ props.row.titulo }}</q-td>
                    <q-td key="fecha" :props="props">{{ props.row.fecha }}</q-td>
                    <q-td key="archivo" :props="props">
                     
                      <q-btn @click="show('modal'+props.row.id)" flat icon="file_copy"  />

                      <modal 
                     
                        :name="'modal'+props.row.id"
                        :clickToClose="false"
                        :pivot-y="0.5"
                        :adaptive="true"
                        :scrollable="true"
                        :reset="true"
                        width="60%"
                        height="100%"
                      >
                          <q-card>
                                  <q-card-section>
                                    <div class="row">
                                      <div class="col-10 col-md-11">
                                          <div class="text-h6">Archivo</div>
                                      </div>
                                      <div class="col-10 col-md-1">
                                        <q-btn label="Volver" icon="keyboard_backspace" flat @click="hide('modal'+props.row.id)" />
                                      
                                      </div>
                                    </div>
                                    
                                  </q-card-section>

                                </q-card>

                                  <iframe style="height:100%; width:100%;" :src="'../'+props.row.archivo" frameborder="0" allowfullscreen></iframe>
                      </modal>
                            <!-- <q-dialog :ref="'dialog'+props.row.__index" @hide="onDialogHide" full-width full-height :no-backdrop-dismiss="true"> -->
                              <!-- <vue-friendly-iframe :src="'../'+props.row.archivo"></vue-friendly-iframe> -->
                            
                                  <!-- <q-card>
                                  <q-card-section>
                                    <div class="row">
                                      <div class="col-10 col-md-11">
                                          <div class="text-h6">Archivo</div>
                                      </div>
                                      <div class="col-10 col-md-1">
                                        <q-btn label="Volver" icon="keyboard_backspace" flat v-close-popup />
                                      
                                      </div>
                                    </div>
                                    
                                  </q-card-section>

                                  
                                   
                                    <iframe style="height:100%; width:100%;" :src="'../'+props.row.archivo" frameborder="0" allowfullscreen></iframe>

                              

                                </q-card>
                            </q-dialog> -->
                            

                    </q-td>
                    <q-td key="descripcion" :props="props">{{ props.row.descripcion }}</q-td>
                    <q-td key="ingreso" :props="props">{{ formatPrice(props.row.monto_ingreso) }}</q-td>
                    <q-td key="egreso" :props="props">{{ formatPrice(props.row.monto_egreso) }}</q-td>
                    <q-td key="view" :props="props">
                      
                      <q-btn id="show-modal"  @click="show('modal2'+props.row.id);
                            llenar_inputs(props.row.fecha, props.row.descripcion,props.row.monto_ingreso, props.row.monto_egreso)" 
                      color="primary" icon="edit">
                        <template v-slot:loading>
                          <q-spinner-facebook />
                        </template>
                      </q-btn>

                    
                      <modal 
                     
                        :name="'modal2'+props.row.id"
                        :clickToClose="false"
                        :pivot-y="0.5"
                        :adaptive="true"
                        :scrollable="true"
                        :reset="true"
                        width="60%"
                 
                        height="auto" 

                      >

                               <q-card>
                                  <q-card-section>
                                    <div class="row">
                                      <div class="col-10 col-md-11">
                                          <div class="text-h6">Modificación</div>
                                      </div>
                                      <div class="col-10 col-md-1">
                                        <q-btn label="Volver" icon="keyboard_backspace" flat @click="hide('modal2'+props.row.id)" />
                                          <!-- <q-btn class="text-right" flat v-close-popup round dense icon="close" /> -->
                                      </div>
                                    </div>
                                    
                                  </q-card-section>
                                  <template>
                                      <div class="row justify-center q-gutter-md">
                                        <q-card class="my-card">
                                          <q-card-section class="bg-primary text-white">
                                            <div class="text-h6">Modificar ID: {{ props.row.id }}</div>
                                            
                                          </q-card-section>

                                          <q-separator />
                                            <div class="q-pa-md">
                                              <div class="row q-col-gutter-md">
                                                <div class="col-8">
                                                    <q-input outlined
                                                          stack-label
                                                          label="Titulo"
                                                          :size="'sm'"
                                                          :value="props.row.titulo"
                                                          :disable="true"
                                                    />
                                                </div>
                                                <div class="col-2">
                                                    <!-- <q-btn
                                                  
                                                      dense
                                                      color="primary"
                                                      :size="'sm'"
                                                      label="Modificar"
                                                    /> -->
                                                </div>

                                              </div>
                                              <br>
                                              <div class="row q-col-gutter-md">
                                                <div class="col-8">
                                                  <q-input v-model="e_fecha" 
                                                          outlined
                                                          stack-label
                                                          label="Fecha"
                                                          type="date"
                                                          :value="props.row.fecha"
                                                  />
                                                </div>
                                                <div class="col-2">
                                                    <q-btn
                                                      dense
                                                      color="primary"
                                                      :size="'sm'"
                                                      label="Modificar"
                                                      @click="editar(props.row.id,'fecha', e_fecha)"
                                                    />
                                                </div>
                                              </div>
                                              <br>
                                              <div class="row q-col-gutter-md">
                                                <div class="col-8">
                                                  <q-input 
                                                          outlined
                                                          @input="val => { file = val[0] }"
                                                          stack-label
                                                          label="Archivo"
                                                          type="file"
                                                  />
                                                </div>
                                                <div class="col-2">
                                                    <q-btn
                                                      dense
                                                      color="primary"
                                                      :size="'sm'"
                                                      label="Modificar"
                                                      @click="editar_archivo(props.row.id,'archivo')"
                                                    />
                                                </div>
                                              </div>
                                              <br>
                                              <div class="row q-col-gutter-md">
                                                <div class="col-8">
                                                  <q-input v-model="e_descripcion" 
                                                          outlined
                                                          :value="props.row.descripcion"
                                                          stack-label
                                                          label="Descripcion"
                                                          type="textarea"
                                                  />
                                                </div>
                                                <div class="col-2">
                                                    <q-btn
                                                      dense
                                                      color="primary"
                                                      :size="'sm'"
                                                      label="Modificar"
                                                      @click="editar(props.row.id,'descripcion', e_descripcion)"
                                                    />
                                                </div>
                                              </div>
                                              <br>

                                            
                                              <div class="row q-col-gutter-md">
                                                <div class="col-8">
                                                  <q-input v-model="e_ingreso"
                                                          outlined
                                                          :value="props.row.monto_ingreso"
                                                          stack-label
                                                          label="Ingreso"
                                                          type="numeric"
                                                  />
                                                </div>
                                                <div class="col-2">
                                                    <q-btn
                                                      dense
                                                      color="primary"
                                                      :size="'sm'"
                                                      label="Modificar"
                                                      @click="editar(props.row.id,'ingreso', e_ingreso)"
                                                    />
                                                </div>
                                              </div>

                                              <br>
                                              <div class="row q-col-gutter-md">
                                                <div class="col-8">
                                                  <q-input v-model="e_egreso" 
                                                          outlined
                                                          :value="props.row.monto_egreso"
                                                          stack-label
                                                          label="Egreso"
                                                          type="numeric"
                                                  />
                                                </div>
                                                <div class="col-2">
                                                    <q-btn
                                                      dense
                                                      color="primary"
                                                      :size="'sm'"
                                                      label="Modificar"
                                                      @click="editar(props.row.id,'egreso', e_egreso)"
                                                    />
                                                </div>
                                              </div>


                                              <hr>
                                              <div class="row q-col-gutter-md">
                                                <div class="col-8">
                                                  <q-btn 
                                                    label="Eliminar" 
                                                    icon="delete" 
                                                    color="red" 
                                                    @click="eliminar(props.row.id, 'edit'+props.row.__index)"
                                                  />
                                          
                                                </div>

                                              
                                            </div>
                                              
                                      
                                          </div>
                                        </q-card>

                                       
                                      </div>
                                    </template>
                                
                                </q-card>
                      </modal>
                    </q-td>
                  
                  
                  </q-tr>               
                </template>   
              </q-table>   
            </div>


            <template>
              <div class="q-pa-md">
                <div class="row q-col-gutter-md">
                   <div clas="col-12 col-5">
                     <q-table
                        :data="data_resumen"
                        :columns="columns_resumen"
                        row-key="name"
                        hide-bottom
                        
                      />
                   </div>  
                   <div clas="col-12 col-5">
                     <q-table
                        :data="data_acumulado"
                        :columns="columns_acumulado"
                        row-key="name"
                        hide-bottom  
                      >
                          <template v-slot:body="props">
                          <q-tr :props="props">
                            <q-td key="name" :props="props">Arrastre</q-td>
                            <q-td key="valor" :props="props">{{ formatPrice(monto_inicio) }}</q-td>
                          </q-tr>
                           <q-tr :props="props">
                            <q-td key="name" :props="props">Monto del mes</q-td>
                            <q-td key="valor" :props="props">{{formatPrice(ingresos-egresos)}}</q-td>
                          </q-tr>
                          <q-tr :props="props">
                            <q-td key="name" :props="props">Total acumulado</q-td>
                            <q-td key="valor" :props="props">{{ formatPrice(monto_inicio +(ingresos-egresos))}}</q-td>
                          </q-tr>
                          </template>
                     </q-table>
                   </div>   
                </div>
              </div>
            </template>

            
           </div>

          <!-- {{ ingresos +' - '+egresos + ' = '+ (ingresos-egresos) }} -->
          
     
          </div>
            
          </q-card>
      </div>
          
    </div>
  </div>
</template>  

<script src="../cuentas_js/listar_cuentas.js"></script> 