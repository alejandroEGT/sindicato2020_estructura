<template>
  <div>
    <div class="row justify-center">
      <div class="col-12 col-md-6">
        <div class="q-pa-md items-start q-gutter-md">
          <q-card class="my-card">
            <q-card-section class="bg-primary text-white">
              <div class="text-h6">Registro de Usuarios</div>
            </q-card-section>

            <q-separator />
            <q-card-section>
              <div class="col-12 col-md-8">
                  <q-input
                    outlined
                    v-model="text"
                    label="Ingrese fecha de nacimiento"
                    stack-label
                    :dense="dense"
                    type="date"
                  />
              </div>
            </q-card-section>
            <q-separator />

            <q-card-actions align="right">
              <q-btn
                :loading="loading1"
                color="secondary"
                @click="simulateProgress(1)"
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
                @click="simulateProgress(2)"
                icon-right="table_chart"
                label="tabla"
              >
                <template v-slot:loading>
                  <q-spinner-facebook />
                </template>
              </q-btn>
            </q-card-actions>
          </q-card>
        </div>
      </div>
    </div>
  </div>
</template>

<script src="../clientes_js/registroClientes.js"></script>
