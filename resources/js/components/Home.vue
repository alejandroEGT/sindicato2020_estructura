<template>
  
    <b-container >
      <b-row class="justify-content-md-center">
        <b-col cols="12" md="5">
          <b-card no-body>
            <b-card-header :style="header_color" >
              ADMIN - LOGIN
            </b-card-header>

            <b-card-body class="text-center">
              <b-form-input v-model="email" size="sm" placeholder="Ingrese su rut"></b-form-input>
              <br>
              <b-form-input v-model="password" type="password"  size="sm" placeholder="Ingrese su contraseña"></b-form-input>
              <br>
              <b-button href="#" 
                variant="primary" :loading="loading1"
                    @click="simulateProgress(1),login()">Entrar</b-button>
            </b-card-body>
          </b-card>

          <br>
          
            <b-card no-body>
            <b-card-header :style="header_color" >
              SOCIO - LOGIN
            </b-card-header>

            <b-card-body class="text-center">
              <b-form-input v-model="email2" size="sm" placeholder="Ingrese su rut"></b-form-input>
              <br>
              <b-form-input v-model="password2" type="password"  size="sm" placeholder="Ingrese su contraseña"></b-form-input>
              <br>
              <b-button href="#" 
                variant="primary" :loading="loading1"
                    @click="simulateProgress(1),login2()">Entrar</b-button>
            </b-card-body>
          
            </b-card>

            
          

          
        </b-col>
      </b-row>
      <br><br><br><br><br>
    </b-container>
  
</template>

                :loading="loading1"
                @click="simulateProgress(1),login()"


                :loading="loading2"
                @click="simulateProgress(2),registrar()"

<script>
export default {
  name: "Media",
  data() {
    return {
      header_color:"color:white; background: rgb(0,0,0);background: linear-gradient(90deg, rgba(0,0,0,0.7413340336134453) 0%, rgba(4,8,9,1) 9%, rgba(46,39,96,1) 90%);",
      nombre: "",
      email: "",
      password: "",
      error: false,
      tab: "login",
      isPwd: true,
      loading1: false,
      loading2: false,
      email2: "",
      password2: "",
    };
  },

  methods: {
    redirect_create_user() {
      this.$router.push("create");
    },
    login() {
      var app = this;
      this.$auth.login({
        params: {
          email: app.email,
          password: app.password
        },
        success: function() {},
        error: function() {},
        rememberMe: true,
        redirect: "/index",
        fetchUser: true
      });
    },

    login2() {
      var app = this;
      this.$auth.login({
        params: {
          email: app.email2,
          password: app.password2
        },
        success: function() {},
        error: function() {},
        rememberMe: true,
        redirect: "/index_socio",
        fetchUser: true
      });
    },

    registrar() {
      const datos = {
        name: this.nombre,
        email: this.email,
        password: this.password
      };
      axios.post("api/auth/register", datos).then(res => {
        console.log(res);
      });
    },
    simulateProgress(number) {
      // we set loading state
      this[`loading${number}`] = true;
      // simulate a delay
      setTimeout(() => {
        // we're done, we reset loading state
        this[`loading${number}`] = false;
      }, 10000);
    }
  }
};
</script>

<style lang="scss" scoped>
  $kkck: red;
</style>
