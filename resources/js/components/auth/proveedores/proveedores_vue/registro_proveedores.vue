<template>
  <div class="q-pa-md">
    <div class="row justify-center">
      <div class="col-12 col-md-10">
        <q-card class="my-card">
          <q-card-section class="bg-primary text-white">
            <div class="text-h6 text-center">Proveedores/Ingreso</div>
          </q-card-section>

          <q-separator />

          <q-card-section>
            <div class="q-pa-md">
              <q-input v-model="codigo" label="Ingrese el codigo" stack-label />
              <q-input v-model="razon_social" label="Ingrese la razon social" stack-label />
              <q-input v-model="direccion" label="Ingrese la direccion" stack-label />
              <q-input v-model="ubicacion" label="Ingrese la ubicacion" stack-label />
              <q-input v-model="telefono" label="Ingrese el n° telefono" stack-label />
              <q-input v-model="correo" type="email" label="Ingrese el correo" stack-label />
              <q-input v-model="pagina" label="Ingrese la pagina web" stack-label />
              <q-select
                v-model="giro"
                :options="giro_opt"
                option-value="id"
                option-label="descripcion"
                label="Seleccione el giro"
                stack-label
              />
              <q-input v-model="contacto" label="Ingrese el contacto" stack-label />
              <q-select
                v-model="procedencia"
                :options="pro_opt"
                option-value="id"
                option-label="descripcion"
                label="Seleccione la Procedencia"
                stack-label
              />
              <q-input
                v-model.number="detraccion"
                type="number"
                label="Seleccione la detraccion"
                stack-label
              />
              <q-input v-model="rut" label="Ingrese el rut" stack-label />
              <q-select
                v-model="tipo"
                :options="tipo_opt"
                option-value="id"
                option-label="descripcion"
                label="Seleccione el tipo proveedor"
                stack-label
              />
              <br />
              <q-btn color="primary" label="Ingresar" @click="registroProveedor" stack-label />
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
      ubicacion: null,
      correo: null,
      pagina: null,
      rut: null,
      detraccion: null,
      contacto: null,
      giro: null,
      procedencia: null,
      tipo: null,
      giro_opt: [],
      pro_opt: [],
      tipo: null,
      tipo_opt: []
    };
  },
  methods: {
    registroProveedor() {
      const datos = {
        codigo: this.codigo,
        razon_social: this.razon_social,
        direccion: this.direccion,
        ubicacion: this.ubicacion,
        telefono: this.telefono,
        correo: this.correo,
        pagina: this.pagina,
        giro: this.giro.id,
        contacto: this.contacto,
        procedencia: this.procedencia.id,
        detraccion: this.detraccion,
        rut: this.rut,
        tipo: this.tipo.id
      };
      axios.post("api/ingresar_proveedor", datos).then(res => {
        console.log(res.data.mensaje);
        if (res.data.estado == 'success') {
          alert(res.data.mensaje);
        }
      });
    },
    traerProcedencia() {
      axios.get("api/traer_procedencia").then(res => {
        console.log(res.data);
        this.pro_opt = res.data;
        console.log(this.pro_opt);
      });
    },

    traerGiros() {
      axios.get("api/traer_giros").then(res => {
        this.giro_opt = res.data;
      });
    },

    traerTipos() {
      axios.get("api/traer_tipos").then(res => {
        this.tipo_opt = res.data;
      });
    }
  },
  created() {
    //this.traerProcedencia();
  },

  mounted() {
    this.traerProcedencia();
    this.traerGiros();
    this.traerTipos();
  }
};
</script>

<style>
</style>