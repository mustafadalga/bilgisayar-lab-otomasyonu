<h1 align="center">Computer Lab Automation</h1>

<p align="center">
  <a href="https://github.com/mustafadalga/bilgisayar-lab-otomasyonu">
    <img src="https://user-images.githubusercontent.com/25087769/93143117-f8341180-f6ef-11ea-9e15-6c029d6db2a1.png" alt="Bilgisayar Laboratuvarı Otomasyonu" width="300">
  </a>
</p>

**A computer lab automation system developed for educational institutions such as universities or high schools, to allow educators to monitor the day and hour of the lab sessions. The system can also be used for classes/lecture halls in the same manner.**

## Özellikler
  :large_blue_circle: **The system has two types of users: admins and instructors.**  
  :large_blue_circle: **Labs and courses can only be added by the admin.**  
  :large_blue_circle: **Instructors can join the system, specify the days and hours of their courses in the relevant labs, and add sessions.**  
  :large_blue_circle: **Instructors cannot interfere with other instructors' course sessions.**  
  :large_blue_circle: **Instructors can edit or delete the course sessions they have added.**  
  :large_blue_circle: **The system only accepts memberships from @marmara.edu.tr extension addresses.You can change email domain addresses [from](https://github.com/mustafadalga/bilgisayar-lab-otomasyonu/blob/7049aed67531d2296fe5c8a55cb6ea8f531834e8/app/Http/Controllers/Auth/RegisterController.php#L57) here.**  
  :large_blue_circle: **The project setup does not include an option to add the first admin. Therefore, an instructor can be added and manually changed to an administrator in the users table in the database by changing the user role to 1.**  
  
## Demo
#### Admin Login
  :small_blue_diamond:     **E-mail:** admin@example.com  **Password:** LabOtomasyon :arrow_right: [Admin](https://labotomasyon.herokuapp.com/dashboard/login)
#### Instructor Login
  :small_blue_diamond: **E-mail:** mustafadalga@marmara.edu.tr  **Parola:** MustafaDalga :arrow_right: [Instructor Login](https://labotomasyon.herokuapp.com) 

## Installation
* ####  Install Composer dependencies
 ```
composer install
```
* #### Install NPM dependencies
 ```
npm install
```
* #### Create a copy of .env file
 ```
cp .env.example .env
```
* #### Generate APP_KEY encryption key
 ```
php artisan key:generate
```

* #### Add database information
> In the .env file, fill the DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD variables to match the credentials of your newly created database.

* #### E-Mail configuration
> Fill the MAIL_DRIVER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD , MAIL_ENCRYPTION , MAIL_FROM_ADDRESS and MAIL_FROM_NAME variables in the .env file according to your information.


### Used Technologies
 :small_blue_diamond: Laravel  
 :small_blue_diamond: PostgreSQL   
 :small_blue_diamond: Vue.js  
 :small_blue_diamond: Bootstrap    
 :small_blue_diamond: HTML    
 :small_blue_diamond: CSS  
 
 ## Project Images
 
:small_blue_diamond: Lab Sessions

![ornek-lab](https://user-images.githubusercontent.com/25087769/93239285-3cc0bb00-f78b-11ea-8b6d-5fb2accee861.png)


:small_blue_diamond:  Admin Panel - Labs

![laboratuvarlar](https://user-images.githubusercontent.com/25087769/93150091-e3ac4500-f700-11ea-8e56-cf0b4bbda383.png)

:small_blue_diamond: Admin Panel - Instructors

![egitmenler](https://user-images.githubusercontent.com/25087769/93150090-e313ae80-f700-11ea-942a-86a2e89681b8.png)
 
:small_blue_diamond: Admin Panel - Lessons

![dersler](https://user-images.githubusercontent.com/25087769/93150089-e1e28180-f700-11ea-846b-95dd909ad503.png)


## License
 [![License](https://img.shields.io/github/license/mustafadalga/bilgisayar-lab-otomasyonu)](https://github.com/mustafadalga/bilgisayar-lab-otomasyonu/blob/master/LICENSE)



