<template>
  <div>
    <div class="q-pa-md">
      <div class="q-gutter-y-md column" style="max-width: 300px">
        <q-input color="blue-12" v-model="text" type="date">
          <template v-slot:prepend>
            <q-icon name="event" />
          </template>
        </q-input>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      text: ''
    }
  }
}
</script>