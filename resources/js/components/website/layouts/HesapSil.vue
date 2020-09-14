<template>
    <div class="card">
        <div class="card-header bg-royal-blue text-white  font-weight-bold">
            Hesap Silme
        </div>
        <div class="card-body">
            <p>
                Bu seçenek hesabınızı devre dışı bırakacak.
            </p>
            <p>
                Hesabınızı devre dışı bırakmanız halinde hesap bilgileriniz ve hesabınıza ait tüm laboratuvar oturumları silinecektir.
            </p>
            <div class="form-group">
                <uyari :uyari="uyari"></uyari>
            </div>
            <button type="button" class="btn btn-danger float-right" @click="hesapSil">Hesap Sil</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "HesapSil",
    props:['user_id'],
    data(){
        return{
            uyari: {
                status:''
            }
        }
    },
    methods:{
        hesapSil(){
            let self=this;
            axios.delete('/ayarlar/hesap-sil/'+this.user_id)
            .then(response=>{
                console.log(response.data)
                self.uyari={
                    status:'success',
                    message:["Hesabınız başarıyla silindi."]
                }
                setTimeout(()=>{
                   window.location="/"
                },1000)


            })
            .catch(error=>{
                console.log(error.response.data)
                self.uyari={
                    status:'success',
                    message:["Hesabınız başarıyla silindi."]
                }
                setTimeout(()=>{
                    window.location="/"
                },1000)
            })
        }
    }
}
</script>

<style scoped>

</style>
