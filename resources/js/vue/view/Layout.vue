<template>
  <div>
    <transition name="fade">
      <router-view></router-view>
    </transition>
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
<style lang="scss">
@import "../../../sass/_variables.scss";
body,html{
  margin: 0;
  padding: 0;
    &::-webkit-scrollbar-track
    {
        border-radius: 10px;
    }
    &::-webkit-scrollbar
    {
        width: 10px;
        background: rgb(227, 239, 250);
    }
    &::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        background-color: #d4d4d4;
    }

}
.layout{
  width: 100%;
  min-height: 1000px;
  background: url('/images/bg.png');
  background-repeat:no-repeat;
  background-position:center center;
  background-size: cover;
    &::-webkit-scrollbar-track
    {
        border-radius: 8px;
        margin-top:10px;
        margin-bottom:10px;
    }
    &::-webkit-scrollbar
    {
        width: 8px;
    }
    &::-webkit-scrollbar-thumb
    {
        border-radius: 8px;
        background-color: #d4d4d4;
    }
  .main{
    width: 70%;
    min-height: 500px;
    background: rgb(255, 255, 255);
    border-radius: 8px;
    box-shadow: 0 0 20px 5px rgba(183, 191, 201, 0.801);
      margin: 30px auto;
    @include moble{
      margin: 10px auto;
    }
    .nav{
      margin: 20px 0 50px 0;
      font-size: 24px;
      font-weight: 400;
      color: #bbc8ce;
      position: relative;
      a{
        color: #bbc8ce;
        font-family: 'EB Garamond', serif;
        line-height: 2;
        margin: 0 15px;
        cursor: pointer;
      }
      span{
        font-size: 18px;
        font-weight: 900;
        line-height: 3;
      }
      &::after{
        content:"";
        position: absolute;
        bottom:-20px;
        left: 50%;
        transform: translateX(-50%);
        width: calc(100% - 20px);
        height: 20px;
        background: url('/images/line.png');
      }
    }
    @include pad{
      width: 95%;
      .nav{
        flex-direction: column;
        justify-content: center;
        align-items: center;
        .center{
          width: 80px;
          height: 60px;
          img{
            width: 100%;
            height: 100%;
            object-fit: contain;
          }
        }
        a{
          margin: 0 5px;
        }
      }
    }
  }
}
.fade-enter-active, .fade-leave-active {
  transition: all .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  position: absolute;
  opacity: 0;
}
</style>