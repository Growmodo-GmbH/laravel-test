<template>
  <div class="container">
    <div class="row" style="padding-top: 20px;">
      <div class="col-sm-8 offset-sm-2">
        <button @click="$router.push('/admin/users')" type="button" class="btn btn-secondary">&lt; Back</button>
      </div>
    </div><br>
    <div class="row">
      <div class="col-sm-8 offset-sm-2">
        <div class="card">
          <form @submit.prevent="saveData">
            <div class="card-header">
              <h5>Edit User</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm">
                  <label>Username <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" v-model="result.username" name="username" id="username"
                    placeholder="Enter your username" required disabled>
                </div>
              </div><br>
              <div class="row">
                <div class="col-sm">
                  <label>Email Address <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" v-model="result.email" name="email" id="email"
                    placeholder="Enter your email address">
                </div>
              </div><br>
              <div class="row">
                <div class="col-sm">
                  <label>Contact Number <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" v-model="result.contact" name="contact" id="contact"
                    placeholder="Enter your number">
                </div>
              </div><br>
              <div class="row">
                <div class="col-sm">
                  <label>Password</label>
                  <input type="password" class="form-control" v-model="result.password" name="password" id="password"
                    placeholder="Leave blank if no changes needed" required>

                </div>
              </div><br>
              <div class="row">
                <div class="col-sm">
                  <label>Confirm Password</label>
                  <input type="password" class="form-control" v-model="confirm_password" name="confirm_password"
                    id="confirm_password" placeholder="Confirm your password if you have changes" required>
                </div>
              </div><br>
              <span class="error">{{ errorMessage }}</span>
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-sm">
                  <input type="submit" class="btn btn-success" style="float: right;" value="Submit">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
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
        contact: '',
        password: '',
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

      if (this.result.password != this.confirm_password) {
        this.errormsg = 'Password and Confirm Password do not match!'
        return false
      } else {
        axios.post('/api/update/' + this.userID, this.result)
          .then(
            ({ data }) => {
              try {
                alert('User has been updated')
                this.$router.push({ name: 'Users' })
                this.errorMessage = ''
                return true
              } catch (err) {
                this.errorMessage = 'Update failed'
                return false
              }
            }
          )
      }
    }
  },
  created() {
    axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
    this.getUserByID()
  }
}
</script>