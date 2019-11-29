<template>
  <div class="row justify-center">
    <div class="col-11 col-md-4">
      <q-card
        class="my-card text-white t-10"
        style="background: radial-gradient(circle, #35a2ff 0%, #014a88 100%)"
      >
        <q-tabs v-model="tab" class="text-white">
          <q-tab class="text-h6" label="Login" name="login" />
          <q-tab class="text-h6" label="Registro" name="registro" />
        </q-tabs>

        <q-tab-panels v-model="tab" animated>
          <q-tab-panel name="login">
            <q-input
              v-model="email"
              label="Ingrese su correo"
              outlined
              counter
              maxlength="100"
              type="email"
            />
            <q-input
              v-model="password"
              outlined
              counter
              maxlength="25"
              label="Ingrese su contraseña"
              :type="isPwd ? 'password' : 'text'"
            >
              <template v-slot:append>
                <q-icon
                  :name="isPwd ? 'visibility_off' : 'visibility'"
                  class="cursor-pointer"
                  @click="isPwd = !isPwd"
                />
              </template>
            </q-input>
            <br />
            <q-card-actions align="right">
              <q-btn
                class="content-center"
                color="primary"
                :loading="loading1"
                @click="simulateProgress(1),login()"
                icon-right="mail"
                label="Ingresar"
              >
                <template v-slot:loading>
                  <q-spinner-facebook />
                </template>
              </q-btn>
            </q-card-actions>

            <!--  </q-card-section> -->
          </q-tab-panel>

          <q-tab-panel name="registro">
            <q-input
              v-model="nombre"
              label="Ingrese su nombre"
              outlined
              counter
              maxlength="100"
              type="text"
            />
            <q-input
              v-model="email"
              label="Ingrese su correo"
              outlined
              counter
              maxlength="100"
              type="email"
            />
            <q-input
              v-model="password"
              outlined
              counter
              maxlength="25"
              label="Ingrese su contraseña"
              :type="isPwd ? 'password' : 'text'"
            >
              <template v-slot:append>
                <q-icon
                  :name="isPwd ? 'visibility_off' : 'visibility'"
                  class="cursor-pointer"
                  @click="isPwd = !isPwd"
                />
              </template>
            </q-input>
            <br />

            <q-card-actions align="right">
              <q-btn
                class="content-center"
                color="primary"
                :loading="loading2"
                @click="simulateProgress(2),registrar()"
                icon-right="mail"
                label="Registrarse"
              >
                <template v-slot:loading>
                  <q-spinner-facebook />
                </template>
              </q-btn>
            </q-card-actions>
          </q-tab-panel>
        </q-tab-panels>
      </q-card>
    </div>
  </div>
</template>

<script>
export default {
  name: "Media",
  data() {
    return {
      nombre: "",
      email: "",
      password: "",
      error: false,
      tab: "login",
      isPwd: true,
      loading1: false,
      loading2: false
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
