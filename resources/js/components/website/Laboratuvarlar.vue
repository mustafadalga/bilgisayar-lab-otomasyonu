<template>
    <div>
        <div class="row text-center">
            <h1 class="col">Laboratuvarlar</h1>
        </div>
        <hr class="bg-royal-blue border-5">
        <div class="row p-5" v-if="labs && labs.length>0">
            <div v-for="lab in labs"  class="col-6 lab p-0 bg-royal-blue border-right border-bottom" >
                <a :href="'/laboratuvar/'+lab.slug" class="w-100 h-100 p-5 text-decoration-none text-white d-flex align-items-center justify-content-center flex-column">
                    <i class="fas fa-network-wired fa-2x mb-1"></i>
                    <span>{{  lab.adi }}</span>
                </a>
            </div>
        </div>
        <div class="row mt-3 text-center" v-else >
            <div class="col">
                <h1>Laboratuvar Bulunmamaktadır.</h1>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Laboratuvarlar",
    props:['labs'],
}
</script>

<style scoped>
.lab{
    font-size: 2em;
    height:200px;
    transition: all 1s;
}
.lab:hover{
    background: var(--blue);
}
@media (max-width: 1000px) {
    .lab{
        font-size: 1em;
    }
}
</style>
