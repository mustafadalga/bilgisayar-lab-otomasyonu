/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
import VueNotification from "vue-notification";
Vue.use(VueNotification)
Vue.config.productionTip = false


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('sidebar-d', require('./components/dashboard/layouts/SideBar').default);
Vue.component('navbar-d', require('./components/dashboard/layouts/Navbar').default);
Vue.component('footer-d', require('./components/dashboard/layouts/Footer').default);
Vue.component('login-d', require('./components/dashboard/Login').default);
Vue.component('dersler-d', require('./components/dashboard/dersler/Dersler').default);
Vue.component('ders-ekle-d', require('./components/dashboard/dersler/DersEkle').default);
Vue.component('ders-detay-d', require('./components/dashboard/dersler/DersDetay').default);
Vue.component('ders-duzenle-d', require('./components/dashboard/dersler/DersDuzenle').default);
Vue.component('ders-sil-d', require('./components/dashboard/dersler/DersSil').default);
Vue.component('egitmenler-d', require('./components/dashboard/egitmenler/Egitmenler').default);
Vue.component('egitmen-detay-d', require('./components/dashboard/egitmenler/EgitmenDetay').default);
Vue.component('egitmen-duzenle-d', require('./components/dashboard/egitmenler/EgitmenDuzenle').default);
Vue.component('egitmen-sil-d', require('./components/dashboard/egitmenler/EgitmenSil').default);
Vue.component('laboratuvarlar-d', require('./components/dashboard/laboratuvarlar/Laboratuvarlar').default);
Vue.component('laboratuvar-ekle-d', require('./components/dashboard/laboratuvarlar/LaboratuvarEkle').default);
Vue.component('laboratuvar-detay-d', require('./components/dashboard/laboratuvarlar/LaboratuvarDetay').default);
Vue.component('laboratuvar-duzenle-d', require('./components/dashboard/laboratuvarlar/LaboratuvarDuzenle').default);
Vue.component('laboratuvar-sil-d', require('./components/dashboard/laboratuvarlar/LaboratuvarSil').default);
Vue.component('oturum-ekle-d', require('./components/dashboard/laboratuvarlar/OturumEkle').default);
Vue.component('oturum-duzenle-d', require('./components/dashboard/laboratuvarlar/OturumDuzenle').default);
Vue.component('yoneticiler-d', require('./components/dashboard/yoneticiler/Yoneticiler').default);
Vue.component('yonetici-ekle-d', require('./components/dashboard/yoneticiler/YoneticiEkle').default);
Vue.component('yonetici-sil-d', require('./components/dashboard/yoneticiler/YoneticiSil').default);
Vue.component('ayarlar-d', require('./components/dashboard/yoneticiler/Ayarlar').default);
Vue.component('navbar-w', require('./components/website/layouts/Navbar').default);
Vue.component('ayarlar-w', require('./components/website/Ayarlar').default);
Vue.component('login-w', require('./components/website/auth/Login').default);
Vue.component('register-w', require('./components/website/auth/Register').default);
Vue.component('parola-degistir-w', require('./components/website/layouts/ParolaDegistir').default);
Vue.component('hesap-sil-w', require('./components/website/layouts/HesapSil').default);
Vue.component('dersler-w', require('./components/website/Dersler').default);
Vue.component('egitmenler-w', require('./components/website/Egitmenler').default);
Vue.component('egitmen-detay-w', require('./components/website/EgitmenDetay').default);
Vue.component('egitmen-duzenle-w', require('./components/website/EgitmenDuzenle').default);
Vue.component('laboratuvarlar-w', require('./components/website/Laboratuvarlar').default);
Vue.component('laboratuvar-detay-w', require('./components/website/LaboratuvarDetay').default);
Vue.component('oturum-ekle-w', require('./components/website/OturumEkle').default);
Vue.component('oturum-duzenle-w', require('./components/website/OturumDuzenle').default);
Vue.component('uyari', require('./components/Uyari').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
