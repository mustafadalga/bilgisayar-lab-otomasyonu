<template>
<div>
    <div class="row">
        <div class="col-3">
            <h1>Laboratuvarlar</h1>
        </div>
        <div class="col-3 offset-4">
            <button class="btn btn-indigo float-right px-4"  data-toggle="modal" data-target="#lab-ekle"><i class="fas fa-plus"></i></button>
        </div>
    </div>

 <div class="row mt-3" v-if="labList && labList.length>0">
     <div v-for="lab in labList"  class="col-6 lab p-0 bg-royal-blue border-right border-bottom" >
         <a :href="'/dashboard/laboratuvar/'+lab.slug" class="w-100 h-100 p-5 text-decoration-none text-white d-flex align-items-center justify-content-center flex-column">
             <i class="fas fa-network-wired fa-2x mb-1"></i>
             <span>{{  lab.adi }}</span>
         </a>
     </div>
 </div>
        <div class="row mt-3 text-center" v-else >
            <div class="col">
                <h1>Laboratuvar Bulunmamaktadır.</h1>
            </div>
        </div>
    <laboratuvar-ekle-d @labListele="labListele"></laboratuvar-ekle-d>
</div>
</template>

<script>
export default {
name: "Laboratuvarlar",
    props:['labs'],
    data(){
    return{
        labList:null
       }
    },
    mounted() {
    this.labList=this.labs
    },
    methods:{
        labListele(){
            axios.get('/lab/list')
                .then(response=>{
                    this.labList=response.data.labs;
                })
        },
    }
}
</script>

<style scoped>
.lab{
    font-size: 2em;
    height:200px;
    transition: all 1s;
}
.lab:hover{
    background: var(--blue);
}
@media (max-width: 1000px) {
  .lab{
      font-size: 1em;
  }
}
</style>
