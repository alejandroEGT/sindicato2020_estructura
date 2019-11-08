<template>
  <div class="q-pa-md row items-start q-gutter-md row justify-center">
    <div class="col-6">
      <q-card class="my-card">
        <q-card-section class="bg-primary text-white">
          <div class="text-h6">Registro de Proveedores</div>
        </q-card-section>

        <q-separator />

        <q-card-actions align="center">
          <q-input
            outlined
            v-model="codigo"
            label="Ingrese codigo identificador"
            stack-label
            type="text"
          />
           <q-separator />
          <q-btn color="secondary" label="Ingresar" />
        </q-card-actions>
      </q-card>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>