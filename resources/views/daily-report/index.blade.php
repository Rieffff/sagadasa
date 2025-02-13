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
                    <form id="reportForm" action="{{route('reportAll.store')}}" method="POST" enctype="multipart/form-data" class="app-form rounded-control">
                        @csrf
                        <!-- Step 1  -->
                        <div id="step1" class="step step-1">
                            <h4 class="text-secondary">Step 1</h4>
                            <div class="dotted-2-secondary b-r-20 p-3 mb-3">
                            <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="contactor" class="form-label ">Select Contractor</label>
                                        <select class="form-control form-select" name="contactor">
                                            @foreach($contractors as $row)
                                                <option value="{{ $row->id }}">{{ $row->contractor_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="report_date" class="form-label ">Select Company</label>
                                        <select class="form-control form-select" name="company">
                                            @foreach($companies as $row)
                                                <option value="{{ $row->id }}">{{ $row->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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
                                    <div class="col-md-5 mb-3">
                                        <input class="form-check-input" type="hidden" name="po" value="Yes" >
                                        <input type="text" class="form-control" name="detail_activity"  placeholder="Activity (ex. Maintenance)" >
                                    </div>
                                    <div class="col-md-7 mb-3">
                                        <input type="hidden" class="form-control" name="approved_by" value="{{ Auth::user()->name }}">
                                        <input class="form-control" type="number" name="work_break" placeholder="Work Break (hours)" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input class="form-control date-time-picker flatpickr-input active" type="text" name="work_start" placeholder="Work Start" >
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input class="form-control date-time-picker flatpickr-input active" type="text" name="work_stop" placeholder="Work Stop" >
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
                                
                                <input type="hidden" class="form-control" value="-" name="activity_description" required>
                            </div>
                            <div id="Step-2">
                                <div id="Activity" class="dotted-2-secondary b-r-20 p-3 mb-3 Step-2 ">
                                    <h5>Activity Details </h5>
                                    <div class="row mb-3">
                                        
                                        <div class="col-md-4">
                                            <label class="form-group">Select The Technician</label>
                                            <select class="form-control form-select" name="man_powers[]">
                                                    <option value="0">______Select Technician_____</option>
                                                @foreach($technicians as $technician)
                                                    <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                                                    
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <label class="form-group">Photos Activity</label>
                                            <input type="hidden" name="status[]" value="activity">
                                            <input type="file" class="form-control" name="photosActivity[]">
                                        </div>
                                        <div class="col-md-1">
                                            <div class="app-divider-h align-items-center">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-light-danger b-r-22 mt-5  remove-activity">Remove</button>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-group">Describe Activity</label>
                                            <textarea class="form-control" rows="5" cols="5" name="descriptionActivity[]" placeholder="Description"></textarea>
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <label class="form-group">Note From Companies</label>
                                            <textarea class="form-control" rows="5" cols="5" name="noteManPower[]" placeholder="Note From Companies"></textarea>
                                        </div>
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
                        <div class="step step-3">
                            <h4>Step 3: Regular Activity</h4>
                            <div id="logHere">
                                <div class="dotted-2-secondary b-r-20 p-3 mt-5 mb-5 cloneLog" id="regulerActivity">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="activity_description" class="form-label">Activity Slug</label>
                                            <input type="text" class="form-control" name="activity_description[]" required>
                                            <input type="hidden" name="statusBefore[]" value="regular">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="device_id">Device</label>
                                            <select name="deviceReguler[]" class="form-control form-select deviceReguler0">
                                                <!-- Isi opsi device dengan data dari controller -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <!-- Before Maintenance -->
                                        <div class="col-md-5 dotted-2-primary pb-3 pt-3 b-r-20">
                                            <h6 class="text-center">Before</h6>
                                            <div class="mb-3">
                                                <label>Photos Before Maintenance</label>
                                                <input type="file" class="form-control" name="photosBefore[]">
                                            </div>
                                            <div class="mb-3">
                                                <label>Description of Maintenance</label>
                                                <textarea class="form-control" rows="5" name="descriptionBefore[]" placeholder="Description"></textarea>
                                            </div>
                                            <label>Maintenance Items:</label>
                                            <ul class="feachers-list">
                                            @foreach($maintenanceItems as $item)
                                            <li class="f-s-16 text-secondary">
                                                <div class="form-check form-switch d-flex">
                                                    <input type="hidden" name="maintenance_item_status_before[0][{{ $item->id }}]" value="ERROR">
                                                    <input class="form-check-input" type="checkbox" name="maintenance_item_status_before[0][{{ $item->id }}]" value="OK">
                                                    <label class="form-check-label ms-2">{{ $item->item_name }}</label>
                                                    <input type="hidden" name="maintenance_item_id_before[0][]" value="{{ $item->id }}">
                                                </div>
                                            </li>
                                            @endforeach
                                            </ul>
                                        </div>

                                        <!-- After Maintenance -->
                                        <div class="col-md-5 dotted-2-primary pb-3 pt-3 b-r-20">
                                            <h6 class="text-center">After</h6>
                                            <div class="mb-3">
                                                <label>Photos After Maintenance</label>
                                                <input type="file" class="form-control" name="photosAfter[]">
                                            </div>
                                            <div class="mb-3">
                                                <label>Description of Error After Maintenance</label>
                                                <textarea class="form-control" rows="5" name="descriptionAfter[]" placeholder="Description"></textarea>
                                            </div>
                                            <label>Maintenance Items:</label>
                                            <ul class="feachers-list">
                                                @foreach($maintenanceItems as $index => $item)
                                                <li class="f-s-16 text-secondary">
                                                    <div class="form-check form-switch d-flex">
                                                        <input type="hidden" name="maintenance_item_status_after[0][{{ $item->id }}]" value="ERROR">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="maintenance_item_status_after[0][{{ $item->id }}]"
                                                            value="OK">
                                                        <label class="form-check-label ms-2">{{ $item->item_name }}</label>
                                                        <input type="hidden" name="maintenance_item_id_afters[0][]" value="{{ $item->id }}">
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-light-danger b-r-22 remove-maintenance">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-light-primary b-r-22 mt-3" id="addLog">Add Another Log</button>

                            <div class="">

                                <hr>
                                <button type="button" class="btn btn-secondary prev-step">Back</button>
                                <input type="submit" name="submit" class="btn btn-primary" value="Save">
                            </div>
                        </div>
                        <!-- Step 3 -->
                        <!-- Step 4: Daily Activity Details (Non-Regular) -->
                        <!-- <div id="step3" class="step step-4">
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
                                <button type="button" class="btn btn-success next-step">Next</button> 
                            </div>
                        </div> -->
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
        let originalLog = document.querySelector('.cloneLog');
        let newDetail = originalLog.cloneNode(true);

        // Hitung jumlah clone yang sudah ada
        let count = document.querySelectorAll('.cloneLog').length;

        // Reset semua input dalam clone
        newDetail.querySelectorAll('input[type="text"], textarea').forEach(input => input.value = '');
        newDetail.querySelectorAll('input[type="file"]').forEach(input => input.value = '');
        newDetail.querySelectorAll('input[type="hidden"]').forEach(input => {
            if (!input.hasAttribute('value')) {
                input.value = '';
            }
        });
        newDetail.querySelectorAll('input[type="checkbox"]').forEach(checkbox => checkbox.checked = false);
        newDetail.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

        // Update name attribute untuk mencerminkan indeks baru
        newDetail.querySelectorAll('[name]').forEach(input => {
            input.name = input.name.replace(/\[\d+\]/, `[${count}]`);
        });

        // Tambahkan elemen baru ke dalam container
        document.getElementById('logHere').appendChild(newDetail);

        // Re-inisialisasi event listener untuk tombol remove
        updateRemoveButtons();
    });

    function updateRemoveButtons() {
        document.querySelectorAll('.remove-maintenance').forEach(button => {
            button.addEventListener('click', function() {
                if (document.querySelectorAll('.cloneLog').length > 1) {
                    this.closest('.cloneLog').remove();
                    updateIndexes(); // Perbarui indeks setelah penghapusan
                } else {
                    pesan('error 405, Method Not Allowed', "Form ini Tidak dapat dihapus !!", 'error');
                }
            });
        });
    }

    // Fungsi untuk memperbarui indeks setelah penghapusan
    function updateIndexes() {
        document.querySelectorAll('.cloneLog').forEach((log, index) => {
            log.querySelectorAll('[name]').forEach(input => {
                input.name = input.name.replace(/\[\d+\]/, `[${index}]`);
            });
        });
    }

    // Panggil saat pertama kali halaman dimuat
    updateRemoveButtons();

    
</script>
<script>


$(document).ready(function() {


    // $(document).on("click", ".remove-maintenance", function () {
    //     if (document.querySelectorAll('.cloneLog').length > 1) {
    //         $(this).closest(".cloneLog").remove();
    //     }else{
    //         pesan('error 405, Method Not Allowed',"Form ini Tidak dapat di hapus !!",'error');
    //     }
    // });

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
            pemberitahuan("success", "Ganti lokasi: ");
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
    
    $(document).on('click', '.remove-activity', function() {
        if (document.querySelectorAll('.Step-2').length > 1) {
            $(this).closest('.Step-2').remove();
        }else{
            pesan('error 405, Method Not Allowed',"Form ini Tidak dapat di hapus !!",'error');
        }
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
        let newDetail = document.querySelector('.Step-2').cloneNode(true);
        document.getElementById('Step-2').appendChild(newDetail);  
    });
        
    

    
});
</script>
@endpush