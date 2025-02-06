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
        <div class="col-lg-10 col-md-8 col-xs-5">
            <div class="card ">
                <div class="card-header">
                    <h5> @yield('title')</h5>
                </div>
                <div class="card-body p-15">
                    <!-- Multi-Step Form -->
                    <form id="reportForm" action="route('daily_reports.store')" method="POST" enctype="multipart/form-data" class="app-form rounded-control">
                        @csrf
                        <!-- Step 1  -->
                        <div id="step1" class="step step-1">
                            <h4 class="text-secondary">Step 1: Daily Report</h4>
                            <div class="dotted-2-secondary b-r-20 p-3 mb-3">
                                <div class="row feachers-list">
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label for="report_date" class="form-label ">Report Date</label>
                                            <input type="text" placeholder="Activity Date" class="form-control basic-date flatpickr-input active" id="report_date" name="report_date" required>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="mb-3">
                                            <label for="location" class="form-label">Location</label>
                                            <select class="form-control form-select" id="location" name="location" required>
                                                <option value="">----Pilih Lokasi----</option>
                                                @foreach($locations as $location)
                                                    <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row feachers-list">
                                    <div class="col-md-5 mb-3 mt-3">
                                            <div class="form-check form-switch d-flex">
                                                <input class="form-check-input" type="checkbox" name="po" id="basic-switch-1">
                                                <label class="form-check-label ms-2" for="basic-switch-1">PO</label>
                                            </div>
                                        </div>
                                    <div class="col-md-7 mb-3">
                                        <input type="text" class="form-control"  value="" name="detail_activity"  placeholder="Activity (ex. Maintenance)" >
                                        <input type="hidden" class="form-control" name="approved_by" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <input class="form-control date-time-picker flatpickr-input active" type="text" name="work_start" placeholder="Work Start" >
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <input class="form-control date-time-picker flatpickr-input active" type="text" name="work_stop" placeholder="Work Stop" >
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <input class="form-control" type="number" name="work_break" placeholder="Work Break (hours)" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <textarea class="form-control" rows="5" cols="5" name="service_data" placeholder="Service Data"></textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <textarea class="form-control" rows="5" cols="5" name="work_reason" placeholder="Work Reason"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <select class="form-control form-select" name="contactor">
                                            @foreach($contractors as $row)
                                                <option value="{{ $row->id }}">{{ $row->contractor_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <select class="form-control form-select" name="contactor">
                                            @foreach($companies as $row)
                                                <option value="{{ $row->id }}">{{ $row->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- <h5>Daily Activities</h5>
                            <div class="dotted-2-secondary b-r-20 p-3 mb-3">
                                <div id="dailyActivities">
                                    <div class="row mb-3">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="activity[]" placeholder="Activity">
                                        </div>
                                        <div class="col-md-5">
                                            <textarea class="form-control" rows="5" cols="5" name="note[]" placeholder="Note"></textarea>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-light-danger b-r-22   remove-activity">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-light-primary b-r-22" id="addActivity">Add Activity</button>
                            <h5>Man Powers</h5>
                            <div class="dotted-2-secondary b-r-20 p-3 mb-3">
                                <div id="manPowers">
                                    <div class="row mb-3">
                                        <div class="col-md-5">
                                            <select class="form-control form-select" name="man_powers[]">
                                                @foreach($technicians as $technician)
                                                    <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-light-danger b-r-22  remove-manpower">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-light-primary b-r-22" id="addManPower">Add Man Power</button> -->
                            <div class="">
                                <hr>
                                <button type="button" class="btn btn-success next-step">Next</button>
                            </div>
                        </div>
                        <!-- Step 2 -->
                        <div id="step2" class="step step-2">
                            <h4>Step 2: Daily Activity Details</h4>
                            <div class="mb-3">
                                <input type="hidden" id="device_id" name="device_id_Activity" value="{{$devices->first()->id}}">
                                <input type="hidden" class="form-control" value="-" name="activity_description" required>
                            </div>
                            
                            <div id="Activity" class="dotted-2-secondary b-r-20 p-3 mb-3 ">
                                <h5>Activity Details </h5>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <input type="hidden" name="status[]" value="activity">
                                        <input type="file" class="form-control" name="photos[]">
                                    </div>
                                    <div class="col-md-5">
                                        <textarea class="form-control" rows="5" cols="5" name="description[]" placeholder="Description"></textarea>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="app-divider-h align-items-center">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-light-danger b-r-22 mt-5  remove-activity">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-light-primary b-r-22 " id="addMaintenance">Add Activity</button>
                            <div class="">
                            
                                <hr>
                                <button type="button" class="btn btn-secondary prev-step">Back</button>
                                <button type="button" class="btn btn-success next-step">Next</button>
                            </div>
                        </div>
                        <!-- Step 3 -->
                        <div  class="step step-3">
                            <h4>Step 3: Reguler Activity</h4>
                            <div id="logHere">
                                <div class="dotted-2-secondary b-r-20 p-3 mt-5 mb-5 cloneLog" id="regulerActivity">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="hidden" id="device_id" name="device_id" value="">
                                            <label for="activity_description" class="form-label">Activity Slug</label>
                                            <input type="text" class="form-control" name="activity_description" required>
                                            <input type="hidden" name="statusBefore[]" value="regular">
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="row mb-3">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="device_id">Device</label>
                                                    <select name="deviceReguler[]" id="deviceReguler[]" class="form-control form-select deviceReguler0">
                                                    
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div  class="row  ">
                                                <div class="col-md-5 dotted-2-primary b-r-20 mr-2">
                                                    <div class="text-center mb-3">
                                                            <h6>Before</h6>
                                                    </div>
                                                    <div class="mb-3">
                                                        <input type="file" class="form-control" name="photosBefore[]">
                                                    </div>
                                                    <div class="mb-3">
                                                        <textarea class="form-control" rows="5" cols="5" name="descriptionBefore[]" placeholder="Description Photos"></textarea>
                                                    </div>
                                                    <label>Maintenance Items:</label>
                                                    @php
                                                        $i = 1;;
                                                    @endphp
                                                    @foreach($maintenanceItems as $item)
                                                    @php
                                                        $i++;
                                                    @endphp
                                                    <div class="mb-3">
                                                        <div class="row">
                                                            <div class="form-check form-switch d-flex">
                                                                <input class="form-check-input" type="checkbox" name="maintenance_item_namesBefore[]" id="basic-switch-{{$i}}">
                                                                <label class="form-check-label ms-2" for="basic-switch-{{$i}}">{{ $item->item_name }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <div class="col-md-5 dotted-2-primary b-r-20 ml-2">
                                                    <div class="text-center mb-3">
                                                            <h6>after</h6>
                                                    </div>
                                                    <div class="mb-3">
                                                        <input type="file" class="form-control" name="photosAfter[]">
                                                    </div>
                                                    <div class="mb-3">
                                                    <textarea class="form-control" rows="5" cols="5" name="descriptionAfter[]" placeholder="Description Photos"></textarea>
                                                    </div>
                                                    <label>Maintenance Items:</label>
                                                    @php
                                                        $i = 1;;
                                                    @endphp
                                                    @foreach($maintenanceItems as $item)
                                                    @php
                                                        $i++;
                                                    @endphp
                                                    <div class="mb-3">
                                                        <div class="row">
                                                            <div class="form-check form-switch d-flex">
                                                                <input class="form-check-input" type="checkbox" name="maintenance_item_namesBefore[]" id="basic-switch-{{$i}}">
                                                                <label class="form-check-label ms-2" for="basic-switch-{{$i}}">{{ $item->item_name }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-light-danger b-r-22  remove-maintenance" id="remove-maintenance">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row m-3">
                                            <div class="col-md-4">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-light-primary  b-r-22  addLog" id="addLog">Add Reguler Activity</button>
                            <div class="">
                            
                                <hr>
                                <button type="button" class="btn btn-secondary prev-step">Back</button>
                                <button type="button" class="btn btn-success next-step">Next</button>
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
                                <button type="button" class="btn btn-light-primary add-maintenance-log-non-reg">Add Maintenance Log</button>
                            </div>
                            <div class="">
                            
                                <hr>
                                <button type="button" class="btn btn-secondary prev-step">Back</button>
                                <!-- <button type="button" class="btn btn-success next-step">Next</button> -->
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
    document.getElementById('addLog').addEventListener('click', function() {
        let newDetail = document.querySelector('.cloneLog').cloneNode(true);
        document.getElementById('logHere').appendChild(newDetail);
    });
    
</script>
<script>


$(document).ready(function() {

    
    $(document).on("click", ".remove-maintenance", function () {
        $(this).closest(".cloneLog").remove();
    });

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
        $('#dailyActivities').append(
            '<div class="row mb-3">' +
            '<div class="col-md-5"><input type="text" class="form-control" name="activity[]" placeholder="Activity"></div>' +
            '<div class="col-md-5"><textarea class="form-control" rows="5" cols="5" name="note[]" placeholder="Note"></textarea></div>' +
            
            '<div class="col-md-2"><button type="button" class="btn btn-light-danger b-r-22  remove-activity">Remove</button></div>' +
            '</div>'
        );
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
                            <button type="button" class="btn btn-light-danger b-r-22  remove-maintenance">Remove</button>
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
            '<div class="col-md-5"><select class="form-control form-select" name="man_powers[]">' +
            '@foreach($technicians as $technician)<option value="{{ $technician->id }}">{{ $technician->name }}</option>@endforeach' +
            '</select></div>' +
            '<div class="col-md-2"><button type="button" class="btn btn-light-danger b-r-22  remove-manpower">Remove</button></div>' +
            '</div>');
    });
    $(document).on('click', '.remove-manpower', function() {
        $(this).closest('.row').remove();
    });
    
    $('#addMaintenance').click(function() {
        $('#Activity').append(
            '<div class="row mb-3">'+
                '<div class="app-divider-v align-items-center"><p>New record</p></div>'+
                '<div class="col-md-4"><input type="hidden" name="status[]" value="activity"><input type="file" class="form-control" name="photos[]"></div>'+
                '<div class="col-md-5"><textarea class="form-control" rows="5" cols="5" name="description[]" placeholder="Description"></textarea></div>'+
                '<div class="col-md-1"><div class="app-divider-h align-items-center"></div></div>'+
                '<div class="col-md-2"><button type="button" class="btn btn-light-danger b-r-22 mt-5  remove-activity">Remove</button></div>'+
            '</div>');
    });
    $(document).on('click', '.remove-maintenance', function() {
        $(this).closest('.row').remove();
    });

    
});
</script>
@endpush