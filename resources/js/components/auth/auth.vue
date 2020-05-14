
   <template >
  <div class="outer-auth"  v-if="$auth.check()">
    
  

     <b-navbar style="background: rgb(0,0,0);
  background: linear-gradient(90deg, rgba(0,0,0,0.7413340336134453) 0%, rgba(4,8,9,1) 9%, rgba(46,39,96,1) 90%);">
    <b-nav-form>
      <div class="col text-center text-weight-bold">
        <b-button class="float-left" size="sm" @click="logout" variant="primary">Salir</b-button>
         <label style="font-size:13px; margin-top:6px; color:#fff" class="float-left"> | Admin -> Alejandro Godoy</label>
       
      </div>
    </b-nav-form>
  </b-navbar>

    
  
    <div class="container">
        <router-view :key="$route.path"></router-view>  
    </div>
    <br><br><br><br>
  </div>
</template>



<script>
export default {
  name: 'Reveal',
  data: () => ({
    menuVisible: false
  }),

  methods:{

    url_perfil(){
        this.$router.push('/mi-perfil');
    },
    ruta(ruta){
      this.$router.push('/'+ruta);
    },

  	logout: function () {
         this.$auth.logout({
                  makeRequest: true,
                  redirect: '/'
              });
    },
  }
}
</script>

<style>
 /*  */
  .outer-auth{
    
   background: rgb(23,26,84);
background: linear-gradient(170deg, rgba(23,26,84,1) 0%, rgba(160,163,187,1) 11%, rgba(251,254,255,1) 25%, rgba(251,254,255,0.15309873949579833) 59%, rgba(190,193,209,1) 94%, rgba(23,26,84,1) 100%);
    /* background: rgb(251,254,255);
background: linear-gradient(90deg, rgba(251,254,255,0.15309873949579833) 0%, rgba(255,255,255,1) 100%);
   */
  
  
  
  /* background: rgb(0,0,0);
background: -moz-linear-gradient(90deg, rgba(0,0,0,0.7413340336134453) 16%, rgba(15,34,38,1) 96%);
background: -webkit-linear-gradient(90deg, rgba(0,0,0,0.7413340336134453) 16%, rgba(15,34,38,1) 96%);
background: linear-gradient(90deg, rgba(0,0,0,0.7413340336134453) 16%, rgba(15,34,38,1) 96%);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#000000",endColorstr="#0f2226",GradientType=1); */
 }
 
</style>


