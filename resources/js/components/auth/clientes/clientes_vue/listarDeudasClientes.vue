<template>
  <div class="q-pa-md">
    <!-- cabecera -->
    <template>
      <q-banner inline-actions class="bg-grey-3">
        <template v-slot:avatar>
          <q-icon name="monetization_on" color="primary" />
        </template>
        LISTADO DE CLIENTES CON DEUDAS
        <template v-slot:action>
          <!-- boton refrescar -->
          <q-btn
            flat
            label="Limpiar"
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
      	        <q-btn round dense flat icon="search" @click="traer_cliente()" />
      	      </template>
      	    </q-input>
      	  </div>
      
      	  <div class="col-12 col-md-6 col-lg-6 q-pa-md">
      	    <q-input outlined v-model="rutCliente" disable label="rut del cliente" stack-label type="text" />
      	  </div>
      	  <div class="col-12 col-md-6 col-lg-6 q-pa-md">
      	    <q-input outlined v-model="nombreCliente" disable label="nombre del cliente" stack-label type="text" />
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
      class="my-sticky-header-table"
    >
      <!-- funciones especiales -->
      <template v-slot:top="pantalla">
        <q-space />
        <!-- filtro de datos -->
        <div class="col">
          <q-toggle
            v-model="visibleColumns"
            left-label
            color="green"
            checked-icon="check"
            unchecked-icon="clear"
            val="id"
            label="ID"
          />
          <q-toggle
            v-model="visibleColumns"
            left-label
            color="green"
            checked-icon="check"
            unchecked-icon="clear"
            val="tipo"
            label="Tipo de Deuda"
          />
          <q-toggle
            v-model="visibleColumns"
            left-label
            color="green"
            checked-icon="check"
            unchecked-icon="clear"
            val="descripcion"
            label="Descripcion"
          />
          <q-toggle
            v-model="visibleColumns"
            left-label
            color="green"
            checked-icon="check"
            unchecked-icon="clear"
            val="monto"
            label="Monto"
          />
          <q-toggle
            v-model="visibleColumns"
            left-label
            color="green"
            checked-icon="check"
            unchecked-icon="clear"
            val="fecha"
            label="Fecha de Tope"
          />
          <!-- full screen -->
          <q-btn
            flat
            round
            dense
            :icon="pantalla.inFullscreen ? 'fullscreen_exit' : 'fullscreen'"
            @click="pantalla.toggleFullscreen"
            class="q-ml-md"
          />
          <label>Pantalla Completa</label>

          <div class="row justify-end">
            <div class="col-12 col-md-4">
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

          <q-td key="tipo" :props="tabla">
            {{tabla.row.tipo}}
            <!-- <q-popup-edit
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
            </q-popup-edit> -->
          </q-td>

          <q-td key="descripcion" :props="tabla">
            {{tabla.row.descripcion}}
            <!-- <q-popup-edit
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
            </q-popup-edit> -->
          </q-td>

          <q-td key="monto" :props="tabla">
            {{tabla.row.monto}}
            <!-- <q-popup-edit
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
            </q-popup-edit> -->
          </q-td>

          <q-td key="fecha" :props="tabla">
            {{tabla.row.fecha}}
            <!-- <q-popup-edit
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
            </q-popup-edit> -->
          </q-td>

          <q-td key="opcion" :props="tabla">
            <q-btn label="Pagar" color="green" @click="eliminar_cliente_estado(tabla.row.id)" />
          </q-td>

        </q-tr>
      </template>


    </q-table>
  </div>
</template>


<script src="../clientes_js/listarDeudasClientes.js"></script>
<style src="../clientes_css/listarDeudasClientes.css"></style>
