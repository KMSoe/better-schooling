<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\CourseStoreRequest;
use App\Http\Requests\Course\CourseUpdateRequest;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Course::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('teacher', function ($row) {
                    return $row->teacher->name;
                })
                ->addColumn(
                    'actions',
                    function ($row) {
                        return '<a href = "' . route('courses.edit', ['course' => $row->id]) . '"
                        class = "btn btn-info m-1"><i class="fas fa-edit"></i></a>
                        <form action="' . route('courses.destroy', ['course' => $row->id]) . '" method="DELETE" class="d-inline"><button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
        </form>';
                    }
                )
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('courses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::all();

        return view('courses.create', [
            'teachers' => $teachers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseStoreRequest $request)
    {
        $course = new Course();
        $course->code = $request->code;
        $course->name = $request->name;
        $course->teacher_id = $request->teacher_id;
        $result = $course->save();

        if ($result) {
            return redirect()->route('courses.index')->with('success', 'Successfully added');
        }

        return back()->with('error', 'Something Went Wrong!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $teachers = Teacher::all();

        return view('courses.edit', [
            'course' => $course,
            'teachers' => $teachers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseUpdateRequest $request, Course $course)
    {
        $course->code = $request->code;
        $course->name = $request->name;
        $course->teacher_id = $request->teacher_id;
        $result = $course->save();

        if ($result) {
            return redirect()->route('courses.index')->with('success', 'Successfully updated');
        }

        return back()->with('error', 'Something Went Wrong!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
