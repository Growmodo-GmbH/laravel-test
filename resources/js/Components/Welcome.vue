<template>
  <section class="text-center text-lg-start">
    <div class="container py-4">
      <div class="row g-0 align-items-center">
        <!-- welcome page -->
        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card cascading-right" style="
              background: hsla(0, 0%, 100%, 0.55);
              backdrop-filter: blur(30px);
              ">
            <div class="card-body p-5 shadow-5 text-center">
              <h2 class="fw-bold mb-5">Welcome User</h2>
            </div>
            <div class="flex justify-center">
              <button class="btn btn-primary" @click="showView()">View Records</button>
              <!-- <button class="btn btn-secondary">Unsubscribe</button>
              <button class="btn btn-warning">Logout</button> -->
            </div>
          </div>
        </div>
        <div class="col-lg-6 mb-5 mb-lg-0">
          <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" class="w-100 rounded-4 shadow-4" alt="" />
        </div>
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
</style>
