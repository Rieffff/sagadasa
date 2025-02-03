@extends('layouts.app')
@section('title')
    Devices
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
            <button class="btn btn-primary mb-3" id="createDevice">Add Device</button>
            <!-- <button class="btn btn-warning mb-3" id="refreshTable">Refresh Data</button> -->
            </div>
            <div class="card-body p-0">
            <div class="app-datatable-default overflow-auto">
                <table id="devices-table" class="display app-data-table default-data-table">
                <thead>
                    <tr>
                    <th>NO</th>
                    <th>Location Name</th>
                    <th>Device Name</th>
                    <th>Status</th>
                    <th>Description</th>
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
   <div class="modal fade" id="deviceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deviceForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="deviceModalLabel">Add Device</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="device_name" class="form-label">Device Name</label>
                        <input type="text" class="form-control" id="device_name" name="device_name" required>
                        <input type="hidden" class="form-control" id="status" name="status" value="ok">
                    </div>
                    <!-- <div class="mb-3">
                        <label for="Status" class="form-label">Device Name</label>
                        <select class="form-select selectpicker" id="status" name="status" data-live-search="true" required>
                            <option value="ok">OK</option>
                            <option value="error">ERROR</option>
                        </select>
                    </div> -->
                    <div class="mb-3">
                        <label for="Description" class="form-label">Description</label>
                        <textarea   class="form-control" id="description" name="Description" required></textarea >
                    </div>
                    <div class="mb-3">
                        <label for="id_location" class="form-label">Location</label>
                        <select class="form-select selectpicker" id="id_location" name="id_location" data-live-search="true" required>
                            <option value="">Select Location</option>
                        </select>
                    </div>
                    <input type="hidden" id="device_id" name="device_id">
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
@push('devices-scripts')
<script>
    $(document).ready(function() {
        const table = $('#devices-table').DataTable({
          ajax: {
                    url: '/devices/list'
                },
            columns: [
                { data: 'index', name: 'index', searchable: false}, // Kolom index
                { data: 'location.location_name' , name:'location_name'},
                { data: 'device_name', name: 'device_name'},
                { data: 'status', name: 'status'},
                { data: 'description', name: 'description'},
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                        @can("edit master data")
                            <button class="btn btn-warning btn-sm edit-device" id="edit-device" data-id="${row.id}"><i class="ph-duotone  ph-pencil-simple-line"></i></button>
                        @endcan
                        @can("delete master data")
                            <button class="btn btn-danger btn-sm delete-device" id="delete-device" data-id="${row.id}"><i class="ph-duotone  ph-trash"></i></button>
                        @endcan
                        `;
                    }
                }
            ]
        });
        
        
        $("#refreshTable").click(function () {
            table.ajax.reload();
            pemberitahuan("success","berhasil load data");
        });

        function loadLocations(id_location,status) {
            $.get("{{ route('locations.list') }}", function (response) {
                if(status === undefined){
                    var options = '<option value="0">Select Location </option>';
                }else{
                    
                    var options = '<option value="'+id_location+'">'+status+'</option>';
                }
                response.data.forEach(location => {
                    options += `<option value="${location.id}">${location.location_name}</option>`;
                });
                $('#id_location').html(options).selectpicker('refresh');
                // $('#id_location').val(status);
            });
        }

        // Open Add Device Modal
        $('#createDevice').click(function () {
            $('#deviceForm')[0].reset();
            $('#device_id').val('');
            $('#deviceModalLabel').text('Add Device');
            loadLocations();
            $('#deviceModal').modal('show');
        });

        // Open Edit Device Modal
        $('#devices-table').on('click', '.edit-device', function() {
            var id = $(this).data('id');
            var url = "/devices/show/" + id;
            $.get(url , function(data) {
                $('#device_id').val(data.id);
                $('#device_name').val(data.device_name);
                $('#status').val(data.status);
                $('#description').val(data.description);
                loadLocations(data.id_location, data.location.location_name); // Refresh locations first
                $('#modalTitle').text('Edit devices');
                $('#deviceModal').modal('show');
            });
        });
        

        // Save or Update Device
        $('#submitBtn').click(function() {
            const id = $('#device_id').val();
            const url = id ? `/devices/update/${id}` : '/devices/store';
            const method = id ? 'PUT' : 'POST';
            const idLocation = $('#id_location').val();
            const device_name= $('#device_name').val();
            if(id === '' && idLocation === "0" || device_name === '' && idLocation === "0"){
                Swal.fire({
                title: "ah anda ini bagaimana sih",
                text: "Silahkan pilih lokasi terlebih dahulu dan pastikan sudah mengisi device name",
                icon: "error"
                });
            }else{
                $.ajax({
                    url: url,
                    method: method,
                    data: {
                        device_name: $('#device_name').val(),
                        status: $('#status').val(),
                        description: $('#description').val(),
                        id_location: $('#id_location').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        $('#deviceModal').modal('hide');
                        pemberitahuan("success","berhasil mengupdate table");
                        table.ajax.reload();
                    }
                });
            }

           
        });

        // Delete Device
        $('#devices-table').on('click', '.delete-device', function () {
            konfirmasi().then((result) => {
                if (result.isConfirmed) {
                    const deviceId = $(this).data('id');
                    $.ajax({
                        url: `/devices/destroy/${deviceId}`,
                        method: 'DELETE',
                        data: { 
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            pemberitahuan("success","Device berhasil di hapus");
                            table.ajax.reload();
                        },
                        error: function (response) {
                            pesan("Gagal",response.responseJSON.message,"error");
                        }
                    });
                    
                }
                });
            
                
            
        });
    });
</script>
@endpush