
<template>
  <div class="q-pa-md">

    <template>
          <q-banner inline-actions class="bg-grey-3">
            <template v-slot:avatar>
              <q-icon name="account_circle" color="primary" />
            </template>
            LISTADO DE CLIENTES
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

    <div class="q-pa-sm"></div>

    <!-- propiedades de la tabla -->
    <q-table
      title="Listado de Clientes"
      no-data-label="Aun no hay datos para mostrar."
      no-results-label="No se han encontrado resultados."
      rows-per-page-label="Cantidad:"
      loading-label="Cargando..."
      row-key="name"
      :data="listarClientes"
      :columns="clientes"
      :separator="separator"
      :loading="loading"
      :filter="filter"
      :visible-columns="visibleColumns"
      :rows-per-page-options="[5,10,15,30,50,100,0]"
    >
        <!-- funciones especiales -->
      <template v-slot:top="pantalla">
        <q-space />
        <!-- filtro de datos -->
        <div class="col-6 col-md-2">
            <q-select
            v-model="visibleColumns"
            multiple
            dense
            filled 
            display-value="Filtrar"
            emit-value
            map-options
            :options="clientes"
            option-value="name"
            style="min-width: 150px;"
            color="green"
            bg-color="white"
          />
        </div>
          <!-- full screen -->
          <div class="col-6 col-md-4">
            <q-btn
              flat
              round
              dense
              :icon="pantalla.inFullscreen ? 'fullscreen_exit' : 'fullscreen'"
              @click="pantalla.toggleFullscreen"
              class="q-ml-md"
            />
            <label>Pantalla Completa</label>
          </div>

          <div class="col-12 col-md-6">
            <div class="row justify-end">
              <div class="col-12 col-md-6">
                <q-input
                  dark
                  borderless
                  input-class="text-right"
                  v-model="filter"
                  placeholder="Buscar"
                  class="q-ml-md"
                >
                  <template v-slot:append>
                    <q-icon v-if="filter === ''" name="search" />
                    <q-icon v-else name="clear" class="cursor-pointer" @click="filter = ''" />
                  </template>
                </q-input>
              </div>
            </div>
          </div>
      </template>

      <template v-slot:body="tabla">
        <q-tr :props="tabla">

          <q-td key="id" :props="tabla">
            <q-badge color="green">{{tabla.row.id}}</q-badge>
          </q-td>

          <q-td key="fecha_nacimiento" :props="tabla">
            {{tabla.row.fecha_nacimiento}}
            <q-popup-edit
              v-model="tabla.row.fecha_nacimiento"
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
                      @click="actualizar_dato(tabla.row.id,'fecha_nacimiento',campoUpd)"
                      @click.stop="set"
                      :disable="validate(campoUpd) === false || initialValue === 'dd-mm-aaaa'"
                    />
                    <q-btn flat dense color="negative" icon="cancel" @click.stop="cancel" />
                  </template>
                </q-input>
              </template>
            </q-popup-edit>
          </q-td>

          <q-td key="rut" :props="tabla">
            {{tabla.row.rut}}
            <q-popup-edit
              v-model="tabla.row.rut"
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
                      @click="actualizar_dato(tabla.row.id,'rut',campoUpd)"
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

          <q-td key="nombres" :props="tabla">
            {{tabla.row.nombres}}
            <q-popup-edit
              v-model="tabla.row.nombres"
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
                      @click="actualizar_dato(tabla.row.id,'nombres',campoUpd)"
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

          <q-td key="apellido_paterno" :props="tabla">
            {{tabla.row.apellido_paterno}}
            <q-popup-edit
              v-model="tabla.row.apellido_paterno"
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
                      @click="actualizar_dato(tabla.row.id,'apellido_paterno',campoUpd)"
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

          <q-td key="apellido_materno" :props="tabla">
            {{tabla.row.apellido_materno}}
            <q-popup-edit
              v-model="tabla.row.apellido_materno"
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
                      @click="actualizar_dato(tabla.row.id,'apellido_materno',campoUpd)"
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

          <q-td key="opcion" :props="tabla">
            <q-btn label="Eliminar" color="red" @click="show('eliminarCliente'+tabla.row.__index)"/>
            <q-dialog :ref="'eliminarCliente'+tabla.row.__index" @hide="onDialogHide" persistent>
              <q-card>
                <q-card-section class="row items-center">
                  <q-avatar icon="delete" color="primary" text-color="white" />
                  <span
                    class="q-ml-sm"
                  >¿Esta seguro que desea eliminar al cliente <b>{{tabla.row.nombres}} {{tabla.row.apellido_paterno}} {{tabla.row.apellido_materno}}</b>?</span>
                </q-card-section>

                <q-card-actions align="right">
                  <q-btn flat label="Cancel" color="red" v-close-popup />
                  <q-btn
                    flat
                    label="Aceptar"
                    color="green"
                    v-close-popup
                    @click="eliminar_cliente_estado(tabla.row.id)"
                  />
                </q-card-actions>
              </q-card>
            </q-dialog>
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


<script src="../clientes_js/listarClientes.js"></script>
<style src="../clientes_css/listarClientes.css"></style>

