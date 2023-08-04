<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="padding-top: 35px;">
                <button @click="$router.push('/')" type="button" class="btn btn-secondary"><b>&lt;</b> Back to
                    Dashboard</button>
                <button @click.prevent="handleLogout" type="button" class="btn btn-danger" style="float: right;">Log
                    Out</button>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header">
                        <h5>Users</h5>
                    </div>
                    <div class="card-body">

                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email Address</th>
                                        <th scope="col">Contact Number</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in result.users" v-bind:key="user.id">
                                        <td>{{ user.username }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.contact }}</td>
                                        <td>
                                            <button @click.prevent="handleEdit(user.id)" type="button"
                                                class="btn btn-sm btn-primary">Edit</button> |
                                            <button @click.prevent="handleDelete(user.id)" type="button"
                                                class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Users',
    data() {
        return {
            result: {},
            users: {
                id: '',
                username: '',
                email: '',
                contact: ''
            },
            token: localStorage.getItem('token')
        }
    },
    created() {
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        this.LoadUsers()
    },
    methods: {
        LoadUsers: function () {
            axios.get('/api/admin/users')
                .then(
                    response => {
                        this.result = response.data
                    }
                )
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
        handleEdit(ID) {
            localStorage.setItem('userID', ID)
            this.$router.push({ name: 'userEdit' })
        },
        handleDelete(ID) {
            axios.post('/api/delete/' + ID)
                .then(
                    response => {
                        alert('User successfully deleted!')
                        window.location.reload()
                    }
                )
        }
    }
}
</script>