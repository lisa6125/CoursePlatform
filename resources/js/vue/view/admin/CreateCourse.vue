<template>
    <div class="text-2xl text-gray-800 course">
        <div class="course-setting card my-5 mx-auto p-1">
                <div class="addbox">
                    <span class="addBtn fs-6 rounded-pill py-3 px-4" @click="showCard =true"><i class="fas fa-plus me-1"></i>新增課程</span>
                </div>
                <span class="fs-2 m-3 ms-5">課程管理</span>
            <div class="course-lists p-3 d-flex justify-content-center align-items-center">
                <div class="item p-2 me-3" v-for="item,idx in allCourse" :key="item.id">
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
                    <div class="title w-100 fs-4 text-center my-2 mx-0">{{item.title}}</div>
                    <div class="signUptime mb-2"><span>登記時間:</span><br> <span style="font-weight:300;">{{timeChanger(item.signUp_start_time)}}<br>~{{timeChanger(item.signUp_end_time)}}</span></div>
                    <div class="coursetime mb-2"><span>課程時間:</span><br><span style="font-weight:300;">{{timeChanger(item.course_start_time)}}<br>~{{timeChanger(item.course_send_time)}}</span></div>
                    <div class="usernum"><span class="me-1">參與人數:</span>{{item.usernum}}</div>
                    <div class="price mb-1"><span class="me-1">費用:</span>{{item.price}}</div>
                    <div class="place"><span class="me-1">地點:</span>{{item.place}}</div>
                </div>
            </div>
        </div>
        <transition name="fade">
            <div v-show="showCard" class="newCourse">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row mb-3">
                            <div class="row w-50 flex-grow-1 me-1">
                                <label class="col-3 col-form-label">登記開始</label>
                                <div class="col-7">
                                    <vue-datepicker-local v-model="newCourse.signUp_start_time" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                </div>
                                <label for="inputEmail3" class="col-3 col-form-label">登記結束</label>
                                <div class="col-7">
                                    <vue-datepicker-local v-model="newCourse.signUp_end_time" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                </div>
                            </div>
                            <div class="row w-50">
                                <label for="inputEmail3" class="col-3 col-form-label">課程開始</label>
                                <div class="col-7">
                                    <vue-datepicker-local v-model="newCourse.course_start_time" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                </div>
                                <label for="inputEmail3" class="col-3 col-form-label">課程結束</label>
                                <div class="col-7">
                                    <vue-datepicker-local v-model="newCourse.course_send_time" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-1 col-form-label">名稱</label>
                            <div class="col-5">
                            <input class="form-control" v-model="newCourse.title">
                            </div>
                            <label class="col-1 col-form-label">地點</label>
                            <div class="col-5">
                            <input class="form-control" v-model="newCourse.place">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-1 col-form-label">價錢</label>
                            <div class="col-5">
                            <input class="form-control" v-model="newCourse.price">
                            </div>
                            <label class="col-1 col-form-label">提醒</label>
                            <div class="col-5">
                            <input class="form-control" v-model="newCourse.notice">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label>標籤1</label>
                                <div>
                                <input class="form-control" v-model="newCourse.class1">
                                </div>
                                <label>標籤2</label>
                                <div>
                                <input class="form-control" v-model="newCourse.class2">
                                </div>
                                <label>標籤3</label>
                                <div>
                                <input class="form-control" v-model="newCourse.class3">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-floating">
                                <textarea v-model="newCourse.content" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 210px"></textarea>
                                <label for="floatingTextarea2">課程主要內容</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-1 col-form-label">照片1</label>
                            <div class="col-3 p-0">
                            <input type="email" class="form-control" v-model="newCourse.pic1">
                            </div>
                            <label class="col-1 col-form-label">照片2</label>
                            <div class="col-3 p-0">
                            <input type="email" class="form-control" v-model="newCourse.pic2">
                            </div>
                            <label class="col-1 col-form-label">照片3</label>
                            <div class="col-3 p-0">
                            <input type="email" class="form-control" v-model="newCourse.pic3">
                            </div>
                        </div>
                        <div class="row mb-3 mx-auto">
                            <div class="picbox col-4 p-3" v-show="newCourse.pic1">
                                <img :src="newCourse.pic1" />
                            </div>
                            <div class="picbox col-4 p-3" v-show="newCourse.pic2">
                                <img :src="newCourse.pic2" />
                            </div>
                            <div class="picbox col-4 p-3" v-show="newCourse.pic3">
                                <img :src="newCourse.pic3" />
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-outline-secondary me-2" @click="showCard = false">取消</button>
                        <button type="button" class="btn btn-outline-primary" @click="sendNewCourse">送出</button>
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
                                    <vue-datepicker-local v-model="choseEdit.course_start_time" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                </div>
                                <label for="inputEmail3" class="col-3 col-form-label">課程結束</label>
                                <div class="col-7">
                                    <vue-datepicker-local v-model="choseEdit.course_send_time" format="YYYY-MM-DD HH:mm:ss"></vue-datepicker-local>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-1 col-form-label">名稱</label>
                            <div class="col-5">
                            <input class="form-control" v-model="choseEdit.title">
                            </div>
                            <label class="col-1 col-form-label">地點</label>
                            <div class="col-5">
                            <input class="form-control" v-model="choseEdit.place">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-1 col-form-label">價錢</label>
                            <div class="col-5">
                            <input class="form-control" v-model="choseEdit.price">
                            </div>
                            <label class="col-1 col-form-label">提醒</label>
                            <div class="col-5">
                            <input class="form-control" v-model="choseEdit.notice">
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
                        <button type="button" class="btn btn-outline-secondary me-2" @click="showEditCard = false">取消編輯</button>
                        <button type="button" class="btn btn-outline-primary" @click="sendEditCourse">編輯送出</button>
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
            newCourse:{
                title:'',
                content:'',
                pic1:'',
                pic2:'',
                pic3:'',
                price:'',
                notice:'',
                place:'',
                course_start_time:new Date(),
                course_send_time:new Date(),
                signUp_start_time:new Date(),
                signUp_end_time:new Date(),
                class1:'',
                class2:'',
                class3:'',

            },
            allCourse:[]
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
        sendNewCourse(){
            axios.post('/api/admin/createCourese', this.newCourse)
            .then((res) =>{
                new this.$swal({
                icon: 'success',
                title: '新建課程成功',
                showCancelButton: false,
                timer: 1500
                })
                this.showCard = false;
                this.newCourse = {
                    title:'',
                    content:'',
                    pic1:'',
                    pic2:'',
                    pic3:'',
                    price:'',
                    notice:'',
                    place:'',
                    course_start_time:new Date(),
                    course_send_time:new Date(),
                    signUp_start_time:new Date(),
                    signUp_end_time:new Date(),
                    class1:'',
                    class2:'',
                    class3:'',

                }
                this.getCourse();
            }).catch((error) =>{
                new this.$swal({
                icon: 'error',
                title: '新增失敗',
                showCancelButton: false,
                timer: 1500
                })
            })
        },
        sendEditCourse(){
            axios.post('/api/admin/updateCourse', this.choseEdit)
            .then((res) =>{
                new this.$swal({
                icon: 'success',
                title: '課程更新成功',
                showCancelButton: false,
                timer: 1500
                })
                this.showEditCard = false;
                this.getCourse();
            }).catch((error) =>{
                new this.$swal({
                icon: 'error',
                title: '更新失敗',
                showCancelButton: false,
                timer: 1500
                })
            })
        },
        getCourse(){
            axios.get('/api/admin/getCourese')
            .then((res)=>{
                this.allCourse = [...res.data];
            })
        },
        editItem(idx){
            this.showEditCard = true;
            this.choseEdit = {...this.allCourse[idx]}
        }
    },
    created(){
        this.getCourse();
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
    min-width:900px;
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
        width:100%;
        top:30px;
        left:0;
        text-align:right;
        z-index:991;
    }
    .addBtn{
        margin-right:10px;
        background:#769fdb;
        cursor:pointer;
        color:#fff;
    }
}
.newCourse{
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