<template>
    <div class="text-2xl text-gray-800">
        <span>createcourse123</span>
        <div class="btn border" @click="createItems">點</div>
        <img src="/images/icon1.png">
        
    </div>
</template>
<script>
import {mapState} from "vuex";

export default {
    data(){
        return {
        }
    },
  computed:{
    ...mapState(["user"])
  },
    methods:{
        createItems(){
            console.log(this.user.id)
            axios.post(`/api/admin/createCourese/${this.user.id}`)
            .then((res)=>{
                console.log(res.data)
            })
        }
    }
}
</script>