<template>
    <div class="container d-flex justify-content-center align-items-center user">
        <div class="user_card d-flex">
            <div class="user_imgbox d-flex flex-column justify-content-center align-items-center">
                <div class="pic mb-3">
                <img v-if="getUser.pic" :src="getUser.pic" />
                <img v-else src="/images/userdefault.jpg" />
                </div>
                <p>{{getUser.name}}</p>
            </div>
            <div class="user_informbox" v-if="!settingOpen">
                <div class="title">用戶資料</div>
                <div class="informain">
                    <div class="name infor"><span>姓名:</span>{{getUser.name}}</div>
                    <div class="account infor"><span>帳號:</span>{{getUser.account}}</div>
                    <div class="phone infor"><span>電話:</span>{{getUser.phone}}</div>
                    <div class="emial infor"><span>信箱:</span>{{getUser.email}}</div>
                </div>
                <button type="button" class="setting btn px-2 py-1 w-100 btn-outline-secondary" @click="settingOpen = !settingOpen">設定</button>
            </div>
            <div class="user_informbox" :class="{showsetting:settingOpen}" v-else>
                <div class="title">用戶資料設定</div>
                <form class="informain">
                    <div class="name infor d-flex align-items-center">
                        <label for="validationDefaultUsername" class="form-label me-4 mb-0">姓名:</label>
                        <div class="input-group">
                        <input type="text" class="form-control" id="validationDefaultUsername"  v-model="userSetting.name" aria-describedby="inputGroupPrepend2" required>
                        </div>
                    </div>
                    <div class="phone infor d-flex align-items-center">
                        <label for="validationDefaultUserphone" class="form-label me-4 mb-0">手機:</label>
                        <div class="input-group">
                        <input type="text" class="form-control" id="validationDefaultUserphone"  v-model="userSetting.phone" aria-describedby="inputGroupPrepend2" required>
                        </div>
                    </div>
                    <div class="email infor d-flex align-items-center">
                        <label for="validationDefaultUseremail" class="form-label me-4 mb-0">姓箱:</label>
                        <div class="input-group">
                        <input type="text" class="form-control" id="validationDefaultUseremail"  v-model="userSetting.email" aria-describedby="inputGroupPrepend2" required>
                        </div>
                    </div>
                    <div class="pic infor d-flex align-items-center">
                        <label for="validationDefaultUserpic" class="form-label me-4 mb-0">照片:</label>
                        <div class="input-group">
                        <input type="text" class="form-control" id="validationDefaultUserpic"  v-model="userSetting.pic" aria-describedby="inputGroupPrepend2" required>
                        </div>
                    </div>
                    <div v-if="changePassword" class="oldpassword infor d-flex align-items-center">
                        <label for="validationDefaultUseroldpassword" class="form-label me-4 mb-0">舊密碼:</label>
                        <div class="input-group">
                        <input type="password" class="form-control" id="validationDefaultUseroldpassword"  v-model="userSetting.oldpassword" aria-describedby="passwordHelpBlock">
                        </div>
                    </div>
                    <div v-if="changePassword" class="newpassword infor d-flex align-items-center">
                        <label for="validationDefaultUsernewpassword" class="form-label me-4 mb-0">新密碼:</label>
                        <div class="input-group">
                        <input type="text" class="form-control" id="validationDefaultUsernewpassword"  v-model="userSetting.password" aria-describedby="inputGroupPrepend2">
                        </div>
                    </div>
                    <div v-if="changePassword" class="newpasswordcomfirm infor d-flex align-items-center">
                        <label for="validationDefaultUsernewpasswordcomfirm" class="form-label me-4 mb-0">確認新密碼:</label>
                        <div class="input-group">
                        <input type="text" class="form-control" id="validationDefaultUsernewpasswordcomfirm"  v-model="userSetting.password_confirmation" aria-describedby="inputGroupPrepend2">
                        </div>
                    </div>
                </form>
                    <div class="mt-4 settingGroup">
                      <div class="btn btn px-2 py-1 me-2 btn-outline-secondary" @click.capture="changePassword = !changePassword">
                        <span v-if="!changePassword">更改密碼</span>
                        <span v-else @click="canceleSettingPassword">取消更改密碼</span>
                      </div>
                      <div class="btn btn px-2 py-1 me-2 btn-outline-secondary" @click="canceleSetting">取消</div>
                      <div class="btn btn px-2 py-1 btn-outline-secondary" @click="sendSetting">確定送出</div>
                    </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapMutations} from "vuex";
export default {
    data(){
        return {
            settingOpen:false,
            changePassword:false,
            userSetting:{},
        }
    },
  computed:{
    getUser(){
      return this.$store.getters.userData
    }
  },
  methods:{
    ...mapMutations(["login"]),
    sendSetting(){
      axios.post('/api/user/update', this.userSetting)
      .then((res)=>{
        if(res.data == "舊密碼錯誤"){
          new this.$swal({
            title: res.data,
            showCancelButton: false,
            timer: 1500
          })
        }else{
          this.login(res.data);
          new this.$swal({
          icon: 'success',
          title: '更新成功',
          showCancelButton: false,
          timer: 1500
          })
        }
      })
      .catch((error)=>{
        new this.$swal({
          icon: 'error',
          showCancelButton: false,
          text:error.response.data.errors["password"],
          timer: 1500
        })
      })
    },
    canceleSetting(){
      this.userSetting ={...this.getUser};
      this.settingOpen = false;
      this.changePassword = false;
    },
    canceleSettingPassword(){
      this.userSetting.oldpassword = "";
      this.userSetting.password = "";
      this.userSetting.password_confirmation = "";
      this.changePassword = false;
    }
  },
  created(){
      this.userSetting = {...this.getUser};
      this.userSetting.oldpassword="";
      this.userSetting.password="";
      this.userSetting.password_confirmation="";
  }
}
</script>
<style lang="scss" scope>
.user{
  padding-top:100px;
    &_card{
    width:800px;
    height:500px;
    margin-top:50px;
    background:rgba(255,255,255,0.3);
    backdrop-filter: blur(5px);
    border-radius:10px;
    box-shadow:0 0 25px 3px rgba(0,0,0,0.1);
    }
    &_imgbox{
        width:35%;
        height:100%;
        border-radius: 10px 0px 0px 10px;
        background:#fff;
        font-weight:900;
        font-size:16px;
        .pic{
            width:200px;
            height:200px;
            border-radius:50%;
            overflow:hidden;
            img{
                width:100%;
                height:100%;
                object-fit:cover;
            }
        }
    }
    &_informbox{
        width:65%;
        height:100%;
        font-weight:900;
        font-size:18px;
        padding:20px 30px;
        &.showsetting{
          position:relative;
          .settingGroup{
            width:90%;
            position:absolute;
            box-sizing:border-box;
            bottom:30px;
            left:30px;
            div{
              width:30%;
              box-sizing:border-box;
            }
          }
            .informain{
                margin-top:20px;
                .form-label{
                    width:80px;
                }
            }
        }
        .title{
        font-size:24px;
        }
        .informain{
            margin-top:100px;
            padding-left:50px;
            padding-right:50px;
            .input-group{
                width:300px;
            }
        }
        .infor{
            margin-bottom:10px;
            span{
                margin-right:10px;
            }
        }
        .setting{
            margin-top:120px;
            font-weight:900;
            font-size:16px;
        }
    }
}
</style>