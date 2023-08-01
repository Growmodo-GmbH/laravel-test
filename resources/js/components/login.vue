<template>
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <h3 class="mb-5">Sign in</h3>
                            <form @submit.prevent="LoginData">
                                <div class="form-outline mb-4">
                                    <input type="text" v-model="user.username" name="username" id="username"
                                        placeholder="Email / Username" required class="form-control form-control-lg" />
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="password" v-model="user.password" name="password" id="password"
                                        placeholder="Enter your password" required class="form-control form-control-lg" />
                                </div>
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button><br>
                                <span class="error">{{ errormsg }}</span>
                            </form>
                            <hr class="my-3">

                            <p>Don't have an account? <a class="link-info" @click="$router.push({ name: 'Register' })">Sign
                                    up</a> here.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'Login',
    data() {
        return {
            result: {},
            user: {
                username: '',
                password: ''
            },
            errormsg: ''
        }
    },
    methods: {
        LoginData() {
            axios.post('/api/login', this.user)
                .then(
                    ({ data }) => {
                        console.log(data)
                        try {
                            if (data.status === 200) {
                                localStorage.setItem('token', data.token)
                                this.$router.push({ name: 'Home' })
                            } else {
                                this.errormsg = data.message
                            }
                        } catch (err) {
                            alert('Error, please try again')
                        }
                    }
                )
        }
    }
}
</script>
