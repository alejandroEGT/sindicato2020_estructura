<template>
  <div class="q-pa-md">

    <div class="q-pa-md">
      <div class="q-gutter-sm">
      
      <q-btn round>
      <q-avatar size="42px">
        <img src="https://scontent.fccp1-1.fna.fbcdn.net/v/t1.0-1/c2.0.40.40a/p40x40/69244077_2495071723872301_9078154412278415360_n.jpg?_nc_cat=102&_nc_oc=AQlmjeCvAF6D92WEjAkYQ9Q2Fi2WHuvafEZRLgxQwP7G-O46o6wd8hJ_63jCXa92bIA&_nc_ht=scontent.fccp1-1.fna&oh=44bb370b2f92430bd85a7ea32fd616ee&oe=5E62CCE1">
      </q-avatar>
  
          <q-menu>
            <div class="row no-wrap q-pa-md">
              <div class="column">
                <div class="text-h6 q-mb-md">Opciones</div>
                
                <a @click="url_perfil" style="" >Mi perfil</a>


              </div>

              <q-separator vertical inset class="q-mx-lg" />

              <div class="column items-center">
                <q-avatar size="72px">
                  <img src="https://scontent.fccp1-1.fna.fbcdn.net/v/t1.0-1/c2.0.40.40a/p40x40/69244077_2495071723872301_9078154412278415360_n.jpg?_nc_cat=102&_nc_oc=AQlmjeCvAF6D92WEjAkYQ9Q2Fi2WHuvafEZRLgxQwP7G-O46o6wd8hJ_63jCXa92bIA&_nc_ht=scontent.fccp1-1.fna&oh=44bb370b2f92430bd85a7ea32fd616ee&oe=5E62CCE1">
                </q-avatar>

                <div class="text-subtitle1 q-mt-md q-mb-xs">Alejandro godoy</div>

                <q-btn
                  @click='logout'
                  color="black"
                  label="Salir"
                  push
                  size="sm"
                  v-close-popup
                />
              </div>
            </div>
          </q-menu>
        </q-btn>

        <q-btn color="black" label="contenido">
        <q-menu
          transition-show="flip-right"
          transition-hide="flip-left"
        >
          <q-list style="min-width: 100px">
            <q-item clickable>
              <q-item-section>Noticias</q-item-section>
            </q-item>
            <q-item clickable>
              <q-item-section>Debates</q-item-section>
            </q-item>
            <q-item clickable>
              <q-item-section>Anime</q-item-section>
            </q-item>
            <q-separator />
            <q-item clickable>
              <q-item-section>el kkck</q-item-section>
            </q-item>
          </q-list>
        </q-menu>
      </q-btn>
    </div>
    </div>

    
    <div class="row justify-center">
      <div class="col-12 col-md-10">
          
          <div class="row q-col-gutter-md">
            
                <div class="col-12 col-md-6">
                   <q-card class="my-card">
                      <q-img src="https://cdn.quasar.dev/img/parallax2.jpg">
                        <div class="absolute-bottom">
                          <div class="text-h6">Contabilidad</div>
                          <div class="text-subtitle2">Registro de cuentas y prestamos</div>
                        </div>
                      </q-img>

                      <q-card-actions>
                        <q-btn flat @click="url_modulo_cuenta">Cuentas</q-btn><br>
                        <q-btn flat @click="url_modulo_prestamos">Prestamos</q-btn><br>
                        <q-btn flat @click="url_modulo_Liquidaciones">Liquidaciones</q-btn>
                         <!-- <q-btn flat @click="url_modulo_prestamos">Liquidaciones</q-btn> -->
                        <!-- <q-btn flat>Action 2</q-btn> -->
                      </q-card-actions>
                    </q-card>
                </div>

                <div class="col-12 col-md-6">
                   <q-card class="my-card">
                      <q-img src="https://cdn.quasar.dev/img/parallax2.jpg">
                        <div class="absolute-bottom">
                          <div class="text-h6">Clientes, empleados y proveedores</div>
                          <div class="text-subtitle2">Registro de clientes, empleados y proveedores</div>
                        </div>
                      </q-img>

                      <q-card-actions>
                        <q-btn flat @click="url_modulo_clientes">Clientes</q-btn><br>
                        <q-btn flat @click="url_modulo_empleados">Empleados</q-btn><br>
                        <q-btn flat @click="url_modulo_proveedor">Proveedores</q-btn>

                        <!-- <q-btn flat>Action 2</q-btn> -->
                      </q-card-actions>
                    </q-card>
                </div>


          </div>

          <div>
            <div class="col-12 col-md-6">
                   <q-card class="my-card">
                      <q-img src="https://cdn.quasar.dev/img/parallax2.jpg">
                        <div class="absolute-bottom">
                          <div class="text-h6">Gestión y Administración</div>
                          <div class="text-subtitle2">Registro de reuniones, monitoreo de tareas administrativas</div>
                        </div>
                      </q-img>

                      <q-card-actions>
                        <q-btn flat @click="url_modulo_reunion">Reuniones</q-btn><br>
                        <!-- <q-btn flat @click="url_modulo_proveedor">Proveedores</q-btn> -->

                        <!-- <q-btn flat>Action 2</q-btn> -->
                      </q-card-actions>
                    </q-card>
                </div>
          </div>


      </div>
    </div>
   
  


  </div>


