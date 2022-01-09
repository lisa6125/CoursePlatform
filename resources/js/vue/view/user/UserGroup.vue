<template>
    <div class="text-2xl text-gray-800 course">
        <div class="course-setting card my-5 mx-auto p-1">
                <span class="fs-2 m-3 ms-5">管理用戶開團</span>
            <div class="course-lists p-3 d-flex flex-wrap justify-content-center align-items-center">
                <div class="item p-2 me-3 mb-3" v-for="item,idx in myParticipates" :key="item.id">
                    <div class="pic">
                        <img :src="item.pic1"/>
                    </div>
                    <div class="itemsetting" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="openModal(idx)">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                    <div class="class">
                        <button type="button" class="btn btn-outline-light badge rounded-pill bg-ligh py-1 px-2 me-1">{{item.class1}}</button>
                        <button v-show="item.class2" type="button" class="btn btn-outline-light badge rounded-pill bg-ligh py-1 px-2 me-1">{{item.class2}}</button>
                        <button v-show="item.class3" type="button" class="btn btn-outline-light badge rounded-pill bg-ligh py-1 px-2 me-1">{{item.class3}}</button>
                    </div>
                    <div class="title w-100 fs-4 text-center my-2 mx-0">{{item.title}}<p class="state">{{item.state}}</p></div>
                    <div class="signUptime mb-2"><span>登記時間:</span><br> <span style="font-weight:300;">{{timeChanger(item.signUp_start_time)}}<br>~{{timeChanger(item.signUp_end_time)}}</span></div>
                    <div class="coursetime mb-2"><span>課程時間:</span><br><span style="font-weight:300;">{{timeChanger(item.activity_start_time)}}<br>~{{timeChanger(item.activity_send_time)}}</span></div>
                    <div class="usernum"><span class="me-1">參與人數:</span>{{item.usernum}}</div>
                    <div class="price mb-1"><span class="me-1">費用:</span>{{item.price}}</div>
                    <div class="place"><span class="me-1">地點:</span>{{item.place}}</div>
                </div>
            </div>
        </div>
        <!-- 彈跳視窗 -->
        <div class="modal fade" v-show="showCard" :v-model="nowOpen" id="exampleModal" tabindex="-1">
          <div class="modal-dialog modal-xl ">
            <div class="modal-content">
              <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close"></button>
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
                  <div class="joinbtn" @click="cancelParticipateCourse(nowOpen.id)">取消參加</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- 彈跳視窗 -->
    </div>
</template>
<script>
import {mapState} from "vuex";
import VueDatepickerLocal from "vue-datepicker-local";
export default {
  components: {
    VueDatepickerLocal
  },
    data(){
        return {
            time: new Date(),
            showCard:true,
            myParticipates:[],
            nowOpen:'',
            nowOpenPic:''
        }
    },
  computed:{
    ...mapState(["user"]),
  },
    methods:{
        // createItems(){
        //     console.log(this.user.id)
        //     axios.post(`/api/admin/createCourese/${this.user.id}`)
        //     .then((res)=>{
        //         console.log(res.data)
        //     })
        // },
        timeChanger(time){
            return new Date(time).toLocaleString();
        },
        openModal(num){
            this.nowOpen = this.myParticipates[num];
            this.nowOpenPic = this.nowOpen.pic1;
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
        cancelParticipateCourse(id){
            axios.post('/api/user/UserCancelParticipateActivity/'+id,{userId:this.user.id})
            .then((res)=>{
                new this.$swal({
                    icon: 'success',
                    title: res.data,
                    showCancelButton: false,
                    timer: 1500
                })
                document.getElementById('close').click();
                this.nowOpen = '';
                this.getUserParticipateActivity();
            })
            .catch((err)=>{
                console.log(err)
            })
        }
    },
    created(){
        this.getUserParticipateActivity();
    }
}
</script>
<style lang="scss" scope>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
a{
    text-decoration:none;
    color:#000;
}
.course{
    padding-top:80px;
}
.course-setting{
    width:70%;
    height:600px;
    overflow:auto;
    position:relative;
    min-width:800px;
    margin-top:100px;
    font-weight:900;
    background:rgba(255, 255, 255,0.5);
    backdrop-filter: blur(3px);
    box-shadow:0px 0px 25px 1px rgba(0, 0, 0,0.1);
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
    .addbox{
        position:sticky;
        pointer-events: none;
        width:100%;
        top:30px;
        left:0;
        text-align:right;
        z-index:991;
    }
    .addBtn{
        pointer-events: initial;
        margin-right:10px;
        background:#769fdb;
        cursor:pointer;
        color:#fff;
    }
}
.newGroup{
    width:100%;
    height:100%;
    background:rgba(0, 0, 0,0.5);
    backdrop-filter: blur(3px);
    position:absolute;
    top:0;
    left:0;
    .card{
        width:800px;
        height:600px;
        overflow:auto;
        background:#fff;
        position:absolute;
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
        top:130px;
        left:50%;
        transform:translateX(-50%);
    }
    .picbox{
        height:200px;
        img{
            width:100%;
            height:100%;
            object-fit:cover;
        }
    }
}
.newEdit{
    width:100%;
    height:100%;
    background:rgba(0, 0, 0,0.5);
    backdrop-filter: blur(3px);
    position:absolute;
    top:0;
    left:0;
    .card{
        width:800px;
        height:600px;
        overflow:auto;
        background:#fff;
        position:absolute;
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
        top:130px;
        left:50%;
        transform:translateX(-50%);
    }
    .picbox{
        height:200px;
        img{
            width:100%;
            height:100%;
            object-fit:cover;
        }
    }
}
.item{
    width:300px;
    min-height:400px;
    background:rgba(255, 255, 255,1);
    position:relative;
    box-shadow:0px 0px 25px 1px rgba(0, 0, 0,0.1);
    .itemsetting{
        position:absolute;
        top:15px;
        right:10px;
        width:25px;
        text-align:center;
        color:#fff;
        font-size:18px;
        cursor:pointer;
        transition:0.3s all ease;
        &:hover{
            filter:drop-shadow(0px 0px 5px #fff);
            transition:0.3s all ease;
        }
    }
    .title{
        background:#e0edff;
        .state{
            font-size: 16px;
            color: #8c8e91;
            font-weight: 500;
        }
    }
    .pic{
        width:100%;
        height:270px;
        position:relative;
        img{
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%,-50%);
            width:100%;
            height:100%;
            object-fit: cover;
        }
    }
    .class{
        position:absolute;
        top:245px;
        right:15px;
    }
    .usernum{
        position:absolute;
        bottom:5px;
        right:20px;
        color:#8c8e91;
        font-size:14px;
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
</style>