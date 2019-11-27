<template>
  <div class="q-pa-md">
    <div class="row justify-center">
      <div class="col-12 col-md-10">
        <q-card class="my-card">
          <q-card-section class="bg-primary text-white">
            <div class="text-h6">Proveedores</div>
          </q-card-section>

          <q-separator />

          <q-card-section class="text-white">
            <div class="q-pa-md">
              <div class="row q-col-gutter-md">
                <div class="col-12 col-md-2">
                  <q-btn
                    @click="url_registro_proveedor"
                    color="primary"
                    class="block"
                    icon="create"
                    label="Ingresar Proveedores"
                  />
                </div>

                <div class="col-12 col-md-2">
                  <q-btn
                  @click="url_listar_proveedor"
                    color="primary"
                    class="block"
                    icon="create"
                    label="Proveedores"
                  />
                </div>
              </div>
            </div>
          </q-card-section>
        </q-card>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  methods: {
    url_registro_proveedor() {
      this.$router.push("/ingreso_proveedor");
    },

    url_listar_proveedor(){
      this.$router.push("/listar_proveedor");
    }
  }
};
</script>
