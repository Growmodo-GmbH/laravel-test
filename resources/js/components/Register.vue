<template>
    <div class="container">
        <div class="title">Registration Form</div>
        <br />
        <br />
        <div class="content">
            <form @submit.prevent="saveData">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Username</span>
                        <input type="text" v-model="user.username" name="username" id="username"
                            placeholder="Enter your username" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Email Address</span>
                        <input type="text" v-model="user.email" name="email" id="email"
                            placeholder="Enter your email address" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input type="text" v-model="user.phone_number" name="phone_number" id="phone_number"
                            placeholder="Enter your number" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" v-model="user.password" name="password" id="password"
                            placeholder="Enter your password" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Confirm Password</span>
                        <input type="password" v-model="confirm_password" name="confirm_password" id="confirm_password"
                            placeholder="Confirm your password" required>
                    </div>
                </div>
                <span class="error">{{ errorMessage }}</span>
                <div class="button">
                    <input type="submit" value="Register">
                </div>
                <div class="d-flex justify-content-center">
                    <a href="" @click="$router.push({ name: 'Login' })">Already have an account?</a>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
  name: 'Register',
  data () {
    return {
      result: {},
      user: {
        username: '',
        email: '',
        phone_number: '',
        password: ''
      },
      confirm_password: '',
      errorMessage: ''
    }
  },
  methods: {
    saveData () {
      console.log(this.user.password + '>>' + this.confirm_password)
      if (this.user.password !== this.confirm_password) {
        this.errorMessage = 'Password and Confirm Password do not match!'
        return false
      } else {
        axios.post('/api/register', this.user)
          .then(
            ({ data }) => {
              console.log(data)

              if (data.status === 200) {
                this.$router.push({ name: 'Login' })
                this.errorMessage = ''

                alert('User successfully registered!')

                return true
              } else {
                this.errorMessage = data.message

                return false
              }
            }
          )
      }
    }
  }
}
</script>
