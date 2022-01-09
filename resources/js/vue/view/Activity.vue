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
      <div>
        <!-- 替換內容 -->
        <div class="banner">
          <div class="banner_container">
            <div class="left">
              <div class="latestcoursescard">
                <img src="/images/latestactivitiescard.png" alt="">
              </div>
              <div class="coursetext">
                <img src="/images/coursetext.png" alt="">
              </div>
            </div>
            <div class="right">
              <swiper class="swiper" :options="swiperOptionbanner">
                <swiper-slide v-for="course,idx in groups" :key="idx">
                  <div class="new_course_item">
                    <div class="pic">
                      <img :src="course.pic1" alt="">
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
              </swiper>
              <div class="swiper-button-prev" slot="button-prev">
                <img src="/images/arrowleft.png" alt="">
              </div>
              <div class="swiper-button-next" slot="button-next">
                <img src="/images/arrowright.png" alt="">
              </div>
            </div>
          </div>
        </div>
        <div class="courseList">
          <div class="courseList_title">
              <img src="/images/coursetitle.png" alt="">
          </div>
          <div class="courseList_container">
            <div class="courseList_item" v-for="course,idx in makNeweActivitys" :key="idx">
              <div class="courseList_item_pic">
                <img :src="course.pic1" alt="">
                <div class="courseList_item_class">
                  <button type="button" class="btn btn-outline-light badge rounded-pill bg-ligh py-1 px-2 me-1">{{course.class1}}</button>
                  <button type="button" class="btn btn-outline-light badge rounded-pill bg-ligh py-1 px-2 me-1">{{course.class2}}</button>
                  <button type="button" class="btn btn-outline-light badge rounded-pill bg-ligh py-1 px-2 me-1">{{course.class3}}</button>
                </div>
                <div class="courseList_item_user">
                  <div class="courseList_item_userpic">
                    <img :src="course.user_pic" alt="">
                  </div>
                  <span>由 {{course.user_name}} 創建</span>
                </div>
              </div>
              <div class="courseList_item_content">
              <div class="courseList_item_content_title"> <span>{{course.title}}</span> </div>
              <!-- <div class="courseList_item_content_title">活動狀態: <span>{{course.state}}</span> </div> -->
              <!-- <div class="courseList_item_content_signuptime">登記時間:<span>{{timeChanger(course.signUp_start_time)}}<br>~{{timeChanger(course.signUp_end_time)}}</span></div> -->
              <div class="courseList_item_content_coursetime">活動時間:<span>{{timeChanger(course.activity_start_time)}}<br>~{{timeChanger(course.activity_send_time)}}</span></div>
              <div class="courseList_item_content_place">活動地點:<span>{{course.place}}</span></div>
              <div class="courseList_item_content_price">活動費用:<span>{{course.price}}</span></div>
              </div>
              <div class="courseList_item_btns">
                <div class="btn border-end disable" v-if="course.alreadyJoin">已參加</div>
                <div class="btn border-end" v-else @click="takeParticipateActivity(course.id)">參加</div>
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="openModal(idx)">
                  詳情
                </button>
              </div>
              <div class="courseList_item_joinusers">參加人數: <span>{{course.usernum}}</span> 人</div>
              <div v-if="course.usernum>3" class="courseList_item_joinuserspics">
                <div class="joinuserspics_box">
                  <div class="pic1">
                    <img :src="course.user_join_activity[0].pic" alt="">
                  </div>
                  <div class="pic2">
                    <img :src="course.user_join_activity[1].pic" alt="">
                  </div>
                  <div class="pic3">
                    <img :src="course.user_join_activity[2].pic" alt="">
                  </div>
                  <div class="pic4">
                    <div class="moreNum">+ {{course.usernum - 3}}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- 替換內容 -->
        <!-- 彈跳視窗 -->
        <!-- 彈跳視窗 -->
        <div class="modal fade" :v-model="nowOpen" id="exampleModal" tabindex="-1">
          <div class="modal-dialog modal-xl ">
            <div class="modal-content">
              <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body d-flex">
                <div class="modal_left">
                    <div class="bigpic">
                      <transition name="fade">
                      <img :src="nowOpenPic" :key="nowOpenPic">
                      </transition>
                    </div>
                    <div class="pics">
                      <img :src="nowOpen.pic1" v-if="nowOpen.pic2" @click="nowOpenPic = nowOpen.pic1">
                      <img :src="nowOpen.pic2" v-if="nowOpen.pic2" @click="nowOpenPic = nowOpen.pic2">
                      <img :src="nowOpen.pic3" v-if="nowOpen.pic3" @click="nowOpenPic = nowOpen.pic3">
                    </div>
                </div>
                <div class="modal_right">
                  <div class="modal_right_title">{{nowOpen.title}}
                    <div class="state">{{nowOpen.state}}</div>
                  </div>
                  <div class="modal_right_content">{{nowOpen.content}}</div>
                  <div class="modal_right_bottom">
                    <div class="modal_right_signuptime">
                      <p class="icon"><i class="fas fa-user-edit"></i></p>
                      <span class="title">登記時間:</span>
                      {{timeChanger(nowOpen.signUp_start_time)}}~{{timeChanger(nowOpen.signUp_end_time)}}
                    </div>
                    <div class="modal_right_coursetime">
                      <p class="icon"><i class="far fa-calendar-alt"></i></p>
                      <span class="title">活動時間:</span>
                      {{timeChanger(nowOpen.activity_start_time)}}~{{timeChanger(nowOpen .activity_send_time)}}
                    </div>
                    <div class="modal_right_notice">
                      <p class="icon"><i class="fas fa-exclamation-circle"></i></p>
                      <span class="title">注意事項:</span>
                      {{nowOpen.notice}}
                    </div>
                    <div class="modal_right_notice">
                      <p class="icon"><i class="far fa-flag"></i></p>
                      <span class="title">開團條件:</span>
                      {{nowOpen.condition}}
                    </div>
                    <div class="modal_right_place">
                      <p class="icon"><i class="fas fa-map-marker-alt"></i></p>
                      <span class="title">活動地點:</span>
                      {{nowOpen.place}}
                    </div>
                    <div class="modal_right_price">
                      <p class="icon"><i class="fas fa-comment-dollar"></i></p>
                      <span class="title">活動費用:</span>
                      {{nowOpen.price}}
                    </div>
                    <div class="modal_right_user">
                      <p class="icon"><i class="fas fa-user-alt"></i></p>
                      <span class="title">聯絡人:</span>
                      {{nowOpen.user_name}}
                    </div>
                    <div class="modal_right_user">
                      <p class="icon"><i class="fas fa-mobile-alt"></i></p>
                      <span class="title">聯絡電話:</span>
                      {{nowOpen.user_phone}}
                    </div>
                    <div class="modal_right_user">
                      <p class="icon"><i class="fas fa-envelope"></i></p>
                      <span class="title">聯絡信箱:</span>
                      {{nowOpen.user_email}}
                    </div>
                  </div>
                  <div class="joinbtn">參加</div>
                </div>
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
        Useradmin:'',
        nowOpen:'',
        nowOpenPic:'',
        groups:[],
        myParticipates:[],
      }
  },
  computed:{
    ...mapState(["user"]),
    makNeweActivitys(){
      let newactivitys = this.groups.map(item => {
          this.myParticipates.forEach(element => {
              if(item.id == element.id){
                  item.alreadyJoin = true
              }
          });
          return item
      });
      return newactivitys;
    },
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
    timeChanger(time){
      return new Date(time).toLocaleString();
    },
    checkUser(){
      if(this.user.id){
        axios.post('/api/admin/checkadmin/'+ this.user.id)
        .then((res)=>{
          this.Useradmin = res.data;
        })
        .catch(()=>{
          this.Useradmin = false;
        })
      }
    },
    // 參加活動
    takeParticipateActivity(id){
      if(!this.user.id){
        new this.$swal({
          icon: 'info',
          title: '請先登入會員',
          showCancelButton: false,
          timer: 1500
        })
        return
      }
      axios.post('/api/user/join/activity/'+id,{userId:this.user.id})
      .then((res)=>{
        new this.$swal({
          icon: 'success',
          title: res.data,
          showCancelButton: false,
          timer: 1500
          })
          this.getGroup();
          this.getUserParticipateActivity();
      }).catch((err)=>{
        console.log(err)
      })
    },
    // 抓取已參加活動
    getUserParticipateActivity(){
      if(!this.user.id){
        return
      }
        axios.post('/api/user/getUserParticipateActivity',{userId:this.user.id})
        .then((res)=>{
            this.myParticipates = [...res.data];
        }).catch((err)=>{
            console.log(err)
        })
    },
    // getCourse(){
    //   axios.get('/api/admin/getCourese')
    //   .then((res)=>{
    //     this.courses = [...res.data];
    //   }).catch((err)=>{
    //     console.log(err)
    //   })
    // },
    openModal(num){
      this.nowOpen = this.groups[num];
      this.nowOpenPic = this.nowOpen.pic1;
    },
    getGroup(){
      axios.get('/api/admin/getAllGroup')
      .then((res)=>{
        this.groups = [...res.data];
        this.groups = this.groups.filter((item)=>{
          let time = Math.floor(new Date());
          if(Date.parse(item.activity_start_time).valueOf()>time && 
          item.state !== '審核' && 
          item.state !== '審核通過' &&
          item.state !== '審核不通過'){
            return item
          }
        })
      }).catch((err)=>{
        console.log(err)
      })
    }
  },
  created(){
    this.checkUser();
    this.getGroup();
    this.getUserParticipateActivity();
  },

}
</script>
<style lang="scss" scoped>
@import "../../../sass/_variables.scss";
.banner{
  font-family: 'EB Garamond', serif;
  width: 100%;
  height: 400px;
  background: url('/images/bluelinebg.png');
  background-size: cover;
  background-repeat: no-repeat;
  &_container{
    width: 100%;
    height: 500px;
    display: flex;
    .left{
      width: 40%;
      position: relative;
      .latestcoursescard{
        width: 285px;
        height: 155px;
        position: absolute;
        top: 63px;
        left: 60px;
        img{
          width: 100%;
          height: 100%;
          object-fit: contain;
        }
      }
      .coursetext{
        width: 240px;
        height: 85px;
        position: absolute;
        top:247px;
        left: 83px;
        img{
          width: 100%;
          height: 100%;
          object-fit: contain;
        }
      }
    }
    .right{
      width: 60%;
      position: relative;
      .swiper-container {
        width: 90%;
        height: 400px;
        z-index: 1;
        position: absolute;
        top: 63px;
        left: 0px;
        // @include min-pc{
        //   height: 600px;
        // }
        @include moble{
          height: 400px;
        }
        .swiper-wrapper {
          height: 400px;
        }
        .swiper-slide {
          .pic{
            height: 400px;
            width: 100%;
          }
          img{
            width: 100%;
            height: 100%;
            object-fit: cover;
          }
        }
      }
      .swiper-button-prev{
        width: 50px;
        height: 50px;
        position: absolute;
        top: 250px;
        left: -25px;
        img{
          width: 100%;
          height: 100%;
          object-fit: contain;
        }
        &::after{
          content: '';
        }
      }
      .swiper-button-next{
        width: 50px;
        height: 50px;
        position: absolute;
        top: 250px;
        right: 6.5%;
        img{
          width: 100%;
          height: 100%;
          object-fit: contain;
        }
        &::after{
          content: '';
        }
      }
    }
  }
}
.courseList{
  margin: 0 auto;
  margin-top: 100px;
  margin-bottom: 90px;
  width: 100%;
  position: relative;
  &::after{
    content: '';
    position: absolute;
    width: 100%;
    height: 210px;
    bottom: -100px;
    left: 0px;
    z-index: 1;
    background: #deebf4;
  }
  &_title{
    width: 508px;
    height: 124px;
    margin: 0 auto;
    img{
      width: 100%;
      height: 100%;
      object-fit: contain;
    }
  }
  &_container{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    z-index:50;
    padding: 0 50px;
  }
  &_item{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width:calc(33% - 30px) ;
    z-index:50;
    min-width: 300px;
    margin:15px;
    margin-bottom: 20px;
    position: relative;
    display: flex;
    font-size: 17px;
    font-weight: 900;
    background: rgb(255, 255, 255);
    box-shadow: 3px 3px 10px 1px rgba(78, 78, 78, 0.13),3px 3px 20px 1px rgba(78, 78, 78, 0.082);
    border-radius: 5px;
    transition: 0.3s all ease-in-out;
    &:hover{
      transform: translate(-5px,-5px);
      transition: 0.3s all ease-in-out;
      box-shadow: 3px 3px 10px 1px rgba(78, 78, 78, 0.212),3px 3px 20px 1px rgba(78, 78, 78, 0.219);
    }
    &_pic{
      width: 100%;
      height: 300px;
      min-height: 300px;
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
      border-bottom-left-radius:20px;
      border-bottom-right-radius: 20px;
      overflow:hidden;
      position: relative;
      &::before{
        content: '';
        position: absolute;
        width: 100%;
        height: 30%;
        top: 0;
        left: 0;
        background-image:linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0));;
        z-index: 2;
      }
      img{
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
      .courseList_item_class{
        position: absolute;
        bottom: 5px;
        right: 5px;
      }
      .courseList_item_user{
        position: absolute;
        top: 10px;
        left: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 5;
        span{
          font-size: 14px;
          color: rgb(255, 255, 255);
        }
        .courseList_item_userpic{
          width: 50px;
          height: 50px;
          border-radius: 50%;
          overflow: hidden;
          margin-right: 5px;
          img{
            width: 100%;
            height: 100%;
            object-fit: cover;
          }
        }
      }
    }
    &_content{
      width: 100%;
      height: 100%;
      padding: 10px;
      display: flex;
      flex-direction: column;
      justify-content: space-around;
      align-items: flex-start;
      span{
        font-size: 16px;
        font-weight: 500;
        margin-left: 5px;
      }
      &_title{
        width: 100%;
        font-size: 20px;
        text-align: center;
        margin-bottom: 10px;
        font-weight: 900;
        display: flex;
        justify-content: center;
        align-items: center;
        span{
          font-weight: 900;
          font-size: 20px;
        }
      }
      &_signuptime, &_coursetime{
        display: flex;
        justify-content: space-around;
        align-items: flex-start;
      }
    }
    &_btns{
      width: 100%;
      height: 100%;
      padding: 0px;
      margin-top: 50px;
      display: flex;
      border-bottom-left-radius:5px;
      border-bottom-right-radius: 5px;
      overflow:hidden ;
      .btn{
        background: #8b989f;
        color: #fff;
        border-radius: 0px;
        width: 50%;
        padding: 10px 0;
        &.disable{
          background: #c5cccf;
          cursor: default;
          &:hover{
            background: #c5cccf;
          }
        }
        &:hover{
          background: #a9b9c2;
        }
      }
    }
    &_joinusers{
      position: absolute;
      bottom:55px;
      right:10px;
      font-size: 14px;
      color: rgb(189, 201, 206);
    }
    &_joinuserspics{
      position: absolute;
      bottom:50px;
      left:80px;
      width: 120px;
      height: 40px;
      .joinuserspics_box{
        width: 120px;
        height: 40px;
        position: relative;
        .pic1{
          width: 40px;
          height: 40px;
          top: 0;
          left: 0;
          position: absolute;
          border-radius: 50%;
          overflow:hidden;
          img{
            width: 100%;
            height: 100%;
            object-fit: cover;
          }
        }
        .pic2{
          width: 40px;
          height: 40px;
          top: 0;
          left: 25px;
          position: absolute;
          border-radius: 50%;
          overflow:hidden;
          img{
            width: 100%;
            height: 100%;
            object-fit: cover;
          }
        }
        .pic3{
          width: 40px;
          height: 40px;
          top: 0;
          left: 50px;
          position: absolute;
          border-radius: 50%;
          overflow:hidden;
          img{
            width: 100%;
            height: 100%;
            object-fit: cover;
          }
        }
        .pic4{
          width: 40px;
          height: 40px;
          top: 0;
          left: 75px;
          font-size: 10px;
          background: rgba(44, 44, 44, 0.466);
          color: #fff;
          position: absolute;
          border-radius: 50%;
          overflow:hidden;
          text-align: center;
          line-height: 40px;
          img{
            width: 100%;
            height: 100%;
            object-fit: cover;
          }
        }
      }
    }
  }
}
.modal{
  height: 100%;
  overflow:hidden;
  .modal-content{
    max-height: 700px;
    overflow-y: scroll;
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
  }
  &_left{
    width: 40%;
    height: 80%;
    position: sticky;
    top: 10px;
    left: 0px;
    .bigpic{
      height: 350px;
      width: 100%;
      overflow: hidden;
      position: relative;
      img{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 400px;
        object-fit: cover;
      }
    }
    .pics{
      height: 150px;
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      img{
        width: 100%;
        height: 100px;
        object-fit: cover;
        margin: 0 10px;
        cursor: pointer;
      }
    }
  }
  &_right{
    width: 60%;
    &_title{
      font-size: 24px;
      text-align: center;
      border-bottom: 2px solid rgb(151, 151, 151);
      margin:0 20px;
      position: relative;
      .state{
        position: absolute;
        font-weight: 900;
        background: rgb(44, 60, 95);
        color: #fff;
        top: 0;
        right: 0;
        font-size: 16px;
        padding: 4px 15px;
        border-radius: 8px;
      }
    }
    &_content{
      margin:10px 20px;
      padding: 30px;
      font-size: 18px;
      background: #deebf4;
      border-radius: 5px;
    }
    &_bottom{
      margin:30px 20px;
      div{
        margin-bottom: 10px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
      }
      .icon{
        width: 40px;
        height: 35px;
        font-size: 24px;
        color: rgb(189, 220, 230);
        margin-bottom: 0;
      }
      .title{
        font-weight: 900;
        width: 70px;
      }
    }
    .joinbtn{
      background: #8b989f;
      color: #fff;
      width: calc(100% - 100px);
      padding: 10px 0;
      font-size: 18px;
      text-align: center;
      margin: 0 50px;
      transition: 0.3s all ease-in-out;
      cursor: pointer;
        &:hover{
          background: #a9b9c2;
          transition: 0.3s all ease-in-out;
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