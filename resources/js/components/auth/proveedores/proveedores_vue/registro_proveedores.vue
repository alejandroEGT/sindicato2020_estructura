<template>
  <div class="q-pa-md">
    <div class="row justify-center">
      <div class="col-12 col-md-10">
        <q-card class="my-card">
          <q-card-section class="bg-primary text-white">
            <div class="text-h6">Proveedores/Ingreso</div>
          </q-card-section>

          <q-separator />

          <q-card-section>
            <div class="q-pa-md">
              <q-input v-model="codigo" label="Ingrese el codigo" stack-label :dense="dense" />
              <q-input
                v-model="razon_social"
                label="Ingrese la razon social"
                stack-label
                :dense="dense"
              />
              <q-input v-model="direccion" label="Ingrese la direccion" stack-label :dense="dense" />
              <q-select
                v-model="ubicacion"
                :options="ubi_opt"
                label="Seleccione la ubicacion"
                stack-label
                :dense="dense"
              />
              <q-input
                v-model="telefono"
                label="Ingrese el n° telefono"
                stack-label
                :dense="dense"
              />

              <q-input
                v-model="correo"
                type="email"
                label="Ingrese el correo"
                stack-label
                :dense="dense"
              />

              <q-input v-model="pagina" label="Ingrese la pagina web" stack-label :dense="dense" />
              <q-select
                v-model="giro"
                :options="giro_opt"
                label="Seleccione el giro"
                stack-label
                :dense="dense"
              />

              <q-input v-model="contacto" label="Ingrese el contacto" stack-label :dense="dense" />

              <q-select
                v-model="procedencia"
                :options="pro_opt"
                label="Seleccione la Procedencia"
                stack-label
                :dense="dense"
              />

              <q-input v-model.number="detraccion" type="number" label="Seleccione la detraccion" stack-label :dense="dense"  />

              <q-input v-model="rut" label="Ingrese el rut" stack-label :dense="dense" />
              
              <q-select
                v-model="tipo"
                :options="tipo"
                label="Seleccione el tipo proveedor"
                stack-label
                :dense="dense"
              />
            </div>
          </q-card-section>
        </q-card>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      ubicacion: null,
      giro: null,
      procedencia: null,
      tipo: null,
      ubi_opt: ["Mi Casa", "La Tuya", "EEE"],
      giro_opt: ["Fiambre", "Yogurth", "EEE"],
      pro_opt: ["Nacional", "Extranjera"],
      tipo: ["Compra/Importacion", "Gasto", "H.P."],
    };
  }
};
</script>

<style>
</style>