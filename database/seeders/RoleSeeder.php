<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ["name" => "Student", "value" => 1],
            ["name" => "Teacher", "value" => 2],
            ["name" => "Admin", "value" => 3],
        ];
        foreach ($roles as $role) {
            DB::insert('INSERT INTO roles (name, value) VALUES (?, ?)', [$role['name'], $role['value']]);
        }
    }
}
