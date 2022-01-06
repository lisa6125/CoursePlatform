<template>
  <div class="layout d-flex justify-content-center align-item-center">
    <div class="main">
      <div class="nav d-flex justify-content-center align-item-center">
        <div class="left d-flex justify-content-around align-item-center">
          <router-link to='/' exact>Home</router-link>
          <router-link to='/course' >Course</router-link>
          <router-link to='/' >Activity</router-link>
        </div>
        <div class="center mx-3">
          <img src="/images/logo.png" alt="">
        </div>
        <div class="right d-flex justify-content-around align-item-center">
          <router-link to='/adminpage' v-if="Useradmin">Admin</router-link>
          <router-link to='/adminpage' v-else>User</router-link>
          <router-link to='/login' exact v-if="!user.name">Login</router-link>
          <router-link to='/register' v-if="!user.name">Register</router-link>
          <a v-if="user.name" @click="userLogout">Logout</a>
          <span v-if="user.name">歡迎!{{user.name}}</span>
        </div>
      </div>
      <div>
        <div class="banner">
          <swiper class="swiper" :options="swiperOptionbanner">
            <swiper-slide>
              <img src="/images/banner1.jpg" alt="">
            </swiper-slide>
            <swiper-slide>
              <img src="/images/banner2.jpg" alt="">
            </swiper-slide>
            <swiper-slide>
              <img src="/images/banner3.jpg" alt="">
            </swiper-slide>
          </swiper>
          <div class="bannercard">
            <p>Lohas New Generation</p>
            <div class="btn">show more</div>
          </div>
        </div>
        <div class="new_course">
          <div class="new_course_title">
            <img src="/images/title1.png" alt="">
          </div>
          <swiper class="swiper" :options="swiperOptioncourse">
            <swiper-slide v-for="course,idx in courses" :key="idx">
              <div class="new_course_item">
                <div class="pic">
                  <img :src="course.pic1" alt="">
                </div>
                <div class="contentbox">
                  <div class="title">{{course.title}}</div>
                </div>
              </div>
            </swiper-slide>
            <!-- <swiper-slide>
              <div class="new_course_item">
                <div class="pic">
                  <img src="/images/banner3.jpg" alt="">
                </div>
                <div class="contentbox">
                  <div class="title">課程名稱6</div>
                </div>
              </div>
            </swiper-slide> -->
            <div class="swiper-pagination" slot="pagination"></div>
          </swiper>
        </div>
        <div class="showvideo">
          <div class="bg_imges"></div>
          <div class="video">
            <iframe width="600" height="400" src="https://www.youtube.com/embed/5kQk2AEcyxI?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
          <div class="videocard">
            <img src="/images/videocard.png" alt="">
            <div class="btn">show more</div>
          </div>
        </div>
        <div class="what_new">
          <div class="what_new_title">
            <img src="/images/title2.png" alt="">
          </div>
          <swiper class="swiper" :options="swiperOptionwhatnew">
            <swiper-slide v-for="group,idx in groups" :key="idx">
              <div class="what_new_item">
                <div class="pic">
                  <img :src="group.pic1" alt="">
                </div>
                <div class="sticker">
                  <img src="/images/sticker.png" alt="">
                </div>
              </div>
            </swiper-slide>
            <!-- <swiper-slide>
              <div class="what_new_item">
                <div class="pic">
                  <img src="/images/wn3.jpg" alt="">
                </div>
                <div class="sticker">
                  <img src="/images/sticker.png" alt="">
                </div>
              </div>
            </swiper-slide> -->
          </swiper>
            <div class="swiper-button-next" slot="button-next"></div>
          <div class="teabag">
            <img src="/images/teabag.png" alt="">
          </div>
          <div class="teacup">
            <img src="/images/teacup.png" alt="">
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
          }
        },
        swiperOptioncourse: {
          loop: true,
          loopFillGroupWithBlank: true,
          pagination: {
            el: '.swiper-pagination',
            clickable: true
          },
          breakpoints: {
            310: {
              slidesPerView: 2,
              slidesPerGroup: 2,
              spaceBetween: 10
            },
            576: {
              slidesPerView: 2,
              slidesPerGroup: 2,
              spaceBetween: 10
            },
            768: {
              slidesPerView: 3,
              slidesPerGroup: 3,
              spaceBetween: 20
            },
          },
        },
        swiperOptionwhatnew: {
          loop: true,
          loopFillGroupWithBlank: true,
          navigation: {
            nextEl: '.swiper-button-next',
          },
          breakpoints: {
            310: {
              slidesPerView: 1,
              slidesPerGroup: 1,
              spaceBetween: 10
            },
            576: {
              slidesPerView: 2,
              slidesPerGroup: 2,
              spaceBetween: 10
            },
            978: {
              slidesPerView: 3,
              slidesPerGroup: 3,
              spaceBetween: 50
            },
          },
        },
        showActive:[],
        Useradmin:'',
        courses:[],
        groups:[],
      }
  },
  computed:{
    ...mapState(["user"])
  },
  methods:{
    ...mapMutations(["logout"]),
    userLogout(){
      axios.post('/api/user/logout').then(() =>{
          this.logout();
          this.Useradmin = false;
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
    },
    checkUser(){
      axios.post('/api/admin/checkadmin/'+ this.user.id)
      .then((res)=>{
        this.Useradmin = res.data;
      })
      .catch(()=>{
        this.Useradmin = false;
      })
    },
    getCourse(){
      axios.get('/api/user/getcourse')
      .then((res)=>{
        this.courses = [...res.data];
      }).catch((err)=>{
        console.log(err)
      })
    },
    getGroup(){
      axios.get('/api/user/getgroup')
      .then((res)=>{
        this.groups = [...res.data];
      }).catch((err)=>{
        console.log(err)
      })
    }
  },
  created(){
    this.checkUser();
    this.getCourse();
    this.getGroup();
  }
}
</script>
<style lang="scss" scoped>
@import "../../../sass/_variables.scss";
.banner{
  position: relative;
  font-family: 'EB Garamond', serif;
  .swiper-container {
    width: 100%;
    height: 500px;
    z-index: 1;
    // @include min-pc{
    //   height: 600px;
    // }
    @include moble{
      height: 350px;
    }
    .swiper-wrapper {
      height: 500px;
    }
    .swiper-slide {
      img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
      }
    }
  }
  .bannercard{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    z-index: 99;
    width: 500px;
    height: 190px;
    background:url('/images/bannercard.png');
    background-size: contain;
    background-repeat: no-repeat;
    p{
      font-size: 24px;
      text-align: center;
      font-weight: 900;
      color:#8b989f;
      margin-top: 40px;
    }
    .btn{
      background: #8b989f;
      color: #fff;
      border-radius: 0;
      position: absolute;
      bottom: 50px;
      left:50%;
      transform: translateX(-50%);
    }
    @include moble{
      width: 300px;
      height: 150px;
      p{
        margin-top: 10px;
      }
      .btn{
        bottom: 56px;
      }
    }
  }
}
.new_course{
  height: 300px;
  width: 100%;
  background: #deebf4;
  margin-top: 400px;
  position: relative;
  &_title{
    width: 400px;
    height: 40px;
    position: absolute;
    top: -280px;
    left: 50%;
    transform: translateX(-50%);
    img{
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
  }
  .swiper-container {
    position: absolute;
    top: -185px;
    width: 100%;
    height: 380px;
    z-index: 1;
    .swiper-wrapper {
      height: 300px;
    }
    .swiper-slide {
      .pic{
        width: 100%;
        height: 280px;
        max-height: 280px;
        overflow: hidden;
        position: relative;
        img{
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%,-50%);
          width: 120%;
          height: 120%;
          object-fit: cover;
          object-position: center;
        }
      }
    }
    .contentbox{
      .title{
        font-size: 24px;
        font-weight: 700;
        color: #fff;
        text-align: center;
        width: 100%;
        margin-top: 20px;
      }
    }
  }
  @include moble{
    height: 200px;
    margin-top: 200px;
    &_title{
      width: 150px;
      top: -170px;
    }
    .swiper-container{
      top: -100px;
      height: 290px;
      .swiper-slide{
        .pic{
          height: 200px;
        }
      }
      .contentbox{
        .title{
          font-size: 14px;
        }
      }
    }
  }
}
.showvideo{
  width: 100%;
  height: 600px;
  position: relative;
  .bg_imges{
    width: 100%;
    height: 600px;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
    background: url('/images/videobg.jpg');
    background-repeat:no-repeat;
    background-position:0 -500px;
    background-size: cover;
    background-attachment:fixed;
    -webkit-filter: blur(5px);
    -moz-filter: blur(5px);
    -o-filter: blur(5px);
    -ms-filter: blur(5px);
    filter: blur(5px);
  }
  .video{
    z-index: 50;
    position: absolute;
    width: 60%;
    height: 100%;
    top: 0%;
    left: 0%;
    iframe{
      position: absolute;
      width: 90%;
      top: 50%;
      right: 0%;
      transform: translate(0%,-50%);
    }
  }
  .videocard{
    z-index: 50;
    width: 40%;
    height: 100%;
    position: absolute;
    top: 0px;
    right: 0%;
    img{
      width: 60%;
      height: 50%;
      object-fit: contain;
      position: absolute;
      top: 55px;
      left: 15%;
    }
    .btn{
      width: 150px;
      height: 50px;
      z-index: 50;
      font-size: 20px;
      position: absolute;
      top: 385px;
      left: 15%;
      background: #8b989f;
      color: #fff;
      border-radius: 0;
    }
  }
  @include moble{
    height: 500px;
    .bg_imges{
      background-position:0 0px;
      height: 100%;
    }
    .video{
      width: 100%;
      iframe{
        height: 210px;
        top:250px;
        left:50%;
        transform: translateX(-50%);
      }
    }
    .videocard{
      width: 100%;
      img{
        top:-25px;
        left: 50%;
        transform: translateX(-50%);
      }
      .btn{
        top:145px;
        left: 45%;
      }
    }
  }
}
.what_new{
  height: 700px;
  width: 100%;
  position: relative;
  background: url('/images/bluelinebg.png');
  background-size: cover;
  padding-top: 50px;
  &_title{
    margin: 0 auto;
    width: 400px;
    height: 60px;
    img{
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
  }
  .swiper-container {
    position: absolute;
    top: 200px;
    left: 50%;
    transform: translateX(-50%);
    width: 70%;
    height: 350px;
    z-index: 1;
    .swiper-wrapper {
      height: 350px;
    }
    .swiper-slide {
      img{
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
      padding-top: 20px;
      padding-left: 5px;
      padding-right: 5px;
      &:nth-child(odd){
        transform: rotate(5deg);
      }
      &:nth-child(even){
        transform: rotate(-2deg);
      }
      &:nth-child(3n){
        transform: rotate(2deg);
      }
    }
    .what_new_item{
      width: 100%;
      height: 90%;
      border: 8px solid #fff;
      .pic{
        width: 100%;
        height: 100%;
        img{
          width: 100%;
          height: 100%;
          object-fit: cover;
        }
      }
      .sticker{
        position: absolute;
        top: -5px;
        left: 50%;
        transform: translateX(-50%);
        img{
          width: 100%;
          height: 100%;
          object-fit: cover;
        }
      }
    }
  }
  .teabag{
    position: absolute;
    top: 70px;
    left: 20px;
    width: 147px;
    height: 265px;
    img{
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
  }
  .teacup{
    position: absolute;
    bottom: 30px;
    right: 30px;
    width: 157px;
    height: 175px;
    img{
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
  }
  .swiper-button-next{
    width: 80px;
    height: 60px;
    background: url('/images/arrownext.png');
    background-size: contain;
    background-repeat: no-repeat;
    position: absolute;
    top: 55%;
    right: 5%;
    &::after{
      content: "";
    }
  }
  @include moble{
    &_title{
      width: 150px;
    }
    .teabag{
      height: 200px;
      top:60px;
      left: -15px;
      z-index: 3;
    }
    .teacup{
      height: 100px;
      right: 8px;
    }
    .swiper-container{
      width: 80%;
      .swiper-slide{
        padding-right: 15px;
        padding-left:15px;
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
</style>