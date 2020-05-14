
   <template>
  <div  v-if="$auth.check()">
    
     <q-bar dark class="bg-primary text-white">
      
      <div class="col text-center text-weight-bold">
        <b-button class="float-left" size="sm" @click="logout" variant="primary">Salir</b-button>
         <label style="font-size:13px; margin-top:6px" class="float-left"> | Alejandro Godoy</label>
       <label style="margin-top:6px">SINDICATO SOCIOS</label>
      </div>
    </q-bar>

    
  
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