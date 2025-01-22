@extends('layouts.app')
@section('title')
    Materials
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
            <button class="btn btn-primary" id="add-material">Add material</button>
            </div>
            <div class="card-body p-0">
            <div class="app-datatable-default overflow-auto">
                <table id="materials-table" class="display app-data-table default-data-table">
                <thead>
                    <tr>
                    <th>NO</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Unit</th>
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
   <div class="modal fade" id="materialModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="material-form">
                        <input type="hidden" id="material-id">
                        <div class="mb-3">
                            <label for="material-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="material-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="material-description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="material-description" required>
                        </div>
                        <div class="mb-3">
                            <label for="material-unit" class="form-label">Unit</label>
                            <input type="text" class="form-control" id="material-unit">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-material">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('materials-scripts')
<script>
    $(document).ready(function() {
        const table = $('#materials-table').DataTable({
        columnDefs: [{ width: '20%', targets: 4 }],
          ajax: {
                    url: '/materials/list'
                },
            columns: [
                { data: 'index', name: 'index', searchable: false}, // Kolom index
                { data: 'material_name', name: 'material_name'},
                { data: 'description' , name:'description'},
                { data: 'unit' , name: 'unit'},
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-warning btn-sm edit-material" id="edit-material" data-id="${row.id}"><i class="ph-duotone  ph-pencil-simple-line"></i></button>
                            <button class="btn btn-danger btn-sm delete-material" data-id="${row.id}"><i class="ph-duotone  ph-trash"></i></button>
                        `;
                    }
                }
            ]
        });

        $('#add-material').click(function() {
            $('#material-id').val('');
            $('#material-form')[0].reset();
            $('#modalTitle').text('Add material');
            $('#materialModal').modal('show');
        });

        $('#save-material').click(function() {
            const id = $('#material-id').val();
            const url = id ? `/materials/update/${id}` : '/materials/store';
            const method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: {
                    material_name: $('#material-name').val(),
                    description: $('#material-description').val(),
                    unit: $('#material-unit').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#materialModal').modal('hide');
                    table.ajax.reload();
                    pemberitahuan("success","berhasil mengupdate table");
                }
            });
        });

        $('#materials-table').on('click', '.edit-material', function() {
            var id = $(this).data('id');
            var url = "/materials/show/" + id;
            $.get(url , function(data) {
                $('#material-id').val(data.id);
                $('#material-name').val(data.material_name);
                $('#material-description').val(data.description);
                $('#material-unit').val(data.unit);
                $('#modalTitle').text('Edit material');
                $('#materialModal').modal('show');
            });
        });

        $('#materials-table').on('click', '.delete-material', function() {
            const id = $(this).data('id');
            konfirmasi().then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/materials/destroy/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        table.ajax.reload();
                        pesan("Terhempas","Device berhasil di hapus","success");
                    }
                });
            }});
           
        });
    });
</script>
@endpush