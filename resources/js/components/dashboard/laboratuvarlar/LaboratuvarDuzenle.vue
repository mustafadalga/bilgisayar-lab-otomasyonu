<template>
    <div>
        <div class="modal fade" id="laboratuvar-duzenle" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header">
                        <h4 class="modal-title">Laboratuvar Adı Güncelle</h4>
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
                        <button class="btn btn-primary" @click="labGuncelle">Kaydet</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "LaboratuvarDuzenle",
    props:['lab'],
    data(){
        return{
            adi:'',
            uyari:{
                status:''
            }
        }
    },
    mounted() {
        this.adi=this.lab.adi
    },
    methods:{
        labGuncelle(){
            let self=this;
            const formData = new FormData();
            formData.append('adi', this.adi);
            formData.append('_method', "PUT");
            if (this.adi){
                axios.post('/lab/guncelle/'+this.lab.id, formData)
                    .then(response=>{
                        self.uyari=response.data
                        setTimeout(()=>{
                            window.location='/dashboard/laboratuvarlar'
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
