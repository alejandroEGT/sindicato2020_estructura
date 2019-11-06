<template>
  <div class>
    <q-bar>
      <div class="cursor-pointer">
        <router-link to="/" class="nav-link">Home</router-link>
      </div>
      <div class="cursor-pointer">
        <router-link to="/create" class="nav-link">Create Post</router-link>
      </div>
      <div class="cursor-pointer gt-xs">
        <router-link to="/posts" class="nav-link">Posts</router-link>
      </div>
    </q-bar>
    <br />

    <transition name>
      <router-view></router-view>
    </transition>
  </div>
</template>
