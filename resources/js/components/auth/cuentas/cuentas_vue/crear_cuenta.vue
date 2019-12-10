<template>
  <div><br>
    <div class="row justify-center">
    
      <div class="col-8">
          
          <q-card class="my-card">
            <q-card-section class="bg-primary text-white">
              <div class="text-h6">Cuentas/crear cuenta</div>
             
            </q-card-section>

            <q-separator />
            <div class="col-6">
                  <div class="q-pa-md">
                     
                          <q-form @submit="onSubmit" @reset="onReset" class="q-col-gutter-md q-col-gutter-md">

                              <q-input
                              outlined
                              v-model="nombre"
                              label="Nombre de cuenta"
                              stack-label
                              type="text"
                            />

                             <q-input
                                outlined
                                v-model="descripcion"
                                label="Descripcion de cuenta"
                                stack-label
                                type="textarea"
                              />


                        
                              <div class="row justify-left q-gutter-md">
                                  <div class="col-12 col-md-2">
                                    <q-btn class="full-width" label="Crear cuenta" type="submit" color="primary" />
                                  </div>

                                  <div class="col-12 col-md-2">
                                    <q-btn class="full-width" @click="fixed = true" label="subCuenta" color="purple" />
                                  </div>
                            

                               
                              </div>  
                             
                          </q-form>
                          
                          <q-dialog full-width v-model="fixed" :no-backdrop-dismiss="true">
                              <q-card>
                                <q-card-section>
                                  <div class="text-h6">Crear subcuenta</div>
                                </q-card-section>

                                <q-separator />

                                <q-card-section  style="max-height: 100vh" class="scroll">
                                  <!-- {{ cuenta_id.id }} -->
                                  <q-select 
                                    standout="bg-primary text-white" 
                                    v-model="cuenta_id" 
                                    :options="options" 
                                    label="Seleccione cuenta"
                                    option-label="titulo"
                                    option-value="id"
                                     />
                                  <br>
                                  <q-input
                                    outlined
                                    v-model="nombre_s"
                                    label="Nombre de subcuenta"
                                    stack-label
                                    type="text"
                                  />
                                  <br>
                                   <q-input
                                      outlined
                                      v-model="descripcion_s"
                                      label="Descripcion de la subcuenta"
                                      stack-label
                                      type="textarea"
                                    />

                                </q-card-section>

                                <q-separator />

                                <q-card-actions align="right">
                                  <q-btn @click="guardar_subcuenta" flat label="Crear" color="primary"  />
                                  <q-btn flat label="Cerrar" color="black" v-close-popup />
                                  
                                </q-card-actions>
                              </q-card>
                            </q-dialog>

                          
                  </div>
                </div>
            
          </q-card>

          
      </div>
          
    </div>
  </div>
</template>  

<script src="../cuentas_js/crear_cuentas.js"></script> 