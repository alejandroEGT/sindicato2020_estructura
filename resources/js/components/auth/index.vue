<template>
  <div class="q-pa-md">

    <div class="q-pa-md">
      <div class="q-gutter-sm">
      
      <!-- <q-btn round>
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
        </q-btn> -->

        <!-- <q-btn color="black" label="contenido">
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
      </q-btn> -->
    </div>
    </div>

    
    <div class="row justify-center">
      <div class="col-12 col-md-11">
          
          <div class="row q-col-gutter-md">
            
                <div class="col-12 col-md-4">
                  
                      <div @click="ruta('socios')" style="width:100%;  border:2px solid #E5E8E8; ">
                        <q-img  style="height: 200px; max-width: 100%; "  src="https://informativohoy.com.ar/wp-content/uploads/2019/05/casadei-artesanalaes.jpg">
                          <div class="absolute-bottom">
                            <div class="text-h6">Socios</div>
                            <div class="text-subtitle2">Registro y lista de socios</div>
                          </div>
                        </q-img>
                      </div>
                </div>

                <div class="col-12 col-md-4">
                    <div @click="url_crear_cliente" style="width:100%;  border:2px solid #E5E8E8; ">
                      <q-img  style="height: 200px; max-width: 100% "
                      src="https://billibfinance.com/wp-content/uploads/2019/02/estado-de-flujos-de-tesorer%C3%ADa-1200x565.jpg">
                        <div class="absolute-bottom">
                          <div class="text-h6">Tesorería</div>
                          <div class="text-subtitle2">Registro y lista de cuentas sindicales</div>
                        </div>
                      </q-img>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div @click="url_crear_cliente" style="width:100%;  border:2px solid #E5E8E8; ">
                      <q-img 
                      style="height: 200px; max-width: 100%; " 
                      src="https://www.compartirpalabramaestra.org/sites/default/files/field/image/secretaria-de-educacion-y-organizaciones-sindicales-instalan-mesa-de-negociacion-2019.jpg">
                        <div class="absolute-bottom">
                          <div class="text-h6">Secretaría</div>
                          <div class="text-subtitle2">Registro y lista de reuniones, actas, votaciones</div>
                        </div>
                      </q-img>
                    </div>
                </div>


          </div>

          <div>

      </div>


      </div>
    </div>

    <div class="row justify-center">
       <div class="col-12 col-md-11">
          <div class="row q-col-gutter-md">
            <div class="col-12 col-md-12">
                    <div @click="url_crear_cliente" style="width:100%;  border:2px solid #E5E8E8; ">
                      <q-img  style="height: 200px; max-width: 100%; "  src="https://informativohoy.com.ar/wp-content/uploads/2019/05/casadei-artesanalaes.jpg">
                        <div class="absolute-bottom">
                          <div class="text-h6">Administracion / configuración</div>
                          <div class="text-subtitle2">Configuraciones internas de la compañia</div>
                        </div>
                      </q-img>
                    </div>
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
       },

       ruta(ruta){
        this.$router.push('/'+ruta);
      },


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