<template>
  <div class="q-pa-md">
    <div class="row justify-center">
      <div class="col-12 col-md-8">
        <q-card class="my-card">
          <q-card-section class="bg-primary text-white">
            <div class="text-h6 text-center">Formulario Reunion</div>
          </q-card-section>
          <q-separator />
          <q-card-section>
            <div class="row justify-start q-col-gutter-md">
              <div class="col-3 col-md-3">
                <q-input
                  outlined
                  v-model="fecha"
                  label="Ingrese fecha de inicio"
                  stack-label
                  type="date"
                />
              </div>
              <div class="col-3 col-md-3">
                <q-input
                  v-model="hora"
                  outlined
                  label="Ingrese hora de inicio"
                  stack-label
                  type="time"
                />
              </div>

              <div class="col-6 col-md-6">
                <q-input
                  outlined
                  v-model="titulo"
                  label="Ingrese el titulo"
                  stack-label
                  type="text"
                  maxlength="50"
                  counter
                />
              </div>
              <div class="col-12 col-md-12">
                <q-input
                  outlined
                  v-model="cuerpo"
                  label="Ingrese la descripcion"
                  stack-label
                  type="textarea"
                  autogrow
                  maxlength="500"
                  counter
                />
              </div>
            </div>
          </q-card-section>
          <q-card-actions align="center">
            <q-btn
              :loading="loading1"
              color="secondary"
              @click="simulateProgress(1), guardar()"
              icon-right="send"
              label="Crear Reunion"
            >
              <template v-slot:loading>
                <q-spinner-facebook />
              </template>
            </q-btn>
            <q-btn
              :loading="loading2"
              color="primary"
              @click="simulateProgress(2),traer_reuniones()"
              icon-right="table_chart"
              label="Reuniones"
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
</template>

<script src="../reuniones_js/crearReunion.js"></script>