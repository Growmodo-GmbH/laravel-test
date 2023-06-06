<template>
    <div class="container" id="box">
       <h1 class="title">Edit User Section</h1>
<form>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" v-model="data.email" placeholder="Enter email">
    
  </div>
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" v-model="data.name" placeholder="Name">
  </div>
  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" class="form-control" id="phone" v-model="data.phone" placeholder="phone">
  </div>

  <div class="form-group">
    <label for="subscription">Subscription</label>
  <select id="subscription" class="form-select" aria-label="Default select example">
    <option selected> {{ data.subscription }}</option>
  <option value="unsubscribed">Unsubscribe</option>
  <option value="subscribed">Subscribed</option>
  </select>
</div>
  <div class="form-group">
    <label for="role">Role</label>
    <select id="role" class="form-select" aria-label="Default select example">
  <option selected> {{ data.role }}</option>
  <option value="admin">Admin</option>
  <option value="guest">Guest</option>
  
</select>
  </div>
  <br>
  <button @click="update(data.id)" class="btn btn-primary">Save Changes</button>
</form>
    </div>

</template>

<script>
    export default {
        props:{
            id: Number,
            data: Object,
        },
        data(){
             return{ user:[],
                
             }
        },
        created() {

        },
        mounted() {
           
        },
        methods:{
              update : function(id){
                
                const userid=id;
                var name = document.getElementById('name').value;
                var email = document.getElementById('email').value;
                var phone = document.getElementById('phone').value;
                 var role = document.getElementById('role').value;
                 var subscription = document.getElementById('subscription').value;
               
                 const userdata = {
                    'name':name,
                     'email':email,
                     'phone':phone,
                     'role':role,
                     'subscription': subscription,
                     };
                   

                axios({url:`http://test.growmodo.com/marlontamo-laravel-test/public/api/user/`+id,
                    method:'post',
                    data: userdata
            }).then((res)=> 
                 //window.location.reload
                (console.log(res)))
              
                .catch(function (error) 
                {
                 console.log(error);
                 })
                
             
                 
            },
            closeEdit: function(){
              var box = document.getElementById('box');
              box.style.display ="none";
            }
        }
    }
</script>
<style scoped>
.container{
  background-color: #033;
     
}
.title{
      color:#fff;
      display: inline-block;
 }
 label{
   color: #fff;
 }
 form{
  padding:3em;
 }
 

</style>
