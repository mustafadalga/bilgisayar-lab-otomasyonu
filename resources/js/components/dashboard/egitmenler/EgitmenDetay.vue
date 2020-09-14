<template>
    <div class="card" >
        <div class="card-header card-up"> </div>
        <!-- Avatar -->
        <div class="avatar mx-auto">
            <img :src="egitmen.profil_resim ? '/images/egitmenler/'+egitmen.profil_resim : default_resim" class="rounded-circle"  alt="avatar">
        </div>

        <div class="card-body">
            <h4 class="card-title text-center"> {{ egitmen.adi}} {{ egitmen.soyadi}}</h4>
            <h4 class="text-center">
                <a v-if="egitmen.linkedin" :href="egitmen.linkedin" target="_blank" class="btn-floating "><i class="fab fa-linkedin-in"></i></a>
                <a v-if="egitmen.twitter" :href="egitmen.twitter" target="_blank" class="btn-floating"><i class="fab fa-twitter"></i></a>
                <a v-if="egitmen.website" :href="egitmen.website" target="_blank" class="btn-floating"><i class="fab fa-dribbble"></i></a>
            </h4>
            <div class="row">
                <div class="col">
                    <a  :href="'/dashboard/egitmen/duzenle/'+egitmen.slug" class="btn btn-indigo float-right">Profil Düzenle</a>
                </div>
            </div>
            <hr>
            <h3>Hakkında</h3>
            <p v-if="egitmen.hakkinda">{{ egitmen.hakkinda}}</p>
            <p v-else>Eğitmen hakkında bilgi yok.</p>

            <h3>Eğitim Bilgileri</h3>
            <p v-if="egitmen.egitim">
            <ul class="list-group  list-group-flush">
                <li class="list-group-item" v-for="egitim in egitmen.egitim">{{ egitim }}</li>
            </ul>
            </p>
            <p v-else>
                Eğitim eğitimi hakkında bilgi yok.
            </p>

            <h3>İletişim</h3>
            <p>
                <i class="fa fa-envelope"></i> <span>{{egitmen.email}}</span>
            </p>
            <p v-if="egitmen.telefon">
                <i class="fa fa-phone-alt"></i> <span>{{egitmen.telefon}}</span>
            </p>
            <p v-if="egitmen.website">
                <i class="fa fa-globe"></i> <span><a :href="egitmen.website" target="_blank">{{egitmen.website}}</a></span>
            </p>
            <p v-if="egitmen.linkedin">
                <i class="fab fa-linkedin-in"></i> <span><a :href="egitmen.linkedin" target="_blank">{{egitmen.linkedin}}</a></span>
            </p>
            <p v-if="egitmen.twitter">
                <i class="fab fa-twitter"></i> <span><a :href="egitmen.twitter" target="_blank">{{egitmen.twitter}}</a></span>
            </p>
        </div>
    </div>

</template>

<script>
export default {
    name: "EgitmenDetay",

    props:['egitmen'],
    data(){
        return{
            default_resim:'/images/user.png',
        }
    },
    mounted() {
    }
}
</script>

<style scoped>

</style>