</template>


<script>

// import { WebCam } from 'vue-cam-vision'
export default {
  data () {
    return {
      tab: 'mails',
      splitterModel: 20,
       panel: 'mails',
       body:'list-group-item',
       date: '2019/02/01',
       date2:'2019-02-01 12:44',
       myLocale: {
        /* starting with Sunday */
        days: 'Domingo_Lunes_Martes_Miércoles_Jueves_Viernes_Sábado'.split('_'),
        daysShort: 'Dom_Lun_Mar_Mié_Jue_Vie_Sáb'.split('_'),
        months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
        monthsShort: 'Ene_Feb_Mar_Abr_May_Jun_Jul_Ago_Sep_Oct_Nov_Dic'.split('_'),
        firstDayOfWeek: 1,
        expanded: false,

        //webcam
        // captures: [],
        // imgReport: [],
        // frontCam: false,
        // webcam: null,
        // img: null,
        // camera: null,
        // deviceId: null,
        // devices: [],
        // googleKey: config.googleVisionKey
      }
    }
  },
   components: {
    // WebCam
  },
  methods:{
    logout: function () {
         this.$auth.logout({
                  makeRequest: true,
                  redirect: '/'
              });
      },
        url_perfil(){
        this.$router.push('/mi-perfil');
       },
        url_crear_cliente(){
        this.$router.push('/registro-clientes');
       },

       url_modulo_cuenta(){
        this.$router.push('/modulo-cuentas');
       },
       url_modulo_prestamos(){
        this.$router.push('/modulo-prestamos');
       },

       url_modulo_clientes(){
        this.$router.push('/modulo-clientes');
       },
       url_modulo_proveedor(){
        this.$router.push('/modulo-proveedor');
       },

       url_listar_cuenta(){
        this.$router.push('/listar-cuenta');
       },
       url_modulo_Liquidaciones(){
         this.$router.push('/modulo-liquidaciones');
       },
       url_modulo_reunion(){
         this.$router.push('/modulo-reunion');
       },
       url_modulo_empleados(){
         this.$router.push('/modulo-empleados');
       }


    // async onCapture () {
    //   this.img = await this.$refs.webcam.capture()
    // },
    // onStarted (stream) {
    //   console.log('On Started Event', stream)
    // },
    // onStopped (stream) {
    //   console.log('On Stopped Event', stream)
    // },
    // onStop () {
    //   this.$refs.webcam.stop()
    // },
    // onStart () {
    //   this.$refs.webcam.start()
    // },
    // onError (error) {
    //   console.log('On Error Event', error)
    // },
    // onCameras (cameras) {
    //   this.devices = cameras
    //   console.log('On Cameras Event', cameras)
    // },
    // onCameraChange (deviceId) {
    //   this.deviceId = deviceId
    //   this.camera = deviceId
    //   console.log('On Camera Change Event', deviceId)
    // }

  }
}
</script>

<style type="text/css">
a:link
{
text-decoration:none;
}
</style>