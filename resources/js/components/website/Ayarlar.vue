<template>

        <div class="card">
            <div class="card-header bg-royal-blue text-white font-weight-bold">
                Ayarlar
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex align-items-center  justify-content-between secim" :class="secimNo===1 ? 'bg-info' : ''" @click="secim(1)">Parola Değiştir <i class="fas fa-lg" :class="secimNo===1 && status ? 'fa-chevron-down' : 'fa-chevron-right'"></i></li>
                                <li class="list-group-item d-flex align-items-center justify-content-between secim" :class="secimNo===2 ? 'bg-info' : ''"  @click="secim(2)">Hesap Sil <i class="fas fa-lg" :class="secimNo===2 && status ? 'fa-chevron-down' : 'fa-chevron-right'"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 mobile-margin-top">
                        <parola-degistir-w v-if="secimNo===1" :user_id="user_id"></parola-degistir-w>
                        <hesap-sil-w v-else-if="secimNo===2" :user_id="user_id"></hesap-sil-w>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
$(window).resize(function() {
    causeRepaintsOn.css("z-index", 1);
});
export default {
    name: "Ayarlar",
    props:['user'],
    data(){
        return{
            secimNo:1,
            user_id:null,
            status:false
        }
    },
    created() {
        window.addEventListener("resize", this.resizeHandler);
    },
    mounted() {
        let user=JSON.parse(this.user)
        this.user_id=user.id
    },

    methods:{
        secim(secim){
            this.secimNo=secim
        },
        resizeHandler(){
            if(window.innerWidth<=578){
                this.status=true
            }else{
                this.status=false
            }
        }
    }
}
</script>

<style scoped>
.secim{
    cursor: pointer;
}
@media (max-width: 576px) {
    .mobile-margin-top{
        margin-top: 2em;
    }
}

</style>
