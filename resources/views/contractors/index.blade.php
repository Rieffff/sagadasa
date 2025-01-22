@extends('layouts.app')
@section('title')
    Contractors
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
            <button class="btn btn-primary" id="add-contractor">Add Contractor</button>
            </div>
            <div class="card-body p-0">
            <div class="app-datatable-default overflow-auto">
                <table id="contractors-table" class="display app-data-table default-data-table">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Contractor Name</th>
                    <th>Address</th>
                    <th>Contract Ref</th>
                    <th>Contact Information</th>
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
   <div class="modal fade" id="contractorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Contractor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="contractor-form">
                        <input type="hidden" id="contractor-id">
                        <div class="mb-3">
                            <label for="contractor-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="contractor-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="contractor-address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="contractor-address" required>
                        </div>
                        <div class="mb-3">
                            <label for="contractor-ref" class="form-label">Contract Ref</label>
                            <input type="text" class="form-control" id="contractor-ref">
                        </div>
                        <div class="mb-3">
                            <label for="contractor-contact" class="form-label">Contact Info</label>
                            <input type="text" class="form-control" id="contractor-contact">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-contractor">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('other-scripts')
<script>
    $(document).ready(function() {
        const table = $('#contractors-table').DataTable({
        columnDefs: [{ width: '20%', targets: 5 }],
          ajax: {
                    url: '/contractors/list'
                },
            columns: [
                { data: 'index', name: 'index', searchable: false}, // Kolom index
                { data: 'contractor_name', name: 'contractor_name'},
                { data: 'address' , name:'address'},
                { data: 'contract_ref' , name: 'contract_ref'},
                { data: 'contact_information' , name: 'contact_information'},
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-warning btn-sm edit-contractor" id="edit-contractor" data-id="${row.id}"><i class="ph-duotone  ph-pencil-simple-line"></i></button>
                            <button class="btn btn-danger btn-sm delete-contractor" data-id="${row.id}"><i class="ph-duotone  ph-trash"></i></button>
                        `;
                    }
                }
            ]
        });

        $('#add-contractor').click(function() {
            $('#contractor-id').val('');
            $('#contractor-form')[0].reset();
            $('#modalTitle').text('Add Contractor');
            $('#contractorModal').modal('show');
        });

        $('#save-contractor').click(function() {
            const id = $('#contractor-id').val();
            const url = id ? `/contractors/${id}` : '/contractors/store';
            const method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: {
                    contractor_name: $('#contractor-name').val(),
                    address: $('#contractor-address').val(),
                    contract_ref: $('#contractor-ref').val(),
                    contact_information: $('#contractor-contact').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#contractorModal').modal('hide');
                    table.ajax.reload();
                    pemberitahuan("success","berhasil mengupdate table");
                }
            });
        });

        $('#contractors-table').on('click', '.edit-contractor', function() {
            var id = $(this).data('id');
            var url = "/contractors/show/" + id;
            $.get(url , function(data) {
                $('#contractor-id').val(data.id);
                $('#contractor-name').val(data.contractor_name);
                $('#contractor-address').val(data.address);
                $('#contractor-ref').val(data.contract_ref);
                $('#contractor-contact').val(data.contact_information);
                $('#modalTitle').text('Edit Contractor');
                $('#contractorModal').modal('show');
            });
        });

        $('#contractors-table').on('click', '.delete-contractor', function() {
            const id = $(this).data('id');
            konfirmasi().then((result) => {
                if (result.isConfirmed) {
                $.ajax({
                    url: `/contractors/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        table.ajax.reload();
                        pesan("Terhempas","Device berhasil di hapus","success");
                    }
                });
            }
        });
        });
    });
</script>
@endpush