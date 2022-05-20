<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $students = Student::all();
        $teachers = Teacher::all();
        $courses = Course::all();

        return view('home', [
            "numOfStu" => count($students),
            "numOfTeachers" => count($teachers),
            "numOfCourses" => count($courses),
        ]);
    }
}
