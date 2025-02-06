@extends('layouts.app')
@section('title')
    Maintenance Item
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
            <button class="btn btn-primary" id="add-maintenance-item">Add maintenance item</button>
            </div>
            <div class="card-body p-0">
            <div class="app-datatable-default overflow-auto">
                <table id="Item-table" class="display app-data-table default-data-table">
                <thead>
                    <tr>
                    <th>NO</th>
                    <th>maintenance-item Name</th>
                    <th>description</th>
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
   <div class="modal fade" id="maintenance-itemModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add maintenance-item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="maintenance-item-form">
                        <input type="hidden" id="maintenance-item-id">
                        <div class="mb-3">
                            <label for="maintenance-item-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="maintenance-item-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="maintenance-item-description" class="form-label">description</label>
                            <input type="text" class="form-control" id="maintenance-item-description" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-maintenance-item">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('item-scripts')
<script>
    $(document).ready(function() {
        const table = $('#Item-table').DataTable({
          ajax: {
                    url: '/maintenance-items/list'
                },
            columns: [
                { data: 'index', name: 'index', searchable: false}, // Kolom index
                { data: 'item_name', name: 'item_name'},
                { data: 'description' , name:'description'},
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-light-success icon-btn b-r-4 edit-maintenance-item" id="edit-maintenance-item" data-id="${row.id}"><i class="ph-duotone  ph-pencil-simple-line"></i></button>
                            <button class="btn btn-light-danger icon-btn b-r-4 delete-maintenance-item" data-id="${row.id}"><i class="ph-duotone  ph-trash"></i></button>
                        `;
                    }
                }
            ]
        });

        $('#add-maintenance-item').click(function() {
            $('#maintenance-item-id').val('');
            $('#maintenance-item-form')[0].reset();
            $('#modalTitle').text('Add maintenance-item');
            $('#maintenance-itemModal').modal('show');
        });

        $('#save-maintenance-item').click(function() {
            const id = $('#maintenance-item-id').val();
            const url = id ? `/maintenance-items/update/${id}` : '/maintenance-items/store';
            const method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: {
                    item_name: $('#maintenance-item-name').val(),
                    description: $('#maintenance-item-description').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#maintenance-itemModal').modal('hide');
                    table.ajax.reload();
                    pemberitahuan("success","berhasil mengupdate table");
                }
            });
        });

        $('#Item-table').on('click', '.edit-maintenance-item', function() {
            var id = $(this).data('id');
            var url = "/maintenance-items/show/" + id;
            $.get(url , function(data) {
                $('#maintenance-item-id').val(data.id);
                $('#maintenance-item-name').val(data.item_name);
                $('#maintenance-item-description').val(data.description);
                $('#modalTitle').text('Edit maintenance-item');
                $('#maintenance-itemModal').modal('show');
            });
        });

        $('#Item-table').on('click', '.delete-maintenance-item', function() {
            const id = $(this).data('id');
            konfirmasi().then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/maintenance-items/destroy/${id}`,
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