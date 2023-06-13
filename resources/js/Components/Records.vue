<template>
    <section class="text-center text-lg-start">
        <div class="container py-4">
            <div class="row g-0 align-items-center">
                <!-- view records -->
                <div class="flex justify-between items-center p1em">
                    <button class="btn btn-primary mainColor" @click="backtoWelcome()">back to welcome page</button>
                    <button class="btn btn-primary mainColor" @click="logout()">logout</button>
                </div>
                <div class="col-lg-12 mb-5 mb-lg-0">
                    <div class="card cascading-right" style="
                background: hsla(0, 0%, 100%, 0.55);
                backdrop-filter: blur(30px);
                ">
                        <div class="card-body p-5 shadow-5 text-center">
                            <h2 class="fw-bold mb-5">User Records</h2>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email address</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(val, index) in recordListdata" :key="val.id">
                                        <th>{{ val.name }}</th>
                                        <th>{{ val.email }}</th>
                                        <th>{{ val.phone }}</th>
                                        <th>
                                            <button type="button" class="btn btn-primary" @click="viewEditList(val.id)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="btn btn-danger" @click="removeList(val.id, index)">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                </svg>
                                            </button>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="updateSection" v-if="editModal">
            <div class="col-12 p1" v-for="value in viewData" :key="value.id">
                <label for="" class="mb1 white mt1 flex">Username</label>
                <input type="text" class="col-12 p0 form-control" v-model="value.name">
                <label for="" class="mb1 white mt1 flex">Email Address</label>
                <input type="text" class="col-12 p0 form-control" v-model="value.email">
                <label for="" class="mb1 white mt1 flex">Phone Number</label>
                <input type="text" class="col-12 p0 form-control" v-model="value.phone">
                <div class="py1"></div>
                <div class="">
                    <button class="btn btn-primary" @click="updateList(value.id, value)">Update</button>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import axios from 'axios'
export default {
    name: 'lists',
    data() {
        return {
            recordListdata: [],
            editModal: false,
            viewData: []
        }
    },
    mounted() {
        this.userData()
    },
    methods: {
        userData() {
            const vm = this
            axios.get('/api/records').then(function (res) {
                vm.recordListdata = res.data
            }).catch(function (err) {
                console.log('ERROR!')
            })
        },
        viewEditList(id) {
            var data = this.recordListdata.filter((val) => {
                return id === val.id
            })
            this.editModal = true
            this.viewData = data
        },
        updateList(id, value) {
            axios.put(`http://127.0.0.1:8000/api/update/${id}`, value)
                .then(function (response) {
                    alert('User has been added successfully saved')
                    // location.reload();
                })
                .catch(function (error) {
                    console.log('error')
                })
        },
        removeList(id, index) {
            const m = this
            axios.delete(`/api/delete/${id}`)
                .then(function (response) {
                    m.recordListdata.splice(index, 1)
                })
                .catch(function (error) {
                    console.log('error')
                })
        },
        backtoWelcome() {
            this.$router.push({ name: 'Welcome' })
        },
        logout() {
            console.log('hsdsdsi')
            axios.post('/api/logout')
                .then(({ data }) => {
                    axios.defaults.headers.common['X-CSRF-TOKEN'] = data;
                    this.$router.push({ name: 'Login' })
                })
                .catch(function(error){
                    console.log('error')
                })
        }
    }
}
</script>
<style>
.cascading-right {
    margin-right: -50px;
}

@media (max-width: 991.98px) {
    .cascading-right {
        margin-right: 0;
    }
}

.flex {
    display: flex;
}

.justify-center {
    justify-content: center;
}

.text-left {
    text-align: left;
}

.py1 {
    padding-top: 1em;
}

.justify-between {
    justify-content: space-between;
}

.items-center {
    align-items: center;
}

.p1em {
    padding: 1em;
}
.updateSection {
    background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
    border: 1px solid #beb4b4;
    margin: 2em;
    padding: 2em;
    border-radius: 4px;
}
.white {
    color: #ffff;
}

.mb1 {
    margin-bottom: 1rem;
}

.mt1 {
    margin-top: 1rem;
}
.mainColor {
    background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
    border-color:#ee7724
}
</style>
