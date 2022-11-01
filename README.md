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
    2. php db:seed --class=department_seed
    3. php db:seed --class=employe_seed
    4. php db:seed --class=users_seed
    4. php db:seed --class=absents_seed
```

**When conducting seeding command, please do the command on sequential steps from 1-4 because the data contains foreign keys this can caused error if inserted first.**


## Database Crow Foot Relationship Diagram

This is relationship diagram used on this project, on this website will contain table such as :
 
1. Department Table to save Departement data (for now we keep it simple only save department name, but can be enhaced on future project)
2. Employee Table to save employee data and employee access
3. Users Table save web application user 
4. Absents table to save absents log. 

and for the relationship can be seen on this diagram 
![Skema Database Absensi Website](https://user-images.githubusercontent.com/58820833/199228900-854e8a21-62ca-4ec9-a660-1f4de3fdd91c.png)
