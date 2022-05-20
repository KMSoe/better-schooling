<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StudentCourseController extends Controller
{
    public function index(Request $request)
    {
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
                        return '<form action="" method="DELETE" class="d-inline"><button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
        </form>';
                    }
                )
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('studentviews.courses.index');
    }
}
