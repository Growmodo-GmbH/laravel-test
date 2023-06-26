<template>
    <div class="container">
        <div class="title">Login</div>
        <br />
        <br />
        <div class="content">
            <form @submit.prevent="LoginData">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Username</span>
                        <input type="text" v-model="user.username" name="username" id="username"
                            placeholder="Enter your username" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" v-model="user.password" name="password" id="password"
                            placeholder="Enter your password" required>
                    </div>
                </div>
                <span class="error">{{ errorMessage }}</span>
                <div class="button">
                    <input type="submit" value="LOGIN">
                </div>
                <div>
                    <a @click="$router.push({ name: 'Register' })">Create an account</a>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'

Vue.use(axios)
export default {
  name: 'Log',
  data () {
    return {
      result: {},
      user: {
        username: '',
        password: ''
      },
      errorMessage: ''
    }
  },
  methods: {
    LoginData () {
      axios.post('http://127.0.0.1:8000/api/login', this.user)
        .then(
          ({ data }) => {
            console.log(data)
            try {
              if (data.status === 200) {
                localStorage.setItem('token', data.token)

                this.$router.push({ name: 'Home' })
              } else {
                this.errorMessage = 'Login failed, please try again!'
              }
            } catch (err) {
              alert('Error, please try again')
            }
          }
        )
    }
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
