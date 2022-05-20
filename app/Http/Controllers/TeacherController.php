<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Teacher::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('courses', function ($row) {
                    return $row->courses;
                })
                ->addColumn(
                    'actions',
                    function ($row) {
                        return '<a href = "' . route('teachers.edit', ['teacher' => $row->id]) . '"
                        class = "btn btn-info m-1"><i class="fas fa-edit"></i></a>
                        <form action="' . route('teachers.destroy', ['teacher' => $row->id]) . '" method="DELETE" class="d-inline"><button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
        </form>';
                    }
                )
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('teachers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
