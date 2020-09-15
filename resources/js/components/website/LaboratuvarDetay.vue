<template>
    <div>
        <div class="row text-center mt-5">
            <h1 class="col">{{  lab.adi }}</h1>
        </div>

        <div class="w-75 mx-auto mt-4">
            <div class="row">
                <div class="col-4 bg-green-accent-4 text-white text-center p-1">Kendi Oturumlarım</div>
                <div class="col-4 bg-red-darken text-white text-center p-1">Diğer Eğitmenlerin Oturumları</div>
                <div class="col-4 bg-blue-light-5 text-royal-blue text-center p-1">Boş Oturumlar</div>
            </div>
            <div class="mt-3 d-flex align-items-center">
                <i class="fas fa-info-circle  fa-2x text-royal-blue mr-2"></i> Düzenleme yapmak istediğiniz alana tıklayarak ,oturum ekleme,düzenleme ve silme işlemlerini gerçekleştirebilirsiniz.
            </div>
        </div>

        <hr class="bg-royal-blue border-5">
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
                    <div class=" p-2 font-weight-bold bg-royal-blue text-white text-center border-right">
                        Perşembe
                    </div>
                    <div class=" p-2 font-weight-bold bg-royal-blue text-white text-center">
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
                                <template v-if="oturumGetir(gun,saat).egitmen_id===aktif_egitmen.user_id">
                                    <div class="col-h bg-green-accent-4 border-right border-bottom"  data-toggle="modal" data-target="#oturum-duzenle" @click="oturumSec(gun,saat)">
                                        <p class="text-center text-white mt-1">
                                            <strong class="clearfix">{{ oturumGetir(gun,saat).derskod }}</strong>
                                            <strong class="clearfix">{{ oturumGetir(gun,saat).ders}}</strong>
                                            <span>{{ oturumGetir(gun,saat).egitmen}}</span>
                                        </p>
                                    </div>
                                </template>
                                <template v-else>
                                    <div class="col-h bg-red-darken border-right border-bottom" @click="notificationAlert('Sadece kendi ders oturumlarınızda değişiklik yapabilirsiniz')">
                                        <p class="text-center text-white mt-1">
                                            <strong class="clearfix">{{ oturumGetir(gun,saat).derskod }}</strong>
                                            <strong class="clearfix">{{ oturumGetir(gun,saat).ders}}</strong>
                                            <span>{{ oturumGetir(gun,saat).egitmen}}</span>
                                        </p>
                                    </div>
                                </template>
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

        <oturum-ekle-w  :aktif_oturum="oturum"  :dersler="dersler" @oturumlarGuncelle="oturumlarGuncelle"></oturum-ekle-w>
        <oturum-duzenle-w   :aktif_oturum="oturum" :dersler="dersler" @oturumlarGuncelle="oturumlarGuncelle"></oturum-duzenle-w>
        <notifications position="top right" group="alert" />

    </div>
</template>

<script>
export default {
    name: "LaboratuvarDetay",
    props:['lab','oturumlar','aktif_egitmen'],
    data(){
        return {
            oturumList:[],
            oturum: {
                id:'',
                lab:'',
                gunAdi:'',
                gun:'',
                saatAralik:'',
                saat:'',
                derskod:'',
                ders:'',
                egitmen:'',
                egitmen_id:''
            },
            dersler:null,
            gunler:['Pazartesi','Salı','Çarşamba','Perşembe','Cuma'],
            saatler:['08:30 - 09:20','09:30 - 10:20','10:30 - 11:20','11:30 - 12:20','13:00 - 13:50','14:00 - 14:50','15:00 - 15:50','16:00 - 16:50']
        }
    },
    mounted() {
        this.derslerGetir()
        this.oturumList=this.oturumlar
        this.oturum.egitmen=this.aktif_egitmen.adi
        this.oturum.egitmen_id=this.aktif_egitmen.user_id
        this.oturum.lab=this.lab.id
    },
    methods:{
        notificationAlert(text) {
            this.$notify({
                group: "alert",
                title: 'Uyarı',
                text: text,
                type: 'warn'
            });
        },
        oturumGetir (gun,saat){
            return this.oturumList.find(oturum=>oturum.gun===gun && oturum.saat===saat);
        },
        oturumSec(gun,saat){
            this.oturum.gun=gun
            this.oturum.saat=saat
            this.oturum.gunAdi=this.gunler[gun-1]
            this.oturum.saatAralik=this.saatler[saat-1]
            let oturum=this.oturumList.find(oturum=>oturum.gun===gun && oturum.saat===saat)
            if (oturum){
                this.oturum.id=oturum.id
                this.oturum.ders=oturum.ders
                this.oturum.derskod= oturum.derskod
            }
        },
        derslerGetir(){
            let self=this;
            axios.get('/ders/list')
                .then(response=>{
                    self.dersler=response.data.dersler;
                })
        },
        oturumlarGuncelle(){
            this.oturumSifirla()
            let self=this;
            axios.get('/oturum/list/'+this.lab.id)
                .then(response=>{
                    self.oturumList=response.data.oturumlar
                })
        },
        oturumSifirla(){
            this.oturum.id='',
            this.oturum.gunAdi='',
            this.oturum.gun='',
            this.oturum.saatAralik='',
            this.oturum.saat='',
            delete this.oturum['_method'];
        }
    }
}
</script>

<style scoped>

</style>
