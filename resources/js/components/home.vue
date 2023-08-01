<template>
    <div class="container text-center">

        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="card" style="width: 70%;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" v-if="result">
                            <h1>Welcome, {{ result.user.username }}</h1>
                            <br />
                            <div v-if="result.user.usertype == 1">
                                <button @click="$router.push('/admin/users')" type="button" class="btn btn-primary">View
                                    Records</button> |
                                <button @click.prevent="handleLogout" type="button" class="btn btn-danger"><span
                                        class="fas fas-sign-out"></span> Log Out</button>
                            </div>
                            <div v-else>
                                <button @click.prevent="handleUnsubscribe(result.user.id)" type="button"
                                    class="btn btn-warning">Unsubscribe</button> |
                                <button @click.prevent="handleLogout" type="button" class="btn btn-danger">Log
                                    Out</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding-top: 50px;">
            <div class="col-sm-8 offset-sm-2">
                <div class="card">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Home',
    data() {
        return {
            result: '',
            token: localStorage.getItem('token')
        }
    },
    methods: {
        getUser() {
            this.response = false
            axios.get('/api/admin/user')
                .then(
                    response => {
                        this.result = response.data
                        this.user_type = this.result.user.user_type
                    })
                .catch(
                    errors => {
                        if (errors.response.status === 401 || errors.response.status !== 200) {
                            localStorage.removeItem('token')
                            this.$router.push({ name: 'Login' })
                        }
                    }
                )
        },
        handleLogout() {
            axios.post('/api/logout', this.token)
                .then(
                    response => {
                        localStorage.removeItem('token')
                        this.$router.push({ name: 'Login' })
                    }
                )
        },
        handleUnsubscribe(ID) {
            axios.post('api/delete/' + ID)
                .then(
                    response => {
                        localStorage.removeItem('token')
                        this.$router.push({ name: 'Login' })
                    }
                )
        }
    },
    created() {
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        this.getUser()
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1,
h2 {
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

.logo {
    width: 172px;
    max-width: 172px;
}
</style>