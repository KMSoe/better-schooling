@extends('layouts.admin')

@section('title', 'Student List')
@section('content-header', 'Student List')
@section('content-actions')
<a href="{{ route('students.create') }}" class="btn btn-primary float-end">Add Student</a>
@endsection

@section('content')
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
                <input type="text" class="form-control filter-input" placeholder="Search Name ..." data-column="0">
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
@endsection
@section('js')
<script>
    function deleteStudent(id) {
        let url = "{{ route('students.destroy', ':id') }}";
        url = url.replace(':id', id);
        axios.delete(url, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(res => {
                $('#students-table').DataTable().ajax.reload();
                showAlert('info', 'Deleted');
            })
            .catch(({
                response
            }) => {
                showAlert('warning', response.data.message);

            })
    }
    
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
                    name: 'birth_date'
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
                    orderable: false,
                    searchable: false,
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