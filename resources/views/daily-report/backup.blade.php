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
                    <form id="reportForm" action="route('daily_reports.store')" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Step 1  -->
                        <div id="step1" class="step step-1">
                            <h4>Step 1: Daily Report</h4>
                            <div class="mb-3">
                                <label for="report_date" class="form-label">Report Date</label>
                                <input type="date" class="form-control" id="report_date" name="report_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <select class="form-control" id="location" name="location" required>
                                    <option value="">----Pilih Lokasi----</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">PO</label><br>
                                <input type="radio" name="po" value="Yes" checked> Yes
                                <input type="radio" name="po" value="No"> No
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Approved By</label>
                                <input type="text" class="form-control" name="approved_by" value="{{ Auth::user()->name }}" readonly>
                            </div>
                            
                            <h5>Daily Activities</h5>
                            <div id="dailyActivities">
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="activity[]" placeholder="Activity">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="note[]" placeholder="Note">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger remove-activity">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" id="addActivity">Add Activity</button>
                            
                            <h5>Man Powers</h5>
                            <div id="manPowers">
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <select class="form-control" name="man_powers[]">
                                            @foreach($technicians as $technician)
                                                <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger remove-manpower">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" id="addManPower">Add Man Power</button>
                            <div class="">
                                <hr>
                                <button type="button" class="btn btn-primary next-step">Next</button>
                            </div>
                        </div>
                        <!-- Step 2 -->
                        <div id="step2" class="step step-2">
                            <h4>Step 2: Daily Activity Details</h4>
                            <div class="mb-3">
                                <input type="hidden" id="device_id" name="device_id" value="">
                                <label for="activity_description" class="form-label">Activity Description</label>
                                <input type="text" class="form-control" name="activity_description" required>
                            </div>
                            
                            <div id="Activity">
                                <h5>Activity Details </h5>
                                <div class="row mb-3">
                                    <div class="col-md-5">
                                        <input type="hidden" name="status[]" value="activity">
                                        <input type="file" class="form-control" name="photos[]">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="description[]" placeholder="Description">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger remove-activity">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" id="addMaintenance">Add Activity</button>
                            <div class="">
                            
                                <hr>
                                <button type="button" class="btn btn-secondary prev-step">Back</button>
                                <button type="button" class="btn btn-primary next-step">Next</button>
                            </div>
                        </div>
                        <!-- Step 3 -->
                        <div  class="step step-3">
                            <h4>Step 3: Reguler Activity</h4>
                            <div class="mb-3">
                                <input type="hidden" id="device_id" name="device_id" value="">
                                <label for="activity_description" class="form-label">Activity Description</label>
                                <input type="text" class="form-control" name="activity_description" required>
                            </div>
                            
                            <h5>Maintenance Log</h5>
                            <div id="dailyReguler">
                                <div class="row mb-3">
                                    <div class="mb-3">
                                        <hr>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="device_id">Device</label>
                                            <select name="deviceReguler[]" id="deviceReguler[]" class="form-control deviceReguler0">
                                            
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="text-center mb-3">
                                                <h6>Before</h6>
                                        </div>
                                        <div class="mb-3">
                                            <input type="hidden" name="statusBefore[]" value="activity">
                                            <input type="file" class="form-control" name="photosBefore[]">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="descriptionBefore[]" placeholder="Description">
                                        </div>
                                        <label>Maintenance Items:</label>
                                        @foreach($maintenanceItems as $item)
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="form-check">
                                                    <input type="hidden" name="maintenance_item_namesBefore[]" value="{{ $item->item_name }}">
                                                    <input type="radio" name="maintenance_item_statusBefore[]" value="ok">   <span class="radiomark outline-primary ms-2"></span>
                                                    <span class="text-primary">{{ $item->item_name }} OK </span>
                                                    <input type="radio" name="maintenance_item_statusBefore[]" value="error">   <span class="radiomark outline-danger ms-2"></span>
                                                    <span class="text-danger">{{ $item->item_name }} Error</span>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-5">
                                        <div class="text-center mb-3">
                                                <h6>after</h6>
                                        </div>
                                        <div class="mb-3">
                                            <input type="hidden" name="statusBefore[]" value="activity">
                                            <input type="file" class="form-control" name="photosBefore[]">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="descriptionBefore[]" placeholder="Description">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger remove-maintenance">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary addReguler" id="addReguler">Add Reguler Activity</button>
                            <div class="">
                            
                                <hr>
                                <button type="button" class="btn btn-secondary prev-step">Back</button>
                                <button type="button" class="btn btn-primary next-step">Next</button>
                            </div>
                        </div>
                        <!-- Step 4: Daily Activity Details (Non-Regular) -->
                        <div id="step3" class="step step-4">
                            <h4>Daily Activity Details - Non-Regular</h4>
                            <div class="form-group">
                                <label for="device_id_non_reg">Device</label>
                                <select name="device_id_non_reg" id="device_id_non_reg" class="form-control">
                                    @foreach($devices as $device)
                                        <option value="{{ $device->id }}">{{ $device->device_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="maintenance-log-container-non-reg">
                                <button type="button" class="btn btn-primary add-maintenance-log-non-reg">Add Maintenance Log</button>
                            </div>
                            <div class="">
                            
                                <hr>
                                <button type="button" class="btn btn-secondary prev-step">Back</button>
                                <!-- <button type="button" class="btn btn-primary next-step">Next</button> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</main>



@endsection

@push('other-scripts')
<script>
$(document).ready(function() {

    function loadLocations(idLocation,optionSelect) {
        
        $.ajax({
            url: `{{ url('getDevices') }}/${idLocation}`, // Perbaikan URL
            method: "GET",
            success: function(response) {
                var options = `<option value="">Pilih Perangkat</option>`; // Value kosong tanpa spasi

                response.data.forEach(device => {
                    options += `<option value="${device.id}">${device.device_name}</option>`;
                });

                $(optionSelect).html(options).selectpicker('refresh'); // Perbaikan refresh
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                alert("Terjadi kesalahan saat mengambil perangkat.");
            }
        });
    }

    $("#location").change(function() {
        var id_location = $(this).val(); // Gunakan `$(this).val()` untuk efisiensi
        if (id_location) {
            pemberitahuan("success", "Ganti lokasi: " + id_location);
            loadLocations(id_location, '.deviceReguler0');
        }
    });
    

    $(document).ready(function() {
        let currentStep = 1;
        function showStep(step) {
            $('.step').hide();
            $('.step-' + step).show();
        }
        showStep(currentStep);

        $('.next-step').click(function() {
            currentStep++;
            showStep(currentStep);
        });

        $('.prev-step').click(function() {
            currentStep--;
            showStep(currentStep);
        });
    });
    $('#addActivity').click(function() {
        $('#dailyActivities').append('<div class="row mb-3">' +
            '<div class="col-md-5"><input type="text" class="form-control" name="activity[]" placeholder="Activity"></div>' +
            '<div class="col-md-5"><input type="text" class="form-control" name="note[]" placeholder="Note"></div>' +
            '<div class="col-md-2"><button type="button" class="btn btn-danger remove-activity">Remove</button></div>' +
            '</div>');
    });
    $(document).on('click', '.remove-activity', function() {
        $(this).closest('.row').remove();
    });
    let i = 0;
    $('#addReguler').click(function() {
        i = i + 1;
        let LogHtml = `
                    <div class="row mb-3">
                        <div class="mb-3">
                            <hr>
                            <h6>Reguler Activity #${i}</h6>
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="device_id">Device</label>
                                <select name="deviceReguler[]" id="deviceReguler[]" class="form-control deviceReguler${i}">
                                
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="text-center mb-3">
                                    <h6>Before</h6>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="statusBefore[]" value="activity">
                                <input type="file" class="form-control" name="photosBefore[]">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="descriptionBefore[]" placeholder="Description">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="text-center mb-3">
                                    <h6>after</h6>
                            </div>
                            <div class="mb-3">
                                <input type="hidden" name="statusBefore[]" value="activity">
                                <input type="file" class="form-control" name="photosBefore[]">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="descriptionBefore[]" placeholder="Description">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-maintenance">Remove</button>
                        </div>
                    </div>`;
        $('#dailyReguler').append(LogHtml);
        var id_location = $("#location").val(); // Gunakan `$(this).val()` untuk efisiensi
        if (id_location) {
            pemberitahuan("success", "Ganti lokasi: " + id_location);
            loadLocations(id_location, '.deviceReguler'+i);
        }
    });
    $(document).on('click', '.remove-reguler', function() {
        $(this).closest('.row').remove();
    });
    
    $('#addManPower').click(function() {
        $('#manPowers').append('<div class="row mb-3">' +
            '<div class="col-md-5"><select class="form-control" name="man_powers[]">' +
            '@foreach($technicians as $technician)<option value="{{ $technician->id }}">{{ $technician->name }}</option>@endforeach' +
            '</select></div>' +
            '<div class="col-md-2"><button type="button" class="btn btn-danger remove-manpower">Remove</button></div>' +
            '</div>');
    });
    $(document).on('click', '.remove-manpower', function() {
        $(this).closest('.row').remove();
    });
    
    $('#addMaintenance').click(function() {
        $('#Activity').append('<div class="row mb-3">' +
            '<div class="col-md-5"><input type="file" class="form-control" name="photos[]"></div>' +
            '<div class="col-md-5"><input type="text" class="form-control" name="description[]" placeholder="Description"></div>' +
            '<div class="col-md-2"><button type="button" class="btn btn-danger remove-maintenance">Remove</button></div>' +
            '</div>');
    });
    $(document).on('click', '.remove-maintenance', function() {
        $(this).closest('.row').remove();
    });

    
});
</script>
@endpush