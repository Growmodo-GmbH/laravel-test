<template>
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                                            style="width: 185px;" alt="logo">
                                    </div>
                                    <h1 class="text-center">Login</h1>
                                    <div class="form-outline mb-4">
                                        <input type="email" v-model="user.email" id="form2Example11" class="form-control"
                                            placeholder="Email address" />
                                        <!-- <label class="form-label" for="form2Example11">Email address</label> -->
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="password" v-model="user.password" id="form2Example22"
                                            class="form-control" placeholder="Password" />
                                        <!-- <label class="form-label" for="form2Example22">Password</label> -->
                                    </div>
                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button"
                                            @click="LoginData()">Login</button>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2">Don't have an account?</p>
                                        <button type="button" @click="showRegister()" class="btn btn-outline-danger">Create
                                            new</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2 justify-center">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Rogen Mae Pagsanjan</h4>
                                    <p>Software Developer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>

import axios from 'axios'
export default {
    name: 'Login',
    data() {
        return {
            result: {},
            user: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        LoginData() {
            axios.post('/api/login', this.user)
                .then(
                    ({ data }) => {
                        console.log(data)
                        try {
                            if (data.status === true) {
                                this.$swal('Login Successfully..')
                                setTimeout(() => {
                                    this.$router.push({ name: 'Welcome' })
                                }, 1000);
                            } else {
                                this.$swal({
                                    title: 'Login Failed!',
                                    text: "Incorrect Credentials..",
                                    confirmButtonColor: '#e81616',
                                })
                            }
                        } catch (err) {
                            // alert('Error, please try again')
                            this.$swal('Error, please try again')
                        }
                    }
                )
        },
        showRegister() {
            this.$router.push({ name: 'Register' })
        }
    }
}

</script>
<style>
.gradient-custom-2 {
    background: #fccb90;
    background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
    background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
}

@media (min-width: 768px) {
    .gradient-form {
        height: 100vh !important;
    }
}

@media (min-width: 769px) {
    .gradient-custom-2 {
        border-top-right-radius: .3rem;
        border-bottom-right-radius: .3rem;
    }
}

.justify-center {
    justify-content: center;
}
.text-center{
  text-align: center !important;
}
</style>