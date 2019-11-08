<template>
  <div><br>
    <div class="row justify-center">

      <div class="col-8">
          
          <q-card class="my-card">
            <q-card-section class="bg-primary text-white">
              <div class="text-h6">Cuentas/listar cuenta</div>
             
            </q-card-section>

            <q-separator />
            <div class="col-6">
                  <div class="q-pa-md">
                     
                         
                         <template>
						  <div class="q-pa-md">
						    <q-table
						      title="Listado"
						      :data="data"
						      :columns="columns"
						      row-key="id"

						      selection="single"
     						 :selected.sync="selected"
     						 rows-per-page-label='Cantidad:'
     						 no-data-label='Sin datos'
     						 no-results-label="sin resultados"
     						 :pagination.sync="pagination"
     						 :filter="filter"
     						 :loading="loading"
     						 @request="onRequest"
      						  binary-state-sort
      						  :no-results-label="'sin datos niggis'"
						    >

						    <template v-slot:top-right>
						        <q-input borderless dense debounce="300" v-model="filter" placeholder="Buscar por nombre..">
						          <template v-slot:append>
						            <q-icon name="search" />
						          </template>
						        </q-input>
						      </template>
								
						    </q-table>
						  <q-list>
						    <q-item v-for="s in selected" :key="s.id">
						      {{s.name}}
						    </q-item>                 
						  </q-list>


						    <div class="q-mt-md">
						      Selected: {{ JSON.stringify(selected) }}
						    </div>
						  </div>
						</template>
                        
                
                  </div>
                </div>
            
          </q-card>
      </div>
          
    </div>
  </div>
</template>  

<script src="../cuentas_js/listar_cuentas.js"></script> 