<template>
<div>
    <div class="row m-3">
        <i class="fas fa-info-circle  fa-2x text-royal-blue mr-2"></i> Düzenleme yapmak istediğiniz alana tıklayarak ,oturum ekleme,düzenleme ve silme işlemlerini gerçekleştirebilirsiniz.
    </div>
    <div class="row">
        <div class="col-1">
        </div>
        <div class="col-10">
            <div class="row row-cols-5">
                <div class="p-2 font-weight-bold bg-royal-blue text-white text-center border-right">
                    Pazartesi
                </div>
                <div class="p-2 font-weight-bold bg-royal-blue text-white text-center border-right">
                    Salı
                </div>
                <div class="p-2 font-weight-bold bg-royal-blue text-white text-center border-right">
                    Çarşamba
                </div>
                <div class="p-2 font-weight-bold bg-royal-blue text-white text-center border-right">
                    Perşembe
                </div>
                <div class="p-2 font-weight-bold bg-royal-blue text-white text-center">
                    Cuma
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-1">
            <div class="row col-h bg-royal-blue text-white font-weight-bold d-flex text-center align-items-center border-bottom">
                <div class="col">
                    08:30 09:20
                </div>
            </div>
            <div class="row col-h bg-royal-blue text-white font-weight-bold d-flex text-center align-items-center border-bottom">
                <div class="col">
                    09:30 10:20
                </div>
            </div>
            <div class="row col-h bg-royal-blue text-white font-weight-bold d-flex text-center align-items-center border-bottom">
                <div class="col">
                    10:30 11:20
                </div>
            </div>
            <div class="row col-h bg-royal-blue text-white font-weight-bold d-flex text-center align-items-center border-bottom">
                <div class="col">
                    11:30 12:20
                </div>
            </div>
            <div class="row col-h bg-royal-blue text-white font-weight-bold d-flex text-center align-items-center border-bottom">
                <div class="col">
                    13:00 13:50
                </div>
            </div>
            <div class="row col-h bg-royal-blue text-white font-weight-bold d-flex text-center align-items-center border-bottom">
                <div class="col">
                    14:00 14:50
                </div>
            </div>
            <div class="row col-h bg-royal-blue text-white font-weight-bold d-flex text-center align-items-center border-bottom">
                <div class="col">
                    15:00 15:50
                </div>
            </div>
            <div class="row col-h bg-royal-blue text-white font-weight-bold d-flex text-center align-items-center border-bottom">
                <div class="col">
                    16:00 16:50
                </div>
            </div>
        </div>
        <div class="col-10">
            <div class="row row-cols-5">
                <template v-for="saat in 8">
                    <template v-for="gun in 5">
                         <template v-if="oturumGetir(gun,saat)">
                             <div class="col-h bg-red-darken border-right border-bottom"  data-toggle="modal" data-target="#oturum-duzenle" @click="oturumSec(gun,saat)">
                                 <p class="text-center text-white mt-1">
                                     <strong class="clearfix">{{ oturumGetir(gun,saat).derskod }}</strong>
                                     <strong class="clearfix">{{ oturumGetir(gun,saat).ders}}</strong>
                                     <span>{{ oturumGetir(gun,saat).egitmen}}</span>
                                 </p>
                             </div>
                         </template>
                        <template v-else>
                            <div class="col-h bg-blue-light-5 d-flex align-items-center justify-content-center border-right border-bottom" data-toggle="modal" data-target="#oturum-ekle" @click="oturumSec(gun,saat)">
                                <h3 class="text-royal-blue">Boş</h3>
                            </div>
                        </template>
                    </template>
                </template>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-11 text-center">
            <button class="btn btn-indigo" data-toggle="modal" data-target="#laboratuvar-duzenle" >Laboratuvar Adı Düzenle</button>
            <button class="btn btn-danger" data-toggle="modal" data-target="#laboratuvar-sil" >Laboratuvar Sil</button>
        </div>
    </div>

    <oturum-ekle-d :lab="lab" :aktif_oturum="oturum" :veriler="veriler" @oturumlarGuncelle="oturumlarGuncelle"></oturum-ekle-d>
    <oturum-duzenle-d :lab="lab" :aktif_oturum="oturum" :veriler="veriler" @oturumlarGuncelle="oturumlarGuncelle"></oturum-duzenle-d>
    <laboratuvar-duzenle-d :lab="lab"></laboratuvar-duzenle-d>
    <laboratuvar-sil-d :lab="lab"></laboratuvar-sil-d>

</div>
</template>

<script>
export default {
    name: "LaboratuvarDetay",
    props:['lab','oturumlar'],
    data(){
        return {
            oturumList:[],
            oturum: {
                id:'',
                gun:'',
                gunkod:'',
                saat:'',
                saatkod:'',
                derskod:'',
                ders:'',
                egitmen:'',
                egitmen_id:''
            },
            veriler: {
                dersler:null,
                egitmenler:null
            },
            gunler:['Pazartesi','Salı','Çarşamba','Perşembe','Cuma'],
            saatler:['08:30 - 09:20','09:30 - 10:20','10:30 - 11:20','11:30 - 12:20','13:00 - 13:50','14:00 - 14:50','15:00 - 15:50','16:00 - 16:50']
        }
    },
    mounted() {
        this.veriGetir(),
        this.oturumList=this.oturumlar
    },
    methods:{
        oturumGetir (gun,saat){
            return this.oturumList.find(oturum=>oturum.gun===gun && oturum.saat===saat);
        },
        oturumSec(gun,saat){
            this.oturum.gunkod=gun
            this.oturum.saatkod=saat
            this.oturum.gun=this.gunler[gun-1]
            this.oturum.saat=this.saatler[saat-1]
            let oturum=this.oturumList.find(oturum=>oturum.gun===gun && oturum.saat===saat)
            if (oturum){
                this.oturum.id=oturum.id
                this.oturum.ders=oturum.ders
                this.oturum.derskod= oturum.derskod
                this.oturum.egitmen= oturum.egitmen
                this.oturum.egitmen_id=oturum.egitmen_id
            }
        },
        veriGetir(){
            let self=this;
            axios.get('/ders/list')
                .then(response=>{
                    self.veriler.dersler=response.data.dersler;
                })
            axios.get('/egitmen/list')
                .then(response=>{
                    self.veriler.egitmenler=response.data.egitmenler;
                })
        },
        oturumlarGuncelle(){
            let self=this;
            axios.get('/oturum/list/'+this.lab.id)
                .then(response=>{
                    self.oturumList=response.data.oturumlar
                })
        }
    }
}
</script>

<style scoped>

</style>
