<template>
	<div class="q-pa-md">
		<div class="row justify-center">

            <div class="col-12 col-md-10">
				<q-card class="my-card">
			      <q-card-section class="bg-primary text-white">
			        <div class="text-h6">Liquidaciones</div>
			        <!-- <div class="text-subtitle2">by John Doe</div> -->
			      </q-card-section>

			      <q-separator />

			      <div class="q-pa-md">
			        <div class="row q-col-gutter-md">
						<div class="col-12 col-md-3">
			        		<q-btn @click="url('/detalle-haberes-descuentos')" color="green" class="block" icon="create" label="det. haberes y descuentos" />
			        	</div>
			        	<div class="col-12 col-md-2">
			        		<q-btn @click="url('/formulario-liquidaciones')" color="primary" class="block" icon="create" label="Formulario" />
			        	</div>
			        	<div class="col-12 col-md-2">
			        		<q-btn @click="url('/listar-liquidaciones')" color="primary" class="block" icon="list" label="lista Generadas" />
			        	</div>
			        	<!-- <div class="col-12 col-md-2">
			        		<q-btn @click="url_formulario_cuenta" color="primary" class="block" icon="attach_file" label="Formulario" />
			        	</div> -->
			        </div>
			      </div>
			    </q-card>
			</div>
		</div>
	</div>
</template>

<script src="../liquidaciones_js/modulo_liquidaciones.js"></script>