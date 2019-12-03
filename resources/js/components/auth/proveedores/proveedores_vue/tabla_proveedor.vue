<template>
  <div class="q-pa-md">
    <div class="row justify-center">
      <div class="col-12 col-md-10">
        <q-card class="my-card">
          <q-card-section class="bg-primary text-white">
            <div class="text-h6 text-center">Proveedores/Tabla</div>
          </q-card-section>

          <q-separator />

          <q-card-section>
            <div class="q-pa-md">
              <q-table
                class="my-sticky-header-table"
                title="Proveedores"
                :data="data"
                :columns="columns"
                row-key="name"
                flat
                bordered
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
      columns: [
        {
          name: "id",
          required: true,
          label: "ID",
          field: "id",
          align: "left",
          sortable: true
        },
        {
          name: "activo",
          label: "Activo",
          field: "activo",
          sortable: true
        },
        {
          name: "codigo",
          align: "center",
          label: "Codigo",
          field: "codigo",
          sortable: true
        },
        {
          name: "rut",
          label: "Rut",
          field: "rut",
          sortable: true
        },
        {
          name: "razon_social",
          label: "Razon Social",
          field: "razon_social",
          sortable: true
        },
        {
          name: "direccion",
          label: "Direccion",
          field: "direccion",
          sortable: true
        },
        {
          name: "telefono",
          label: "Telefono",
          field: "telefono",
          sortable: true
        },
        {
          name: "correo",
          label: "Correo",
          field: "correo",
          sortable: true
        },
        {
          name: "pagina",
          label: "Pagina Web",
          field: "pagina",
          sortable: true
        },
        {
          name: "contacto",
          label: "Contacto",
          field: "contacto",
          sortable: true
        },
        {
          name: "detraccion",
          label: "Detraccion",
          field: "detraccion",
          sortable: true
        },
        {
          name: "giro",
          label: "Giro",
          field: "giro",
          sortable: true
        },
        {
          name: "procedencia",
          label: "Procedencia",
          field: "procedencia",
          sortable: true
        },
        {
          name: "tipo",
          label: "Tipo Proveedor",
          field: "tipo",
          sortable: true
        }
      ],

      data: []
    };
  },
  methods: {
    traerProveedores() {
      axios.get("api/traer_proveedores").then(res => {
        if (res.data.estado == "success") {
          this.data = res.data.proveedores;
        } else {
          alert(res.data.mensaje);
        }
      });
    }
  },
  created() {
    //this.traerProveedores();
  },

  mounted() {
    this.traerProveedores();
  }
};
</script>

<style lang="sass">
.my-sticky-header-table
  /* max height is important */
  .q-table__middle
    max-height: 200px

  .q-table__top,
  .q-table__bottom,
  thead tr:first-child th
    /* bg color is important for th; just specify one */
    background-color: #c1f4cd

  thead tr th
    position: sticky
    z-index: 1
  thead tr:first-child th
    top: 0

  /* this is when the loading indicator appears */
  &.q-table--loading thead tr:last-child th
    /* height of all previous header rows */
    top: 48px
</style>