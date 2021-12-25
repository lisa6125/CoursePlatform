<template>
<div class="dashboard w-100 d-flex">
  <div class="sidebar" :class="{close:sideBarClose}">
    <div class="user_pic mx-auto my-3 rounded-circle overflow-hidden">
      <img :src="user.pic">
    </div>
    <div class="user_name py-3 px-5">
    {{user.name}}
    </div>
    <div class="adminpage py-3 px-5">
    <i class="far fa-address-card"></i>
    <router-link class="text-decoration-none" to='/adminpage/' >
    個人資料
    </router-link>
    </div>
    <div class="adminpage py-3 px-5">
    <i class="fas fa-users-cog"></i>
    用戶管理
    </div>
    <div class="adminpage py-3 px-5">
    <i class="fas fa-chalkboard-teacher"></i>
    <router-link class="text-decoration-none" to='/adminpage/createcourse' >
    課程管理
    </router-link>
    </div>
    <div class="adminpage py-3 px-5">
    <i class="fas fa-clipboard-list"></i>
    開團管理
    </div>
  </div>
  <div class="content flex-grow-1">
    <div class="nav d-flex justify-content-end align-items-center">
        <div class="mr-4" v-if="user.name">歡迎回來!{{user.name}}</div>
        <router-link class="mr-4" to='/' exact>Home</router-link>
        <div v-if="user.name" @click="userLogout">Logout</div>
        <div class="nav_btn" @click="sideBarClose = !sideBarClose"><i class="fas fa-bars"></i></div>
    </div>
    <div class="main">
    <router-view></router-view>
    </div>
  </div>
</div>
</template>
<script>
import {mapState, mapMutations} from "vuex";
export default {
  data(){
    return {
      sideBarClose:false
    }
  },
  computed:{
    ...mapState(["user"])
  },
  methods:{
    ...mapMutations(["logout"]),
    userLogout(){
      axios.post('/api/user/logout').then(() =>{
          new this.$swal({
          icon: 'success',
          title: '登出成功',
          showCancelButton: false,
          timer: 1500
          }).then(()=>{
            this.$router.push({ name: "Home"});
            this.logout();
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
<style lang="scss" scope>
.sidebar{
  width:250px;
  height:100vh;
  position:sticky;
  z-index:999;
  background-color:#3c4c66;
  color:#fff;
  font-weight:900;
  font-size:16px;
  color:#6d7e9e;
  transition:0.3s all ease;
  &.close{
    margin-left:-250px;
    transition:0.3s all ease;
  }
  a{
    color:#6d7e9e;
  }
  .user_pic{
    width:120px;
    height:120px;
    img{
      width:100%;
      height:100%;
      object-fit:contain;
    }
  }
  .adminpage,a{
    cursor: pointer;
    transition:0.3s all ease;
    &:hover{
      color:#f0f0f0;
      a{
        color:#f0f0f0;
      }
    }
  }
}
.content{
  background-color:#f1f0f2;
    &.close{
      width:100%;
    }
  .nav{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:80px;
    box-shadow:0 0 20px 1px rgba(0,0,0,0.05);
    position:fixed;
    padding-right:150px;
    background-color:rgba(255,255,255,1);
    a,div{
      cursor: pointer;
      margin-right:20px;
      font-weight:900;
      font-size:16px;
      text-decoration:none;
      color:#3c4c66;
    }
    &_btn{
      font-size:20px;
    }
  }
  .main{
    margin-top:100px;
  }
}
</style>