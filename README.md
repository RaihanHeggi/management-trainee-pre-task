## Attendance Monitoring Website
This website has main task to gather attendance data, beside that provide calculation of Early, Late, and Overwork and show attendance logs, we build this website based on Laravel 8 Framework, with Chart.JS for graph library, disclaimer this is not official version app of some business and still need enhancement.

## Application Requirement
1. Webserver 
2. PHP (version >=7.4) 
3. SQL Database

## Web Application Setup

### 1. .ENV Setup 
For ENV file configuration change this section to your database configurations, make sure you create database with name kb_insurance_absent first on your database management (PHPMyAdmin, SQLYog, or DBBeaver).

``` 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kb_insurance_absent
DB_USERNAME= MYSQL_USERNAME (XAMPP Default 'root')
DB_PASSWORD= MYSQL_PASSWORD (XAMPP Default '')
```

### 2. Running Migration and Seeder

After we create connection to database we need to create table structures and inserting basic data to accessing the website, you can running following command. 

```
    1. php artisan migrate (command to migrating database structure)
    2. php artisan db:seed --class=department_seed
    3. php artisan db:seed --class=employe_seed
    4. php artisan db:seed --class=users_seed
    4. php artisan db:seed --class=absents_seed
```

**When conducting seeding command, please do the command on sequential steps from 1-4 because the data contains foreign keys this can caused error if inserted first.**


### 3. Generate Application Key
APP_KEY needed to run application so we need to generate key, to generate key can be fullfilled by using ```php artisan key:generate```, then APP_KEY will be created on yout .env file

### 4. Application Runtime


## Website Feature


## Website Sneak Peak

### Login Frontpage
![Login Page](https://user-images.githubusercontent.com/58820833/199671089-df6ad084-ab47-4005-b2b6-11b591fa52e3.PNG)

### Checkin and Checkout Page
![Absen Page](https://user-images.githubusercontent.com/58820833/199671111-0c2e0ae3-06ca-4168-bf78-9117482f72d8.PNG)

### Users Personal Attendance Statistics
![Main Dashboard](https://user-images.githubusercontent.com/58820833/199671130-8cc4a2db-775e-4ce1-9c5c-6ec0bca4bc5e.PNG)

### All Users Attendance Statistics
![Statistics](https://user-images.githubusercontent.com/58820833/199671148-f32af3ed-6157-4a7b-b990-628ba07bb6e2.PNG)



## Database Crow Foot Relationship Diagram

This is relationship diagram used on this project, on this website will contain table such as :
 
1. Department Table to save Departement data (for now we keep it simple only save department name, but can be enhaced on future project)
2. Employee Table to save employee data and employee access
3. Users Table save web application user 
4. Absents table to save absents log. 

and for the relationship can be seen on this diagram 
![Skema Database Absensi Website](https://user-images.githubusercontent.com/58820833/199228900-854e8a21-62ca-4ec9-a660-1f4de3fdd91c.png)



### Running Development 
The Example of this website can be seen on this [Link](http://kb-attendance.herokuapp.com/), this website will always live as long as Heroku Postgres Database not deactivated. 
