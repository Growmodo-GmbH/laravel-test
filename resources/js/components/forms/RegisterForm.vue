<template>
    <form @submit.prevent="handleSubmit">
        <h2>Register Form</h2>
        <div class="input-group">
            <input type="text" id="username" v-model="username" placeholder=" ">
            <label for="username">Username:</label>
            <span v-if="formSubmitted && usernameError">{{ usernameError }}</span>
        </div>
        <div class="input-group">
            <input type="email" id="email" v-model="email" placeholder=" ">
            <label for="email">Email:</label>
            <span v-if="formSubmitted && emailError">{{ emailError }}</span>
        </div>
        <div class="input-group">
            <input type="tel" id="phone" v-model="phone" placeholder=" ">
            <label for="phone">Phone Number:</label>
            <span v-if="formSubmitted && phoneError">{{ phoneError }}</span>
        </div>
        <div class="input-group">
            <input type="password" id="password" v-model="password" placeholder=" ">
            <label for="password">Password:</label>
            <span v-if="formSubmitted && passwordError">{{ passwordError }}</span>
        </div>
        <div class="input-group">
            <input type="password" id="confirm-password" v-model="confirmPassword" placeholder=" ">
            <label for="confirm-password">Confirm Password:</label>
            <span v-if="formSubmitted && confirmPasswordError">{{ confirmPasswordError }}</span>
        </div>
        <button type="submit">Register</button>
    </form>
</template>


<script>
import {toast} from '../../../utils';

export default {
    data() {
        return {
            username: '',
            email: '',
            phone: '',
            password: '',
            confirmPassword: '',
            formSubmitted: false
        }
    },
    computed: {
        usernameError() {
            if (this.username.length === 0) {
                return 'Username is required';
            } else if (this.username.length > 55) {
                return 'Username must be at most 55 characters long';
            } else {
                return null;
            }
        },
        emailError() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (this.email.length === 0) {
                return 'Email is required';
            } else if (!emailRegex.test(this.email)) {
                return 'Email must be a valid email address';
            } else {
                return null;
            }
        },
        phoneError() {
            const phoneRegex = /^\d+$/;
            if (this.phone.length === 0) {
                return 'Phone number is required';
            } else if (!phoneRegex.test(this.phone)) {
                return 'Phone number must be an integer';
            } else {
                return null;
            }
        },
        passwordError() {
            if (this.password.length === 0) {
                return 'Password is required';
            } else if (this.password.length < 8) {
                return 'Password must be at least 8 characters long';
            } else {
                return null;
            }
        },
        confirmPasswordError() {
            if (this.confirmPassword.length === 0) {
                return 'Confirm password is required';
            } else if (this.confirmPassword !== this.password) {
                return 'Passwords do not match';
            } else {
                return null;
            }
        },
    },
    methods: {
        // Method to handle form submission
        handleSubmit() {
            this.formSubmitted = true;
            if (!this.usernameError && !this.emailError && !this.phoneError && !this.passwordError && !this.confirmPasswordError) {
                // Emit a register event with user data
                this.$emit('register', {
                    name: this.username,
                    email: this.email,
                    phone: this.phone,
                    password: this.password,
                    password_confirmation: this.confirmPassword
                });
            } else {
                // If there are errors, show a toast message
                toast('Please fix the errors on the form before submitting', 'error');
            }
        }
    }
}
</script>
