<template>
  <div class="w-full flex items-center justify-center mt-36">
    <button @click="unsubscribe"  class="bg-transparent hover:bg-red-800 text-red-900 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">
      Unsubscribe
    </button>

    <Unsubscribe v-if="isUnsubscribe" @logout="logout" @close="close"/>
  </div>
</template>

<script>
import Unsubscribe from './Unsubscribe.vue';

export default {
  components: {
    Unsubscribe
  },
  data(){
    return {
      isUnsubscribe: null,
    }
  },
  methods: {
    unsubscribe(){
      this.isUnsubscribe = !this.isUnsubscribe;
    },
    close(){
      this.isUnsubscribe = null;
    },
    logout(){
      this.$emit('logout');
    }
  }
}
</script>

<style>

</style>