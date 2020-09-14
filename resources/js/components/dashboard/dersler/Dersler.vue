<template>
    <div>
        <div class="row">
            <div class="col-3">
                <h1>Dersler</h1>
            </div>
            <div class="col-3 offset-4">
                <button class="btn btn-indigo float-right px-4"  data-toggle="modal" data-target="#ders-ekle"><i class="fas fa-plus"></i></button>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ders Kodu</th>
                <th scope="col">Ders Adı</th>
                <th scope="col">Kredi</th>
                <th scope="col">Seçenekler</th>
            </tr>
            </thead>
            <tbody v-if="dersList && dersList.length>0" >
            <tr v-for="(ders,index) in dersList">
                <th scope="row">{{index+1}}</th>
                <td>{{ ders.kod }}</td>
                <td>{{ ders.adi }}</td>
                <td>{{ ders.kredi }}</td>
                <td>
                    <button class="btn btn-info btn-sm text-white" data-toggle="modal" data-target="#ders-detay" @click="dersSec(ders)"><i class="fas fa-eye"></i></button>
                    <button class="btn btn-indigo btn-sm" data-toggle="modal" data-target="#ders-duzenle" @click="dersSec(ders)"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ders-sil" @click="dersSec(ders)"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            </tbody>
            <tbody v-else class="text-center">
            <tr>
                <td colspan="4">
                    <h1 >Ders Bulunmamaktadır.</h1>
                </td>
            </tr>
            </tbody>
        </table>
        <ders-detay-d :ders="ders" ></ders-detay-d>
        <ders-ekle-d  @dersListele="dersListele"></ders-ekle-d>
        <ders-duzenle-d :ders="ders" @dersListele="dersListele"></ders-duzenle-d>
        <ders-sil-d :ders="ders" @dersListele="dersListele"></ders-sil-d>
    </div>
</template>
<script>
export default {
    name: "Dersler",
    props:['dersler'],
    data:function (){
        return{
            dersList:null,
            ders: {
                kod:null,
                adi:null,
                kredi:null
            }
        }
    },
    mounted() {
        this.dersList=this.dersler
    },
    methods:{
        dersListele(){
                axios.get('/ders/list')
            .then(response=>{
                this.dersList=response.data.dersler;
            })
        },
        dersSec(ders){
            this.ders=ders
        }
    }
}
</script>

<style scoped>

</style>
