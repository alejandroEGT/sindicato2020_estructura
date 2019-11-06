<template>
  <div class="row justify-center">
    <div class="col-6">
      <q-card
        class="my-card text-white"
        style="background: radial-gradient(circle, #35a2ff 0%, #014a88 100%)"
      >
        <!-- <q-card-section>
          <div class="text-h6">Bienvenido</div>
        </q-card-section>-->

        <q-tabs v-model="tab" class="text-white">
          <q-tab class="text-h6" label="Login" name="login" />
          <q-tab class="text-h6" label="Registro" name="registro" />
        </q-tabs>

        <q-tab-panels v-model="tab" animated>
          <q-tab-panel
            name="login"
            style="background: radial-gradient(circle, #35a2ff 0%, #014a88 100%)"
          >
            <!-- <q-card-section> -->
            <q-input v-model="email" label="Ingrese su correo" />
            <q-separator />
            <q-input v-model="password" label="Ingrese su contraseña" />
            <q-separator />
            <br />
            <q-btn
              class="content-center"
              color="primary"
              @click="login"
              icon="mail"
              label="Ingresar"
            />
            <!--  </q-card-section> -->
          </q-tab-panel>

          <q-tab-panel
            name="registro"
            style="background: radial-gradient(circle, #35a2ff 0%, #014a88 100%)"
          >
            <q-input v-model="nombre" label="Ingrese su nombre" />
            <q-input v-model="email" label="Ingrese su correo" />
            <q-input v-model="password" label="Ingrese su contraseña" />
            <br />
            <q-btn class="content-center" color="primary" icon="mail" label="Registrarse" />
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
      email: "",
      password: "",
      error: false,
      tab: "login"
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
    }
  }
};
</script>
