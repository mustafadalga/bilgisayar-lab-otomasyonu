<template>
        <div class="row">
            <div class="col">
                <div class="mx-auto text-center">
                    <div class="card-up"></div>
                    <div class="avatar mx-auto">
                        <img :src="default_resim" class="rounded-circle" alt="avatar"/>
                    </div>
                    <h6 class="my-4">Yeni bir profil resmi yükle</h6>
                    <div class="w-50 input-group px-xl-4 mx-auto">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile02" name="img" @change="resimSec" accept="image/x-png,image/gif,image/jpeg">
                            <label class="custom-file-label" for="inputGroupFile02" >Profil Resmi Seç</label>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-secondary"><i class="fa fa-upload"></i></button>
                        </div>
                    </div>
                </div>
                <hr>
                <form class="mt-5">
                    <h3>Kişisel Bilgiler</h3>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Adı Soyadı </label>
                        <div class="col-lg-9">
                            <input  name="adi" class="form-control" type="text" v-model="adi" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Hakkında</label>
                        <div class="col-lg-9">
                            <textarea name="hakkinda" class="form-control " type="text" rows="6"  v-model="hakkinda"/>
                        </div>
                    </div>
                    <h3>İletişim Bilgileri</h3>
                    <hr>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                        <div class="col-lg-9">
                            <input name="email" class="form-control" type="email"  v-model="email"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Telefon</label>
                        <div class="col-lg-9">
                            <input name="tel" class="form-control" type="tel"  v-model="tel" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Linkedin</label>
                        <div class="col-lg-9">
                            <input name="linkedin" class="form-control" type="text"  v-model="linkedin" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Web Site</label>
                        <div class="col-lg-9">
                            <input name="website" class="form-control" type="text"  v-model="website" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Twitter</label>
                        <div class="col-lg-9">
                            <input name="twitter" class="form-control" type="text"  v-model="twitter" />
                        </div>
                    </div>
                    <h3>Eğitim Bilgileri</h3>
                    <hr>
                    <div class="input-group control-group after-add-more">
                        <input type="text" name="egitim[]" class="form-control" placeholder="Eğitim bilgisi giriniz" v-model="egitim[0]">
                        <div class="input-group-btn">
                            <button class="btn btn-primary add-more" type="button" @click="egitimEkle"><i class="glyphicon glyphicon-plus"></i> Ekle</button>
                        </div>
                    </div>
                    <div class="inputArea" v-for="(input,index) in egitimInput">
                        <div class="control-group input-group mt-2">
                            <input type="text" name="egitim[]" class="form-control" placeholder="Eğitim bilgisi giriniz" v-model="egitim[index+1]">
                            <div class="input-group-btn">
                                <button class="btn btn-danger remove" type="button" @click="egitimKaldir(index)"><i class="glyphicon glyphicon-remove"></i> Sil</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group w-50 mx-auto mt-3">
                        <uyari :uyari="uyari"></uyari>
                    </div>
                    <div class="form-group row mt-5">
                        <button class="btn btn-success btn-lg mx-auto" @click.prevent="profilTamamla">Profil Bilgilerini Kaydet</button>
                    </div>
                </form>
            </div>
    </div>
</template>

<script>
export default {
    name: "EgitmenDuzenle",
    props:['egitmen'],
    data(){
       return{
           default_resim:'/images/user.png',
           egitimInput:[],
           adi:'',
           hakkinda:'',
           profil_resim:'',
           email:'',
           tel:'',
           website:'',
           linkedin:'',
           twitter:'',
           egitim:[],
           uyari: {
               status:''
           }
       }
    },
    mounted() {
            this.adi=this.egitmen.adi
            this.hakkinda=this.degerVarMi(this.egitmen.hakkinda)
            this.email=this.degerVarMi(this.egitmen.email)
            this.tel=this.degerVarMi(this.egitmen.tel)
            this.website=this.degerVarMi(this.egitmen.website)
            this.linkedin=this.degerVarMi(this.egitmen.linkedin)
            this.twitter=this.degerVarMi(this.egitmen.twitter)
            if (this.egitmen.egitim) {
                this.egitim=this.egitmen.egitim
                this.egitim.forEach(()=>{
                    this.egitimInput.push('')
                })
            }
            if (this.egitmen.profil_resim) {
                this.default_resim='/images/egitmenler/'+this.egitmen.profil_resim
            }
    },
    methods:{
        egitimEkle() {
            this.egitimInput.push('')
        },
        egitimKaldir(index) {
            this.egitim.splice(index+1,1)
            this.egitimInput.splice(index,1);
        },
        degerVarMi(veri){
            return veri ? veri : '';
        },
        profilTamamla(){
            let self=this;
            const formData = new FormData();
            formData.append('adi', this.adi);
            formData.append('hakkinda', this.hakkinda);
            formData.append('profil_resim', this.profil_resim);
            formData.append('email', this.email);
            formData.append('tel', this.tel);
            formData.append('website', this.website);
            formData.append('linkedin', this.linkedin);
            formData.append('twitter', this.twitter);
            formData.append('_method','PUT');
            this.egitim.forEach(egitim=>{
                formData.append('egitim[]', egitim);
            })
            axios.post('/egitmen/guncelle/'+self.egitmen.id,formData)
                .then(response=>{
                   // console.log(response.data)
                    self.uyari=response.data
                    setTimeout(()=>{
                    window.location = "/dashboard/egitmenler"
                    },1000)
                })
                .catch(errors=>{
               //     console.log(errors.response.data)

                    self.uyari=errors.response.data
                })
        },
        resimSec(e) {
            const file = e.target.files[0];
            this.profil_resim=file;
            this.default_resim = URL.createObjectURL(file);
        },
    }
}
</script>

<style scoped>

</style>
