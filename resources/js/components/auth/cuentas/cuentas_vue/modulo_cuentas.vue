<template>
	<div class="q-pa-md">
		<div class="row justify-center">

            <div class="col-12 col-md-10">
				<q-card class="my-card">
			      <q-card-section class="bg-primary text-white">
			        <div class="text-h6">Cuentas</div>
			        <!-- <div class="text-subtitle2">by John Doe</div> -->
			      </q-card-section>

			      <q-separator />

			      <div class="q-pa-md">
			        <div class="row q-col-gutter-md">
			        	<div class="col-12 col-md-2">
			        		<q-btn class="full-width" @click="url_crear_cuenta" color="primary"  icon="create" label="Crear cuenta" />
			        	</div>
			        	<div class="col-12 col-md-2">
			        		<q-btn class="full-width" @click="url_listar_cuenta" color="primary"  icon="list" label="Listar cuentas" />
			        	</div>
			        	<div class="col-12 col-md-2">
			        		<q-btn class="full-width" @click="url_formulario_cuenta" color="primary"  icon="attach_file" label="Formulario" />
			        	</div>
			        </div>
			      </div>
			    </q-card>
			</div>
		</div>
	</div>
</template>

<script src="../cuentas_js/modulo_cuentas.js"></script>