<template>
  <div class="q-pa-md">

    <template>
      <q-banner inline-actions class="bg-grey-3">
        <template v-slot:avatar>
          <q-icon name="account_circle" color="primary" />
        </template>
        LISTADO DE CLIENTES CON DEUDAS
        <template v-slot:action>
          <!-- boton refrescar -->
          <q-btn
            flat
            label="Refrescar"
            icon-right="refresh"
            color="primary"
            @click="onRefresh()"
            class="q-mb-md"
          />

          <!-- boton Formulario -->
          <q-btn
            flat
            label="Formulario"
            icon-right="person_add"
            color="green"
            @click="url_registro()"
            class="q-mb-md"
          />

          <!-- boton volver -->
          <q-btn
            flat
            label="Volver"
            icon-right="settings_backup_restore"
            color="red"
            @click="url_volver2()"
            class="q-mb-md"
          />
        </template>
      </q-banner>
    </template>
    
  </div>
</template>


<script src="../clientes_js/listarDeudasClientes.js"></script>
<style src="../clientes_css/listarDeudasClientes.css"></style>