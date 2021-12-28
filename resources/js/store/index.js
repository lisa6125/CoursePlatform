import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    user: {
      name: '',
      account:'',
      id: '',
      pic: '',
      phone:'',
      email:''
    }
  },
  mutations: {
    logout (state) {
      state.user.name = ''
      state.user.id = ''
      state.user.account = ''
      state.user.pic = ''
      state.user.phone = ''
      state.user.email = ''

    },
    login (state, data) {
      state.user.name = data.name
      state.user.account = data.account
      state.user.id = data.id
      state.user.pic = data.pic
      state.user.phone = data.phone
      state.user.email = data.email
    }
  },
  getters:{
    userData(state){
      return state.user;
    }
  },
  actions: {
  },
  modules: {
  },
  plugins: []
})