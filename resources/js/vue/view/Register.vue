<template>
  <div class="layout d-flex justify-content-center align-item-center">
    <div class="main">
      <div class="nav d-flex justify-content-center align-item-center">
        <div class="left d-flex justify-content-around align-item-center">
          <router-link to='/' exact>Home</router-link>
          <router-link to='/course' >Course</router-link>
          <router-link to='/activity' >Activity</router-link>
        </div>
        <div class="center mx-3">
          <img src="/images/logo.png" alt="">
        </div>
        <div class="right d-flex justify-content-around align-item-center">
          <router-link to='/adminpage' v-if="Useradmin">Admin</router-link>
          <router-link to='/userpage' v-else>User</router-link>
          <router-link to='/login' exact v-if="!user.name">Login</router-link>
          <router-link to='/register' v-if="!user.name">Register</router-link>
          <a v-if="user.name" @click="userLogout">Logout</a>
          <span v-if="user.name">歡迎!{{user.name}}</span>
        </div>
      </div>
        <!-- 替換內容 -->
      <div class="banner">
      <div class="banner_container mx-auto d-flex justify-content-center align-items-center">
        <div class="card d-flex flex-column justify-content-center align-items-center border-0">
            <div class="p-2 text-2xl text-gray-800 font-semibold"><h1>Register an account</h1></div>
            <div class="p-2 w-75 d-flex align-items-center">
                <label class="title" for="name">Name</label>
                <span class=" text-red-500" v-if="errors.name">{{errors.name[0]}}</span>
                <input class=" bg-gray-100 rounded border border-gray-400 text-base px-4 py-2" placeholder="Name" type="text" v-model="form.name" >
            </div>
            <div class="p-2 w-75 d-flex align-items-center">
                <label class="title" for="name">account</label>
                <input class="bg-gray-100 rounded border border-gray-400 text-base px-4 py-2" placeholder="account" type="text" v-model="form.account" >
            </div>
            <div class="p-2 w-75 d-flex align-items-center">
                <label class="title" for="name">pic</label>
                <input class="  bg-gray-100 rounded border border-gray-400 text-base px-4 py-2" placeholder="pic" type="text" v-model="form.pic" >
            </div>
            <div class="p-2 w-75 d-flex align-items-center">
                <label class="title" for="name">phone</label>
                <input class="  bg-gray-100 rounded border border-gray-400 text-base px-4 py-2" placeholder="phone" type="text" v-model="form.phone" >
            </div>
            <div class="p-2 w-75 d-flex align-items-center">
                <label class="title" for="email">Your e-mail</label>
                <input class="  bg-gray-100 rounded border border-gray-400 text-base px-4 py-2" placeholder="Email" type="email" v-model="form.email">
            </div>
            <div class="p-2 w-75 d-flex align-items-center">
                <label class="title" for="password">Password</label>
                <input class="  bg-gray-100 rounded border border-gray-400 text-base px-4 py-2" placeholder="Password" type="password" v-model="form.password" name="password">
            </div>
            <div class="p-2 w-75 d-flex align-items-center">
                <label class="title" for="confirm_password">Confirm Password</label>
                <input class="  bg-gray-100 rounded border border-gray-400 text-base px-4 py-2" placeholder="Confirm Password" type="password" v-model="form.password_confirmation" name="password_confirmation">
            </div>
            <div class="p-2 mt-4">
                <button @click.prevent="saveForm" type="submit" class="btn text-white bg-indigo-500 border-0 py-2 px-8 btn-secondary">Register</button>
            </div>
        </div> 
    </div>
      </div>
      <div class="footer">
        <div class="contact">
          <div class="title">Contact</div>
          <div class="information">
            <div class="address">address:台灣省臺南市南區機場路1號</div>
            <div class="email">email:example@gmail.com</div>
            <div class="phone">phone:0956217884</div>
          </div>
        </div>
        <div class="followus d-flex">
          <div class="title">Follow<br> us</div>
          <div class="information">Facebook/Intagram/Youtube</div>
        </div>
        <div class="dot">
          <img src="/images/dots.png" alt="">
        </div>
      </div>
  </div>
</div>
</template>
<script>
import {mapState, mapMutations} from "vuex";
import { Swiper, SwiperSlide } from 'vue-awesome-swiper';
import 'swiper/css/swiper.css';

export default {
  components: {
    Swiper,
    SwiperSlide
  },
  data() {
    return {
        swiperOptionbanner: {
          slidesPerView: 1,
          spaceBetween: 0,
          slidesPerGroup: 1,
          effect: 'fade',
          loop: true,
          // loopFillGroupWithBlank: true,
          autoplay: {
            disableOnInteraction: false,
            delay:3000
          },
          pagination: {
            el: '.swiper-pagination',
            clickable: true
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
          }
        },
            form:{
                account: '',
                password: ''
            },
            errors: []
        
      }
  },
  computed:{
    ...mapState(["user"]),
    // 過濾活動
  },

  methods:{
        ...mapMutations(["login"]),
        loginUser(){
            axios.post('/api/user/login', this.form).then((res) =>{
                this.login(res.data)
                new this.$swal({
                icon: 'success',
                title: '登入成功',
                showCancelButton: false,
                timer: 1500
                }).then(()=>{
                this.$router.push({ name: "Home"});
                })
            }).catch((error) =>{
                new this.$swal({
                icon: 'error',
                title: '登入失敗',
                showCancelButton: false,
                text:error.response.data.errors["account"],
                timer: 1500
                })
        this.errors = error.response.data.errors;
            })
        }
  },

}
</script>
<style lang="scss" scoped>
@import "../../../sass/_variables.scss";
.banner{
  font-family: 'EB Garamond', serif;
  width: 100%;
  height: 800px;
  background: url('/images/bluelinebg.png');
  background-size: cover;
  &_container{
    width: 100%;
    height: 800px;
    display: flex;
    .card{
      background:url('/images/whiteCard2.png');
      background-size: contain;
      background-repeat: no-repeat;
      background-position: center;
      padding: 50px;
      .title{
          width:200px;
      }
      .btn{
        width: 120px;
        background: #8b989f;
        border-radius: 0;
      }
    }
  }
}
.footer{
  display: flex;
  padding: 20px 30px;
  position: relative;
  .contact,.followus{
    display: flex;
    align-items: center;
    margin-right: 90px;
    .title{
      width: 45%;
      line-height: 0.9;
      font-size: 28px;
      font-weight: 900;
    }
    .information{
      width: 55%;
    }
  }
  .dot{
    position: absolute;
    top: 50%;
    right: 40px;
    transform: translateY(-50%);
  }
  @include pad{
    flex-direction: column;
    .contact,.followus{
      margin: 0;
      margin-bottom: 20px;
      .title{
        font-size: 16px;
        width: 30%;
      }
      .information{
        width: 70%;
      }
    }
      .dot{
        width: 80px;
        height: 17px;
        top: 85%;
        right: 20px;
        img{
          width: 100%;
          height: 100%;
          object-fit: contain;
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