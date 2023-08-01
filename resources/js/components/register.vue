<template>
  <div class="container">
    <div class="row" style="padding-top: 20%;">
      <div class="col-sm-8 offset-sm-2">
        <div class="card">
          <div class="card-header">
            <h5>Register New Account</h5>
          </div>
          <form @submit.prevent="saveData">
            <div class="card-body">
              <div class="row">
                <div class="col-sm">
                  <label>Username</label>
                  <input type="text" class="form-control" v-model="user.username" name="username" id="username"
                    placeholder="Enter your username" required>
                </div>
              </div><br>
              <div class="row">
                <div class="col-sm">
                  <label>Email Address</label>
                  <input type="text" class="form-control" v-model="user.email" name="email" id="email"
                    placeholder="Enter your email address" required>
                </div>
              </div><br>
              <div class="row">
                <div class="col-sm">
                  <label>Contact Number</label>
                  <input type="text" class="form-control" v-model="user.contact" name="contact" id="contact"
                    placeholder="Enter your number" required>
                </div>
              </div><br>
              <div class="row">
                <div class="col-sm">
                  <label>Password</label>
                  <input type="password" class="form-control" v-model="user.password" name="password" id="password"
                    placeholder="Enter your password" required>
                </div>
              </div><br>
              <div class="row">
                <div class="col-sm">
                  <label>Confirm Password</label>
                  <input type="password" class="form-control" v-model="confirm_password" name="confirm_password"
                    id="confirm_password" placeholder="Confirm your password" required>
                </div>
              </div><br>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-sm">
                  <input type="submit" class="btn btn-success" style="float:  right;" value="Register">
                </div>
              </div>
            </div>
          </form>
        </div><br>
        <div class="row">
          <div class="col-sm">
            <center>
              <a href="" @click="$router.push({ name: 'Login' })">Already have an account? Click here</a>
            </center>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
    </div>
  </div>
</template>

<script>
export default {
  name: 'Register',
  data() {
    return {
      result: {},
      user: {
        username: '',
        contact: '',
        email: '',
        password: ''
      },
      confirm_password: '',
      errormsg: ''
    }
  },
  methods: {
    saveData() {
      if (this.user.password != this.confirm_password) {
        this.errormsg = 'Password and Confirm Password do not match!'
        return false
      } else {
        axios.post('/api/register', this.user)
          .then(
            ({ data }) => {
              if (data.status === 200) {
                this.$router.push({ name: 'Login' })
                this.errormsg = ''

                alert('User successfully registered!')

                return true
              } else {
                this.errormsg = data.message

                return false
              }
            }
          )
      }
    }
  }
}
</script>