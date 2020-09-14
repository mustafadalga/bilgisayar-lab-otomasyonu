<template>
    <div>
        <div class="modal fade" id="ders-ekle" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header">
                        <h4 class="modal-title">Ders Ekle</h4>
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
                        <button class="btn btn-primary" @click="dersEkle">Ekle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "DersEkle",
    data:function (){
        return{
            ders:{
                kod:'',
                adi:'',
                kredi:'',
            },
            uyari: {
                status:''
            }
        }
    },
    methods:{
        dersEkle(){
            let self=this;
            axios.post('/ders/ekle',this.ders)
                .then(response=>{
                    self.uyari=response.data
                    this.$emit('dersListele')
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
