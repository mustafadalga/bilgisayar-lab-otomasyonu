<h1 align="center">Bilgisayar Laboratuvarı Otomasyonu</h1>

<p align="center">
  <a href="https://github.com/mustafadalga/bilgisayar-lab-otomasyonu">
    <img src="https://user-images.githubusercontent.com/25087769/93143117-f8341180-f6ef-11ea-9e15-6c029d6db2a1.png" alt="Bilgisayar Laboratuvarı Otomasyonu" width="300">
  </a>
</p>


## Açıklama 
**Üniversite veya lise gibi bilgisayar laboratuvarlarının kullanıldığı yerlerde , eğitimcilerin laboratuvarların ders oturumu gün ve saatlerini takip etmek için geliştirilen bir bilgisayar laboratuvar otomasyonudur.**

## Özellikler
  :large_blue_circle: **Sistemde adminler ve eğitmenler olarak iki tür kullanıcı bulunmaktadır.**  
  :large_blue_circle: **Laboratuvarlar ve dersler sadece admin tarafından eklenebilmektedir.**  
  :large_blue_circle: **Eğitmenler sisteme üye olarak ilgili laboratuvarlarda verdiği dersleri gün ve saat olarak belirleyerek oturum ekleyebilmektedir.**  
  :large_blue_circle: **Eğitmenler diğer eğitmenlerin ders oturumlarına müdahale edememektedir.**  
  :large_blue_circle: **Eğitmenler kendi ekledikleri ders oturumlarını düzenleyebilir veya silebilir.**  
  :large_blue_circle: **Sadece @marmara.edu.tr uzantılı adresler ile sisteme üye olunabilmektedir.E-mail domain adreslerini [buradan](https://github.com/mustafadalga/bilgisayar-lab-otomasyonu/blob/7049aed67531d2296fe5c8a55cb6ea8f531834e8/app/Http/Controllers/Auth/RegisterController.php#L57) değiştirebilirsiniz.**  
    :large_blue_circle: **Proje kurulumunda ilk admini eklemek için bir seçenek bulunmamaktadır.Bu yüzden bir eğitmen eklenip manuel olarak veritabanında users tablosunda kullanıcı rolü 1 olarak değiştirilerek yönetici yapılabilir.**  
  
## Demo
#### Örnek Admin 
  :small_blue_diamond:     **E-mail:** admin@example.com  **Parola:** LabOtomasyon :arrow_right: [Admin Paneli](https://labotomasyon.herokuapp.com/dashboard/login)
#### Örnek Eğitmen
  :small_blue_diamond: **E-mail:** mustafadalga@marmara.edu.tr  **Parola:** MustafaDalga :arrow_right: [Eğitmen Girişi](https://labotomasyon.herokuapp.com) 

## Kurulum
* #### 1. Composer bağımlılıklarını yükleme
 ```
composer install
```
* #### 2. NPM bağımlılıklarını yükleme
 ```
npm install
```
* #### 3. .env dosyasının kopyasını oluşturma
 ```
cp .env.example .env
```
* #### 4. APP_KEY uygulama şifreleme anahtarı oluşturma
 ```
php artisan key:generate
```
* #### 5. Veritabanı bilgilerini ekleme

> .env dosyasında **DB_CONNECTION**,**DB_HOST**,**DB_PORT**, **DB_DATABASE**, **DB_USERNAME** ve **DB_PASSWORD** değişkenlerini yeni oluşturduğunuz veritabanının kimlik bilgileriyle eşleşecek şekilde doldurun.

* #### 6. E-Mail yapılandırılması
> .env dosyasında **MAIL_DRIVER**,**MAIL_HOST**,**MAIL_PORT**, **MAIL_USERNAME**, **MAIL_PASSWORD** , **MAIL_ENCRYPTION** , **MAIL_FROM_ADDRESS** ve **MAIL_FROM_NAME** değişkenlerini değişkenlerini kendi bilgilerinize göre doldurun.


### Kullanılan Teknolojiler
 :small_blue_diamond: Laravel  
 :small_blue_diamond: PostgreSQL   
 :small_blue_diamond: Vue.js  
 :small_blue_diamond: Bootstrap    
 :small_blue_diamond: HTML    
 :small_blue_diamond: CSS  
 
 ## Proje Görüntüleri
 
:small_blue_diamond: Laboratuvar Oturumları

![ornek-lab](https://user-images.githubusercontent.com/25087769/93239285-3cc0bb00-f78b-11ea-8b6d-5fb2accee861.png)


:small_blue_diamond: Yönetici Paneli - Laboratuvarlar

![laboratuvarlar](https://user-images.githubusercontent.com/25087769/93150091-e3ac4500-f700-11ea-8e56-cf0b4bbda383.png)

:small_blue_diamond: Yönetici Paneli - Eğitmenler

![egitmenler](https://user-images.githubusercontent.com/25087769/93150090-e313ae80-f700-11ea-942a-86a2e89681b8.png)
 
:small_blue_diamond: Yönetici Paneli - Dersler

![dersler](https://user-images.githubusercontent.com/25087769/93150089-e1e28180-f700-11ea-846b-95dd909ad503.png)
