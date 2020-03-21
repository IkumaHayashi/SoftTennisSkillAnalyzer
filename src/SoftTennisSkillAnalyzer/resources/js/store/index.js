import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import error from './error'
import score from './score'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    score,
    error
  }
})

export default store