<template>
    <div class="rc-wrapper">
        <button class="btn btn-primary" @click="goBack">Go Back</button>
        <div class="records-container">
            <h1 class="mb-4">View Records</h1>
            <div class="table-responsive">
                <table class="records-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td>{{ user.id }}</td>
                        <td v-if="!user.isEditing">{{ user.name }}</td>
                        <td v-if="user.isEditing"><input class="form-control" type="text" v-model="user.name"></td>
                        <td v-if="!user.isEditing">{{ user.email }}</td>
                        <td v-if="user.isEditing"><input class="form-control" type="email" v-model="user.email"></td>
                        <td v-if="!user.isEditing">{{ user.phone }}</td>
                        <td v-if="user.isEditing"><input class="form-control" type="tel" v-model="user.phone"></td>
                        <td>
                            <span v-if="!user.isEditing">
                                    <span class="me-1 svg-green" @click="editUser(user)">
                                        <i data-feather="edit"></i>
                                    </span>
                                    <span :class="{ invisible: isUserAdmin(user) }" class="svg-red"
                                          @click="deleteUser(user)">
                                        <i data-feather="trash-2"></i>
                                    </span>
                                </span>
                            <span v-else>
                                    <span class="me-1 svg-green" @click="updateUser(user)">
                                        <i data-feather="check"></i>
                                    </span>
                                    <span class="svg-red" @click="cancelUpdate(user)">
                                        <i data-feather="x"></i>
                                    </span>
                                </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import store from '../../store';
import {api, toast} from '../../../utils';

export default {
    store,
    data() {
        return {
            users: []
        }
    },
    // Fetch the list of users when the component is mounted
    mounted() {
        this.$store.commit('toggleLoading');
        api.users()
            .then(response => {
                this.users = response.data.map(user => ({...user, isEditing: false}));
            })
            .finally(() => {
                this.$store.commit('toggleLoading');
            });

    },
    updated() {
        feather.replace();
    },
    methods: {
        // Navigate to the Welcome page
        goBack() {
            this.$router.push({name: 'Welcome'});
        },
        // Enable editing for the specified user
        editUser(user) {
            user.originalData = {...user};
            user.isEditing = true;
        },
        // Cancel editing for the specified user and revert any changes
        cancelUpdate(user) {
            Object.assign(user, user.originalData);
            delete user.originalData;
            user.isEditing = false;
        },
        // Update the specified user
        updateUser(user) {
            const errors = this.validateUser(user);
            if (errors.length > 0) {
                errors.forEach(errorMessage => {
                    toast(errorMessage, 'error');
                });
                return;
            }
            this.$store.commit('toggleLoading');
            api.updateUser(user)
                .then(response => {
                    console.log(this.$store.state.user);
                    console.log(user.id);

                    // Update the current user's name, email, and phone in the store if the updated user is the current user
                    if (this.$store.state.user && this.$store.state.user.id === user.id) {
                        this.$store.commit('updateUser', {
                            name: user.name,
                            email: user.email,
                            phone: user.phone
                        });
                    }

                    const message = response.data.message ? response.data.message : 'Updated Successfully!';
                    toast(message, 'success');
                    delete user.originalData;
                    user.isEditing = false;
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        const errors = error.response.data.errors;
                        Object.values(errors).flat().forEach(errorMessage => {
                            toast(errorMessage, 'error');
                        });
                    } else {
                        toast('An error occurred while updating the user.', 'error');
                    }
                })
                .finally(() => {
                    this.$store.commit('toggleLoading');
                });
        },
        // Delete the specified user
        deleteUser(user) {
            this.$store.commit('toggleLoading');
            api.deleteUser(user)
                .then(response => {
                    toast(response.data.message, 'success');
                    this.users = this.users.filter(u => u.id !== user.id);
                })
                .catch(error => {
                    if (error.response && error.response.status === 422) {
                        const errors = error.response.data.errors;
                        Object.values(errors).flat().forEach(errorMessage => {
                            toast(errorMessage, 'error');
                        });
                    } else {
                        toast('An error occurred while deleting the user.', 'error');
                    }
                })
                .finally(() => {
                    this.$store.commit('toggleLoading');
                });
        },
        // Validate the specified user and return an array of error messages
        validateUser(user) {
            const errors = [];
            if (user.name.length === 0) {
                errors.push('Username is required');
            } else if (user.name.length > 55) {
                errors.push('Username must be at most 55 characters long');
            }
            if (user.email.length === 0) {
                errors.push('Email is required');
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(user.email)) {
                errors.push('Email must be a valid email address');
            }
            if (user.phone.length === 0) {
                errors.push('Phone number is required');
            } else if (!/^\d+$/.test(user.phone)) {
                errors.push('Phone number must be an integer');
            }
            return errors;
        },
        isUserAdmin(user) {
            return user.is_admin;
        }
    }
}
</script>
