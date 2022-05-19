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
            "password" => bcrypt("11111111"),
            "role_id" => 3
        ]);
        
        \App\Models\User::factory(10)->create();
    }
}
