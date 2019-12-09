<template>
    <div class="q-pa-md">

        <q-banner inline-actions class="bg-grey-3">
            <div class="row">
                <div class="col-md-7">
                  
                    <q-icon style="font-size: 3rem;" name="monetization_on" color="primary" />
                 
                    LISTADO DE LIQUIDACIONES
                </div>

                <div class="col-md-5">
                     <!-- boton refrescar -->
                    <div class="row">
                        <div  class="col-4 col-md-4">
                            <q-btn
                                flat
                                label="REFRESCAR"
                                icon-right="refresh"
                                color="primary"
                                @click="onRefresh()"
                                
                            />

                    
                        </div>
                        <div class="col-4 col-md-4">
                            <q-btn
                                    flat
                                    label="FORMULARIO"
                                    icon-right="person_add"
                                    color="green"
                                    @click="url('/formulario-liquidaciones')"
                                    
                                />
                        </div>
                        <div class="col-4 col-md-4">
                            <q-btn
                                flat
                                label="VOLVER"
                                icon-right="settings_backup_restore"
                                color="red"
                                @click="url('/modulo-liquidaciones')"
                                
                            />
                        </div>
                    </div>
                </div>





            </div>
        </q-banner>

        <q-table
            :data="tabla"
            :columns="columns"
        >
         <template v-slot:body="props">
                  <q-tr :props="props">
                    <q-td key="id" :props="props">{{ props.row.id }}</q-td>
                    <q-td key="fecha" :props="props">{{ props.row.fecha }}</q-td>
                    <q-td key="empresa" :props="props">{{ props.row.empresa }}</q-td>
                    <q-td key="empleado" :props="props">{{ props.row.empleado }}</q-td>
                    <q-td key="editar" :props="props">
                        <q-btn 
                            @click="url_params('ListarLiquEdit', {
                                    id:props.row.id,
                                    desc:props.row.fecha+'-'+props.row.empleado+'-'+props.row.id

                                   })" 
                            flat round color="primary" icon="edit" />
                    </q-td>
                    <q-td key="ver" :props="props">
                        <q-btn flat round color="primary" icon="picture_as_pdf" />
                    </q-td>
                  </q-tr>
         </template>
        </q-table>

    </div>
</template>

<script src="../liquidaciones_js/listar.js"></script>