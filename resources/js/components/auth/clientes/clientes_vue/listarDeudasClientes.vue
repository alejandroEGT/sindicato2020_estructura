<template>
  <div class="q-pa-md">
    <!-- cabecera -->
   <template>
          <q-banner inline-actions class="bg-grey-3">
            <div class="row">
              <div class="col-12 col-md-7">
                <q-icon style="font-size: 3rem;" name="monetization_on" color="primary" />
              LISTADO DE CLIENTES
              </div>
              
                <div class="col-12 col-md-5">
                  <div class="row">
                    <!-- boton refrescar -->
                    <div class="col-4 col-md-4">
                      <q-btn
                        flat
                        label="Refrescar"
                        icon-right="refresh"
                        color="primary"
                        @click="onRefresh()"
                        class="q-mb-md"
                      />
                    </div>
        
                    <!-- boton Formulario -->
                    <div class="col-4 col-md-4">
                      <q-btn
                        flat
                        label="Formulario"
                        icon-right="person_add"
                        color="green"
                        @click="url_registro()"
                        class="q-mb-md"
                      />
                    </div>
        
                    <!-- boton volver -->
                    <div class="col-4 col-md-4">
                      <q-btn
                        flat
                        label="Volver"
                        icon-right="settings_backup_restore"
                        color="red"
                        @click="url_volver2()"
                        class="q-mb-md"
                      />
                    </div>
                  </div>
                </div>
              </div>
          </q-banner>
    </template>

    <!-- buscador -->
    <template>
      <div class="row">
        <div class="col-12 col-md-12 q-pa-md">
          <q-input
            outlined
            bottom-slots
            v-model="buscadorCliente"
            label="Ingrese su rut"
            counter
            maxlength="20"
          >
            <template v-slot:append>
              <q-icon
                v-if="buscadorCliente !== ''"
                name="close"
                @click="buscadorCliente = ''"
                class="cursor-pointer"
              />
            </template>

            <template v-slot:after>
              <q-btn round dense flat icon="search" @click="traer_cliente();traerDeudas='cliente'"/>
            </template>
          </q-input>
        </div>

        <div class="col-12 col-md-6 col-lg-6 q-pa-md">
          <q-input
            outlined
            v-model="rutCliente"
            disable
            label="rut del cliente"
            stack-label
            type="text"
          />
        </div>
        <div class="col-12 col-md-6 col-lg-6 q-pa-md">
          <q-input
            outlined
            v-model="nombreCliente"
            disable
            label="nombre del cliente"
            stack-label
            type="text"
          />
        </div>
      </div>
    </template>

    <!-- propiedades de la tabla -->
    <q-table
      title="Listado de Clientes"
      no-data-label="Aun no hay datos para mostrar, porfavor ingrese un rut de cliente para mostrar informacion."
      no-results-label="No se han encontrado resultados."
      rows-per-page-label="Cantidad:"
      loading-label="Cargando..."
      row-key="name"
      :data="listarDeudaCliente"
      :columns="clientes"
      :separator="separator"
      :loading="loading"
      :filter="filter"
      :visible-columns="visibleColumns"
      :rows-per-page-options="[5,10,15,30,50,100,0]"
      :dense="$q.screen.lt.md"
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

      <!-- datos de la tabla -->
      <template v-slot:body="tabla">
        <q-tr :props="tabla">
          <q-td key="id" :props="tabla">
            <q-badge color="green">{{tabla.row.id}}</q-badge>
          </q-td>
          <q-td key="rut" :props="tabla">
            {{formateaRut(tabla.row.rut)}}
          </q-td>
          <q-td key="cliente" :props="tabla">
           {{tabla.row.cliente_deuda}}
          </q-td>

          <q-td key="tipo" :props="tabla">
            {{tabla.row.tipo}}
            <q-popup-edit v-model="tabla.row.tipo" title="Modificar tipo de deuda">
              <template v-slot="{initialValue,validate,set, cancel}">
                <q-select
                  standout="bg-blue text-white"
                  v-model="campoUpd"
                  :options="selectTipoDeuda"
                  option-value="id"
                  option-label="tipo"
                  label="Tipo de deuda"
                  @keyup.enter.stop
                >
                  <template v-slot:after>
                    <q-btn
                      color="red"
                      round
                      dense
                      flat
                      icon="edit"
                      @click="actualizar_dato(tabla.row.id,'tipo_deuda_id',campoUpd.id)"
                      @click.stop="set"
                    />

                    <q-btn flat dense color="negative" icon="cancel" @click.stop="cancel" />
                  </template>
                </q-select>
              </template>
            </q-popup-edit>
          </q-td>

          <q-td key="descripcion" :props="tabla">
            {{tabla.row.descripcion}}
            <q-popup-edit
              v-model="tabla.row.descripcion"
              title="Modificar Descripcion"
              :validate="val => val.length >= 3"
            >
              <template v-slot="{initialValue,validate,set, cancel }">
                <q-input
                  type="text"
                  maxlength="80"
                  v-model="campoUpd"
                  dense
                  autofocus
                  counter
                  autogrow
                  @keyup.enter.stop
                  :rules="[
                          val => validate(campoUpd) || 'Minimo 3 caracteres.'
                        ]"
                >
                  <template v-slot:after>
                    <q-btn
                      @click="actualizar_dato(tabla.row.id,'descripcion',campoUpd)"
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

          <q-td key="monto" :props="tabla">
            <b><span class="green_noPagado">$ </span>{{formatPrice(tabla.row.monto)}}</b>
            <q-popup-edit
              v-model="tabla.row.monto"
              title="Modificar Monto"
              :validate="val => val.length >= 1"
            >
              <template v-slot="{initialValue,validate,set, cancel }">
                <q-input
                  type="number"
                  maxlength="50"
                  v-model="campoUpd"
                  dense
                  autofocus
                  counter
                  @keyup.enter.stop
                  :rules="[
                          val => validate(campoUpd) || 'Minimo 1 caracter.'
                        ]"
                >
                  <template v-slot:after>
                    <q-btn
                      @click="actualizar_dato(tabla.row.id,'monto',campoUpd)"
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

          <q-td key="fecha" :props="tabla">
            {{tabla.row.fecha}}
            <q-popup-edit
              v-model="tabla.row.fecha"
              title="Modificar Fecha de Tope"
              :validate="val => val.length >= 10"
            >
              <template v-slot="{initialValue,validate,set, cancel }">
                <q-input
                  type="date"
                  maxlength="10"
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
                      @click="actualizar_dato(tabla.row.id,'fecha',campoUpd)"
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
            <q-btn label="Pagar" color="green" @click="show('modal'+tabla.row.id)"/>

              <modal       
                        :name="'modal'+tabla.row.id"
                        :clickToClose="false"
                        :pivot-y="0.5"
                        :adaptive="true"
                        :scrollable="true"
                        :reset="true"
                        height="auto"
                      >

              <div class="col-12">
              	<q-card>
              	  <q-card-section class="row items-center">
              	    <q-avatar icon="monetization_on" color="danger" text-color="white" />
              	    <span
              	      class="q-ml-sm"
              	    >¿Esta seguro que desea registrar la deuda pagada del cliente: <br>
                     <b>{{tabla.row.cliente_deuda}}?</b></span>
              	  </q-card-section>
              
              	  <q-card-actions align="right">
              	    <q-btn flat label="Cancel" color="red" @click="hide('modal'+tabla.row.id)" />
              	    <q-btn
              	      flat
              	      label="Aceptar"
              	      color="green"
              	      v-close-popup
              	      @click="pagar_deuda(tabla.row.id),hide('modal'+tabla.row.id)"
              	    />
              	  </q-card-actions>
              	</q-card>
              </div>

            </modal>
          </q-td>

            <q-td key="estado_deuda" :props="tabla">
              <div v-bind:class="{ 'red_pagado': tabla.row.estado_deuda == 'NO PAGADO', 'green_noPagado': tabla.row.estado_deuda == 'PAGADO' }">
              <b>{{tabla.row.estado_deuda}}</b>
              </div>
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


<script src="../clientes_js/listarDeudasClientes.js"></script>
<style src="../clientes_css/listarDeudasClientes.css"></style>

