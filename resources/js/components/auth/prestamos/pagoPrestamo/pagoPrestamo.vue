<template>
  <div class="q-pa-md">
    <div class="row justify-center">
      <div class="col-12 col-md-8">
        <q-card>
          <q-card-section class="bg-primary text-white">
            <div class="text-h6">Pagar Prestamo</div>
          </q-card-section>
          <q-stepper v-model="step" ref="stepper" color="primary" animated>
            <q-step
              :name="1"
              title="Ingrese el rut del cliente"
              icon="account_circle"
              :done="step > 1"
            >
              <div class="q-gutter-md">
                <q-input
                  outlined
                  counter
                  maxlength="20"
                  v-model="rut"
                  label="Ingrese rut del cliente"
                  stack-label
                  type="text"
                  :rules="[
                              val => val.length <= 20 || 'El maximo da caracteres es de 20' , 
                              val => val.length >= 2 || 'El minimo de caracteres es de 2'
                            ]"
                />

                <q-separator />

                <q-input filled v-model="usuario.nombrecliente" hint="Nombre del Cliente" readonly />

                <q-btn color="primary" label="Buscar Cliente" v-on:click="getUsuario" />
              </div>
            </q-step>

            <q-step :name="2" title="Lista de prestamos" icon="create_new_folder" :done="step > 2">
              <q-list>
                <q-item v-for="itemPrestamo in prestamos" v-bind:key="itemPrestamo.id" tag="label" v-ripple>
                  <q-item-section avatar>
                    <q-radio v-model="idPrestamo" :val="itemPrestamo.id" />
                  </q-item-section>
                  <q-item-section>
                    <q-item-label><b>Prestamo N°:</b>{{itemPrestamo.id}} <b>Monto Solicitado:</b> {{itemPrestamo.monto_solicitado}}</q-item-label>
                    <q-item-label caption>Fecha: {{itemPrestamo.fecha}} Cuotas Totales: {{itemPrestamo.cuotas}}</q-item-label>
                  </q-item-section>
                </q-item>
              </q-list>
            </q-step>

            <q-step :name="3" title="Detalle del prestamo" icon="assignment">
              <div class="q-gutter-md">
                
                <q-list>
                <q-item v-for="itemCuotas in cuotasPagadas" v-bind:key="itemCuotas.id">
                  <q-item-section>
                    <q-item-label>Cuota N°: {{itemCuotas.cuota}} Fue Cancelada en la fecha: {{itemCuotas.fecha}}</q-item-label>
                    <q-item-label caption lines="2"> Valor Cancelado {{itemCuotas.monto}}</q-item-label>
                  </q-item-section>
                </q-item>

                </q-list>

                <q-separator />

                <q-input
                  outlined
                  counter
                  maxlength="20"
                  v-model="monto"
                  label="Ingrese monto a pagar"
                  stack-label
                  type="number"
                  hint="El monto debe de ser ingresado sin puntos"
                  :rules="[
                              val => val.length <= 20 || 'El maximo da caracteres es de 20' , 
                              val => val.length >= 2 || 'El minimo de caracteres es de 1'
                            ]"
                />

                <q-input
                  outlined
                  counter
                  v-model="fecha"
                  label="Fecha del pago"
                  stack-label
                  type="date"
                  hint="Seleccione la fecha en la cual se pagará la cuota"
                />
              </div>
            </q-step>

            <q-step :name="4" title="Confimar datos prestamo" icon="add_comment">
              <q-list>
                <q-item>
                  <q-item-section>
                    <q-item-label>Solicitante del pago</q-item-label>
                    <q-item-label caption lines="2">{{usuario.nombrecliente}}</q-item-label>
                  </q-item-section>
                </q-item>

                <q-separator spaced inset />

                <q-item>
                  <q-item-section>
                    <q-item-label>Cuota a pagar</q-item-label>
                    <q-item-label caption>{{cuotasPagadas.length+1}}/{{totalCuotas}}</q-item-label>
                  </q-item-section>
                </q-item>

                <q-separator spaced inset />

                <q-item>
                  <q-item-section>
                    <q-item-label>Monto del pago</q-item-label>
                    <q-item-label caption>{{monto}}</q-item-label>
                  </q-item-section>
                </q-item>

                <q-separator spaced inset />

                <q-item>
                  <q-item-section>
                    <q-item-label>Monto restante si se paga la cuota</q-item-label>
                    <q-item-label caption>{{montoMenosCuota}}</q-item-label>
                  </q-item-section>
                </q-item>

                <q-separator spaced inset />

                <q-item>
                  <q-item-section>
                    <q-item-label>Fecha de pago</q-item-label>
                    <q-item-label caption>{{fecha}}</q-item-label>
                  </q-item-section>
                </q-item>
              </q-list>
            </q-step>

            <template v-slot:navigation>
              <q-stepper-navigation>
                <q-btn
                  v-on:click="procesarDatos()"
                  @click="$refs.stepper.next()"
                  color="primary"
                  :disable="(step === 1 && usuario == '') || (step === 3 && (monto == null || fecha == '' || monto == ''))"
                  :label="step === 4 ? 'Solicitar' : 'Continuar'"
                />
                <q-btn
                  v-if="step > 1"
                  flat
                  color="primary"
                  @click="$refs.stepper.previous()"
                  label="Volver"
                  class="q-ml-sm"
                />
              </q-stepper-navigation>
            </template>
          </q-stepper>
        </q-card>

        <q-dialog v-model="confirm" persistent>
          <q-card>
            <q-card-section class="row items-center">
              <span
                class="q-ml-sm"
              >El usuario ingresado no se encuentra en la base de datos. ¿Desea registrarlo?.</span>
            </q-card-section>

            <q-card-actions align="right">
              <q-btn flat label="Cancelar" color="primary" v-close-popup />
              <q-btn
                flat
                @click="url_crear_cliente2"
                label="Registrar"
                color="primary"
                v-close-popup
              />
            </q-card-actions>
          </q-card>
        </q-dialog>
      </div>
    </div>
  </div>
</template>

<script src="./pagoPrestamo.js"></script>