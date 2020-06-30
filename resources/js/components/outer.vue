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
    
    background: rgb(23,26,84);
background: linear-gradient(225deg, rgba(23,26,84,1) 0%, rgba(47,40,92,1) 44%, rgba(251,254,255,1) 44%, rgba(251,254,255,0.15309873949579833) 100%, rgba(23,26,84,1) 100%, rgba(190,193,209,1) 100%);
    /* background:url(https://i.pinimg.com/originals/ae/eb/9d/aeeb9d2facd0bbd9c0819bad7b84c054.jpg);
    
    background-repeat: no-repeat;
    background-size: 100% 100%; */
  }

  .outer-block{
    color:white;
    border-radius: 8px;
    padding: 3px;

    background: rgb(47,40,92);
    background: linear-gradient(180deg, rgba(47,40,92,1) 0%, rgba(47,40,92,1) 96%, rgba(240,174,88,1) 100%);
  }
  
</style>
