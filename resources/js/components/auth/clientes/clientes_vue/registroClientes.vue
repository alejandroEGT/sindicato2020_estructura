<template>
  <div>
    <div class="q-pa-md q-gutter-md">
      <div class="row justify-center">
        <div class="col-12 col-md-8">
          <q-card class="my-card">
            <!-- titulo  -->
            <q-card-section class="bg-primary text-white">
              <div class="text-h6">Registro de Clientes</div>
            </q-card-section>

            <q-separator />

            <!-- formulario -->
            <q-card-section>
              <div class="row justify-start q-col-gutter-md">
                <div class="col-12 col-md-4">
                  <q-input
                    outlined
                    counter
                    maxlength="10"
                    v-model="fechaNac"
                    label="Ingrese fecha de nacimiento"
                    stack-label
                    type="date"
                  />
                </div>

                <div class="col-12 col-md-4">
                  <q-input
                    outlined
                    counter
                    maxlength="20"
                    v-model="rut"
                    label="Ingrese rut del cliente"
                    stack-label
                    type="text"
                    hint="El rut debe ser sin punto ni guion"
                    :rules="[
                              val => val.length <= 20 || 'El maximo da caracteres es de 20' , 
                              val => val.length >= 2 || 'El minimo de caracteres es de 2'
                            ]"
                  />
                </div>

                <div class="col-12 col-md-4">
                  <q-input
                    outlined
                    counter
                    maxlength="50"
                    v-model="nombres"
                    label="Ingrese nombres"
                    stack-label
                    type="text"
                    :rules="[
                              val => val.length <= 50 || 'El maximo da caracteres es de 50',
                              val => val.length >= 3 || 'El minimo de caracteres es de 3'
                            ]"
                  />
                </div>

                <div class="col-12 col-md-4">
                  <q-input
                    outlined
                    counter
                    maxlength="50"
                    v-model="aPaterno"
                    label="Ingrese apellido paterno"
                    stack-label
                    type="text"
                    :rules="[
                              val => val.length <= 50 || 'El maximo da caracteres es de 50',
                              val => val.length >= 3 || 'El minimo de caracteres es de 3'
                            ]"
                  />
                </div>

                <div class="col-12 col-md-4">
                  <q-input
                    outlined
                    counter
                    maxlength="50"
                    v-model="aMaterno"
                    label="Ingrese apellido materno"
                    stack-label
                    type="text"
                    :rules="[
                              val => val.length <= 50 || 'El maximo da caracteres es de 50',
                              val => val.length >= 3 || 'El minimo de caracteres es de 3'
                            ]"
                  />
                </div>
              </div>
            </q-card-section>

            <q-separator />

            <!-- botones -->
            <q-card-actions align="right">
              <q-btn
                :loading="loading1"
                color="secondary"
                @click="simulateProgress(1),registrar_clientes()"
                icon-right="send"
                label="ingresar"
              >
                <template v-slot:loading>
                  <q-spinner-facebook />
                </template>
              </q-btn>

              <q-btn
                :loading="loading2"
                color="primary"
                @click="simulateProgress(2),url_listado_clientes()"
                icon-right="table_chart"
                label="tabla"
              >
                <template v-slot:loading>
                  <q-spinner-facebook />
                </template>
              </q-btn>
              <q-btn
                :loading="loading3"
                color="red"
                @click="simulateProgress(3), url_volver()"
                icon-right="settings_backup_restore"
                label="volver"
              >
                <template v-slot:loading>
                  <q-spinner-facebook />
                </template>
              </q-btn>
            </q-card-actions>
          </q-card>

          <!-- alertas -->
          <div class="q-pa-md q-gutter-sm">
            <ul v-for="e in errores" :key="e[0]">
              <q-banner inline-actions rounded class="bg-orange text-white">
                <li>
                  <i class="material-icons md-24">info</i>
                  {{e[0]}}
                </li>
                <template v-slot:action>
                  <q-btn flat color="white" label="Advertencia!" disabled />
                </template>
              </q-banner>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script src="../clientes_js/registroClientes.js"></script>
<style src="../clientes_css/registroClientes.css"></style>
