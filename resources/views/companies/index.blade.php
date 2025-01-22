@extends('layouts.app')
@section('title')
    Companies
@endsection
@section('content')


<main>
    <div class="container-fluid">
    <!-- Breadcrumb start -->
    <div class="row m-1">
        <div class="col-12 ">
            <h4 class="main-title">@yield('title')</h4>
            <ul class="app-line-breadcrumbs mb-3">
                <li class="">
                <a href="{{ route('dashboard') }}" class="f-s-14 f-w-500"> 
                    <span>
                    <i class="ph-duotone  ph-table f-s-16"></i> Home
                    </span>
                </a>
                </li>
                <li class="active">
                <a href="#" class="f-s-14 f-w-500">@yield('title')</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb end -->

    <div class="row">
        <div class="col-12">
        <div class="card ">
            <div class="card-header">
            <h5> @yield('title')</h5>
            <button class="btn btn-primary mb-3" id="createcompany">Add company</button>
            </div>
            <div class="card-body p-0">
            <div class="app-datatable-default overflow-auto">
                <table id="companies-table" class="display app-data-table default-data-table">
                <thead>
                    <tr>
                    <th>NO</th>
                    <th>Company Name</th>
                    <th>Contact</th>
                    <th>Addres</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                </table>
            </div>
            </div>
        </div>
        </div>      
    </div>
    </div>
</main>

   <!-- Modal -->
   <div class="modal fade" id="companyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="companyForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="companyModalLabel">Add company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="company_name" class="form-label">company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    
                    <input type="hidden" id="company_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('companies-scripts')
<script>
    $(document).ready(function() {
        const table = $('#companies-table').DataTable({
            columnDefs: [{ width: '20%', targets: 4 }],
          ajax: {
                    url: '/companies/list'
                },
            columns: [
                { data: 'index', name: 'index', searchable: false}, // Kolom index
                { data: 'company_name', name: 'company_name'},
                { data: 'contact' , name:'contact'},
                { data: 'address', name: 'address'},
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                        @can("edit master data")
                            <button class="btn btn-warning btn-sm edit-company" id="edit-company" data-id="${row.id}"><i class="ph-duotone  ph-pencil-simple-line"></i></button>
                        @endcan
                        @can("delete master data")
                            <button class="btn btn-danger btn-sm delete-company" id="delete-company"  data-id="${row.id}"><i class="ph-duotone  ph-trash"></i></button>
                        @endcan
                        `;
                    }
                }
            ]
        });

        // Open Add company Modal
        $('#createcompany').click(function () {
            $('#companyForm')[0].reset();
            $('#company_id').val('');
            $('#companyModalLabel').text('Add company');
            $('#companyModal').modal('show');
        });

        // Open Edit company Modal
        $('#companies-table').on('click', '#edit-company', function() {
            var id = $(this).data('id');
            var url = "/companies/show/" + id;
            $.get(url , function(data) {
                $('#company_id').val(data.id);
                $('#company_name').val(data.company_name);
                $('#address').val(data.address);
                $('#contact').val(data.contact);
                $('#modalTitle').text('Edit companies');
                $('#companyModal').modal('show');
            });
        });

        // Save or Update company
        $('#submitBtn').click(function() {
            const id = $('#company_id').val();
            const url = id ? `/companies/update/${id}` : '/companies/store';
            const method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: {
                    company_name: $('#company_name').val(),
                    address: $('#address').val(),
                    contact: $('#contact').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#companyModal').modal('hide');
                    table.ajax.reload();
                }
            });
        });

        // Delete company
        $(companies-table).on('click', '#delete-company', function () {
            if (confirm('Are you sure you want to delete this company?')) {
                let companyId = $(this).data('id');
                $.ajax({
                    url: `/companies/destroy/${companyId}`,
                    method: 'DELETE',
                    data: { 
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        alert(response.message);
                        table.ajax.reload();
                    },
                    error: function () {
                        alert('Failed to delete company!');
                    }
                });
            }
        });
    });
</script>
@endpush