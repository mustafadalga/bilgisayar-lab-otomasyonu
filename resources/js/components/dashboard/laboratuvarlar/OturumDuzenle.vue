<template>
    <div>
        <div class="modal fade" id="oturum-duzenle" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Ders Oturum Düzenle</h4>
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
                            <label class="col-lg-3 col-form-label form-control-label">Ders Kodu</label>
                            <div class="col-lg-6">
                                <input class="form-control" type="text" disabled v-model="oturum.derskod"/>
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-center">
                            <label class="col-lg-3 col-form-label form-control-label font-weight-bold">Ders Adı</label>
                            <div class="col-lg-6">
                                <select class="custom-select" @change="veriSec($event,1)">
                                    <option v-for="ders in veriler.dersler" :value="ders.kod" :selected="ders.kod === aktif_oturum.derskod">{{ ders.adi }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-center">
                            <label class="col-lg-3 col-form-label form-control-label font-weight-bold">Eğitmen Adı / Soyadı</label>
                            <div class="col-lg-6">
                                <select class="custom-select" @change="veriSec($event,2)">
                                    <option v-for="egitmen in veriler.egitmenler" :value="egitmen.adi" :data-id="egitmen.user_id" :selected="egitmen.user_id=== aktif_oturum.egitmen_id" :data-control="setAktifEgitmenId(egitmen.user_id,aktif_oturum.egitmen_id)">{{ egitmen.adi }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row  d-flex justify-content-center">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button class="btn btn-danger btn-sm float-right" @click="oturumSil">Oturum Sil</button>
                            </div>
                        </div>

                      <div class="form-group">
                          <uyari :uyari="uyari"></uyari>
                      </div>
                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal" ref="modal_kapat">Kapat</button>
                        <button class="btn btn-primary" @click="oturumGuncelle">Güncelle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "OturumDuzenle",
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
                lab:'',
                _method:'PUT'
            },
            oturum_id:null,
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
                this.oturum_id=this.aktif_oturum.id
                this.oturum.gun=this.aktif_oturum.gunkod
                this.oturum.saat=this.aktif_oturum.saatkod
                this.oturum.derskod=this.aktif_oturum.derskod
                this.oturum.ders=this.aktif_oturum.ders
                this.oturum.egitmen=this.aktif_oturum.egitmen
            },
            deep: true
        },
    },
    methods:{
        setAktifEgitmenId(a,b) {
            if (a===b){
                this.oturum.egitmen_id=a
            }
        },
        veriSec(event,durum){
            if(durum===1){
                this.oturum.derskod=event.target.value
                this.oturum.ders=this.veriler.dersler.find(ders=>ders.kod===this.oturum.derskod).adi;
            }else if(durum===2){
                this.oturum.egitmen_id = (event.target.options[event.target.options.selectedIndex].dataset).id;
                this.oturum.egitmen=event.target.value
            }
        },
        oturumGuncelle(){
            let self=this;
            console.log(this.oturum)
            axios.post('/oturum/guncelle/'+this.oturum_id,this.oturum)
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
                    self.uyari=errors.response.data
                })
        },
        oturumSil(){
            let self=this;
            axios.delete('/oturum/sil/'+this.oturum_id)
                .then(response=>{
                    self.uyari=response.data
                    this.$emit('oturumlarGuncelle')
                    setTimeout(function (){
                        self.uyari= {
                            status: null
                        }
                        self.$refs.modal_kapat.click()
                    },1000)
                })
                .catch(errors=>{
                    self.uyari=errors.response.data
                })
        }
    }
}
</script>

<style scoped>

</style>
