<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);

        User::create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("12345678"),
            "role_id" => 3
        ]);

        User::create([
            "name" => "Student Mg Mg",
            "email" => "student@gmail.com",
            "password" => bcrypt("12345678"),
            "role_id" => 2
        ]);
        
        \App\Models\User::factory(10)->create(["role_id" => 1]);
        \App\Models\User::factory(8)->create(["role_id" => 2]);

        $this->call(TeacherSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(StudentSeeder::class);
    }
}
