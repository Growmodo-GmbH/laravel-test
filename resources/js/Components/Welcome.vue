<template>
  <section class="text-center text-lg-start">
    <div class="container py-4">
      <div class="row g-0 align-items-center">
        <!-- welcome page -->
        <div class="col-lg-12 mb-5 mb-lg-0">
          <div class="card cascading-right" style="
              background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
              ">
            <div class="card-body p-5 shadow-5 text-center">
              <h2 class="fw-bold mb-5" style="color: #ffff;">Welcome User</h2>
            </div>
            <div class="flex flex-row justify-center" style="margin: 2em">
              <button class="btn btn-primary m1" @click="showView()">View Records</button>
              <button class="btn btn-secondary m1">Unsubscribe</button>
              <button class="btn btn-warning m1">Logout</button>
              <button class="btn btn-warning m1" @click="showLogin()">Login</button>
            </div>
          </div>
        </div>
        <!-- <div class="col-lg-6 mb-5 mb-lg-0" style="opacity:0">
          <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" class="w-100 rounded-4 shadow-4" alt="" />
        </div> -->
      </div>
    </div>
  </section>
</template>
<script>
export default {
  name: 'Welcome',
  data () {
  },
  methods: {
    showView () {
      this.$router.push({ name: 'Records' })
      // location.reload()
    },
    showLogin (){
      this.$router.push({ name: 'Login' })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
.flex-row{
  flex-direction: row;
}
.m1{
  margin: 1em;
}
</style>
