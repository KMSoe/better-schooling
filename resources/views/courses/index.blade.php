@extends('layouts.admin')

@section('title', 'Course List')
@section('content-header', 'Course List')

@section('content-actions')
<a href="{{ route('courses.create') }}" class="btn btn-primary float-end">Add Course</a>
@endsection

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
                <input type="text" class="form-control filter-input" placeholder="Search Name ..." data-column="0">
            </td>
            <td>
                <input type="text" class="form-control filter-input" placeholder="Search Code ..." data-column="1">
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
    function deleteCourse(id) {
        let url = "{{ route('courses.destroy', ':id') }}";
        url = url.replace(':id', id);
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
                url: "{{ route('courses.index') }}",
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