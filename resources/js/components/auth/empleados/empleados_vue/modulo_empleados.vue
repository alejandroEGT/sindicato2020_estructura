<template>
    <div>
    
        <div class="q-pa-md">
		<div class="row justify-center">

            <div class="col-12 col-md-12">
				<q-card class="my-card">
			      <q-card-section class="bg-primary text-white">
			        <div class="text-h6">Empleados</div>
			        <!-- <div class="text-subtitle2">by John Doe</div> -->
			      </q-card-section>

			      <q-separator />

			      <div class="q-pa-md">
			        <div class="row q-col-gutter-md">
			        	<div class="col-12 col-md-3">
			        		<q-btn @click="url('/formulario-empleados')" color="primary"  class="full-width" icon="create" label="Formulario empleado" />
			        	</div>
			        	<div class="col-12 col-md-3">
			        		<q-btn color="primary"  class="full-width" icon="list" label="Listar empleados" />
			        	</div>
			        	<!-- <div class="col-12 col-md-2">
			        		<q-btn @click="" color="primary" class="block" icon="attach_file" label="Formulario" />
			        	</div> -->
			        </div>
			      </div>
			    </q-card>
			</div>
		</div>
	</div>

    </div>
</template>

<script src="../empleados_js/modulo_empleados.js"></script> 