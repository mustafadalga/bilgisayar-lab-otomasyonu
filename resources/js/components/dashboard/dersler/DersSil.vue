<template>
    <!--Modal: modalConfirmDelete-->
    <div class="modal fade" id="ders-sil" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <!--Content-->
            <div class="modal-content text-center">
                <!--Header-->
                <div class="modal-header d-flex justify-content-center bg-danger text-white">
                   <h3> Ders Sil</h3>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <p>{{ ders.kod }} kodlu {{ ders.adi}} dersini silmek istediğinize emin misiniz ?</p>
                    <i class="fas fa-times fa-4x text-danger"></i>
                </div>

                <!--Footer-->
                <div class="modal-footer flex-center">
                    <button class="btn btn-danger text-white" @click="dersSil">Evet</button>
                    <button class="btn btn-outline-danger" data-dismiss="modal" ref="modal_kapat">Hayır</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!--Modal: modalConfirmDelete-->
</template>

<script>
export default {
name: "DersSilConfirm",
    props:['ders'],
    methods:{
    dersSil(){
        let self=this;
        axios.delete('/ders/sil/'+this.ders.id)
            .then(response=>{
                this.$emit('dersListele')
                self.$refs.modal_kapat.click()
            })
            .catch(errors=>{
            })
         }
    }
}
</script>

<style scoped>

</style>
