<template>
  <div class="q-pa-md">
    <div class="row justify-center">
      <div class="col-12 col-md-10">
        <q-card class="my-card">
          <q-card-section class="bg-primary text-white">
            <div class="text-h6 text-center">Formulario Proveedores</div>
          </q-card-section>
          <q-separator />
          <q-card-section>
            <div class="row justify-start q-col-gutter-md">
              <div class="col-4 col-md-4">
                <q-input
                  outlined
                  v-model="codigo"
                  label="Ingrese codigo identificador"
                  stack-label
                  type="text"
                  maxlength="20"
                  counter
                />
              </div>

              <div class="col-4 col-md-4">
                <q-input
                  outlined
                  v-model="rut"
                  label="Ingrese RUT empresa"
                  stack-label
                  type="text"
                  maxlength="20"
                  counter
                />
              </div>

              <div class="col-4 col-md-4">
                <q-input
                  outlined
                  v-model="fono_emp"
                  label="GIRO"
                  stack-label
                  type="text"
                  maxlength="20"
                  counter
                />
              </div>

              <div class="col-12 col-md-12">
                <q-input
                  outlined
                  v-model="razon_social"
                  label="Ingrese razon social"
                  stack-label
                  type="text"
                  autogrow
                  maxlength="200"
                  counter
                />
              </div>
              <!--  <div class="col-3 col-md-3">
                <q-input
                  outlined
                  v-model="fono_emp"
                  label="Ingrese telefono empresa"
                  stack-label
                  type="text"
                  maxlength="20"
                  counter
                />
              </div>

              <div class="col-3 col-md-3">
                <q-input
                  outlined
                  v-model="pagina"
                  label="Ingrese pagina web"
                  stack-label
                  type="text"
                  maxlength="20"
                  counter
                />
              </div>

              <div class="col-3 col-md-3">
                <q-input
                  outlined
                  v-model="correo_emp"
                  label="Ingrese correo empresa"
                  stack-label
                  type="text"
                  maxlength="20"
                  counter
                />
              </div>-->
            </div>
          </q-card-section>
          <q-separator />
          <div class="bg-primary text-white text-center">Contacto</div>
          <q-separator />
          <q-card-section>
            <div class="row justify-start q-col-gutter-md">
              <div class="col-3 col-md-3">
                <q-input
                  outlined
                  v-model="pagina"
                  label="Ingrese nombres contacto"
                  stack-label
                  type="text"
                  maxlength="20"
                  counter
                />
              </div>
              <div class="col-3 col-md-3">
                <q-input
                  outlined
                  v-model="pagina"
                  label="Ingrese apellidos contacto"
                  stack-label
                  type="text"
                  maxlength="20"
                  counter
                />
              </div>
              <div class="col-3 col-md-3">
                <q-input
                  outlined
                  v-model="pagina"
                  label="Ingrese correo contacto"
                  stack-label
                  type="text"
                  maxlength="20"
                  counter
                />
              </div>
              <div class="col-3 col-md-3">
                <q-input
                  outlined
                  v-model="pagina"
                  label="Ingrese telefono contacto"
                  stack-label
                  type="text"
                  maxlength="20"
                  counter
                />
              </div>
            </div>
          </q-card-section>
          <q-separator />
          
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

            <q-btn
              :loading="loading3"
              color="red"
              @click="simulateProgress(3), volver()"
              icon-right="settings_backup_restore"
              label="volver"
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

<script src="../proveedores_js/registroProveedores.js"></script>