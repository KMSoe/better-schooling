# Better Schooling

## Table of contents
 <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
    </li>
    <li>
      <a href="#built-with">Built with</a>
    </li>
    <li>
      <a href="#get-started">Get started</a>
    </li>
    <li>
      <a href="#creater">Creater</a>
    </li>
  </ol>
  
### About the project
- This project is for the management of School Information.The system can store the information of students, teachers and their related courses. The data is retrieved using yajra datatable and is presented with jQuery datatables so filtering search, sorting features are available. A student can take many courses and a course can have many students so that is implemented with Many to Many relationship. For teacher-courses, it is with One to Many relationship. Most of the tasks are only authorized by admin. The admin can manage the information of the students, teachers, and courses. For the student view, there are courses that he has joined. At that page, the students can enroll more courses and can also resign their courses.


### Built with
- HTML5, CSS3, JavaScript
- jQuery datatables
- axios
- PHP
- Laravel 8
- yajra datatable
- Git as the version control system

### Get started

- clone the repository
  ```
  git clone https://github.com/KMSoe/better-schooling.git
  ```
- change directory to project folder and rename env file
  ```
   cd better-schooling
   rename .env.example .env
  ```
- create database naming as"better_schooling"
- Install Dependencies
  ```
  composer install or composer update
  npm install & npm run dev
  ```
- Application Key Generate
  ```
  php artisan key:generate
  ```
- Database Migrations and seeding
  ```
  php artisan migrate:fresh --seed
  ```
- Run the app
  ```
  php artisan serve
  ```
- For Admin interface
  - email: admin@gmail.com
  - password: 12345678
- For Student interface
  - email: student@gmail.com
  - password: 12345678
- Teacher section (Teacher addition, update) is being implemented in future.

### Creater
 - [Kaung Myat Soe](https://github.com/KMSoe)

