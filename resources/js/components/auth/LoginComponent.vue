<template>
    <n-space
        justify="center"
        style="margin-top:15px;"
    >
        <n-card class="mt5" title="Login" style="width: 500px;">
            <label>
                Email
            </label>
            <n-input 
                v-model:value="auth.email"
                type="email"
                placeholder="Email"
            />
            <label
                style="margin-top:5px;"
            >
                Password
            </label>
            <n-input
                v-model:value="auth.password"
                type="password"
                placeholder="password"
            />
            <template #action>
                <n-space
                    justify="end"
                >
                    <n-button
                        @click="register()"
                        ghost
                        style="padding-left: 40px; padding-right: 40px;"
                        round
                    >
                        Register
                    </n-button>
                    <n-button
                        type="primary"
                        @click="login()"
                        style="padding-left: 40px; padding-right: 40px;"
                        round
                    >
                        Login
                    </n-button>
                </n-space>
            </template>
        </n-card>
    </n-space>
</template>

<script>
    // import { mapGetters } from 'vuex';
    import { NCard, NSpace, NInput, NButton } from 'naive-ui'
    export default {
        components: {
            NCard,
            NSpace,
            NInput,
            NButton
        },
        data() {
            return {
                auth: {
                    email: "",
                    password: ""
                }
            }
        },
        computed : {
            // ...mapGetters({
            //     get_user_data:          'auth/get_user_data'
            // })
        },
        mounted() {
        },
        methods: {
            async login(){
                await axios.get("/sanctum/csrf-cookie")
                await axios.post('/api/un_auth/login', this.auth)
                .then(({data}) => {
                    if(data.response){
                        this.$store.dispatch('auth/set_authenticated', data.response)
                        this.$store.dispatch('auth/set_user_data', data.user)
                        this.$store.dispatch('auth/set_token', data.token)
                        this.$router.push({name: 'dashboard'})
                    }
                })
            },
            register(){
                this.$router.push({name: 'registerv'})
            }
        }
    }
</script>
