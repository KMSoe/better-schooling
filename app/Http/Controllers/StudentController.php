<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StudentStoreRequest;
use App\Http\Requests\Student\StudentUpdateRequest;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    private $states = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14];
    private $nrcTypes = ['C', 'AC', 'NC', 'V', 'M', 'N'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('birth_date', function ($row) {
                    $date = date('M d, Y', strtotime($row->birth_date));
                    return $date;
                })
                ->addColumn('courses', function ($row) {
                    return $row->courses;
                })
                ->addColumn(
                    'actions',
                    function ($row) {
                        return '<a href = "' . route('students.edit', ['student' => $row->id]) . '"
                        class = "btn btn-info m-1"><i class="fas fa-edit"></i></a>
                       <a href="javascript:void(0)" onClick="deleteStudent(' . $row->id . ')" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
                    }
                )
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('students.index');
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
            'states' => $this->states,
            'nrcTypes' => $this->nrcTypes,
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

        if ($student) {
            $insertedStu = Student::where('email', $request->email)->first();

            $courseIds = explode(",", $request->courses);

            foreach ($courseIds as $id) {
                $insertedStu->courses()->attach(intval($id));
            }

            return redirect()->route('students.index')->with('info', 'Successfully added');
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
        $courses = Course::all();
        $nrcArr = explode('/', $student->nrc);
        $student->state = $nrcArr[0];
        $nrcNumArr = explode('(', $nrcArr[1]);
        $student->township = $nrcNumArr[0];
        $student->nrcType = explode(')', $nrcNumArr[1])[0];
        $student->nrcNumber = explode(')', $nrcNumArr[1])[1];
        $stuCourses = $student->courses->toArray();
        $stuCourseIds = array_map(function ($el) {
            return $el['id'];
        }, $stuCourses);

        return view('students.edit', [
            'courses' => $courses,
            "student" => $student,
            "stuCourseIds" => $stuCourseIds,
            'states' => $this->states,
            'nrcTypes' => $this->nrcTypes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentUpdateRequest $request, Student $student)
    {
        $user = User::where('email', $student->email)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $nrc = "$request->state/$request->township($request->type) $request->nrc_number";

        $student->name = $request->name;
        $student->email = $request->email;
        $student->birth_date = $request->birth_date;
        $student->nrc = $nrc;
        $courseIds = explode(",", $request->courses);
        
        // $currentCourses = DB::select(DB::raw('SELECT * FROM course_student WHERE student_id=?'), [$student->id]);
        
        // foreach ($currentCourses as $course) {
            DB::table('course_student')->where('student_id', $student->id)->delete();
        // }

        foreach ($courseIds as $id) {
            if ($id !== "") {
                $student->courses()->attach(intval($id));
            }
        }
        $result = $student->save();

        if ($result) {
            return redirect()->route('students.index')->with('info', 'Successfully Updated');
        }

        return back()->with('error', 'Something Went Wrong!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        User::where('email', $student->email)->first()->delete();
        $result = $student->delete();

        if ($result) {
            return response()->json([], 204);
        }

        return response()->json(["success" => false, "message" => "Something Went Wrong"], 500);
    }
}
