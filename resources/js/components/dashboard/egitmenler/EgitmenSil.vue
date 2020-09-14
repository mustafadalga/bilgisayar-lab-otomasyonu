<template>
    <!--Modal: modalConfirmDelete-->
    <div class="modal fade" id="egitmen-sil" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <!--Content-->
            <div class="modal-content text-center">
                <!--Header-->
                <div class="modal-header d-flex justify-content-center bg-danger text-white">
                  <h3>  Eğitmen Sil</h3>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <p >  {{  egitmen ? egitmen.adi: '' }} {{ egitmen ? egitmen.soyadi : '' }} eğitmenini silmek istediğinize emin misiniz ?</p>
                    <i class="fas fa-times fa-4x text-danger"></i>
                </div>

                <!--Footer-->
                <div class="modal-footer flex-center">
                    <button class="btn btn-danger text-white" @click="egitmenSil">Evet</button>
                    <a type="button" class="btn btn-outline-danger" data-dismiss="modal" ref="modal_kapat">Hayır</a>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!--Modal: modalConfirmDelete-->
</template>

<script>
export default {
name: "EgitmenSil",
    props:['egitmen'],
    methods:{
    egitmenSil(){
        let self=this;
        axios.delete('/egitmen/sil/'+this.egitmen.id)
            .then(response=>{
                this.$emit('egitmenListele')
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
