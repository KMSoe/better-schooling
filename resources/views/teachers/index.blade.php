@extends('layouts.admin')

@section('title', 'Teacher List')
@section('content-header', 'Teacher List')

@section('content-actions')
<a href="{{ route('teachers.create') }}" class="btn btn-primary float-end">Add Teacher</a>
@endsection

@section('content')
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

<table class="table table-striped table-bordered" id="teachers-table">
    <thead>
        <tr>
            <th><i class="fas fa-user me-1"></i>Name</th>
            <th><i class="fas fa-at me-1"></i>Email</th>
            <th><i class="fas fa-book-open-reader me-1"></i>Courses</th>
            <th><i class="fas fa-bars me-1"></i>Actions</th>
        </tr>
        <tr>
            <td>
                <input type="text" class="form-control filter-input" placeholder="Search Name ..." data-column="0">
            </td>
            <td>
                <input type="text" class="form-control filter-input" placeholder="Search Email ..." data-column="1">
            </td>
            <td>
                <input type="text" class="form-control filter-input" placeholder="Search Courses ..." data-column="2">
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
    $(document).ready(function() {
        const table = $('#teachers-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('teachers.index') }}",
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
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
    });
</script>
@endsection