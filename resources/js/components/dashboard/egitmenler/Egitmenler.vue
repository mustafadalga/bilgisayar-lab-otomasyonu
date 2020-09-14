<template>
    <div>
        <div class="row">
            <div class="col-3">
                <h1>Eğitmenler</h1>
            </div>
        </div>
        <table class="table" >
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Eğitmen Adı / Soyadı</th>
                <th scope="col">Eğitmen Email</th>
                <th scope="col">Seçenekler</th>
            </tr>
            </thead>
            <tbody  v-if="egitmenList && egitmenList.length>0">
                <tr v-for="(egitmen,index) in egitmenList">
                    <th scope="row">{{ index+1 }}</th>
                    <td>{{ egitmen.adi  }} {{egitmen.soyadi }}</td>
                    <td>{{ egitmen.email }}</td>
                    <td>
                        <a :href="'/dashboard/egitmen/'+egitmen.slug" class="btn btn-info btn-sm text-white"><i class="fas fa-eye"></i></a>
                        <a :href="'/dashboard/egitmen/duzenle/'+egitmen.slug" class="btn btn-indigo btn-sm"><i class="fas fa-edit"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#egitmen-sil" @click="egitmenSec(egitmen)"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            </tbody>
            <tbody v-else class="text-center">
            <tr>
                <td colspan="4">
                    <h1 >Eğitmen Bulunmamaktadır.</h1>
                </td>
            </tr>
            </tbody>
        </table>
        <egitmen-sil-d :egitmen="egitmen" @egitmenListele="egitmenListele"></egitmen-sil-d>
    </div>
</template>

<script>
export default {
    name: "Egitmenler",
    props:['egitmenler'],
    data(){
        return{
          egitmenList:null,
          egitmen: null,
        }
    },
    mounted() {
        this.egitmenList=this.egitmenler
    },
    methods:{
        egitmenSec(egitmen){
            this.egitmen=egitmen
        },
        egitmenListele(){
            let self=this;
            axios.get('/egitmen/list')
                .then(response=>{
                    self.egitmenList=response.data.egitmenler;
                })
        }
    }

}
</script>

<style scoped>

</style>
