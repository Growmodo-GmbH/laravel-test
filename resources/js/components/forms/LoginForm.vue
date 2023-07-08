<template>
    <form @submit.prevent="handleSubmit">
        <h2>Login Form</h2>
        <div class="input-group">
            <input type="text" id="login" v-model="login" placeholder=" ">
            <label for="login">Username/Email:</label>
            <span v-if="formSubmitted && loginError">{{ loginError }}</span>
        </div>
        <div class="input-group">
            <input type="password" id="password" v-model="password" placeholder=" ">
            <label for="password">Password:</label>
            <span v-if="formSubmitted && passwordError">{{ passwordError }}</span>
        </div>
        <button class="mt-2 mb-2" type="submit">Login</button>
    </form>
</template>


<script>
import {toast} from '../../../utils';

export default {
    data() {
        return {
            login: '',
            password: '',
            formSubmitted: false
        }
    },
    computed: {
        // Computed property to check if login input is empty
        loginError() {
            return this.login.length === 0 ? 'Username/Email is required' : null;
        },
        // Computed property to check if password input is empty
        passwordError() {
            return this.password.length === 0 ? 'Password is required' : null;
        }
    },
    methods: {
        // Method to handle form submission
        handleSubmit() {
            this.formSubmitted = true;
            if (!this.loginError && !this.passwordError) {
                // Emit a login event with login and password data
                this.$emit('login', {
                    login: this.login,
                    password: this.password
                });
            } else {
                // If there are errors, show a toast message
                toast('Please fix the errors on the form before submitting', 'error');
            }
        }
    }
}
</script>

