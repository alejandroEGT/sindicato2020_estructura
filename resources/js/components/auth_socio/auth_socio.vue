
   <template>
  <div  v-if="$auth.check()">
    
     <b-navbar style="background: rgb(0,0,0);
  background: linear-gradient(90deg, rgba(0,0,0,0.7413340336134453) 0%, rgba(4,8,9,1) 9%, rgba(46,39,96,1) 90%);">
    <b-nav-form>
      <div class="col text-center text-weight-bold">
        <b-button class="float-left" size="sm" @click="logout" variant="primary">Salir</b-button>
         <label style="font-size:13px; margin-top:6px; color:#fff" class="float-left"> | Socio -> {{$auth.user().name}}</label>
       
      </div>
    </b-nav-form>
  </b-navbar>

    
  
    <div class="container">
        <router-view :key="$route.path"></router-view>  
    </div>
    
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