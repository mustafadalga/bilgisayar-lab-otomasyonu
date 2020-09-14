<template>
    <div>
        <div class="row">
            <div class="col-3">
                <h1>Yöneticiler</h1>
            </div>
            <div class="col-3 offset-4" v-if="role==1">
                <button class="btn btn-indigo float-right px-4"  data-toggle="modal" data-target="#yonetici-ekle"><i class="fas fa-plus"></i></button>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Adı Soyadı</th>
                <th scope="col">Email</th>
                <th scope="col" v-if="role==1">Seçenekler</th>
            </tr>
            </thead>
            <tbody v-if="yoneticiList && yoneticiList.length>0">
            <tr v-for="(yonetici,index) in yoneticiList">
                <th scope="row">{{index+1}}</th>
                <td>{{yonetici.name}}</td>
                <td>{{yonetici.email}}</td>
                <td v-if="role==1">
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#yonetici-sil" @click="yoneticiSec(yonetici)"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            </tbody>
            <tbody v-else class="text-center">
            <tr>
                <td colspan="4">
                    <h1 >Yönetici Bulunmamaktadır.</h1>
                </td>
            </tr>
            </tbody>
        </table>
        <yonetici-ekle-d  @yoneticiListele="yoneticiListele"></yonetici-ekle-d>
        <yonetici-sil-d :yonetici="yonetici" @yoneticiListele="yoneticiListele"></yonetici-sil-d>
    </div>
</template>
<script>
export default {
    name: "Yoneticiler",
    props:['yoneticiler','role'],
    data:function (){
        return{
            yoneticiList:null,
            yonetici: {
                kod:null,
                adi:null,
                kredi:null
            }
        }
    },
    mounted() {
        this.yoneticiList=this.yoneticiler
    },

    methods:{
        yoneticiListele(){
                axios.get('/yonetici/list')
            .then(response=>{
                this.yoneticiList=response.data.yoneticiler;
            }).catch(error=>{
            })
        },
        yoneticiSec(yonetici){
            this.yonetici=yonetici
        }
    }
}
</script>

<style scoped>

</style>
