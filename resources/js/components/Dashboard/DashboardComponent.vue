<template>
    <n-space
        justify="center"
        style="margin-top:15px;"
        v-if="!get_to_edit_status"
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
    <n-space
        v-if="get_to_edit_status"
        justify="center"
        style="margin-top: 15px"
    >
        <n-card
            class="mt5" title="Edit Record" style="width: 500px;"
        >
            <label>
                Name
            </label>
            <n-input 
                v-model:value="get_to_edit_data.name"
                type="text"
                placeholder="Name"
            />
            <label>
                Email
            </label>
            <n-input 
                v-model:value="get_to_edit_data.email"
                type="email"
                placeholder="Email"
            />
            <label>
                Phone Number
            </label>
            <n-input 
                v-model:value="get_to_edit_data.phone_number"
                type="number"
                placeholder="Phone Number"
            />
            <template #action>
                <n-space
                    justify="end"
                >
                    <n-button
                        @click="cancel_edit()"
                        ghost
                        style="padding-left: 40px; padding-right: 40px;"
                        round
                    >
                        Cancel
                    </n-button>
                    <n-button
                        @click="edit()"
                        type="primary"
                        style="padding-left: 40px; padding-right: 40px;"
                        round
                    >
                        Save
                    </n-button>
                </n-space>
            </template>
        </n-card>
    </n-space>
</template>

<script>
    const createColumns = ({
        edit
    }) => {
        return [
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
            {
                title: "Action",
                key: "actions",
                render(row) {
                    return h(
                        NButton,
                        {
                            strong: true,
                            tertiary: true,
                            size: "small",
                            onClick: () => edit(row)
                        },
                        { default: () => "Edit" }
                    );
                }
            }
        ]
    };
    import { h } from 'vue'
    import { mapGetters } from 'vuex'
    import { NCard, NSpace, NButton, NDataTable, NInput } from 'naive-ui'
    import store from '../../store/index.js'
    export default {
        components: {
            NSpace,
            NButton,
            NCard,
            NDataTable,
            NInput
        },
        data() {
            return {
                data_to_edit: {},
                columns: createColumns({
                    edit(row){
                        const dd = {
                            id:             row.id,
                            name:           row.name,
                            email:          row.email,
                            phone_number:   row.phone_number
                        }
                        store.dispatch('auth/set_to_edit_data', dd)
                        store.dispatch('auth/set_to_edit_status', true)
                    }
                }),
            }
        },
        mounted() {
        },
        computed: {
            ...mapGetters({
                get_user_data:          'auth/get_user_data',
                get_users:              'auth/get_users',
                get_to_edit_data:       'auth/get_to_edit_data',
                get_to_edit_status:     'auth/get_to_edit_status'
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
            cancel_edit(){
                store.dispatch('auth/set_to_edit_status', false)
                store.dispatch('auth/set_to_edit_data', {})
            },
            async edit(){
                await this.$store.dispatch('auth/edit_user_data', this.get_to_edit_data)
                this.cancel_edit()
                this.view_records()
            }
        }
    }
</script>
