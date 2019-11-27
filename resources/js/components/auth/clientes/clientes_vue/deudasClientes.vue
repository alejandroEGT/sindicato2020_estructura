<template>
  <div>
    <div class="q-pa-md q-gutter-md">
      <div class="row justify-center">
        <div class="col-12 col-md-8">
          <q-card class="my-card">
            <!-- titulo  -->
            <q-card-section class="bg-primary text-white">
              <div class="text-h6">Deudas de Clientes</div>
            </q-card-section>

            <q-separator />

            <q-card-section>
              <div class="row justify-start q-col-gutter-md">
                <div class="col-12 col-md-4">
                  <q-select
                    standout="bg-blue text-white"
                    v-model="clientes"
                    :options="selectClientes"
                    option-value="id"
                    option-label="cliente_deuda"
                    label="Clientes"
                  />
                </div>

                <div class="col-12 col-md-4">
                  <q-select
                    standout="bg-blue text-white"
                    v-model="tipoDeuda"
                    :options="selectTipoDeuda"
                    option-value="id"
                    option-label="tipo"
                    label="Tipo de deuda"
                  />
                </div>
                <div class="col-12 col-md-4">
                    <q-input
                    outlined
                    counter
                    maxlength="50"
                    v-model="monto"
                    label="Monto que debe"
                    stack-label
                    type="number"
                  />
                </div>
                <div class="col-12 col-md-8">
                    <q-input
                    outlined
                    counter
                    maxlength="100"
                    v-model="descripcion"
                    label="Descripcion de la deuda"
                    stack-label
                    type="text"
                  />
                </div>
                <div class="col-12 col-md-4">
                    <q-input
                    outlined
                    counter
                    maxlength="10"
                    v-model="fechaTope"
                    label="fecha tope de pago"
                    stack-label
                    type="date"
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
                @click="simulateProgress(1), registrar_clientes_deudas()"
                icon-right="send"
                label="ingresar"
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


<script src="../clientes_js/deudasClientes.js"></script>
<style src="../clientes_css/deudasClientes.css"></style>