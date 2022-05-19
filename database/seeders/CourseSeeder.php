<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            ["code" => "Mar-1101", "name" => "Myanmar", "teacher_id" => 1],
            ["code" => "E-1101", "name" => "English", "teacher_id" => 2],
            ["code" => "Math-1101", "name" => "Mathematics", "teacher_id" => 3],
            ["code" => "Ph-1101", "name" => "Physics", "teacher_id" => 4],
            ["code" => "Ch-1101", "name" => "Chemistry", "teacher_id" => 5],
            ["code" => "Bio-1101", "name" => "Biology", "teacher_id" => 6],
            ["code" => "Eco-1101", "name" => "Economic", "teacher_id" => 7],
        ];

        foreach ($courses as $course) {
            DB::insert('INSERT INTO courses (code, name, teacher_id) VALUES (?, ?, ?)', [$course['code'], $course['name'], $course['teacher_id']]);
        }
    }
}
