<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role_id', 2)->get();
        
        foreach ($users as $user) {
            Teacher::create([
                "name" => $user->name,
                "email" => $user->email,
            ]);
        }
    }
}
