<template>
  <div class="outer">
    <b-navbar  style="	background: rgb(0,0,0);
  background: linear-gradient(90deg, rgba(0,0,0,0.7413340336134453) 0%, rgba(4,8,9,1) 9%, rgba(46,39,96,1) 90%);">
    <b-nav-form>
      <label style="color:#fff" for="">SINDICATO</label> 
    </b-nav-form>
  </b-navbar>
    <br />

    <transition name>
      <router-view></router-view>
    </transition>
    
  </div>
</template>

<style >
  .outer{
    
    background:url(https://i.pinimg.com/originals/ae/eb/9d/aeeb9d2facd0bbd9c0819bad7b84c054.jpg);
    
    background-repeat: no-repeat;
    background-size: 100% 100%;
  }
  
</style>
