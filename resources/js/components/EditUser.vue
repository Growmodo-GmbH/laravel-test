<template>
    <div class="container">
        <div>
            <button @click="$router.push('/admin/users')" type="button" class="btn btn-success">Back to View Records</button>
        </div>
        <div class="title">Edit Form</div>
        <br />
        <br />
        <div class="content">
            <form @submit.prevent="saveData">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Username</span>
                        <input type="text" v-model="result.username" name="username" id="username"
                            placeholder="Enter your username" required disabled>
                    </div>
                    <div class="input-box">
                        <span class="details">Email Address</span>
                        <input type="text" v-model="result.email" name="email" id="email"
                            placeholder="Enter your email address">
                    </div>
                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input type="text" v-model="result.phone_number" name="phone_number" id="phone_number"
                            placeholder="Enter your number">
                    </div>
                </div>
                <span class="error">{{ errorMessage }}</span>
                <div class="button">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: 'EditUser',
    data() {
        return {
            result: {
                email: '',
                phone_number: '',
            },
            confirm_password: '',
            errorMessage: '',
            token: localStorage.getItem('token'),
            userID: localStorage.getItem('userID')
        }
    },
    methods: {
        getUserByID() {
            this.response = false
            axios.get('/api/admin/user/' + this.userID)
                .then(
                    response => {
                        this.result = response.data.user
                    })
                .catch(
                    errors => {
                        if (errors.response.status === 401 || errors.response.status !== 200) {
                            localStorage.removeItem('token')
                            this.$router.push({ name: 'Login' })
                        }
                    }
                )
        },
        saveData() {
            axios.post('/api/update/' + this.userID, this.result)
                .then(
                    ({ data }) => {
                        console.log(data)
                        try {
                            alert('User has been updated!')
                            this.$router.push({ name: 'Users' })
                            this.errorMessage = ''
                            return true
                        } catch (err) {
                            this.errorMessage = 'Registration failed, please try again!'
                            return false
                        }
                    }
                )
        }
    },
    created() {
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        this.getUserByID()
    }
}
</script>


<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

.container {
    max-width: 700px;
    width: 100%;
    background-color: #fff;
    padding: 25px 30px;
    border-radius: 5px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
}

.container .title {
    font-size: 25px;
    font-weight: 500;
    position: absolute;
}

.container .title::before {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    height: 3px;
    width: 30px;
    border-radius: 5px;
    background: linear-gradient(135deg, #0d3bd3, #161716, #62ea13);
}

.content form .user-details {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin: 20px 0 12px 0;
}

span.error {
    display: flex;
    font-weight: 500;
    margin-bottom: 5px;
    color: darkred;
}

form .user-details .input-box {
    margin-bottom: 15px;
    width: calc(100% / 2 - 20px);
}

form .input-box span.details {
    display: flex;
    font-weight: 500;
    margin-bottom: 5px;
}

.user-details .input-box input {
    height: 45px;
    width: 100%;
    outline: none;
    font-size: 16px;
    border-radius: 5px;
    padding-left: 15px;
    border: 1px solid #ccc;
    border-bottom-width: 2px;
    transition: all 0.3s ease;
}

.user-details .input-box input:focus,
.user-details .input-box input:valid {
    border-color: #50ea55;
}

form .button {
    height: 45px;
    margin: 35px 0
}

form .button input {
    height: 100%;
    width: 100%;
    border-radius: 5px;
    border: none;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #2b5bf9, #303230, #7bed39);
}

form .button input:hover {
    /* transform: scale(0.99); */
    background: linear-gradient(135deg, #0d3bd3, #161716, #62ea13);
}

@media(max-width: 584px) {
    .container {
        max-width: 100%;
        max-height: fit-content;
    }

    form .user-details .input-box {
        margin-bottom: 15px;
        width: 100%;
    }

    form .category {
        width: 100%;
    }

    .user-details::-webkit-scrollbar {
        width: 5px;
    }
}

@media(max-width: 459px) {
    .container .content .category {
        flex-direction: column;
    }
}
</style>