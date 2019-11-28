<template>
  <div>
    <div class="q-pa-md q-gutter-md">
      <div class="row justify-center">
        <div class="col-12 col-md-6">
          <q-card class="my-card">
            <!-- titulo  -->
            <q-card-section class="bg-primary text-white">
              <div class="text-h5 text-center">Reuniones</div>
            </q-card-section>

            <q-separator />

            <div class="row justify-center">
              <q-card-actions>
                <q-btn
                  color="blue"
                  @click="crear_reunion"
                  label="Crear Reunion"
                />
                <q-btn
                  color="blue"
                  icon-right="format_list_numbered"
                  @click="traer_reuniones"
                  label="Reuniones"
                />
              </q-card-actions>
            </div>
          </q-card>
        </div>
      </div>
    </div>
  </div>
</template>

<script src="../reuniones_js/moduloReuniones.js"></script>