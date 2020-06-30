<template>
   <div>
        <br><br>
        <div class="row justify-center">
           <div class="col-md-8">
                <b-card no-body>
                    <b-card-header :style="header_color" >
                    CUENTA
                    </b-card-header>

					        <b-card-body>
                    <div class="row q-col-gutter-md">
                      <div class="col-12 col-md-6">
                        <label for="">Cuenta:</label>
                          <b-form-select 
                            v-model="cuenta_id" 
                            :options="options"
                            value-field="id"
                            text-field="titulo"
                            size="sm"
                            
                            >
                            <template  v-slot:first>
                              <b-form-select-option :value="''">--Seleccione cuenta--</b-form-select-option>
                            </template>

                          </b-form-select>
                      </div>
                      <div class="col-12 col-md-3">
                        <label for="">Año:</label>
                          <b-form-select 
                            v-model="anio" 
                            :options="anios"
                            value-field="id"
                            text-field="label"
                            size="sm"  
                          >
                            <template  v-slot:first>
                              <b-form-select-option :value="''">--Seleccione año--</b-form-select-option>
                            </template>

                          </b-form-select>
                      </div>
                      <div class="col-12 col-md-3">
                        <label for="">Mes:</label>
                          <b-form-select 
                            v-model="mes" 
                            :options="meses"
                            value-field="id"
                            text-field="label"
                            size="sm"  
                          >
                            <template  v-slot:first>
                              <b-form-select-option :value="''">--Seleccione mes--</b-form-select-option>
                            </template>

                          </b-form-select>
                      </div>

                      <div>
                        
                            <b-button variant="dark" size="sm" @click="listar" >
                              <i class="fas fa-search"></i>
                              Buscar</b-button>
                          

                          
                            <b-button variant="success" size="sm" @click="limpiar" >
                              <i class="fas fa-eraser"></i>
                              Limpiar</b-button>
                          

                       
                            <b-button  size="sm" @click="ruta('index_socio')">
                              <i class="fas fa-undo-alt"></i>
                              Volver</b-button>
                          
                          
                        
                        <!-- <b-button variant="info" size="sm" v-b-modal.modal-1>
                          <i class="far fa-calendar-alt"></i>
                            Inicio mensual
                        </b-button> -->

                        <b-modal id="modal-1" 
                        hide-footer
                          size="lg"
                          title="Inicio mensual"
                          header-bg-variant="dark"
                          header-text-variant="white">

                          <div>
                              <div>
                                    
                                        <div class="">
                                          <div class="row">
                                            <div class="col-12 col-md-3">
                                              <label for="">Cuenta:</label>
                                              <b-form-select 
                                                v-model="cuenta_id" 
                                                :options="options"
                                                value-field="id"
                                                text-field="titulo"
                                                size="sm"
                                                
                                                >
                                                <template  v-slot:first>
                                                  <b-form-select-option :value="''">--Seleccione cuenta--</b-form-select-option>
                                                </template>

                                              </b-form-select>
                                            </div>
                                            <div class="col-12 col-md-3">
                                              <label for="">Año:</label>
                                              <b-form-select 
                                                v-model="anio" 
                                                :options="anios"
                                                value-field="id"
                                                text-field="label"
                                                size="sm"  
                                              >
                                                <template  v-slot:first>
                                                  <b-form-select-option :value="''">--Seleccione año--</b-form-select-option>
                                                </template>

                                              </b-form-select>
                                            </div>
                                            <div class="col-12 col-md-3">
                                              <label for="">Mes:</label>
                                              <b-form-select 
                                                v-model="mes" 
                                                :options="meses"
                                                value-field="id"
                                                text-field="label"
                                                size="sm"  
                                              >
                                                <template  v-slot:first>
                                                  <b-form-select-option :value="''">--Seleccione mes--</b-form-select-option>
                                                </template>

                                              </b-form-select>
                                            </div>
                                            <div class="col-12 col-md-3">
                                              <label for="">Monto de inicio:</label>
                                              <!-- <q-input v-model="monto_inicio" label="Monto inicial" /> -->
                                               <b-form-input size="sm" v-model="monto_inicio" placeholder="Monto inicial"></b-form-input>
                                            </div>
                                            <!-- <div class="col-12 col-md-2">
                                              <q-btn label="Calcular" />
                                            </div> -->
                                            <!-- <div class="col-12 col-md-2">
                                              <b-button @click="ingresar_inicio_mes">Guardar</b-button>
                                            </div> -->
                                          </div>
                                          <hr>
                                          <b-button
                                            variant="primary"
                                            size="sm"
                                            class="float-right"
                                            @click="ingresar_inicio_mes" 
                                          >
                                            Guardar
                                          </b-button>
                                        </div>


                                  </div>
                          </div>
                        </b-modal>
                      </div>

                    </div>
                    
					        </b-card-body>
                </b-card>
            </div>
        </div>   

         <div v-if="view_tabla">
                <hr>
                <div class="table-responsive" >
                  <table class="table" >
                           <tr :style="header_color">
                             <td>ID</td>
                             <td>SUBCUENTA</td>
                             <td>FECHA</td>
                             <td>ARCHIVO</td>
                             <td>DESCRIPCION descripcion descripcion</td>
                             <td>INGRESO</td>
                             <td>EGRESO</td>
                             <td> </td>
                           </tr>

                            <tr :style="tr_style" v-for="(t,i) in tabla" :key='t.id' >
                               <td :style="border" style="background:#D5DBDB">{{ i+1+'-'+t.id }}</td>
                               <td :style="border">{{ t.titulo }}</td>
                               <td :style="border">{{ t.fecha }}</td>
                               <td :style="border">
                                <b-button size="sm" variant="light" v-b-modal="'graf'+t.id">
                                  <i class="fas fa-file-alt"></i> Archivo</b-button>

                                   <b-modal 
                                   header-bg-variant="dark"
                                   header-text-variant="white"
                                   hide-footer 
                                   size="md" :id="'graf'+t.id" title="Archivo">
                                        <iframe 
                                             style="width:100%; height:500px;" 
                                            :src="'../'+t.archivo" 
                                            frameborder="0" 
                                            allowfullscreen>
                                        </iframe>

                                    </b-modal>
                                 
                               </td>
                               <td :style="border">{{ t.descripcion}}</td>
                               <td :style="border"><label style="color:green">{{formatPrice(t.monto_ingreso)}}</label></td>
                               <td :style="border"><label style="color:red">{{formatPrice(t.monto_egreso)}}</label></td>
                               <td :style="border"></td>
                            </tr>
                            

                            <tr >
                             <th :style="header_color" colspan="5">RESUMEN DEL MES</th>
                             <td :style="border" >{{data_resumen[0].valor}}</td>
                             <td :style="border" >{{data_resumen[1].valor}}</td>
                             <td :style="border" ><b>{{data_resumen[2].valor}}</b></td>
                           </tr>

                           <tr >
                             <th :style="header_color" colspan="3">ACUMULADO MESES ANTERIORES</th>
                             <td :style="border" colspan="1">{{formatPrice(monto_inicio)}}</td>
                             <th :style="header_color" colspan="3">ARRASTRE TOTAL</th>
                             <td :style="border">{{formatPrice(monto_inicio +(ingresos-egresos))}}</td>
                           </tr>
                  
                           

                    </table>
                </div>


                
                
              </div>
            

            <hr>
            <div class="col-6">

                     
                         
              <template>
						  <div class="q-pa-md">
                

						   
						  <q-list>
						    <q-item v-for="s in selected" :key="s.id">
						      {{s.name}}
						    </q-item>                 
						  </q-list>
                <br>
                
						    <!-- <div class="q-mt-md">
						      Selected: {{ JSON.stringify(selected) }}
						    </div> -->
						  </div>
              </template>
                  

            <!-- {{ ingresos +' - '+egresos + ' = '+ (ingresos-egresos) }} -->
            
      
            </div>
            
   </div>
   
    
</template>  

<script src="./cuentas.js"></script> 