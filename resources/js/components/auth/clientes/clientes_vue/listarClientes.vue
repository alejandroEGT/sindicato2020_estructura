
<template>
  <div class="q-pa-md">
    <div class="row justify-between">
      <!-- diseño de casillas -->
      <div class="col-12 col-md-8">
        <q-option-group
          v-model="separator"
          inline
          class="q-mb-md"
          :options="[
                { label: 'Casilla', value: 'cell' },
                { label: 'Horizontal', value: 'horizontal' },
                { label: 'Vertical', value: 'vertical' },
                { label: 'Ninguno', value: 'none' },
              ]"
        />
      </div>

      <!-- boton refrescar -->
      <q-btn label="Refrescar" color="primary" @click="onRefresh" class="q-mb-md" />

      <!-- boton Formulario -->
      <q-btn
        label="Formulario"
        icon-right="person_add"
        color="green"
        @click="url_registro()"
        class="q-mb-md"
      />

      <!-- boton volver -->
      <q-btn
        label="Volver"
        icon-right="settings_backup_restore"
        color="red"
        @click="url_volver2()"
        class="q-mb-md"
      />
    </div>

    <!-- propiedades de la tabla -->
    <q-table
      title="Listado de Clientes"
      :data="listarClientes"
      :columns="columns"
      row-key="name"
      :separator="separator"
      rows-per-page-label="Cantidad:"
      :loading="loading"
      loading-label="Cargando"
      :filter="filter"
      no-data-label="Aun no hay datos para mostrar."
      no-results-label="No se han encontrado resultados."
      :visible-columns="visibleColumns"
      :rows-per-page-options="[5,10,15,30,50,100,0]"
    >
      <!-- funciones especiales -->
      <template v-slot:top-left="props">
        <q-space />
        <!-- filtro de datos -->
        <div v-if="$q.screen.gt.xs" class="col">
          <q-toggle v-model="visibleColumns" val="id" label="ID" />
          <q-toggle v-model="visibleColumns" val="fecha_nacimiento" label="Fecha de Nacimiento" />
          <q-toggle v-model="visibleColumns" val="rut" label="Rut" />
          <q-toggle v-model="visibleColumns" val="nombres" label="Nombres" />
          <q-toggle v-model="visibleColumns" val="apellido_paterno" label="Apellido Paterno" />
          <q-toggle v-model="visibleColumns" val="apellido_materno" label="Apellido Materno" />
          <!-- full screen -->
          <q-btn
            flat
            round
            dense
            :icon="props.inFullscreen ? 'fullscreen_exit' : 'fullscreen'"
            @click="props.toggleFullscreen"
            class="q-ml-md"
          />
        </div>

        <!-- columnas visibles -->
        <q-select
          v-else
          v-model="visibleColumns"
          multiple
          borderless
          dense
          options-dense
          :display-value="$q.lang.table.columns"
          emit-value
          map-options
          :options="columns"
          option-value="name"
          style="min-width: 150px"
        />
      </template>

      <!-- buscador -->
      <template v-slot:top-right>
        <q-input borderless dense debounce="300" v-model="filter" placeholder="Buscar">
          <template v-slot:append>
            <q-icon name="search"></q-icon>
          </template>
        </q-input>
      </template>

      <!-- contenido tabla -->
      <template v-slot:body="props">
        <q-tr :props="props">
          <q-td key="id" :props="props">{{props.row.id}}</q-td>

          <q-td key="fecha_nacimiento" :props="props">
            {{props.row.fecha_nacimiento}}
            <q-popup-edit
              v-model="props.row.fecha_nacimiento"
              title="Modificar Fecha de Nacimiento"
              :validate="val => val.length >= 3"
            >
              <template v-slot="{initialValue,validate,set, cancel}">
                <q-input
                  type="date"
                  v-model="campoUpd"
                  dense
                  autofocus
                  counter
                  @keyup.enter.stop
                  :rules="[
                          val => validate(campoUpd) || 'Minimo 10 caracteres.'
                        ]"
                >
                  <template v-slot:after>
                    <q-btn
                      color="red"
                      round
                      dense
                      flat
                      icon="edit"
                      @click="actualizar_dato(props.row.id,'fecha_nacimiento',campoUpd)"
                      @click.stop="set"
                      :disable="validate(campoUpd) === false || initialValue === 'dd-mm-aaaa'"
                    />
                    <q-btn flat dense color="negative" icon="cancel" @click.stop="cancel" />
                  </template>
                </q-input>
              </template>
            </q-popup-edit>
          </q-td>

          <q-td key="rut" :props="props">
            {{props.row.rut}}
            <q-popup-edit
              v-model="props.row.rut"
              title="Modificar Rut"
              :validate="val => val.length >= 2"
            >
              <template v-slot="{initialValue,validate,set, cancel }">
                <q-input
                  type="text"
                  maxlength="20"
                  v-model="campoUpd"
                  dense
                  autofocus
                  counter
                  @keyup.enter.stop
                  :rules="[
                          val => validate(campoUpd) || 'Minimo 2 caracteres.'
                        ]"
                >
                  <template v-slot:after>
                    <q-btn
                      @click="actualizar_dato(props.row.id,'rut',campoUpd)"
                      @click.stop="set"
                      color="red"
                      round
                      dense
                      flat
                      icon="edit"
                      :disable="validate(campoUpd) === false || initialValue === ''"
                    />
                    <q-btn flat dense color="negative" icon="cancel" @click.stop="cancel" />
                  </template>
                </q-input>
              </template>
            </q-popup-edit>
          </q-td>

          <q-td key="nombres" :props="props">
            {{props.row.nombres}}
            <q-popup-edit
              v-model="props.row.nombres"
              title="Modificar Nombres"
              :validate="val => val.length >= 3"
            >
              <template v-slot="{initialValue,validate,set, cancel }">
                <q-input
                  type="text"
                  maxlength="50"
                  v-model="campoUpd"
                  dense
                  autofocus
                  counter
                  @keyup.enter.stop
                  :rules="[
                          val => validate(campoUpd) || 'Minimo 3 caracteres.'
                        ]"
                >
                  <template v-slot:after>
                    <q-btn
                      @click="actualizar_dato(props.row.id,'nombres',campoUpd)"
                      @click.stop="set"
                      color="red"
                      round
                      dense
                      flat
                      icon="edit"
                      :disable="validate(campoUpd) === false || initialValue === ''"
                    />
                    <q-btn flat dense color="negative" icon="cancel" @click.stop="cancel" />
                  </template>
                </q-input>
              </template>
            </q-popup-edit>
          </q-td>

          <q-td key="apellido_paterno" :props="props">
            {{props.row.apellido_paterno}}
            <q-popup-edit
              v-model="props.row.apellido_paterno"
              title="Modificar Apellido Paterno"
              :validate="val => val.length >= 3"
            >
              <template v-slot="{initialValue,validate,set, cancel }">
                <q-input
                  type="text"
                  maxlength="50"
                  v-model="campoUpd"
                  dense
                  autofocus
                  counter
                  @keyup.enter.stop
                  :rules="[
                          val => validate(campoUpd) || 'Minimo 3 caracteres.'
                        ]"
                >
                  <template v-slot:after>
                    <q-btn
                      @click="actualizar_dato(props.row.id,'apellido_paterno',campoUpd)"
                      @click.stop="set"
                      color="red"
                      round
                      dense
                      flat
                      icon="edit"
                      :disable="validate(campoUpd) === false || initialValue === ''"
                    />
                    <q-btn flat dense color="negative" icon="cancel" @click.stop="cancel" />
                  </template>
                </q-input>
              </template>
            </q-popup-edit>
          </q-td>

          <q-td key="apellido_materno" :props="props">
            {{props.row.apellido_materno}}
            <q-popup-edit
              v-model="props.row.apellido_materno"
              title="Modificar Apellido Materno"
              :validate="val => val.length >= 3"
            >
              <template v-slot="{initialValue,validate, set, cancel }">
                <q-input
                  type="text"
                  maxlength="50"
                  v-model="campoUpd"
                  dense
                  autofocus
                  counter
                  @keyup.enter.stop
                  :rules="[
                          val => validate(campoUpd) || 'Minimo 3 caracteres.'
                        ]"
                >
                  <template v-slot:after>
                    <q-btn
                      @click="actualizar_dato(props.row.id,'apellido_materno',campoUpd)"
                      @click.stop="set"
                      color="red"
                      round
                      dense
                      flat
                      icon="edit"
                      :disable="validate(campoUpd) === false || initialValue === ''"
                    />
                    <q-btn flat dense color="negative" icon="cancel" @click.stop="cancel" />
                  </template>
                </q-input>
              </template>
            </q-popup-edit>
          </q-td>

          <q-td key="opcion" :props="props">
            <q-btn color="red" label="Eliminar" />
          </q-td>
        </q-tr>
      </template>
    </q-table>
    
      <!-- alertas -->
          <div class="q-pa-md q-gutter-sm">
            <ul v-for="e in errores" :key="e[0]">
              <q-banner inline-actions rounded class="bg-orange text-white">
                <li>
                  <i class="material-icons md-24">info</i>
                  {{e[0]}}
                </li>
                <template v-slot:action>
                  <q-btn flat color="white" label="Advertencia!" disabled />
                </template>
              </q-banner>
            </ul>
          </div>
  </div>
</template>

<script src="../clientes_js/listarClientes.js"></script>
<style src="../clientes_css/listarClientes.css"></style>
