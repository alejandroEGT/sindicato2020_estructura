<template>
    <div>
        <br><br>
        <div class="row justify-center">
           <div class="col-md-7">
                <b-card no-body>
                    <b-card-header :style="header_color" >
                    Cuentas/crear cuenta
                    </b-card-header>
                    <b-card-body>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">nombre:</label>
                                
                                <b-form-input size="sm" v-model="nombre" placeholder="Ingrese nombre"></b-form-input>
                            </div>
                            <!-- <div class="col-md-6">
                                <label for="">Apellidos:</label>
                                <b-form-input v-model="apellidos" placeholder="Ingrese apellidos"></b-form-input>
                            </div> -->
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Descripción:</label>
                                <b-form-textarea 
                                size="sm"
                                    rows="5"
                                    max-rows="6" 
                                    v-model="descripcion"
                                    placeholder="Ingrese descripción">
                                    </b-form-textarea>
                            </div>
                            <!-- <div class="col-md-6">
                                <label for="">Fecha de naciemiento:</label>
                                <b-form-input type="date" v-model="fecha_nacimiento" placeholder="Ingrese fecha"></b-form-input>
                            </div> -->
                        </div>
                        <br>
                        
                        <hr>
                        <b-button @click="onSubmit" size="sm" variant="primary"><i class="fas fa-save"></i> Registrar</b-button>
                        <b-button  size="sm" v-b-modal.modal-1><i class="fas fa-undo-alt"></i> Crear sub-cuenta</b-button>
                        <b-button  size="sm" @click="ruta('modulo-cuentas')"><i class="fas fa-undo-alt"></i> Volver</b-button>

                    </b-card-body>
               </b-card>
           </div>
        </div>
        <b-modal id="modal-1" 
                  title="Crear subcuenta"
                  header-bg-variant="dark"
                  header-text-variant="white">
               
                <q-card-section  style="max-height: 100vh" class="scroll">
                    <b-form-select
                      size="sm"
                      v-model="cuenta_id"
                      :options="options"
                      label="Seleccione cuenta"
                      class="mb-3"
                      value-field="id"
                      text-field="titulo"
                      disabled-field="notEnabled"
                    >
                      <template  v-slot:first>
                                <b-form-select-option :value="''">--Seleccione tipo de familiar--</b-form-select-option>
                            </template>
                    </b-form-select>
                     <br>
                      <b-form-input size="sm" 
                        v-model="nombre_s" 
                        placeholder="Nombre de subcuenta"
                        >
                      </b-form-input>
                      <br>
                      <label for="">Descripción:</label>
                      <b-form-textarea 
                        size="sm"
                        rows="5"
                        max-rows="6" 
                        v-model="descripcion_s"
                        placeholder="Descripcion de la subcuenta">
                      </b-form-textarea>
                                   

                  </q-card-section>

                  <q-separator />

                  <!-- <q-card-actions align="right">
                      <q-btn @click="guardar_subcuenta" flat label="Crear" color="primary"  />
                      <q-btn flat label="Cerrar" color="black" v-close-popup />
                                  
                  </q-card-actions> -->

                  <template v-slot:modal-footer>
                    <div class="w-100">
                     
                      <b-button
                        variant="primary"
                        size="sm"
                        class="float-left"
                        @click="guardar_subcuenta" 
                      >
                        Guardar
                      </b-button>

                      <!-- <b-button
                        variant="dark"
                        size="sm"
                        class="float-right"
                        @click="show=false"
                      >
                        Cerrar
                      </b-button> -->
                    </div>
                  </template>
             


        </b-modal>
    </div>
</template>



    <!-- <div class="row justify-center">
    
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


                        
                              <div class="row justify-left">
                                  <div class="col-2">
                                    <q-btn class="" label="Crear cuenta" type="submit" color="primary" />
                                  </div>
                            

                                <div class="row justify-center">
                                  <div class="col-2">
                                    <q-btn @click="fixed = true" label="subCuenta" color="purple" />
                                  </div>
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
          
    </div> -->
  
 

<script src="../cuentas_js/crear_cuentas.js"></script> 

<style >
bg-dark {
    /* background: #1d1d1d !important; */
    background: red !important;
}
</style>