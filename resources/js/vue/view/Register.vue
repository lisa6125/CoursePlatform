<template>
      <div class="mx-auto d-flex justify-content-center align-items-center">
        <div class="card px-5 py-3 d-flex flex-column justify-content-center align-items-center">
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
                <button @click.prevent="saveForm" type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 rounded btn-secondary">Register</button>
            </div>
        </div> 
    </div>
</template>
<script>
export default {
    data(){
        return{
            form:{
                name: '',
                account: '',
                pic: '',
                phone: '',
                email: '',
                admin:false,
                password:'',
                password_confirmation:''
            },
            errors:[]
        }
    },
    methods:{
        saveForm(){
            if(this.form.name == ''|| this.form.account == '' || this.form.phone == '' ||this.form.email == '' ||this.form.password == '' ||this.form.password_confirmation == ''){
                new this.$swal({
                icon: 'warning',
                title: '資料請填寫確實',
                showConfirmButton: false,
                timer: 1500
                })
                return ;
            }
            axios.post('/api/user/register', this.form).then(() =>{
                new this.$swal({
                icon: 'success',
                title: '註冊成功',
                showCancelButton: true,
                confirmButtonText: '來去登入!',
                }).then(()=>{
                this.$router.push({ name: "Login"});
                })
            }).catch((error) =>{
                let content = ''
                if(error.response.data.errors["name"]){
                    content+=`${error.response.data.errors["name"]}\n`
                }
                if(error.response.data.errors["account"]){
                    content+=`${error.response.data.errors["account"]}\n`
                }
                if(error.response.data.errors["email"]){
                    content+=`${error.response.data.errors["email"]}\n`
                }if(error.response.data.errors["password"]){
                    content+=`${error.response.data.errors["password"]}\n`
                }
                new this.$swal({
                icon: 'warning',
                title: '註冊失敗',
                text:content,
                showCancelButton: true,
                })
                this.errors = error.response.data.errors;
            })
        }
    }
}
</script>
<style lang="scss" scope>
.title{
    width:250px;
}
</style>