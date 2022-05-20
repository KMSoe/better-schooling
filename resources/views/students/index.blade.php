@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-5">Student List <a href="{{ route('students.create') }}" class="btn btn-primary float-end">Add Student</a></h3>

    @if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-warning">
        {{ session('error') }}
    </div>
    @endif

    <table class="table table-striped table-bordered" id="students-table">
        <thead>
            <tr>
                <th><i class="fas fa-user me-1"></i>Name</th>
                <th><i class="fas fa-calendar-day me-1"></i>Date of Birth</th>
                <th><i class="fas fa-at me-1"></i>Email</th>
                <th><i class="fas fa-flag me-1"></i>NRC</th>
                <th><i class="fas fa-book-open-reader me-1"></i>Courses</th>
                <th><i class="fas fa-bars me-1"></i>Actions</th>
            </tr>
            <tr>
                <td>
                    <input type="text" class="form-control filter-input" placeholder="Search Name ..." data-column="0" id="datepicker">
                </td>
                <td class="d-flex">
                    <input type="text" class="form-control me-1" placeholder="Search Birth Date ..." data-column="1" id="datePicker">
                    <button class="btn btn-secondary" id="resetDate">reset</button>
                </td>
                <td>
                    <input type="text" class="form-control filter-input" placeholder="Search Email ..." data-column="2">
                </td>
                <td>
                    <input type="text" class="form-control filter-input" placeholder="Search NRC ..." data-column="3">
                </td>
                <td>
                    <input type="text" class="form-control filter-input" placeholder="Search Courses ..." data-column="4">
                </td>
                <td></td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {

        $("#datePicker").datepicker({
            dateFormat: 'M dd, yy'
        });


        $('#resetDate').click(function() {
            $.datepicker._clearDate($("#datePicker"));
        });

        const table = $('#students-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('students.index') }}",
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'birth_date',
                    name: ''
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'nrc',
                    name: 'nrc'
                },
                {
                    data: 'courses',
                    name: 'courses',
                    render: function(data, type, full, meta) {
                        div = JSON.parse(full.courses).map(course => {
                            return `<span class="badge bg-primary p-2 m-1">${course.name}</span>`;
                        });
                        return div;
                    }
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

        $("#datePicker").change(function() {
            table.column($(this).data('column'))
                .search($(this).val())
                .draw();
        });
    });
</script>
@endsection