<template>
        <div class="d-flex justify-content-center align-items-center " style="height: 100vh">
            <div class="auth-form px-5 py-2 border border-5 bg-royal-blue text-white" style="border-radius: 2em;">
                <h1 class="text-center auth-form-title">Eğitmen Kayıt Ol</h1>
                <div class="form-group">
                    <label>Adı Soyadı </label>
                    <input type="text" name="name" class="form-control" placeholder="Adı" v-model="user.name">
                </div>
                <div class="form-group">
                    <label>Email Adresi</label>
                    <input type="email" name="email" class="form-control" placeholder="Email adresiniz..." v-model="user.email">
                </div>
                <div class="form-group">
                    <label>Parola</label>
                    <input type="password" name="password" class="form-control" placeholder="Parolanız" v-model="user.password">
                </div>
                <div class="form-group">
                    <label>Parola Onay</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Parolanız Onay" v-model="user.password_confirmation">
                </div>
                <div class="form-group">
                    <uyari :uyari="uyari"></uyari>
                </div>
                <div class="form-group clearfix ">
                    <a href="/login" class="float-left text-white text-decoration-none">Giriş Yap</a>
                    <a href="/password/reset" class="float-right text-white  text-decoration-none">Parolanızı mı unuttunuz ?</a>
                </div>
                <span >Kayıt onayı için kullandığınız email adresinize doğrulama bağlantısı gönderilecektir.</span>
                <div class="form-group text-center">
                    <button  class="form-control btn btn-success  col-lg-6 col-md-6 col-12" @click="register" >Kayıt Ol</button>
                </div>
            </div>
        </div>
</template>
<script>
export default {
    name: "Register",
    data(){
        return{
            user:{
                name:'',
                email:'',
                password:'',
                password_confirmation:''
            },
            uyari: {
                status:''
            }
        }
    },
    methods:{
        checkinput(){
            if(this.user.name.trim()==='' || this.user.email.trim()==='' || this.user.password.trim()==='' || this.user.password_confirmation.trim()===''){
                return false
            }else{
                return true
            }
        },
        register(){
            if(this.checkinput()){
                let self=this;
                axios.post('/register', this.user)
                    .then(response => {
                        console.log(response)
                        self.uyari={
                            status:'success',
                            message:["Başarıyla kayıt işlemi tamamlandı."]
                        }
                       setTimeout(()=>{
                           window.location='/login'
                       },1000)
                    })
                    .catch(error => {
                        self.uyari={
                            status:'danger',
                            message:error.response.data.errors
                        }
                        console.log(error.response.data);
                    })
            }else{
                this.uyari={
                    status:'danger',
                    message:['Lütfen boş alanları doldurun!']
                }
            }

        }
    }
}
</script>
<style>
</style>
