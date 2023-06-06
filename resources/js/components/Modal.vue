<template>
    <div class="container">
       <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title fs-5" id="exampleModalLabel">User Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="close"></button>
      </div>
      <div class="modal-body">
        <edit-user-component v-if="show" :data="pass">
</edit-user-component>
        <b>idNumber:</b> {{ data.id }} <br/>
          <b>name:</b> {{ data.name }} <br />
          <b>email:</b> {{ data.email }}<br />
          <b>Phone:</b> {{ data.phone }}<br />
          <b>Subscription:</b> {{ data.subscription }}<br />
          <b>Role:</b> <span class="badge bg-danger">{{ data.role }}</span>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="close">Close</button>
        <button type="button" class="btn btn-warning" @click="passdata(data.id)" >Edit User</button>
       
      </div>
    </div>
  </div>
</div>
    </div>
</template>

<script>
    export default {
        props:{
            data:Object,
        },
        data(){
          return{
              pass:[],
              show:false,
            }
        },    
        mounted() {
            
        },
        methods:{
            passdata: function(id){
                this.show=!this.show;

           axios.get('https://test.growmodo.com/marlontamo-laravel-test/public/api/user/'+id)
           .then((res)=> (this.pass = res.data.data))
                .catch(function (error) 
                {
                 console.log(error);
                 })
            },
            close: function(){
            this.show= false;
            this.pass =[];
            },
        }
        
    }
</script>