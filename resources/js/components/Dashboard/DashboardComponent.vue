<template>
    <n-space
        justify="center"
        style="margin-top:15px;"
    >
        <n-card class="mt5" :title="`Welcome, ${ get_user_data.name }`" style="width: 500px;">
            <template #header-extra>
                <n-button
                    v-if="get_user_data.role_id == 1"
                    type="primary"
                    @click="view_records()"
                >
                    View Records
                </n-button>
                <n-button
                    v-else
                    type="primary"
                    @click="unsubscribe()"
                >
                    Unsubscribe
                </n-button>
                <n-button
                    @click="logout()"
                >
                    Logout
                </n-button>
            </template>
            <n-data-table
                v-if="get_user_data.role_id == 1"
                :columns="columns"
                :data="get_users"
                :pagination="pagination"
                :bordered="false"
            />
        </n-card>
    </n-space>
</template>

<script>
    import { h } from 'vue'
    import { mapGetters } from 'vuex'
    import { NCard, NSpace, NButton, NDataTable } from 'naive-ui'
    export default {
        components: {
            NSpace,
            NButton,
            NCard,
            NDataTable
        },
        data() {
            return {
                columns: [
                    {
                        title: "Name",
                        key: "name"
                    },
                    {
                        title: "Email",
                        key: "email"
                    },
                    {
                        title: "Phone Number",
                        key: "phone_number"
                    },
                    // {
                    //     title: "Action",
                    //     key: "actions",
                    //     render(row) {
                    //         return h(
                    //             NButton,
                    //             {
                    //                 strong: true,
                    //                 tertiary: true,
                    //                 size: "small",
                    //                 onClick: () => this.edit(row)
                    //             },
                    //             { default: () => "Edit" }
                    //         );
                    //     }
                    // }
                ],
            }
        },
        mounted() {
        },
        computed: {
            ...mapGetters({
                get_user_data:          'auth/get_user_data',
                get_users:              'auth/get_users'
            })
        },
        methods: {
            view_records(){
                this.$store.dispatch('auth/fetch_records')
            },
            logout(){
                this.$store.dispatch('auth/set_clear')
                this.$router.push({name: 'login'})
            },
            unsubscribe(){
                this.$store.dispatch('auth/remove_user', this.get_user_data)
                this.$store.dispatch('auth/set_clear')
                this.$router.push({name: 'login'})
            },
            // edit(data){
            //     console.log(data)
            // }
        }
    }
</script>
