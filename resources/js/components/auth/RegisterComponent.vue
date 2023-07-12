<template>
    <n-space
        justify="center"
        style="margin-top:15px;"
    >
        <n-card class="mt5" title="Register" style="width: 500px;">
            <label
                style="margin-top:5px;"
            >
                Name
            </label>
            <n-input 
                v-model:value="r.name"
                type="text"
                placeholder="Name"
            />
            <label
                style="margin-top:5px;"
            >
                Username
            </label>
            <n-input 
                v-model:value="r.username"
                type="text"
                placeholder="Username"
            />
            <label
                style="margin-top:5px;"
            >
                Email
            </label>
            <n-input 
                v-model:value="r.email"
                type="email"
                placeholder="Email"
            />
            <label
                style="margin-top:5px;"
            >
                Phone Number
            </label>
            <n-input 
                v-model:value="r.phone_number"
                type="number"
                placeholder="Phone Number"
            />
            <label
                style="margin-top:5px;"
            >
                Password
            </label>
            <n-input
                v-model:value="r.password"
                type="password"
                placeholder="Password"
            />
            <label
                style="margin-top:5px;"
            >
                Repeat Password
            </label>
            <n-input
                v-model:value="r.rpassword"
                type="password"
                placeholder="Repeat Password"
            />
            <template #action>
                <n-space
                    justify="end"
                >
                    <n-button
                        @click="login()"
                        ghost
                        style="padding-left: 40px; padding-right: 40px;"
                        round
                    >
                        Login
                    </n-button>
                    <n-button
                        type="primary"
                        @click="register()"
                        style="padding-left: 40px; padding-right: 40px;"
                        round
                    >
                        Register
                    </n-button>
                </n-space>
            </template>
        </n-card>
    </n-space>
</template>

<script>
    import { NCard, NSpace, NInput, NButton, NAlert } from 'naive-ui'
    export default {
        components: {
            NCard,
            NSpace,
            NInput,
            NButton,
            NAlert,
        },
        data() {
            return {
                r: {
                    name: "",
                    email: "",
                    username: "",
                    phone_number: "",
                    password: "",
                    rpassword: ""
                },
                message: "",
                show_dialog: false
            }
        },
        mounted() {
        },
        methods: {
            login(){
                this.$router.push({name: 'login'})
            },
            async register(){
                const message = useMessage()
                if(this.r.password != this.r.rpassword){
                    alert('password did not match!')
                    return
                }
                await axios.post('/api/un_auth/register', this.r)
                .then(({data}) => {
                    if(data.response){
                        alert("You are now registered, You may now login")
                        this.r = {}
                        this.$router.push({name: 'login'})
                        return
                    }
                })
            }
        }
    }
</script>
