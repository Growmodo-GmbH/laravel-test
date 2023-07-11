<template>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Phone Number</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users.data" :key="user.id">
                    <th scope="row">{{ user.id }}</th>
                    <td>{{ user.username }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.phone }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
    import axios from "axios"
    import {ref, onMounted} from 'vue'

    const users = ref([])
    const getUsers = () => {
        axios.get('/api/v1/users')
        .then(res => users.value = res.data)
        .catch(error => console.log(error) )

    }

    onMounted(() => getUsers())
</script>
