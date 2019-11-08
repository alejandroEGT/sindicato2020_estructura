
<template>
  <div class="q-pa-md">
    <div class="row justify-between">
        <div class="col-12 col-md-8">
            <q-option-group
              v-model="separator"
              inline
              class="q-mb-md"
              :options="[
                { label: 'Horizontal (default)', value: 'horizontal' },
                { label: 'Vertical', value: 'vertical' },
                { label: 'Cell', value: 'cell' },
                { label: 'None', value: 'none' },
              ]"
            />
        </div>
        <div class="col-12 col-md-4">
            <q-btn
              color="red"
              @click="url_volver2()"
              icon-right="settings_backup_restore"
              label="volver"
            />
        </div>
    </div>

    <q-table 
    title="Treats" 
    :data="data" 
    :columns="columns" 
    row-key="name" 
    :separator="separator" 
    rows-per-page-label='Cantidad:'/>
  </div>
</template>

<script src="../clientes_js/listarClientes.js"></script>
<style src="../clientes_css/listarClientes.css"></style>
