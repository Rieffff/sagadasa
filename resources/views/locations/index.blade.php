@extends('layouts.app')
@section('title')
    Locations
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
            <button class="btn btn-primary" id="add-location">Add location</button>
            </div>
            <div class="card-body p-0">
            <div class="app-datatable-default overflow-auto">
                <table id="locations-table" class="display app-data-table default-data-table">
                <thead>
                    <tr>
                    <th>NO</th>
                    <th>Location Name</th>
                    <th>Address</th>
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
   <div class="modal fade" id="locationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="location-form">
                        <input type="hidden" id="location-id">
                        <div class="mb-3">
                            <label for="location-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="location-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="location-address" class="form-label">address</label>
                            <input type="text" class="form-control" id="location-address" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-location">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('locations-scripts')
<script>
    $(document).ready(function() {
        const table = $('#locations-table').DataTable({
          ajax: {
                    url: '/locations/list'
                },
            columns: [
                { data: 'index', name: 'index', searchable: false}, // Kolom index
                { data: 'location_name', name: 'location_name'},
                { data: 'address' , name:'address'},
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                        @can("edit master data")
                            <button class="btn btn-warning btn-sm edit-location" id="edit-location" data-id="${row.id}"><i class="ph-duotone  ph-pencil-simple-line"></i></button>
                        @endcan
                        @can("delete master data")
                            <button class="btn btn-danger btn-sm delete-location" data-id="${row.id}"><i class="ph-duotone  ph-trash"></i></button>
                        @endcan
                        `;
                    }
                }
            ]
        });

        $('#add-location').click(function() {
            $('#location-id').val('');
            $('#location-form')[0].reset();
            $('#modalTitle').text('Add location');
            $('#locationModal').modal('show');
        });

        $('#save-location').click(function() {
            const id = $('#location-id').val();
            const url = id ? `/locations/update/${id}` : '/locations/store';
            const method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: {
                    location_name: $('#location-name').val(),
                    address: $('#location-address').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#locationModal').modal('hide');
                    table.ajax.reload();
                    pemberitahuan("success","berhasil mengupdate table");
                }
            });
        });

        $('#locations-table').on('click', '.edit-location', function() {
            var id = $(this).data('id');
            var url = "/locations/show/" + id;
            $.get(url , function(data) {
                $('#location-id').val(data.id);
                $('#location-name').val(data.location_name);
                $('#location-address').val(data.address);
                $('#modalTitle').text('Edit location');
                $('#locationModal').modal('show');
            });
        });

        $('#locations-table').on('click', '.delete-location', function() {
            const id = $(this).data('id');
            konfirmasi().then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: `/locations/destroy/${id}`,
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