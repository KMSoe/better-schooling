@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Student') }} <a href="{{ route('students.index') }}" class="btn btn-primary float-end">back</a></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('students.store') }}" id="add-student-form">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('NRC') }}</label>

                            <div class="col-md-6">
                                <div class="row g-1">
                                    <div class="col-2">
                                        <select name="state" id="state" class="form-control">
                                            <option value="1" selected>1&nbsp;/</option>
                                            <option value="2">2/</option>
                                            <option value="3">3/</option>
                                            <option value="4">4/</option>
                                            <option value="5">5/</option>
                                            <option value="6">6/</option>
                                            <option value="7">7/</option>
                                            <option value="8">8/</option>
                                            <option value="9">9/</option>
                                            <option value="10">10/</option>
                                            <option value="11">11/</option>
                                            <option value="12">12/</option>
                                            <option value="13">13/</option>
                                            <option value="14">14/</option>
                                        </select>
                                    </div>
                                    <div class="col-4 d-flex">
                                        <input type="text" name="township" class="form-control">
                                    </div>
                                    <div class="col-2">
                                        <select name="type" class="form-control col-1">
                                            <option value="N">( C )</option>
                                            <option value="AC">( AC )</option>
                                            <option value="NC">( NC )</option>
                                            <option value="V">( V )</option>
                                            <option value="M">( M )</option>
                                            <option value="N">( N )</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" name="nrc_number" class="form-control">
                                    </div>
                                </div>

                                @error('nrc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="birth-date" class="col-md-4 col-form-label text-md-end">{{ __('Date Of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="birth-date" type="date" class="form-control @error('birth-date') is-invalid @enderror" name="birth_date" value="{{ old('birth-date') }}" required>

                                @error('birth_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="courses" class="col-md-4 col-form-label text-md-end">{{ __('Courses') }}</label>

                            <input type="hidden" name="courses" id="courses">
                            <div class="col-md-6">
                                <div class="d-flex flex-wrap">
                                    @foreach($courses as $course)
                                    <span class="badge bg-secondary p-2 m-1 course" style="cursor: pointer;" data-id="{{ $course->id }}">{{ $course->name }}</span>
                                    @endforeach
                                </div>

                                @error('courses')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    const coursesInput = document.getElementById('courses');
    const selectCourseBtns = document.querySelectorAll('.course');
    const coursesSelected = [];

    selectCourseBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            e.target.classList.toggle('bg-secondary');
            e.target.classList.toggle('bg-primary');

            const courseId = e.target.dataset.id;
            if (coursesSelected.includes(courseId)) {
                coursesSelected.splice(coursesSelected.indexOf(courseId), 1);
                return;
            }

            coursesSelected.push(courseId);

            coursesInput.value = coursesSelected;
        })
    });
    $("#datepicker").datepicker();
</script>
@endsection