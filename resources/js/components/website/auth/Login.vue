<template>
        <div class="d-flex justify-content-center align-items-center " style="height: 100vh">
            <div class="auth-form p-5 border border-5 bg-royal-blue text-white" style="border-radius: 2em;">
                <h1 class="text-center auth-form-title">Eğitmen Giriş Yap</h1>
                <div class="form-group">
                    <label>Email Adresi</label>
                    <input type="email" name="email" class="form-control" placeholder="Email adresiniz..." v-model="email">
                </div>
                <div class="form-group">
                    <label>Parola</label>
                    <input type="password" name="password" class="form-control" placeholder="Parolanız" v-model="password" @keyup.enter="login">
                </div>
                <div class="form-group">
                    <uyari :uyari="uyari"></uyari>
                </div>
                <div class="form-group clearfix ">
                    <a href="/register" class="float-left text-white text-decoration-none">Kayıt Ol</a>
                    <a href="/password/reset" class="float-right text-white  text-decoration-none">Parolanızı mı unuttunuz ?</a>
                </div>
                <div class="form-group text-center">
                    <button  class="form-control btn btn-success col-lg-6 col-md-6 col-12" @click="login" >Giriş Yap</button>
                </div>
            </div>
        </div>
</template>

<script>
export default {
    name: "Login",
    props:['password_reset_status'],
    data(){
        return{
            email: '',
            password: '',
            uyari: {
                status:''
            }
        }
    },
    mounted() {
        if (this.password_reset_status){
            this.uyari.status="success"
            this.uyari.message=[this.password_reset_status]
        }
    },
    methods:{
        login() {
            let self=this;
            if (this.checkinput()){
                axios.post('/login', {
                    email: this.email, password: this.password
                })
                    .then(response => {
                        console.log(response.data.errors)
                        self.uyari={
                            status:'success',
                            message:["Başarıyla giriş yapıldı."]
                        }
                        window.location='/home'
                    })
                    .catch(error => {
                        console.log(error.response.data.errors);
                        self.uyari={
                            status:'danger',
                            message:error.response.data.errors
                        }
                    })

            }else{
                this.uyari={
                    status:'danger',
                    message:['Lütfen boş alanları doldurun!']
                }
            }
        },
        checkinput(){
            if(this.email.trim()==='' || this.password.trim()===''){
                return false
            }else{
                return true
            }
        },
    }
}
</script>
