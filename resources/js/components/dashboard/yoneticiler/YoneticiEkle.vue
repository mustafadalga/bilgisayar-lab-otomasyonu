<template>
    <div>
        <div class="modal fade" id="yonetici-ekle" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header">
                        <h4 class="modal-title">Yönetici Ekle</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <!--Body-->
                    <div class="modal-body">

                        <div class="form-group">
                            <label >Adı Soyadı</label>
                            <input type="text" class="form-control" name="adi" v-model="admin.name">
                        </div>
                        <div class="form-group">
                            <label >Email</label>
                            <input type="text" class="form-control" name="email" v-model="admin.email">
                        </div>
                        <div class="form-group">
                            <label >Parola</label>
                            <input type="password" class="form-control" name="parola" v-model="admin.password">
                        </div>
                        <div class="form-group">
                            <label >Parola Onay</label>
                            <input type="password" class="form-control" name="parola2" v-model="admin.password_confirmation">
                        </div>
                        <div class="form-group">
                            <uyari :uyari="uyari"></uyari>
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal" ref="modal_kapat">Kapat</button>
                        <button class="btn btn-primary" @click="yoneticiEkle">Ekle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "YoneticiEkle",
    data:function (){
        return{
            admin:{
                name:'',
                email:'',
                password:'',
                password_confirmation:''
            },
            uyari: {
                status:''
            }
        }
    },
    methods:{
        yoneticiEkle(){
            if(this.checkinput()){
                let self=this;
                axios.post('/yonetici/ekle',this.admin)
                    .then(response=>{
                        self.uyari=response.data
                        this.$emit('yoneticiListele')
                        setTimeout(function (){
                            this.admin={
                                name:'',
                                email:'',
                                password:'',
                                password_confirmation:''
                            },
                            self.uyari= {
                                status: ''
                            }
                            self.$refs.modal_kapat.click()
                        },1000)
                    })
                    .catch(errors=>{
                        self.uyari=errors.response.data
                    })
            }else{
                this.uyari= {
                    status: 'danger',
                    message:['Lütfen boş alanları doldurunuz.']
                }
            }

        },
        checkinput(){
            if(this.admin.name.trim()==='' || this.admin.email.trim()==='' || this.admin.password.trim()==='' || this.admin.password_confirmation.trim()===''){
                return false
            }else{
                return true
            }
        },
    }
}
</script>

<style scoped>

</style>
