<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>Welcome {{data}}</h1></div>

                    <div class="card-body">
                       your current userRole is<code>{{role}}</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
    export default {
        props:{
            data:String,
            role:String,
        },
        mounted() {
            
           
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