<template>
     <div class="mx-auto d-flex justify-content-center align-items-center">
        <div class="card px-5 py-3 d-flex flex-column justify-content-center align-items-center">
            <p>{{user.name}}</p>
            <div class="p-2 text-2xl text-gray-800 font-semibold"><h1>Login to your account</h1></div>
            <div class="p-2 w-75 d-flex align-items-center">
                <label class="title" for="email">Your account</label>
                <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="account" type="email" v-model="form.account">
            </div>
            <div class="p-2 w-75 d-flex align-items-center">
                <label class="title" for="password">Password</label>
                <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Password" type="password" v-model="form.password" name="password">
            </div>
            <div class="p-2 w-75 d-flex justify-content-center align-items-center mt-4">
                <button @click.prevent="loginUser" type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 rounded btn-secondary">Login</button>
            </div>
        </div> 
    </div>
</template>
<script>
import {mapState, mapMutations} from "vuex";
export default {
    data(){
        return{
            form:{
                account: '',
                password: ''
            },
            errors: []
        }
    },
    computed:{
        ...mapState(["user"])
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
    }
}
</script>
<style lang="scss" scope>
.title{
    width:250px;
}
</style>