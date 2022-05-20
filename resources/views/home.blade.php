@extends('layouts.admin')

@section('title', 'Dashboard')
@section('content-header', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-4">
        <div class="card mb-3">
            <div class="card-body d-flex align-items-center">
                <h3 class="card-title h2 me-3">{{ $numOfStu }}</h3>
                <span class="text-success">
                    <i class="fas fa-users"></i>
                    Students
                </span>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card mb-3">
            <div class="card-body d-flex align-items-center">
                <h3 class="card-title h2 me-3">{{ $numOfTeachers }}</h3>
                <span class="text-success">
                    <i class="fas fa-user-tie"></i>
                    Teachers
                </span>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card mb-3">
            <div class="card-body d-flex align-items-center">
                <h3 class="card-title h2 me-3">{{ $numOfCourses }}</h3>
                <span class="text-success">
                    <i class="fas fa-th-large"></i>
                    Courses
                </span>
            </div>
        </div>
    </div>
</div>
@endsection