 <template>
 <div class="q-pa-md">
        <div class="row justify-center">
	    
	      <div class="col-6">

              <q-card class="my-card">
		            <q-card-section class="bg-primary text-white">
		               <div class="text-h6">Liquidaciones/detalle haberes y descuentos legales</div>
		             
		            </q-card-section>

		             <q-separator />
                   
                     
                     <div class="q-pa-md row justify-center">
                        <div class="col-12 col-md-12">
                            <div class="row q-pa-md ">
                                <div class="col-12 col-md-12">
                                    <q-select 
                                        outlined v-model="detalle" 
                                        :options="detalles" 
                                        option-label="tipo"
                                        option-value="id"
                                        label="Tipo detalle"

                                    />
                                </div> 
                                
                            </div>

                            <div class="q-pa-md row">
                                <div class="col-12 col-md-12">
                                    <q-input
                                     
                                        outlined
                                        v-model="concepto"
                                        label="Concepto"
                                        stack-label
                                        type="textarea"
                                                
                                                    
                                    />
                                </div> 
                            </div>

                             <div class="q-pa-md row">
                                <div class="col-12 col-md-12">
                                    <q-btn
                                      
                                        outlined
                                        label="Guardar"
                                        @click="ingresar"
                                                
                                                    
                                    />
                                </div> 
                            </div>

                        </div> 
                     </div>

                     <div class="q-pa-md row justify-center">
                         <div class="col-12 col-md-12">

                              <q-table
                                title="Listado"
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
                                    <q-td key="tipo" :props="props">{{ props.row.tipo }}</q-td>
                                    <q-td key="tipo_detalle" :props="props">{{ props.row.tipo_detalle }}</q-td>
                                    <q-td key="opcion" :props="props">
                                    
                                    <q-btn @click="eliminar(props.row.id)" flat icon="delete"  />
                                          
                                            

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
    <!-- tipo_detalle
concepto -->
</template>

<script src="../liquidaciones_js/detalle_haberes_descuentos.js"></script>