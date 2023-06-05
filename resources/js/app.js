/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';



const app = createApp({});

import WelcomeComponent from './components/WelcomeComponent.vue';
import UserComponent from './components/Users.vue';
import NewUserForm from './components/NewUser.vue';
import EditUserComponent from './components/EditUser.vue';
import HomePage from './components/HomePage.vue';
import Modal from './components/Modal.vue';
app.component('modal',Modal);
app.component('homepage-component', HomePage);
app.component('welcome-component', WelcomeComponent);
app.component('user-component',UserComponent);
app.component('edit-user-component',EditUserComponent);
app.component('newuserform-component', NewUserForm);


app.mount('#app');
