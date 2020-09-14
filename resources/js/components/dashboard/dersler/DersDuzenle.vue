<template>
    <div>
        <div class="modal fade" id="ders-duzenle" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Ders Düzenle</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <!--Body-->
                    <div class="modal-body">

                        <div class="form-group">
                            <label >Ders Kodu</label>
                            <input type="text" class="form-control" name="kod" v-model="ders.kod">
                        </div>
                        <div class="form-group">
                            <label >Ders Adı</label>
                            <input type="text" class="form-control" name="adi" v-model="ders.adi">
                        </div>
                        <div class="form-group">
                            <label >Ders Kredi</label>
                            <input type="text" class="form-control" name="kredi" v-model="ders.kredi">
                        </div>

                        <div class="form-group">
                            <uyari :uyari="uyari"></uyari>
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal" ref="modal_kapat">Kapat</button>
                        <button class="btn btn-primary" @click="dersGuncelle">Güncelle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DersDuzenle",
    props:['ders'],
    data(){
        return{
            uyari: {
                status:''
            }
        }
    },
    methods:{
        dersGuncelle(){
            let self=this;
         self.ders['_method']="PUT"
            let ders=Object.assign({},self.ders);
            axios.post('/ders/guncelle/'+ders.id,ders)
                .then(response=>{
                    this.$emit('dersListele')
                    self.uyari=response.data
                    setTimeout(function (){
                        self.ders.kod=''
                        self.ders.adi=''
                        self.ders.kredi=''
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
