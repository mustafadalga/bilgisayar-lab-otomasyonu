<template>
<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-indigo">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link  text-white" href="/"><i class="fas fa-network-wired"></i> Laboratuvarlar </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/egitmenler"><i class="fas fa-users"></i> Eğitmenler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/dersler"><i class="fas fa-fw fa-book"></i> Dersler</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <ul class="navbar-nav float-right">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle  text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ egitmen.adi }}
                                <img :src="egitmen.profil_resim ? '/images/egitmenler/'+egitmen.profil_resim : default_resim" alt="" style="width: 2em;height:2em;border-radius: 50%">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" :href="'/egitmen/'+egitmen.slug">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    Profilim
                                </a>
                                <a class="dropdown-item" href="/ayarlar">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                    Ayarlar
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"  @click="logout">
                                    <i class="fas fa-sign-out-alt"> </i>
                                    Çıkış Yap
                                </a>
                            </div>
                        </li>
                    </ul>
                </form>


            </div>
        </div>
    </nav>
</div>
</template>

<script>
export default {
    name: "Navbar",
    data(){
        return{
        egitmen:{},
        default_resim:'/images/user.png',
        }
    },
    mounted() {
        this.aktifProfil()
    },
    methods:{
        aktifProfil(){
            axios.get('/egitmen/detay/aktif-egitmen')
            .then(response=>{
                this.egitmen=response.data.egitmen
            }) .catch(error => {
                console.log(error.response.data);
            })
        },
        logout(){
            axios.post('/logout', )
                .then(response => {
                    console.log(response.data.role);
                   window.location='/login'
                })
                .catch(error => {
                    console.log(error.response.data);
                })
        },
    }
}
</script>

<style scoped>

</style>
