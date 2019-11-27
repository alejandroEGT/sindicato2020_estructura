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
                        <q-item clickable v-close-popup @click="ruta()">
                          <q-item-section>
                            
                             <q-avatar icon="monetization_on" color="primary" text-color="white" />
                              </q-item-section>
                              <q-item-section>
                       
                               <q-item-label >Inicio y cierre mensual</q-item-label>
                          
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
                   <div class="col-2 col-md-2">
                      
                     <q-btn @click="listar" label="Buscar" icon="search" />
                  </div>

                  <div class="col-2 col-md-2">
                      
                     <q-btn @click="limpiar" label="Limpiar" icon="clear" />
                  </div>

                  <div class="col-2 col-md-2">
                      
                     <q-btn @click="ruta('/modulo-cuentas')" label="Volver" icon="keyboard_backspace" />
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
        
              
              > 
                <template v-slot:body="props">
                  <q-tr :props="props">
                    <q-td key="id" :props="props">{{ props.row.id }}</q-td>
                    <q-td key="titulo" :props="props">{{ props.row.titulo }}</q-td>
                    <q-td key="fecha" :props="props">{{ props.row.fecha }}</q-td>
                    <q-td key="archivo" :props="props">
                      <q-btn @click="fixed = true" flat icon="file_copy"  />
                            <q-dialog full-width full-height v-model="fixed" :no-backdrop-dismiss="true">
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

                                  
                                    <!-- {{ cuenta_id.id }} -->
                                    <iframe style="height:100%; width:100%;" :src="'../'+props.row.archivo" frameborder="0" allowfullscreen></iframe>

                              

                                </q-card>
                              </q-dialog>
                            

                    </q-td>
                    <q-td key="descripcion" :props="props">{{ props.row.descripcion }}</q-td>
                    <q-td key="ingreso" :props="props">{{ props.row.monto_ingreso }}</q-td>
                    <q-td key="egreso" :props="props">{{ props.row.monto_egreso }}</q-td>
                    <!-- <q-td key="view" :props="props">
                      
                      <q-btn />
                    </q-td> -->
                  
                  
                  </q-tr>               
                </template>   
              </q-table>   
            </div>


            <template>
              <div class="q-pa-md">
                <div class="row">
                   <div clas="col-12 col-5">
                     <q-table
                        :data="data_resumen"
                        :columns="columns_resumen"
                        row-key="name"
                        hide-bottom
                        
                      />
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