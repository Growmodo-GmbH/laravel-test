<template>
    <form>
        <div v-if="message !==null" class="alert alert-secondary" role="alert">
{{ message }}
</div>
                        

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control    " name="name" value="" required autocomplete="name" autofocus>

                                
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                               
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control    " name="email" value="" required autocomplete="email">

                                
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control    " name="phone" value="" required autocomplete="phone">

                                
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control    " name="password" required autocomplete="new-password">

                                
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                               
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" id="btn-submit" class="btn btn-primary" @click="register">
                                   Register
                                </button>
                            </div>
                        </div>
                    </form>

</template>
<script>
import axios from 'axios';


    export default {
        data() {
            return {
                message:null,
            }
        },
        methods:{
            register:function(e){
                const form = document.getElementById('reg-form');
                var name = document.getElementById('name').value;
                var email = document.getElementById('email').value;
                var phone = document.getElementById('phone').value;
                var pass = document.getElementById('password').value;
                const confirm = document.getElementById('password-confirm').value;
                if(pass!==confirm){
                    this.message ="password does not match";
                    return;
                }else{
                    this.message ="Password matched";
                
                let userdata = {
                    'name':name,
                     'email':email,
                     'phone':phone,
                     'password':pass,
                };
                getToken();

                axios({

                    url: 'https://test.growmodo.com/marlontamo-laravel-test/public/api/user',
                    method:'post',
                    data:userdata
                })
                .then(function (response) {
                // your action after success
                 console.log(response);

                 window.location.href='https://test.growmodo.com/marlontamo-laravel-test/public/pages/users';

                })
                .catch(function (error) {
                 // your action on error success
                  console.log(error);
                });

                
            }
        }
        }
        
    }
    const getToken =async ()=>{
    await axios.get('/sanctum/csrf-cookie');
        }
</script>