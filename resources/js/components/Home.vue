<template>
  
    <b-container >

      
        <b-row class="justify-content-md-center justify-content-xs-center">
          <b-col md="5" xs="12" lg="2">
            <h2 style="text-shadow: 0 0 0.1em; color: black;"><b>Neo-SC</b></h2>
            <br>
            
              <h5 style="text-shadow:1px 1px 2px #999; color:#7F8C8D; ">
                Intranet general disponible para sindicatos, incluyendo los socios asociados


              </h5>
           
          </b-col>
          <b-col md="5" xs="12">
             <!-- <center>
                <iframe width="420" height="315" src="https://www.youtube.com/embed/k26ANMfXt4I"></iframe>
               
              </center> -->
            <!-- https://i.pinimg.com/originals/1e/a2/bf/1ea2bf43d262adc533f6ba78a7772a9c.gif -->
              <center><b-card
                no-body
                img-src="https://sanmol.in/images/services/responsive.gif"
                img-alt="Image"
                img-top
                tag="article"
                style="max-width: 15rem;"
                class="mb-2"
              >
                <!-- <b-card-text>
                  Some quick example text to build on the card title and make up the bulk of the card's content.
                </b-card-text> -->

                <!-- <b-button href="#" variant="primary">Go somewhere</b-button> -->
              </b-card></center>
          </b-col>
          
        </b-row>
      
<div style="background: rgb(244,208,63);
            background: linear-gradient(180deg, rgba(244,208,63,1) 0%, rgba(244,208,63,1) 76%, rgba(247,160,112,1) 100%, rgba(253,45,230,1) 100%); 
            padding-top:10px;
            padding-bottom:10px;
            width:100%; border-radius:8px;">
      <b-row class="justify-content-md-center text-center">
            <b-col md="3" xs="3" lg="2">
              <center><q-avatar size="110px">
               <img src="https://img.icons8.com/bubbles/100/000000/internet.png"/>
              </q-avatar></center>

              <div class="outer-block">
                <p><b>Cuentas</b></p>
                <p>LLeve un control de los ingresos y egresos de su sindicato</p>
              </div>
              
            </b-col>
            <b-col md="3" xs="3" lg="2">
              <center><q-avatar size="110px">
               <img src="https://img.icons8.com/bubbles/100/000000/admin-settings-male.png"/>
              </q-avatar></center>

              <div class="outer-block">
                <p><b>Administración</b></p>
                LLeve un registro de los socios, beneficios y establezca temas de votaciones
              </div>
             
            </b-col>

             <b-col md="3" xs="3" lg="2">
              <center><q-avatar size="110px">
                <img src="https://img.icons8.com/bubbles/100/000000/user-male.png"/>
              </q-avatar></center>

              <div class="outer-block">
                <p><b>Socio</b></p>
                Conozca libremente las cuentas sindicales, participe tambien en temas de votaciones
              </div>
            </b-col>

            
        
      </b-row>
      <br>
</div>

<br>
<center>
  <b-button v-b-modal.modal-1 variant="light"><i class="fas fa-key"></i> Intranet</b-button>
</center>

    <b-modal header-bg-variant="dark"
            header-text-variant="white"
            hide-footer 
            size="md" 
            id="modal-1" 
            :title="'Intranet'">
            <b-row class="justify-content-md-center">
            <b-col cols="12" md="12">
              <b-card no-body>
                <b-card-header :style="header_color" >
                  ADMIN - LOGIN
                </b-card-header>

                <b-card-body class="text-center">
                  <b-form-input v-model="email" size="sm" placeholder="Ingrese su email"></b-form-input>
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
                  <b-form-input v-model="email2" size="sm" placeholder="Ingrese su email"></b-form-input>
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

    </b-modal>

      <!-- <b-row class="justify-content-md-center">
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
      </b-row> -->
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
