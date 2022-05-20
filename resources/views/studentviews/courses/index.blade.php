@extends('layouts.admin')

@section('title', 'My Course List')
@section('content-header', 'My Course List')

@section('content-actions')
<button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addCourseModal">Add Course</button>
@endsection
<!-- Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCourseModalLabel">Add Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('students.courses.store') }}" method="post" id="courseAddForm">
                    @csrf
                    <input type="hidden" name="courses" id="courses">
                </form>
                <div class="d-flex flex-wrap">
                    @foreach($courses as $course)
                    <span class="badge bg-secondary p-2 m-1 course" style="cursor: pointer;" data-id="{{ $course->id }}">{{ $course->name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="courseAddForm">Save</button>
            </div>
        </div>
    </div>
</div>

@section('content')
<table class="table table-striped table-bordered" id="courses-table">
    <thead>
        <tr>
            <th><i class="fas fa-user me-1"></i>Name</th>
            <th><i class="fas fa-at me-1"></i>Course Code</th>
            <th><i class="fas fa-book-open-reader me-1"></i>Teacher</th>
            <th><i class="fas fa-bars me-1"></i>Actions</th>
        </tr>
        <tr>
            <td>
                <input type="text" class="form-control filter-input" placeholder="Search Code ..." data-column="0">
            </td>
            <td>
                <input type="text" class="form-control filter-input" placeholder="Search Name ..." data-column="1">
            </td>
            <td>
                <input type="text" class="form-control filter-input" placeholder="Search Teacher ..." data-column="2">
            </td>
            <td></td>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
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

    function deattachCourse(courseId) {
        let url = "{{ route('students.courses.destroy', [':id']) }}";
        url = url.replace(':id', courseId);

        axios.delete(url, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(res => {
                $('#courses-table').DataTable().ajax.reload();
                showAlert('info', 'Deleted');
            })
            .catch(({
                response
            }) => {
                showAlert('warning', response.data.message);

            })
    }

    $(document).ready(function() {

        const table = $('#courses-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('students.courses.index') }}",
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'teacher',
                    name: 'teacher',
                },
                {
                    name: 'actions',
                    data: 'actions',
                },
            ]
        });

        $(".filter-input").keyup(function() {
            table.column($(this).data('column'))
                .search($(this).val())
                .draw();
        })
    });
</script>
@endsection