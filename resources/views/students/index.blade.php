@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Student List</h3>
    <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th><i class="fas fa-user me-1"></i>Name</th>
                <th><i class="fas fa-calendar-day me-1"></i>Date of Birth</th>
                <th><i class="fas fa-at me-1"></i>Email</th>
                <th><i class="fas fa-flag me-1"></i>NRC</th>
                <th><i class="fas fa-book-open-reader me-1"></i>Courses</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $stu)
            <tr>
                <td>{{ $stu->name }}</td>
                <td>{{ $stu->birth_date }}</td>
                <td>{{ $stu->email }}</td>
                <td>{{ $stu->nrc }}</td>
                <td>
                    @foreach($stu->courses as $course)
                    <span class="badge bg-primary p-2 m-1 course">{{ $course->name }}</span>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
@endsection