<template>
<div>
  <div class="w-100">
    <router-view></router-view>
  </div>
</div>
</template>
<script>
import {mapState, mapMutations} from "vuex";
export default {
  computed:{
    ...mapState(["user"])
  },
  methods:{
    ...mapMutations(["logout"]),
    userLogout(){
      axios.post('/api/user/logout').then(() =>{
          this.logout();
          new this.$swal({
          icon: 'success',
          title: '登出成功',
          showCancelButton: false,
          timer: 1500
          })
      }).catch((error) =>{
          new this.$swal({
          icon: 'error',
          title: '登出失敗',
          showCancelButton: false,
          text:error.response.data.errors["account"],
          timer: 1500
          })
      })
    }
  }
}
</script>