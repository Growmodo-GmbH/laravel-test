<template>
    <div>
        <router-view></router-view>
        <LoadingScreen></LoadingScreen>
    </div>
</template>

<script>
import LoadingScreen from './LoadingScreen.vue';

export default {
    components: {
        LoadingScreen
    }
}
</script>
