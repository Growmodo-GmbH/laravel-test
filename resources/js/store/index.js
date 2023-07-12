import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate'

import auth from '../components/auth/states/index.js'

const store = createStore({
    plugins:[
        createPersistedState()
    ],
    modules:{
        auth:       auth
    }
})

export default store