<template>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center " style="height: 100vh">
            <div class="login-form p-5 border border-5 bg-royal-blue text-white" style="border-radius: 2em;">
                <h1 class="text-center">Yönetici Girişi</h1>
                <div class="form-group">
                    <label>Email Adresi</label>
                    <input type="email" name="email" class="form-control" placeholder="Email adresiniz..." v-model="email">
                </div>
                <div class="form-group">
                    <label>Parola</label>
                    <input type="password" name="password" class="form-control" placeholder="Parolanız" v-model="password"  @keyup.enter="login">
                </div>
                <div class="form-group">
                    <uyari :uyari="uyari"></uyari>
                </div>
                <div class="form-group text-center">
                    <button  class="form-control btn btn-success col-lg-6 col-md-6 col-12" @click="login" >Giriş Yap</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    data(){
        return{
            email: '',
            password: '',
            uyari: {
                status:''
            }
        }
    },
    methods:{
        login() {
            let self=this;
            if (this.checkinput()){
                axios.post('/dashboard/post-login', {
                    email: this.email, password: this.password
                })
                    .then(response => {
                        if (response.data){
                            self.uyari=response.data
                        }
                        if (response.data.status=='success'){
                            window.location='/dashboard'
                        }
                    })
                    .catch(error => {
                        if (error.response.data){
                            self.uyari=error.response.data
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

<style scoped>

.login-form {
    width: 90%;
}
@media (min-width: 576px) {
    .login-form {
        width: 100%;
    }
}
@media (min-width: 768px) {
    .login-form {
        width:70%;
    }
}
@media (min-width: 1200px) {
    .login-form {
        width: 50%;
    }
}
.border-5{
    border-width: 5px!important;
}
</style>
