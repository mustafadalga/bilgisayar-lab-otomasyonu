<template>
    <!--Modal: modalConfirmDelete-->
    <div class="modal fade" id="laboratuvar-sil" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!--Content-->
            <div class="modal-content text-center">
                <!--Header-->
                <div class="modal-header d-flex justify-content-center bg-danger text-white">
                    <h3>  Laboratuvar Sil</h3>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <p>{{ lab.adi }} laboratuvarını silmek istediğinize emin misiniz ?</p>
                    <p>Laboratuvarı silmeniz durumunda laboratuvara ait bütün ders oturumları silinecektir.</p>
                    <i class="fas fa-times fa-4x text-danger"></i>
                    <uyari :uyari="uyari"></uyari>
                </div>

                <!--Footer-->
                <div class="modal-footer flex-center">
                    <button class="btn btn-danger text-white" @click="labSil">Evet</button>
                    <button class="btn btn-outline-danger" data-dismiss="modal">Hayır</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!--Modal: modalConfirmDelete-->
</template>


<script>
export default {
    name: "LaboratuvarSil",
    props:['lab'],
    data(){
        return{
            uyari:{
                status:''
            }
        }
    },
    methods:{
        labSil(){
            let self=this;
            axios.delete('/lab/sil/'+this.lab.id)
                .then(response=>{
                    self.uyari=response.data
                    setTimeout(function (){
                        window.location='/dashboard/laboratuvarlar'
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
