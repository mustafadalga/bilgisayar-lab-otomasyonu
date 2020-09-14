<template>
    <div class="row">
       <div class="col-lg-6 mx-auto">
           <div class="card">
               <div class="card-header bg-royal-blue text-white font-weight-bold">
                   Ayarlar
               </div>
               <div class="card-body">
                   <div class="form-group">
                       <label for="name">Adı Soyadı</label>
                       <input type="text" id="name" class="form-control" placeholder="Adı / Soyadı" v-model="admin.adi">
                   </div>
                   <div class="form-group">
                       <label for="email">Email</label>
                       <input type="email" id="email" class="form-control" placeholder="Email" v-model="admin.email">
                   </div>
                   <div class="form-group">
                       <label for="parola">Parola</label>
                       <input type="password" id="parola" class="form-control" placeholder="Parola" v-model="admin.parola">
                   </div>
                   <div class="form-group">
                       <label for="parola2">Parola</label>
                       <input type="password" id="parola2" class="form-control" placeholder="Parola Onay" v-model="admin.parola_onay">
                   </div>
                   <hr>
                   <div class="form-group">
                       <uyari :uyari="uyari"></uyari>
                   </div>
                   <div class="form-group d-flex">
                       <input type="password" class="form-control ml-auto mr-3" placeholder="Şuan ki parolanız" v-model="admin.aktif_parola">
                       <button class="btn btn-success pull-right" @click="kaydet">Kaydet</button>
                   </div>
               </div>
           </div>
       </div>
    </div>

</template>

<script>
export default {
    name: "Ayarlar",
    props:['user'],
    data(){
        return{
            admin:{
                adi:'',
                email:'',
                parola:'',
                parola_onay:'',
                aktif_parola:'',
                _method:'PUT'
            },
            id:null,
            uyari: {
                status:''
            }
        }
    },
    mounted() {
        let user=JSON.parse(this.user)
        this.admin.adi=user.name;
        this.admin.email=user.email;
        this.id=user.id
    },
    methods:{
        kaydet(){
            let self=this;
            axios.post('/yonetici/guncelle/'+this.id,this.admin)
            .then(response=>{
                self.uyari=response.data
                window.location='/dashboard'
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
