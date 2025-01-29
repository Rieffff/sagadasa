@extends('layouts.app')
@section('title')
Daily Report
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
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-header">
                    <h5> @yield('title')</h5>
                </div>
                <div class="card-body p-15">

                    <!-- Multi-Step Form -->
                    <form id="technicianReportForm" >
                        @csrf
                        <!-- Step 1: contractors and companies Selection -->
                        <div class="step" id="step-1">
                            <div class ="card-header">
                                <h5>Step 1: Contractor</h5>
                            </div>
                            <div class="form-group">
                                <label for="company_id">Company</label>
                                <select name="company_id" id="company_id" class="form-control" required>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}" {{ $company->default ? '1' : '0' }}>
                                            {{ $company->company_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="company_id">contractor</label>
                                <select name="contractor_id" id="contractor_id" class="form-control" required>
                                    @foreach ($contractors as $contractor)
                                        <option value="{{ $contractor->id }}" {{ $contractor->default ? '1' : '0' }}>
                                            {{ $contractor->contractor_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="location_id">Location</label>
                                <select name="location_id" id="location_id" class="form-control" required>
                                    <option value="">Select a location</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary next-step">Next</button>
                            </div>
                        </div>

                        <!-- Step 2: device and maintenance Photo -->
                        <div class="step d-none" id="step-2">
                            <div class ="card-header">
                                <h5>Step 1: select Device</h5>
                            </div>
                            <div class="form-group">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <span>Device di Lapangan</span>
                                    <button type="button" class="btn btn-primary btn-sm" id="addDevice">Tambah Aktivitas</button>
                                </div>
                            </div>
                            <div class="card-body" id="deviceList">
                                <!-- Dynamic Activity Fields -->
                            </div>
                            

                            
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="regular">Regular</option>
                                    <option value="non-regular">Non-Regular</option>
                                </select>
                            </div>
                            <br>
                            <br>
                            <button type="button" class="btn btn-secondary prev-step">Back</button>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <!-- Step 3: Maintenance Check -->
                        <div class="step d-none" id="step-3">
                            <div class="mb-3">
                                <label for="status" class="form-label">Device Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="OK">OK</option>
                                    <option value="Error">Error</option>
                                </select>
                            </div>
                            <div class="mb-3 d-none" id="error-details">
                                <label for="error_description" class="form-label">Error Description</label>
                                <textarea class="form-control" id="error_description" name="error_description" rows="3"></textarea>
                                <label for="error_photo" class="form-label mt-2">Error Photo</label>
                                <input type="file" class="form-control" id="error_photo" name="error_photo" accept="image/*">
                            </div>
                            <button type="button" class="btn btn-secondary prev-step">Back</button>
                            <button type="button" class="btn btn-primary next-step">Next</button>
                        </div>

                        <!-- Step 4: Non-Regular Activity -->
                        <div class="step d-none" id="step-4">
                            <h4>Step 4: Non-Regular Activity (Optional)</h4>
                            <div class="mb-3">
                                <label for="non_regular_activity" class="form-label">Describe Non-Regular Activity</label>
                                <textarea class="form-control" id="non_regular_activity" name="non_regular_activity" rows="4"></textarea>
                            </div>
                            <button type="button" class="btn btn-secondary prev-step">Back</button>
                            <button type="submit" class="btn btn-success">Submit Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</main>
<script id="deviceTemplate" type="text/template">
    <div class="device-item card mb-3">
        <div class="card-body">
            <button type="button" class="btn-close float-end removeDevice"></button>
            <div class="form-group">
                <label for="device_id">Device</label>
                <select name="device_id" id="device_id" class="form-control" required>
                    <option value="">Select a device</option>
                    @foreach ($devices as $device)
                        <option value="{{ $device->id }}">{{ $device->device_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="activity_details">Activity Details</label>
                <textarea name="activity_details" id="activity_details" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="maintenance_item_id" class="form-label">Item Maintenance</label>
                <select class="form-select" name="activities[][maintenance_item_id]" required>
                    <option value="" disabled selected>Pilih Item</option>
                    @foreach ($maintenanceItems as $item)
                        <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="status_before" class="form-label">Status Sebelum</label>
                <textarea class="form-control" name="activities[][status_before]" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="status_after" class="form-label">Status Sesudah</label>
                <textarea class="form-control" name="activities[][status_after]" rows="3" required></textarea>
            </div>
            <h4>Step 3: Maintenance Check</h4>
            <div class="mb-3">
                <label for="before_photo" class="form-label">Before Photo</label>
                <input type="file" class="form-control" id="before_photo" name="before_photo" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="after_photo" class="form-label">After Photo</label>
                <input type="file" class="form-control" id="after_photo" name="after_photo" accept="image/*" required>
            </div>
        </div>
    </div>
</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {

        $('#addDevice').click(function() {
            const deviceTemplate = $('#deviceTemplate').html();
            $('#deviceList').append(deviceTemplate);
        });

        // Remove device
        $(document).on('click', '.removeDevice', function() {
            $(this).closest('.device-item').remove();
        });
        let currentStep = 1;

        // Show next step
        $('.next-step').click(function () {
            $(`#step-${currentStep}`).addClass('d-none');
            currentStep++;
            $(`#step-${currentStep}`).removeClass('d-none');
        });

        // Show previous step
        $('.prev-step').click(function () {
            $(`#step-${currentStep}`).addClass('d-none');
            currentStep--;
            $(`#step-${currentStep}`).removeClass('d-none');
        });

        // Toggle error details
        $('#status').change(function () {
            if ($(this).val() === 'Error') {
                $('#error-details').removeClass('d-none');
            } else {
                $('#error-details').addClass('d-none');
            }
        });

        // Submit form
        $('#technicianReportForm').submit(function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                url: '{{ route("technician.reports.store") }}',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    alert('Report submitted successfully!');
                    window.location.reload();
                },
                error: function (xhr) {
                    alert('An error occurred, please try again.');
                    console.error(xhr.responseJSON);
                }
            });
        });
    });
</script>
@endsection