<template>
  <div class="q-pa-md">
    <template>
      <q-banner inline-actions class="bg-grey-3">
        <template v-slot:avatar>
          <q-icon name="local_shipping" color="primary" />
        </template>
        PROVEEDORES
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
      :data="proveedores"
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

          <q-td key="codigo" :props="tabla">{{tabla.row.codigo}}</q-td>

          <q-td key="rut" :props="tabla">{{tabla.row.rut}}</q-td>

          <q-td key="razon_social" :props="tabla">{{tabla.row.razon_social}}</q-td>

          <q-td key="giro" :props="tabla">{{tabla.row.giro}}</q-td>

          <q-td key="telefono" :props="tabla">{{tabla.row.telefono}}</q-td>

          <q-td key="correo" :props="tabla">{{tabla.row.correo}}</q-td>

          <q-td key="pagina_web" :props="tabla">{{tabla.row.pagina_web}}</q-td>

          <q-td key="direccion" :props="tabla">{{tabla.row.direccion}}</q-td>

          <q-td key="ciudad" :props="tabla">{{tabla.row.ciudad}}</q-td>

          <q-td key="estado" :props="tabla">{{tabla.row.estado}}</q-td>

          <q-td key="opciones" :props="tabla">
            <q-btn label="Ver Contactos" color="blue" />
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

<script src="../proveedores_js/tablaProveedor.js"></script>