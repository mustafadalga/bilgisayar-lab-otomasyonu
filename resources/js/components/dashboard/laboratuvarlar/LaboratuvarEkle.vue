<template>
    <div>
        <div class="modal fade" id="lab-ekle" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header">
                        <h4 class="modal-title">Laboratuvar Ekle</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <!--Body-->
                    <div class="modal-body">
                        <div class="form-group">
                            <label >Laboratuvar Adı</label>
                            <input type="text" class="form-control" name="adi" v-model="adi" >
                        </div>
                        <div class="form-group">
                            <uyari :uyari="uyari"></uyari>
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal" ref="modal_kapat">Kapat</button>
                        <button class="btn btn-primary" @click="labEkle">Ekle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "LaboratuvarEkle",
    data(){
    return{
        adi:'',
        uyari:{
            status:''
        }
    }
    },
    methods:{
        labEkle(){
            let self=this;
            const formData = new FormData();
            console.log(this.adi)
            formData.append('adi', this.adi);
            if (this.adi){
                axios.post('/lab/ekle',formData)
                    .then(response=>{
                        self.uyari=response.data
                        this.$emit('labListele');
                        setTimeout(()=>{
                            self.uyari={status:''}
                            self.adi=''
                            self.$refs.modal_kapat.click()
                        },1000)
                    })
                    .catch(errors=>{
                        self.uyari=errors.response.data
                    })
            }else{
                this.uyari={
                    status:'danger',
                    message:['Lütfen boş alanları doldurun!']
                }
            }

        }
    }
}
</script>

<style scoped>

</style>
