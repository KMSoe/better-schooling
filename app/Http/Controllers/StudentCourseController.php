<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class StudentCourseController extends Controller
{
    public function index(Request $request)
    {
        $student_id = Student::where('email', $request->user()->email)->first()->id;
        if ($request->ajax()) {
            $data = Student::where('email', $request->user()->email)->first()->courses;

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('teacher', function ($row) {
                    return $row->teacher->name;
                })
                ->addColumn(
                    'actions',
                    function ($row) {
                        return '<a href="javascript:void(0)" onClick="deattachCourse(' . $row->id . ')" class="btn btn-danger"><i class="fas fa-trash"></i></a>';
                    }
                )
                ->rawColumns(['actions'])
                ->make(true);
        }

        $stuCourseIds = array_map(function ($el) {
            return $el->id;
        }, DB::table('course_student')->where('student_id', $student_id)->select(DB::raw('course_id AS id'))->get()->toArray());
        $courses = Course::whereNotIn('id', $stuCourseIds)->get();

        return view('studentviews.courses.index', [
            "courses" => $courses,
        ]);
    }

    public function store(Request $request)
    {
        $student = Student::where('email', $request->user()->email)->first();

        $courseIds = explode(",", $request->courses);

        foreach ($courseIds as $id) {
            if ($id !== "") {
                $student->courses()->attach(intval($id));
            }
        }

        return redirect()->route('students.courses.index')->with('info', 'Course added');
    }

    public function destroy(Request $request)
    {
        $student_id = Student::where('email', $request->user()->email)->first()->id;

        $result = DB::delete('DELETE FROM course_student WHERE course_id=? AND student_id=?', [$request->id, $student_id]);

        if ($result) {
            return response()->json([], 204);
        }

        return response()->json(["success" => false, "message" => "Something Went Wrong"], 500);
    }
}
