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


                        
                              <div class="row justify-center">
                                <div class="col-2">
                                  <q-btn class="" label="Crear" type="submit" color="primary" />
                                </div>
                              </div>
                           
                          </q-form>
                        
                
                  </div>
                </div>
            
          </q-card>
      </div>
          
    </div>
  </div>
</template>  

<script src="../cuentas_js/crear_cuentas.js"></script> 