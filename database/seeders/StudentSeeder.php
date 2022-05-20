<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role_id', 1)->get();

        foreach ($users as $user) {
            \App\Models\Student::factory(1)->create(["name" => $user->name, 'email' => $user->email]);
        }
    }
}
