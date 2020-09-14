<template>
    <div>
        <div class="modal fade" id="oturum-ekle" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Ders Oturum Ekle</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <!--Body-->
                    <div class="modal-body">
                        <h4 class="text-center">Oturum Bilgisi</h4>
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-3">
                                <p><strong>Gün</strong></p>
                                <p><strong>Saat</strong></p>
                            </div>
                            <div class="col-lg-6">
                                <p>{{ aktif_oturum.gun }}</p>
                                <p>{{ aktif_oturum.saat }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row d-flex justify-content-center">
                            <label class="col-lg-3 col-form-label form-control-label font-weight-bold">Ders Adı</label>
                            <div class="col-lg-6">
                                <select class="custom-select" @change="veriSec($event,1)">
                                    <option selected disabled>Ders Seçiniz</option>
                                    <option v-for="ders in veriler.dersler" :value="ders.kod">{{ ders.adi }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-center">
                            <label class="col-lg-3 col-form-label form-control-label font-weight-bold">Eğitmen Adı / Soyadı</label>
                            <div class="col-lg-6">
                                <select class="custom-select" @change="veriSec($event,2)">
                                    <option selected disabled>Eğitmen Seçiniz</option>
                                    <option v-for="egitmen in veriler.egitmenler" :value="egitmen.adi" :data-id="egitmen.user_id">{{ egitmen.adi }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <uyari :uyari="uyari"></uyari>
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal" ref="modal_kapat">Kapat</button>
                        <button class="btn btn-primary" @click="oturumEkle" >Ekle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "OturumEkle",
    props:['lab','aktif_oturum','veriler'],
    data(){
        return{
            oturum:{
                gun:'',
                saat:'',
                ders:'',
                derskod:'',
                egitmen:'',
                egitmen_id:'',
                lab:''
            },
            uyari:{
                status:''
            },
        }
    },
    mounted() {
        this.oturum.lab=this.lab.id
    },
    watch: {
        aktif_oturum: {
            handler() {
                this.oturum.gun=this.aktif_oturum.gunkod
                this.oturum.saat=this.aktif_oturum.saatkod
            },
            deep: true
        },
    },
    methods:{
        veriSec(event,durum){
            if(durum===1){
                this.oturum.derskod=event.target.value
                this.oturum.ders=this.veriler.dersler.find(ders=>ders.kod===this.oturum.derskod).adi;
            }else if(durum===2){
                this.oturum.egitmen_id = (event.target.options[event.target.options.selectedIndex].dataset).id;
                this.oturum.egitmen=event.target.value
            }
        },
        oturumEkle(){
            let self=this;
            axios.post('/oturum/ekle',this.oturum)
                .then(response=>{
                    self.uyari=response.data
                    this.$emit('oturumlarGuncelle')
                    setTimeout(function (){
                        self.uyari= {
                            status: ''
                        }
                        self.$refs.modal_kapat.click()
                    },1000)
                })
                .catch(errors=>{
                 //   console.log(errors.response.data)
                    self.uyari=errors.response.data
                })
        },
    }
}
</script>

<style scoped>

</style>
