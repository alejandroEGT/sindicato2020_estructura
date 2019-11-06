<template>
  <div>
    <div class="q-pa-md items-start q-gutter-md">
      <div class="row justify-center">
        <div class="col-12 col-md-8">

          <q-card class="my-card">

            <!-- titulo  -->
            <q-card-section class="bg-primary text-white">
              <div class="text-h6">Registro de Usuarios</div>
            </q-card-section>

            <q-separator />

            <!-- formulario -->
            <q-card-section>
              <div class="row justify-center q-col-gutter-md">

                <div class="col-12 col-md-4">
                  <q-input
                    outlined
                    v-model="fecha"
                    label="Ingrese fecha de nacimiento"
                    stack-label
                    type="date"
                  />
                </div>
                <div class="col-12 col-md-4">
                  <q-input
                    outlined
                    v-model="descripcion"
                    label="Ingrese descripcion"
                    stack-label
                    type="text"
                  />
                </div>
                <div class="col-12 col-md-4">
                  <q-input
                    outlined
                    v-model="monto"
                    label="Ingrese monto"
                    stack-label
                    type="number"
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
