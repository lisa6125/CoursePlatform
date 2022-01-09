<template>
<div class="dashboard w-100 d-flex">
  <div class="sidebar" :class="{close:sideBarClose}">
    <div class="user_pic mx-auto my-3 rounded-circle overflow-hidden">
      <img v-if="user.pic" :src="user.pic" />
      <img v-else src="/images/userdefault.jpg" />
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
    <router-link class="text-decoration-none" to='/adminpage/adminuser' >
    用戶管理
    </router-link>
    </div>
    <div class="adminpage py-3 px-5">
    <i class="fas fa-chalkboard-teacher"></i>
    <router-link class="text-decoration-none" to='/adminpage/createcourse' >
    課程管理
    </router-link>
    </div>
    <div class="adminpage py-3 px-5">
    <i class="fas fa-clipboard-list"></i>
    <router-link class="text-decoration-none" to='/adminpage/adminGroup' >
    開團管理
    </router-link>
    </div>
    <div class="adminpage py-3 px-5">
    <i class="fas fa-receipt"></i>
    <router-link class="text-decoration-none" to='/adminpage/creategroup' >
    我的開團
    </router-link>
    </div>
  </div>
  <div class="content flex-grow-1" :class="{close:sideBarClose}">
    <div class="nav d-flex bd-highlight align-items-center">
        <div class="nav_btn me-auto bd-highlight" @click="sideBarClose = !sideBarClose"><i class="fas fa-bars"></i></div>
        <p class="bd-highlight" v-if="user.name">歡迎回來!{{user.name}}😊</p>
        <router-link class="me-4 ms-4 bd-highlight" to='/' exact>Home</router-link>
        <span v-if="user.name" @click="userLogout">Logout</span>
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
      sideBarClose:true
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
    },
    checkUser(){
      if(!this.user.id){
          this.$router.push('/');
      }
      axios.post('/api/admin/checkadmin/'+ this.user.id)
      .then((res)=>{
        if(!res.data){
          this.$router.push('/');
        }
      })
      .catch((err)=>{
        console.log(err)
      })
    }
  },
  created(){
    this.checkUser();
  }
}
</script>
<style lang="scss" scope>
.sidebar{
  width:250px;
  height:100vh;
  position:sticky;
  top:0;
  left:0;
  z-index:999;
  background-color:#3c4c66;
  color:#fff;
  font-weight:900;
  font-size:16px;
  color:#6d7e9e;
  transition:0.3s all ease;
  &.close{
    left:-250px;
    margin-left:-250px;
    transition:0.3s all ease;
  }
  a{
    color:#6d7e9e;
  }
  .user_pic{
    width:120px;
    height:120px;
    overflow: hidden;
    img{
      width:100%;
      height:100%;
      object-fit:cover;
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
  width: calc(100% - 250px);
  background:url('/images/usercard.jpg');
  background-size:1920px 1000px;
  background-repeat:no-repeat;
  background-position:center center;
    &.close{
      .nav{
        transition:0.3s all ease;
        padding-left:10px;
      }
    }
  .nav{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:80px;
    box-shadow:0 0 20px 1px rgba(0,0,0,0.05);
    position:fixed;
    padding-left:252px;
    padding-right:150px;
    background-color:rgba(255,255,255,1);
    transition:0.3s all ease;
    z-index:990;
    a,span{
      cursor: pointer;
      margin-right:20px;
      font-weight:900;
      font-size:16px;
      text-decoration:none;
      color:#3c4c66;
    }
    p{
      font-weight:900;
      font-size:16px;
      margin:0;
    }
    &_btn{
      cursor: pointer;
      font-size:28px;
      margin-left:20px;
    }
  }
  .main{
    position:relative;
    min-height:100vh;
  }
}
</style>