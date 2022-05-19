<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StudentStoreRequest;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        
        return view('students.index', [
            'students' => $students,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();

        return view('students.create', [
            'courses' => $courses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentStoreRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            "role_id" => 1
        ]);
        
        $nrc = "$request->state/$request->township($request->type) $request->nrc_number";

        $student = DB::insert('INSERT INTO students (name, email, nrc, birth_date, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())', [$request->name, $request->email, $nrc, $request->birth_date]);

        if($student) {
            $insertedStu = Student::where('email', $request->email)->first();

            $courseIds = explode(",", $request->courses);

            foreach ($courseIds as $id) {
                // DB::insert('INSERT INTO course_student (course_id, student_id, created_at, updated_at) VALUES (?, ?, NOW(), NOW())', [intval($id), $insertedStu->id]);
                $insertedStu->courses()->attach(intval($id));
            }

            return redirect()->route('students.index')->with('success', 'Successfully added');
        }

        return back()->with('error', 'Something Went Wrong!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
