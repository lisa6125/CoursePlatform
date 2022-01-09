<template>
    <div class="text-2xl text-gray-800 course">
        <div class="course-setting card my-5 mx-auto p-1">
                <div class="addbox">
                    <span class="addBtn fs-6 rounded-pill py-3 px-4" @click="showCard =true"><i class="fas fa-plus me-1"></i>新增開團</span>
                </div>
                <span class="fs-2 m-3 ms-5">我的開團</span>
            <div class="course-lists p-3 d-flex flex-wrap justify-content-center align-items-center">
                <div class="item p-2 me-3 mb-3" v-for="item,idx in allGroup" :key="item.id">
                    <div class="pic">
                        <img :src="item.pic1"/>
                    </div>
                    <div class="itemsetting" @click="editItem(idx)">
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
                    <button type="button" class="usernumbtn btn btn-outline-secondary mt-3" @click="userConnect(idx)">參與名單</button>
                </div>
            </div>
        </div>
        <transition name="fade">
            <div v-show="showCard" class="newGroup">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row mb-3">
                            <div class="row w-50 flex-grow-1 me-1">
                                <label class="col-3 col-form-label">登記開始</label>
                                <div class="col-7">
                                    <vue-datepicker-local v-model="newGroup.signUp_start_time" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                </div>
                                <label for="inputEmail3" class="col-3 col-form-label">登記結束</label>
                                <div class="col-7">
                                    <vue-datepicker-local v-model="newGroup.signUp_end_time" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                </div>
                            </div>
                            <div class="row w-50">
                                <label for="inputEmail3" class="col-3 col-form-label">活動開始</label>
                                <div class="col-7">
                                    <vue-datepicker-local v-model="newGroup.activity_start_time" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                </div>
                                <label for="inputEmail3" class="col-3 col-form-label">活動結束</label>
                                <div class="col-7">
                                    <vue-datepicker-local v-model="newGroup.activity_send_time" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <span style="width:50px">名稱</span>
                                <input class="form-control" v-model="newGroup.title">
                            </div>
                            <div class="col-4 d-flex d-flex justify-content-center align-items-center">
                                <span style="width:50px">地點</span>
                                <input class="form-control" v-model="newGroup.place">
                            </div>
                            <div class="col-4 d-flex d-flex justify-content-center align-items-center">
                                <span style="width:50px">價錢</span>
                                <input class="form-control" v-model="newGroup.price">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-1 col-form-label">條件</label>
                            <div class="col-5">
                                <input class="form-control" v-model="newGroup.condition">
                            </div>
                            <label class="col-1 col-form-label">提醒</label>
                            <div class="col-5">
                                <input class="form-control" v-model="newGroup.notice">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label>標籤1</label>
                                <div>
                                <input class="form-control" v-model="newGroup.class1">
                                </div>
                                <label>標籤2</label>
                                <div>
                                <input class="form-control" v-model="newGroup.class2">
                                </div>
                                <label>標籤3</label>
                                <div>
                                <input class="form-control" v-model="newGroup.class3">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-floating">
                                <textarea v-model="newGroup.content" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 210px"></textarea>
                                <label for="floatingTextarea2">活動主要內容</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-1 col-form-label">照片1</label>
                            <div class="col-3 p-0">
                            <input type="email" class="form-control" v-model="newGroup.pic1">
                            </div>
                            <label class="col-1 col-form-label">照片2</label>
                            <div class="col-3 p-0">
                            <input type="email" class="form-control" v-model="newGroup.pic2">
                            </div>
                            <label class="col-1 col-form-label">照片3</label>
                            <div class="col-3 p-0">
                            <input type="email" class="form-control" v-model="newGroup.pic3">
                            </div>
                        </div>
                        <div class="row mb-3 mx-auto">
                            <div class="picbox col-4 p-3" v-show="newGroup.pic1">
                                <img :src="newGroup.pic1" />
                            </div>
                            <div class="picbox col-4 p-3" v-show="newGroup.pic2">
                                <img :src="newGroup.pic2" />
                            </div>
                            <div class="picbox col-4 p-3" v-show="newGroup.pic3">
                                <img :src="newGroup.pic3" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-secondary me-2" @click="showCard = false">取消</button>
                        <button type="button" class="btn btn-outline-primary" @click="sendNewGroup">送出</button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
        <!-- 編輯modal -->
        <transition name="fade">
            <div v-show="showEditCard" class="newEdit">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row mb-3">
                            <div class="row w-50 flex-grow-1 me-1">
                                <label class="col-3 col-form-label">登記開始</label>
                                <div class="col-7">
                                    <vue-datepicker-local v-model="choseEdit.signUp_start_time" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                </div>
                                <label for="inputEmail3" class="col-3 col-form-label">登記結束</label>
                                <div class="col-7">
                                    <vue-datepicker-local v-model="choseEdit.signUp_end_time" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                </div>
                            </div>
                            <div class="row w-50">
                                <label for="inputEmail3" class="col-3 col-form-label">課程開始</label>
                                <div class="col-7">
                                    <vue-datepicker-local v-model="choseEdit.activity_start_time" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                </div>
                                <label for="inputEmail3" class="col-3 col-form-label">課程結束</label>
                                <div class="col-7">
                                    <vue-datepicker-local v-model="choseEdit.activity_send_time" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <span style="width:50px">名稱</span>
                                <input class="form-control" v-model="choseEdit.title">
                            </div>
                            <div class="col-4 d-flex d-flex justify-content-center align-items-center">
                                <span style="width:50px">地點</span>
                                <input class="form-control" v-model="choseEdit.place">
                            </div>
                            <div class="col-4 d-flex d-flex justify-content-center align-items-center">
                                <span style="width:50px">價錢</span>
                                <input class="form-control" v-model="choseEdit.price">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4 d-flex d-flex justify-content-center align-items-center">
                                <span style="width:50px">條件</span>
                                <input class="form-control" v-model="choseEdit.condition">
                            </div>
                            <div class="col-4 d-flex d-flex justify-content-center align-items-center">
                                <span style="width:50px">提醒</span>
                                <input class="form-control" v-model="choseEdit.notice">
                            </div>
                            <div class="col-4 d-flex d-flex justify-content-center align-items-center">
                                <span style="width:50px">狀態</span>
                                <select class="form-select" aria-label="Default select example" v-model="choseEdit.state">
                                <option selected>{{choseEdit.state}}</option>
                                <!-- <option value="審核" class="disable">審核</option>
                                <option value="審核通過">審核通過</option>
                                <option value="審核不通過">審核不通過</option> -->
                                <option v-show='choseEdit.state !== "審核不通過" && choseEdit.state !== "審核"' value="確認開團">確認開團</option>
                                <option v-show='choseEdit.state!== "審核不通過" && choseEdit.state!== "審核"' value="開團失敗">開團失敗</option>
                                <option v-show='choseEdit.state!== "審核不通過" && choseEdit.state!== "審核"' value="報名截止">報名截止</option>
                                <option v-show='choseEdit.state!== "審核不通過" && choseEdit.state!== "審核"' value="已結束">已結束</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label>標籤1</label>
                                <div>
                                <input class="form-control" v-model="choseEdit.class1">
                                </div>
                                <label>標籤2</label>
                                <div>
                                <input class="form-control" v-model="choseEdit.class2">
                                </div>
                                <label>標籤3</label>
                                <div>
                                <input class="form-control" v-model="choseEdit.class3">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-floating">
                                <textarea v-model="choseEdit.content" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 210px"></textarea>
                                <label for="floatingTextarea2">課程主要內容</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-1 col-form-label">照片1</label>
                            <div class="col-3 p-0">
                            <input type="email" class="form-control" v-model="choseEdit.pic1">
                            </div>
                            <label class="col-1 col-form-label">照片2</label>
                            <div class="col-3 p-0">
                            <input type="email" class="form-control" v-model="choseEdit.pic2">
                            </div>
                            <label class="col-1 col-form-label">照片3</label>
                            <div class="col-3 p-0">
                            <input type="email" class="form-control" v-model="choseEdit.pic3">
                            </div>
                        </div>
                        <div class="row mb-3 mx-auto">
                            <div class="picbox col-4 p-3">
                                <img :src="choseEdit.pic1" />
                            </div>
                            <div class="picbox col-4 p-3" v-show="choseEdit.pic2">
                                <img :src="choseEdit.pic2" />
                            </div>
                            <div class="picbox col-4 p-3" v-show="choseEdit.pic3">
                                <img :src="choseEdit.pic3" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-danger me-2" @click="delteGroup">刪除活動</button>
                        <button type="button" class="btn btn-outline-secondary me-2" @click="showEditCard = false">取消編輯</button>
                        <button type="button" class="btn btn-outline-primary" @click="sendEditGroup">編輯送出</button>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
        <!-- 參與名單 -->
        <transition name="fade">
            <div v-show="showUserCard">
                <div  class="userList">
                    <div class="card">
                        <div class="close" @click="showUserCard=false">
                            <i class="fas fa-times"></i>
                        </div>
                        <h5 class="card-title">{{choseEdit.title}}</h5>
                        <div class="card-body">
                            <div class="user-info">
                                <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col"></th>
                                    <th scope="col">name</th>
                                    <th scope="col">phone</th>
                                    <th scope="col">email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user,idx in choseEdit.user_join_activity" :key='idx'>
                                    <td><div class="user-pic"><img :src="user.pic" alt=""></div></td>
                                    <td><div class="user-name">{{user.name}}</div></td>
                                    <td><div class="user-phone">{{user.phone}}</div></td>
                                    <td><div class="user-email">{{user.email}}</div></td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
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
            showCard:false,
            showEditCard:false,
            choseEdit:'',
            showUserCard:false,
            newGroup:{
                title:'',
                content:'',
                pic1:'',
                pic2:'',
                pic3:'',
                price:'',
                notice:'',
                place:'',
                activity_start_time:new Date(),
                activity_send_time:new Date(),
                signUp_start_time:new Date(),
                signUp_end_time:new Date(),
                condition:'',
                class1:'',
                class2:'',
                class3:'',

            },
            allGroup:[]
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
        disabledDate (time) {
          var day = time.getDay();
          return day === 0 || day === 6;
        },
        sendNewGroup(){
            this.newGroup.who_create = this.user.id;
            this.newGroup.connect_user_phone = this.user.phone;
            this.newGroup.connect_user_email = this.user.email;
            this.newGroup.connect_user_pic = this.user.pic;
            this.newGroup.who = this.user.id;
            axios.post('/api/admin/createGroup', this.newGroup)
            .then((res) =>{
                new this.$swal({
                icon: 'success',
                title: res.data,
                showCancelButton: false,
                timer: 1500
                })
                this.showCard = false;
                this.newGroup = {
                    title:'',
                    content:'',
                    pic1:'',
                    pic2:'',
                    pic3:'',
                    price:'',
                    notice:'',
                    place:'',
                    activity_start_time:new Date(),
                    activity_send_time:new Date(),
                    signUp_start_time:new Date(),
                    signUp_end_time:new Date(),
                    condition:'',
                    class1:'',
                    class2:'',
                    class3:'',
                }
                this.getGroup();
            }).catch((error) =>{
                new this.$swal({
                icon: 'error',
                title: '刪除失敗',
                showCancelButton: false,
                timer: 1500
                })
            })
        },
        sendEditGroup(){
            if(this.choseEdit.state == '審核' ||this.choseEdit.state == '審核不通過'){
                new this.$swal({
                icon: 'error',
                title: '此狀態不可更新，若有疑問請聯繫管理者',
                showCancelButton: false,
                timer: 1500
                })
                return 
            }
            axios.post('/api/admin/updateGroup', this.choseEdit)
            .then((res) =>{
                new this.$swal({
                icon: 'success',
                title: '更新成功',
                showCancelButton: false,
                timer: 1500
                })
                this.showEditCard = false;
                this.getGroup();
            }).catch((error) =>{
                new this.$swal({
                icon: 'error',
                title: '更新失敗',
                showCancelButton: false,
                timer: 1500
                })
            })
        },
        getGroup(){
            axios.get('/api/admin/getGroup/'+this.user.id)
            .then((res)=>{
                this.allGroup = [...res.data];
            })
        },
        editItem(idx){
            this.showEditCard = true;
            this.choseEdit = {...this.allGroup[idx]}
        },
        delteGroup(){
            new this.$swal({
            title: '確定是否刪除',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: '刪除',
            denyButtonText: '取消',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post('/api/admin/destroyGroup/'+this.choseEdit.id,{id:this.user.id})
                    .then((res) =>{
                        new this.$swal({
                        icon: 'success',
                        title: res.data,
                        showCancelButton: false,
                        timer: 1500
                        })
                        this.showEditCard = false;
                        this.getGroup();
                    }).catch((error) =>{
                        new this.$swal({
                        icon: 'error',
                        title: '刪除失敗',
                        showCancelButton: false,
                        timer: 1500
                        })
                    })
                } else if (result.isDenied) {
                    this.showEditCard=false;
                }
            })
        },
        userConnect(idx){
            this.showUserCard = true;
            this.choseEdit = {...this.allGroup[idx]}
        },
    },
    created(){
        this.getGroup();
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
.userList{
    width:100%;
    height:100%;
    background:rgba(0, 0, 0, 0.158);
    position:absolute;
    top:0;
    left:0;
    .card{
        width:450px;
        height:500px;
        margin-top: 50px;
        overflow:auto;
        background:#fff;
        position:absolute;
        .close{
            position: absolute;
            font-size: 20px;
            top: 5px;
            right: 12px;
            cursor: pointer;
        }
        &-title{
            font-size: 24px;
            font-weight: 900;
            text-align: center;
            margin: 10px 50px;
            padding: 10px 20px;
        }
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
    .user-pic{
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow:hidden ;
        img{
            width: 100%;
            height: 100%;
            object-fit: cover;
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
</style>