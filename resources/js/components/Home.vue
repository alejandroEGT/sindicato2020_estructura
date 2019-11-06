<template>
  <div class="row justify-center">
    <div class="col-6">
      <q-card
        class="my-card text-white"
        style="background: radial-gradient(circle, #35a2ff 0%, #014a88 100%)"
      >
        <q-card-section>
          <div class="text-h6 justify-center">
            <q-tabs v-model="tab" class="text-teal">
              <q-tab label="Login" name="Login" />
              <q-tab label="Registro" name="Registro" />
            </q-tabs>
          </div>
        </q-card-section>

        <q-card-section>
          <q-input v-model="email" label="Ingrese su correo" />
          <q-separator />
          <q-input v-model="password" label="Ingrese su contraseña" />
          <q-separator />
          <br />
          <q-btn
            class="justify-center"
            color="primary"
            @click="login"
            icon="mail"
            label="Ingresar"
          />
        </q-card-section>
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
      error: false
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