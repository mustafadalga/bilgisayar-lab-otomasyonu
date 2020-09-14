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
                                <p><strong>Eğitmen</strong></p>
                                <p><strong>Gün</strong></p>
                                <p><strong>Saat</strong></p>
                            </div>
                            <div class="col-lg-6">
                                <p>{{ aktif_oturum.egitmen }}</p>

                                <p>{{ aktif_oturum.gunAdi }}</p>
                                <p>{{ aktif_oturum.saatAralik }}</p>
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
                                <select class="custom-select" @change="dersSec($event)">
                                    <option v-for="ders in dersler" :value="ders.kod" :selected="ders.kod === aktif_oturum.derskod" >{{ ders.adi }}</option>
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
    props:['aktif_oturum','dersler'],
    data(){
        return{
            oturum: {},
            uyari:{
                status:''
            },
        }
    },
    watch: {
        aktif_oturum: {
            handler() {
                this.oturum=this.aktif_oturum
            },
            deep: true
        },
    },
    methods:{
        dersSec(event){
            this.oturum.derskod=event.target.value
            this.oturum.ders=this.dersler.find(ders=>ders.kod===this.oturum.derskod).adi;

        },
        oturumGuncelle(){
            this.oturum._method='PUT'
            let self=this;

            axios.post('/oturum/guncelle/'+this.oturum.id,this.oturum)
                .then(response=>{
                    self.uyari=response.data
                    setTimeout(function (){
                        self.$emit('oturumlarGuncelle')
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
            axios.delete('/oturum/sil/'+this.oturum.id)
                .then(response=>{
                    self.uyari=response.data
                    setTimeout(function (){
                        self.$emit('oturumlarGuncelle')
                        self.uyari= {
                            status: ''
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
