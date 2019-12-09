<template>
  <div class="q-pa-md">
    <template>
      <q-banner inline-actions class="bg-grey-3">
        <template v-slot:avatar>
          <q-icon name="work" color="primary" />
        </template>
        REUNIONES CREADAS
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

          <q-btn
            flat
            label="Volver"
            icon-right="settings_backup_restore"
            color="red"
            @click="volver()"
            class="q-mb-md"
          />
        </template>
      </q-banner>
    </template>

    <!-- propiedades de la tabla -->
    <q-table
      no-data-label="Aun no hay datos para mostrar."
      no-results-label="No se han encontrado resultados."
      rows-per-page-label="Cantidad:"
      loading-label="Cargando"
      row-key="name"
      :data="reuniones"
      :columns="tabla"
      :separator="separator"
      :loading="loading"
      :filter="filter"
      :visible-columns="visibleColumns"
      :rows-per-page-options="[5,10,15,30,50,100,0]"
    >
      <template v-slot:body="tabla">
        <q-tr :props="tabla">
          <q-td key="id" :props="tabla">
            <q-badge color="green">{{tabla.row.id}}</q-badge>
          </q-td>

          <q-td key="fecha_inicio" :props="tabla">{{tabla.row.fecha_inicio}}</q-td>

          <q-td key="titulo" :props="tabla">{{tabla.row.titulo}}</q-td>

          <q-td key="creada_por" :props="tabla">{{tabla.row.creada_por}}</q-td>

          <q-td key="estado" :props="tabla">{{tabla.row.estado}}</q-td>

          <q-td key="created_at" :props="tabla">{{tabla.row.created_at}}</q-td>

          <q-td key="opcion" :props="tabla">
            <q-btn label="Ver Reunion" color="blue" />
          </q-td>
        </q-tr>
      </template>
    </q-table>

    <!-- alertas -->
    <template>
      <ul v-for="e in errores" :key="e[0]">
        <q-banner inline-actions class="bg-orange text-white">
          <li>
            <i class="material-icons md-24">info</i>
            {{e[0]}}
          </li>
          <template v-slot:action>
            <q-btn flat color="white" label="Advertencia!" disabled />
          </template>
        </q-banner>
      </ul>
    </template>
  </div>
</template>

<script src="../reuniones_js/traerReuniones.js"></script>
<style src="../reuniones_css/traerReuniones.css"></style>