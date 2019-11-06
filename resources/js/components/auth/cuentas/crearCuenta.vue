<template>
  <div>
    <div class="row justify-center">
      <div class="col-6">
        <div class="q-pa-md">
          <div class="q-pa-md items-start q-gutter-md">
            <q-card class="my-card">
              <q-card-section>
                <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md">

                   <q-input outlined v-model="ph" label="Label" placeholder="Placeholder" hint="With placeholder" :dense="dense" />
                  <!-- <q-input
                    filled
                    v-model="nombreCuenta"
                    label="Nombre *"
                    hint="Nombre de la cuenta"
                    lazy-rules
                    :rules="[ val => val && val.length > 0 || 'Porfavor ingrese un nombre de cuenta']"
                  >
                    <template v-slot:prepend>
                      <q-icon name="account_balance_wallet" />
                    </template>
                  </q-input> -->

                  <q-input
                    filled
                    v-model="descripcionCuenta"
                    label="Descripcion *"
                    hint="Descripcion de la cuenta"
                    lazy-rules
                    :rules="[ val => val && val.length > 0 || 'Porfavor ingrese una descripcion de cuenta']"
                  >
                    <template v-slot:prepend>
                      <q-icon name="description" />
                    </template>
                  </q-input>

                  <q-toggle v-model="accept" label="Confirmar la cuenta a crearse." />

                  <div>
                    <q-btn label="Crear Cuenta" type="submit" color="primary" />
                    <q-btn label="Limpiar" type="reset" color="primary" flat class="q-ml-sm" />
                  </div>
                </q-form>
              </q-card-section>
            </q-card>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>    
       
<script>
export default {
  data() {
    return {
      nombreCuenta: null,
      descripcionCuenta: null,

      accept: false,

      text: '',
      ph: '',

      dense: false
    };
  },

  methods: {
    onSubmit() {
      if (this.accept !== true) {
        this.$q.notify({
          color: "red-5",
          textColor: "white",
          icon: "warning",
          message: "You need to accept the license and terms first"
        });
      } else {
        this.$q.notify({
          color: "green-4",
          textColor: "white",
          icon: "cloud_done",
          message: "Submitted"
        });
      }
    },

    onReset() {
      this.nombreCuenta = null;
      this.descripcionCuenta = null;
      this.accept = false;
    }
  }
};
</script>


