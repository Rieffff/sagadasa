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
            </div>
            <div class="card-body p-0">
            <div class="app-datatable-default overflow-auto">
                <table id="devices-table" class="display app-data-table default-data-table">
                <thead>
                    <tr>
                    <th>NO</th>
                    <th>Device Name</th>
                    <th>Location Name</th>
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
                    </div>
                    <div class="mb-3">
                        <label for="id_location" class="form-label">Location</label>
                        <select class="form-select selectpicker" id="id_location" name="id_location" data-live-search="true" required>
                            <option value="">Select Location</option>
                        </select>
                    </div>
                    <input type="hidden" id="device_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
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
                { data: 'device_name', name: 'device_name'},
                { data: 'location.location_name' , name:'location_name'},
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                        @can("edit master data")
                            <button class="btn btn-warning btn-sm edit-device" id="edit-device" data-id="${row.id}"><i class="ph-duotone  ph-pencil-simple-line"></i></button>
                        @endcan
                        @can("delete master data")
                            <button class="btn btn-danger btn-sm delete-device" data-id="${row.id}"><i class="ph-duotone  ph-trash"></i></button>
                        @endcan
                        `;
                    }
                }
            ]
        });

        function loadLocations() {
            $.get("{{ route('locations.list') }}", function (response) {
                let options = '<option value="">Select Location</option>';
                response.data.forEach(location => {
                    options += `<option value="${location.id}">${location.location_name}</option>`;
                });
                $('#id_location').html(options).selectpicker('refresh');
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
        $('#locations-table').on('click', '.editDevice', function () {
            let deviceId = $(this).data('id');
            $.get('/devices/list', function (response) {
                let device = response.data.find(d => d.id == deviceId);
                if (device) {
                    $('#device_name').val(device.device_name);
                    loadLocations(); // Refresh locations first
                    setTimeout(() => {
                        $('#id_location').val(device.id_location).selectpicker('refresh');
                    }, 300); // Delay to ensure dropdown refreshes
                    $('#device_id').val(device.id);
                    $('#deviceModalLabel').text('Edit Device');
                    $('#deviceModal').modal('show');
                }
            });
        });

        // Save or Update Device
        $('#deviceForm').submit(function (e) {
            e.preventDefault();

            let deviceId = $('#device_id').val();
            let formData = {
                device_name: $('#device_name').val(),
                id_location: $('#id_location').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            if (deviceId) {
                // Update device
                $.ajax({
                    url: `/devices/update/${deviceId}`,
                    method: 'PUT',
                    data: formData,
                    success: function (response) {
                        alert(response.message);
                        deviceModal.hide();
                        fetchDevices();
                    },
                    error: function (error) {
                        alert('Failed to update device!' + error);
                    }
                });
            } else {
                // Add device
                $.post("{{ route('devices.store') }}", formData, function (response) {
                    alert(response.message);
                    $('#deviceModal').modal('hide');
                    fetchDevices();
                }).fail(function (response) {
                    alert(response.message);
                });
            }
        });

        // Delete Device
        $(document).on('click', '.deleteDevice', function () {
            if (confirm('Are you sure you want to delete this device?')) {
                let deviceId = $(this).data('id');
                $.ajax({
                    url: `/devices/destroy/${deviceId}`,
                    method: 'DELETE',
                    data: { _token: $('meta[name="csrf-token"]').attr('content') },
                    success: function (response) {
                        alert(response.message);
                        fetchDevices();
                    },
                    error: function () {
                        alert('Failed to delete device!');
                    }
                });
            }
        });
    });
</script>
@endpush