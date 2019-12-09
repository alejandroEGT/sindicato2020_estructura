<template>
  <div class="q-pa-md">
    <div class="row justify-center">
      <div class="col-12 col-md-8">
        <q-card>
          <q-card-section class="bg-primary text-white">
            <div class="text-h6">Solicitar Prestamo</div>
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

                <q-btn color="primary" label="Buscar Usuario" v-on:click="getUsuario" />
              </div>
            </q-step>

            <q-step :name="2" title="Tipo de Prestamo" icon="create_new_folder" :done="step > 2">
              <q-list>
                <q-item tag="label" v-ripple>
                  <q-item-section avatar>
                    <q-radio v-model="tipo" val="1" />
                  </q-item-section>
                  <q-item-section>
                    <q-item-label>Sin Intereses</q-item-label>
                    <q-item-label caption>El prestamo solicitado no generara ningún tipo de interes</q-item-label>
                  </q-item-section>
                </q-item>

                <q-item tag="label" v-ripple>
                  <q-item-section avatar>
                    <q-radio v-model="tipo" val="2" />
                  </q-item-section>
                  <q-item-section>
                    <q-item-label>Con Intereses</q-item-label>
                    <q-item-label
                      caption
                    >El prestamo solicitado generara un interes con un valor que puede definir a continuación</q-item-label>
                  </q-item-section>
                </q-item>
              </q-list>

              <q-slide-transition>
                <div v-show="tipo == '2'">
                  <q-input
                    outlined
                    counter
                    maxlength="3"
                    v-model="interes"
                    label="Ingrese porcentaje"
                    stack-label
                    type="number"
                    hint="Ingrese el porcentaje que desea de interes sin simbolo"
                    :rules="[
                              val => val.length <= 3 || 'El maximo da caracteres es de 3' , 
                              val => val.length >= 1 || 'El minimo de caracteres es de 2'
                            ]"
                  />
                </div>
              </q-slide-transition>
            </q-step>

            <q-step :name="3" title="Monto y fecha" icon="assignment">
              <div class="q-gutter-md">
                <q-input
                  outlined
                  counter
                  maxlength="20"
                  v-model="monto"
                  label="Ingrese monto a solicitar"
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
                  maxlength="2"
                  v-model="cuotas"
                  label="Ingrese numero de cuotas"
                  stack-label
                  type="number"
                  hint="El monto debe de ser ingresado sin puntos"
                  :rules="[
                              val => val.length <= 2 || 'El maximo da caracteres es de 2' , 
                              val => val.length >= 1 || 'El minimo de caracteres es de 1'
                            ]"
                />

                <q-input
                  outlined
                  counter
                  v-model="fecha"
                  label="Fecha del prestamo"
                  stack-label
                  type="date"
                  hint="Seleccione la fecha en la cual se genero el prestamo"
                />
              </div>
            </q-step>

            <q-step :name="4" title="Confimar datos prestamo" icon="add_comment">
              <q-list>
                <q-item>
                  <q-item-section>
                    <q-item-label>Solicitante del Prestamo</q-item-label>
                    <q-item-label caption lines="2">{{usuario.nombrecliente}}</q-item-label>
                  </q-item-section>
                </q-item>

                <q-separator spaced inset />

                <q-item>
                  <q-item-section>
                    <q-item-label>Tipo de prestamo</q-item-label>
                    <q-item-label caption>
                      <b v-show="tipo == '1'">Sin Intereses</b>
                      <b v-show="tipo == '2'">Con Intereses</b>
                    </q-item-label>
                  </q-item-section>
                </q-item>

                <q-separator spaced inset />

                <q-item>
                  <q-item-section>
                    <q-item-label>Monto Solicitado</q-item-label>
                    <q-item-label caption>{{monto}}</q-item-label>
                  </q-item-section>
                </q-item>

                <q-separator spaced inset />

                <q-item>
                  <q-item-section>
                    <q-item-label>Total con Intereses</q-item-label>
                    <q-item-label caption>{{valorConInteres}}</q-item-label>
                  </q-item-section>
                </q-item>

                <q-separator spaced inset />

                <q-item>
                  <q-item-section>
                    <q-item-label>Numero de cuotas</q-item-label>
                    <q-item-label caption>{{cuotas}}</q-item-label>
                  </q-item-section>
                </q-item>

                <q-separator spaced inset />

                <q-item>
                  <q-item-section>
                    <q-item-label>Fecha Solicitud Prestamo</q-item-label>
                    <q-item-label caption>{{fecha}}</q-item-label>
                  </q-item-section>
                </q-item>
              </q-list>
            </q-step>

            <template v-slot:navigation>
              <q-stepper-navigation>
                <q-btn
                  v-on:click="step === 4 ? setPrestamo() : calcularIntereses()"
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
                @click="url_crear_cliente"
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

<script src="./modulo_prestamos.js"></script>