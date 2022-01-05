<template>
    <div class="text-2xl text-gray-800 user">
        <div class="user-setting card my-5 mx-auto p-1">
                <span class="fs-2 m-3 ms-5">管理用戶</span>
            <div class="user-lists p-3 d-flex flex-wrap justify-content-center align-items-center">
                <table class="table align-middle table-hover">
                    <thead>
                        <tr>
                            <td></td>
                            <td>名字</td>
                            <td>帳號</td>
                            <td>信箱</td>
                            <td>手機</td>
                            <td class="text-center">參與課程次數</td>
                            <td class="text-center">參與活動次數</td>
                            <td class="text-center">開團活動次數</td>
                            <td class="text-center">設定</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="eachuser in alluser" :key="eachuser.account">
                            <td class="pic">
                                <img v-if="eachuser.pic" :src="eachuser.pic" />
                                <img v-else src="/images/userdefault.jpg" />
                            </td>
                            <td>{{eachuser.name}}</td>
                            <td>{{eachuser.account}}</td>
                            <td>{{eachuser.email}}</td>
                            <td>{{eachuser.phone}}</td>
                            <td class="text-center">{{eachuser.courseyoujoin}}</td>
                            <td class="text-center">{{eachuser.activityyoujoin}}</td>
                            <td class="text-center">{{eachuser.activityyouopen}}</td>
                            <td class="text-center" ><button v-if="eachuser.id != user.id" type="button" class="btn btn-outline-danger" @click="delteUser(eachuser.id)">刪除</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
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
            alluser:[]
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
        sendEditGroup(){
            axios.post('/api/admin/updateGroup', this.choseEdit)
            .then((res) =>{
                new this.$swal({
                icon: 'success',
                title: res.data,
                showCancelButton: false,
                timer: 1500
                })
                this.showEditCard = false;
                this.getOtherUserGroup();
            }).catch((error) =>{
                new this.$swal({
                icon: 'error',
                title: '更新失敗',
                showCancelButton: false,
                timer: 1500
                })
            })
        },
        getUser(){
            axios.get('/api/admin/getUser')
            .then((res)=>{
                console.log(res.data)
                this.alluser = {...res.data};
            })
        },
        delteUser(id){
            new this.$swal({
            title: '確定是否刪除',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: '刪除',
            denyButtonText: '取消',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.delete('/api/admin/destroyUser/'+id)
                    .then((res) =>{
                        new this.$swal({
                        icon: 'success',
                        title: res.data,
                        showCancelButton: false,
                        timer: 1500
                        })
                        this.getUser();
                    }).catch((error) =>{
                        new this.$swal({
                        icon: 'error',
                        title: '刪除失敗',
                        showCancelButton: false,
                        timer: 1500
                        })
                    })
                }
            })
        },
    },
    created(){
        this.getUser();
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
.user{
    padding-top:80px;
}
.user-setting{
    width:80%;
    height:600px;
    overflow:auto;
    position:relative;
    min-width:1000px;
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

table{
    .pic{
        width: 80px;
        height: 80px;
        img{
            width:100%;
            height:100%;
            border-radius: 80px;
            object-fit:cover;
        }
    }
}
</style>