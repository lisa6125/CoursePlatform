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
  },
created() {
      // 在頁面載入時讀取sessionStorage裡的狀態資訊
      if (sessionStorage.getItem('store')) {
        this.$store.replaceState(
          Object.assign(
            {},
            this.$store.state,
            JSON.parse(sessionStorage.getItem('store'))
          )
        )
        // console.log(JSON.parse(sessionStorage.getItem('store')))  // 列印
      }

      // 在頁面重新整理時將vuex裡的資訊儲存到sessionStorage裡
      // beforeunload事件在頁面重新整理時先觸發
      window.addEventListener('beforeunload', () => {
        sessionStorage.setItem('store', JSON.stringify(this.$store.state))
        // console.log(JSON.parse(sessionStorage.getItem('store')))  // 列印
      })
    },
}
</script>