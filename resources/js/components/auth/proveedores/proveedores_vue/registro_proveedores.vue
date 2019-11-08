<template>
  <div class="q-pa-md">
    {{pro_opt}}
    {{procedencia}}
    <div class="row justify-center">
      <div class="col-12 col-md-10">
        <q-card class="my-card">
          <q-card-section class="bg-primary text-white">
            <div class="text-h6">Proveedores/Ingreso</div>
          </q-card-section>

          <q-separator />

          <q-card-section>
            <div class="q-pa-md">
              <q-input v-model="codigo" label="Ingrese el codigo" stack-label />

              <q-input v-model="razon_social" label="Ingrese la razon social" stack-label />

              <q-input v-model="direccion" label="Ingrese la direccion" stack-label />
              <q-select
                v-model="ubicacion"
                :options="ubi_opt"
                label="Seleccione la ubicacion"
                stack-label
              />
              <q-input v-model="telefono" label="Ingrese el n° telefono" stack-label />

              <q-input v-model="correo" type="email" label="Ingrese el correo" stack-label />

              <q-input v-model="pagina" label="Ingrese la pagina web" stack-label />
              <q-select v-model="giro" :options="giro_opt" label="Seleccione el giro" stack-label />

              <q-input v-model="contacto" label="Ingrese el contacto" stack-label />

              <!-- dsdsds -->
              
              <q-select
                v-model="procedencia"
                :options="pro_opt"
                option-value="id"
                option-label="descripcion"
                label="Seleccione la Procedencia"
                stack-label
              />
              <!-- dsdsds -->

              <q-input
                v-model.number="detraccion"
                type="number"
                label="Seleccione la detraccion"
                stack-label
              />

              <q-input v-model="rut" label="Ingrese el rut" stack-label />
  
              <q-select
                v-model="tipo"
                :options="tipo"
                label="Seleccione el tipo proveedor"
                stack-label
              />
              <br />
              <q-btn color="primary" label="Ingresar" stack-label />
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
      codigo: null,
      razon_social: null,
      telefono: null,
      direccion: null,
      correo: null,
      pagina: null,
      rut: null,
      ubicacion: null,
      detraccion: null,
      contacto: null,
      giro: null,
      procedencia: null,
      tipo: null,
      ubi_opt: ["Mi Casa", "La Tuya", "EEE"],
      giro_opt: ["Fiambre", "Yogurth", "EEE"],
      pro_opt: [],
      tipo: ["Compra/Importacion", "Gasto", "H.P."]
    };
  },
  methods: {
    traerProcedencia() {
      axios.get("api/traer_procedencia").then(res => {
        console.log(res.data);
        this.pro_opt = res.data;
        console.log(this.pro_opt);
      });
    }
    
  },
  created() {
    //this.traerProcedencia();
  },

  mounted(){
this.traerProcedencia();
  }
};
</script>

<style>
</style>