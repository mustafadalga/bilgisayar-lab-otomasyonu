<template>
    <div class="card">
        <div class="card-header bg-royal-blue text-white  font-weight-bold">
            Parola Değiştirme
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Aktif Parola</label>
                <input type="password" class="form-control" v-model="user.aktif_parola">
            </div>
            <div class="form-group">
                <label>Yeni Parola</label>
                <input type="password" class="form-control" v-model="user.parola">
            </div>
            <div class="form-group">
                <label>Yeni Parola Onay</label>
                <input type="password" class="form-control" v-model="user.parola_onay">
            </div>
            <div class="form-group">
                <uyari :uyari="uyari"></uyari>
                </div>
            <button type="submit" class="btn btn-primary float-right" @click="kaydet">Kaydet</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "ParolaDegistir",
    props:['user_id'],
    data(){
        return{
            user:{
                parola:'',
                parola_onay:'',
                aktif_parola:'',
                _method:'PUT'
            },
            uyari: {
                status:''
            },
        }
    },
    methods:{
        kaydet(){
            let self=this;
            axios.post('/ayarlar/parola-degistir/'+this.user_id,this.user)
                .then(response=>{
                    self.uyari=response.data
                    setTimeout(()=>{
                        if (response.data.status==="success"){
                            window.location="/"
                        }
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
