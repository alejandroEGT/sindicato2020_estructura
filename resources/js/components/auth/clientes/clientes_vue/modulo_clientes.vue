<template>
  <div>
    <div class="q-pa-md q-gutter-md">
      <div class="row justify-center">
        <div class="col-12 col-md-6">
          <q-card class="my-card">
            <!-- titulo  -->
            <q-card-section class="bg-primary text-white">
              <div class="text-h5 text-center">Clientes</div>
            </q-card-section>

            <q-separator />

            <q-card-actions class="q-col-gutter-md text-center">
              <div class="col-12 col-md-4">
                <q-btn
                  class="full-width"
                  color="blue"
                  icon-right="person_add"
                  @click="url_registro_clientes"
                  label="Registro de Clientes"
                />
              </div>
              <div class="col-12 col-md-4">
                <q-btn
                  class="full-width"
                  color="blue"
                  icon-right="format_list_numbered"
                  @click="url_listado_clientes"
                  label="Listado de Clientes"
                />
              </div>
              <div class="col-12 col-md-4">
                <q-btn
                  class="full-width"
                  color="red"
                  icon-right="settings_backup_restore"
                  @click="url_index"
                  label="Volver"
                />
              </div>
            </q-card-actions>
          </q-card>
        </div>
      </div>
    </div>
  </div>
</template>

<script src="../clientes_js/moduloClientes.js"></script>
<style src="../clientes_css/moduloClientes.css"></style>
