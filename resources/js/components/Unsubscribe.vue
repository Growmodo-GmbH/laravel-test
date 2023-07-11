<template>
    <h1 class="font-weight-normal">Do you really want to Unsbscribe?</h1>
    <button class="btn btn-primary btn-lg" @click="remove(this.user)"> Yes </button>
    <a class="btn btn-secondary btn-lg" href="/home"> No </a>
</template>

<script>
    export default {
        props: ['user'],
        methods: {
            remove(item) {
                axios.delete(`/api/v1/users/${item.id}`)
                .then(window.location.href = "/")
                .catch(error => console. log(error) );
            },
        }
    }
</script>