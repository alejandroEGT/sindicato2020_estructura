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

            <div class="row justify-center">
              <q-card-actions>
                <q-btn
                  color="blue"
                  icon-right="person_add"
                  @click="url_registro_clientes"
                  label="Registro de Clientes"
                />
                <q-btn
                  color="blue"
                  icon-right="format_list_numbered"
                  @click="url_listado_clientes"
                  label="Listado de Clientes"
                />
              </q-card-actions>
            </div>
          </q-card>
        </div>
      </div>
    </div>
  </div>
</template>

<script src="../clientes_js/moduloClientes.js"></script>
<style src="../clientes_css/moduloClientes.css"></style>
