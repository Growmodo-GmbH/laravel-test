<template>
    <div class="container">
       <h1>User List</h1>                            
       <table class="table table-striped table-bordered table-hover">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th>Subscription</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr v-for="user in users">
                        <td>{{ user.id }}</td>
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>{{user.role}}</td>
                        <td>{{user.phone}}</td>
                        <td>{{ user.subscription }}</td>
                        <td class="text-center"> <div class="btn-group" role="group" aria-label="Basic example">
                            <!-- <button @click="edit(user.id)"  class="btn btn-warning">edit</button> -->
                            <button @click="view(user.id)"  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">view</button>
                            <button @click="del(user.id)"  class="btn btn-danger">unsubscribe</button>
  
                        </div>
                        </td>
                    </tr>
                </tbody>
            </table>
          
            <modal :data="info"></modal>

  
                <hr />

                
</div>
            
    
</template>

<script>
import axios from 'axios';
    export default {
        data(){
            return{
                users :[],
                info:[],
                pass:[],
                show:false,
            }

        },
        created(){

          axios.get('http://test.growmodo.com/marlontamo-laravel-test/public/api/users')
          .then((res) => (this.users = res.data.data))
          .catch(function (error) 
          {
            console.log(error);
           });
        },
        methods:{
            edit : function(id){

                axios.get('http://test.growmodo.com/marlontamo-laravel-test/public/api/user/'+id)
                .then((res)=> (this.info = res.data.data))
                .catch(function (error) 
                {
                 console.log(error);
                 })
              

            },
            view: function(id){

                axios.get('http://test.growmodo.com/marlontamo-laravel-test/public/api/user/'+id)
                .then((res)=> (this.info = res.data.data))
                .catch(function (error) 
                {
                 console.log(error);
                 })
            },
            del: function(id){
                var user = confirm('are you sure you want to unscubscribe this user?');
                if(user){

                    axios.delete('http://test.growmodo.com/marlontamo-laravel-test/public/api/user/'+id)
                .then((res)=> 
                 window.location.reload
                (console.log(res.data)))
                .catch(function (error) 
                {
                 console.log(error);
                 })
                }
                else{
                    alert('cancelled');
                }

                
            },
            cancelEdit: function(){
                this.show =false;
                console.log(this.show);
            }
        }
    }
</script>
<style scoped>
code{
    background-color: #f00;
    color: #fff;
    padding: 5px 12px;
    border-radius: 3px;
}
</style>