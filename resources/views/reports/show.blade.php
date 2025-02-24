@extends('layouts.app')
@section('title')
Daily Report
@endsection
@section('content')


<main>
    <div class="container-fluid">

    <div class="ticket-details row">
        <div class="col-md-5 col-lg-4 col-xxl-3">
            <!-- 1 -->
            <div class="card" id="printFrame">
                <div class="card-body ">
                    <div class="ticket-details-profile ">
                        <div class="ticket-profile mb-5 mt- ">
                            <div class="h-45 w-200 d-flex-center b-r-10   me-3">
                                <img src="{{ asset('assets/images/logo/sagadasa2.png') }}" alt="" class="img-fluid mt-5 ">
                            </div>
                        </div>
                        <div class="text-center">
                            <h6 class="mb-0">{{ $report->contractor->contractor_name }}</h6>
                            <p class="text-secondary">{{ $report->contractor->contact_information }}</p>
                        </div>
                    </div>
                    <div class="about-list pt-0">
                        <div>
                        <span class="fw-medium">Date</span>
                        <span class="float-end f-s-13 text-secondary">{{ date('d F Y', strtotime( $report->report_date)) }}</span>
                        </div>
                        <div>
                        <span class="fw-medium">Company</span>
                        <span class="float-end f-s-13 text-secondary">{{ $report->company->company_name }}</span>
                        </div>
                        <div>
                        <span class="fw-medium">Location</span>
                        <span class="float-end f-s-13 text-secondary">{{ $report->location }}</span>
                        </div>
                        <div>
                        <span class="fw-medium">Activity</span>
                        <span class="float-end f-s-13 badge text-light-primary">{{ $report->detail_activity }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 2 -->
            <div class="card">
                <div class="card-header">
                <h5>Actions</h5>
                </div>
                <div class="card-body">
                    <div class="file-upload-btn mt-3 mr-2">
                        <div class="d-flex">
                            <button type="button" id="printBtn" class="btn bg-outline-warning  icon-btn b-r-22 me-3 print-btn" onclick="window.print()"> 
                                <i class="ti ti-printer f-s-18"></i>
                            </button>
                            <button type="button" class="btn bg-outline-danger icon-btn b-r-22 delete-btn me-3" data-id="{{ $report->id }}" >
                                        <i class="ti ti-trash  f-s-18"> </i>
                            </button>
                            <a href="{{ route('export.daily-reports', ['id' => $report->id]) }}">
                                <button type="button" class="btn bg-outline-success  icon-btn b-r-22 me-3">
                                    <i class="ph-light ph-file-xls  f-s-18"> </i>
                                </button>
                            </a>
                            <a href="{{ url('/daily-report/'.$report->id.'/pdf') }}">
                                <button type="button" class="btn bg-outline-primary  icon-btn b-r-22 me-3">
                                    <i class="ph-light ph-file-pdf f-s-18"></i> 
                                </button>
                            </a>
                                <button type="button" id="button-eyes" class="btn bg-outline-secondary  icon-btn b-r-22 me-3 btn-form-show" >
                                    <i class="ph-thin  ph-note-pencil f-s-18"></i>
                                </button>
                                <button type="button" class="btn bg-outline-success  icon-btn b-r-22 me-3 " id="save-btn" onclick="mySave();" disabled>
                                    <i class="ph-light  ph-floppy-disk -s-18"></i>
                                </button>
                        </div>
                        <div>
                            <!-- <a href="{{ url('/daily-report/'.$report->id.'/pdf') }}">
                                <button type="button" class="btn bg-outline-info icon-btn b-r-22 me-3">
                                    <i class="ti ti-download f-s-18"></i> 
                                </button>
                            </a> -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        <!-- this right -->
        <div class="col-md-7 col-lg-8  col-xxl-9 print-area" id="printFrame">
            <div class="card">
                <div class="card-header">
                <h5>@yield('title')</h5>
                </div>
                <div class="card-body">
                    <div class="ticket-details-content">
                        <div class="mb-3">
                            <h6>Work Time</h6>
                            <p class="text-secondary f-s-16">Start At {{ $report->work_start }} to {{ $report->work_stop }}</p>
                        </div>
                        <div class="mb-3">
                            <h6>Work Reason</h6>
                            <p class="text-secondary f-s-16 label-hidden" id="label-hidden">{{ $report->work_reason }}</p>
                            <div class="work-reason">
                                <textarea name="work_reason" id="work_reason" class="form form-control input-hidden work_reason" >{{ $report->work_reason }}</textarea>
                            </div>
                            <input type="hidden" name="report_id" id="report_id" value="{{ $report->id }}">
                        </div>
                        <div class="mb-3">
                        <h6>Service Data</h6>
                        <p class="text-secondary label-hidden">{{ $report->service_data }}</p>
                        <textarea name="service_data" class="form form-control input-hidden service_data" id="service_data">{{ $report->service_data }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- loop this  -->
            <div class="card">
                <div class="app-divider-v justify-content-center">
                    <h5>Detail Activity</h5>
                </div>
                @foreach($regularActivitiesActivity as $activity)
                @foreach($activity->maintenanceLogs as $log)
                <div class="card-body">
                    <div class="ticket-comment-box mb-3">
                        <div class="d-flex justify-content-between position-relative flex-wrap">
                            <div class="h-45 w-45 d-flex-center b-r-50 bg-success overflow-hidden position-absolute">
                                <a href="{{ asset('storage/reportImg/' . $log->photos) }}" class="glightbox" data-glightbox="type: image; zoomable: true;"><img src="{{ asset('storage/reportImg/' . $log->photos) }}" alt="" class="img-fluid"></a>
                            </div>
                            <div class="flex-grow-1 ps-2 pe-2 ms-5">
                                <h6 class="mb-0">Before {{ $report->detail_activity }}  in {{ $report->location }}</h6>
                                <p class="text-muted f-s-14">{{ date('d F Y', strtotime( $report->report_date)) }}</p>
                                <p class="text-dark mb-1 label-hidden" > {{ $log->description }} at {{ $report->work_start }}</b></p>
                                <textarea name="activity_description[{{ $log->id }}]" class="form form-control input-hidden input-activity" id="activity_description">{{ $log->description }}</textarea>
                                <input type="hidden" name="Log_id[]" value="{{ $log->id }}">
                                <!-- <button type="button" style="display:none;" class="btn bg-outline-danger icon-btn b-r-22 delete-activity-btn me-3 mt-3 input-hidden" data-id="{{ $log->id }}" >
                                        <i class="ti ti-trash  f-s-18 input-hidden"> </i>
                                </button> -->
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endforeach
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-3 ">
                        <!-- <button type="button" class="btn bg-outline-primary b-r-22  input-hidden ">add activity</button> -->
                    </div>
                </div>
                <!-- endloop -->
            </div>
            <!-- loop this  -->
            <div class="card">
                <div class="app-divider-v justify-content-center">
                    <h5>Regular Activity</h5>
                </div>
                @foreach($regularActivitiesRegular as $activity)
                @foreach($activity->maintenanceLogs as $log)
                <!-- loop this  -->
                <div class="card-body">
                    <div class="ticket-comment-box mb-3">
                        <div class="d-flex justify-content-between position-relative flex-wrap">
                            <div class="h-45 w-45 d-flex-center b-r-50 bg-success overflow-hidden position-absolute">
                                <a href="{{ asset('storage/reportImg/' . $log->photos) }}" class="glightbox" data-glightbox="type: image; zoomable: true;"><img src="{{ asset('storage/reportImg/' . $log->photos) }}" alt="" class="img-fluid"></a>
                            </div>
                            <div class="flex-grow-1 ps-2 pe-2 ms-5">
                                <h6 class="mb-0">Before {{ $activity->activity_description }}</h6>
                                <p class="text-muted f-s-14">{{ $report->detail_activity }} of {{ optional($activity->device)->device_name }} </p>
                                <p class="text-dark mb-3"> {{ $log->description }}</b></p>
                                <textarea name="activity_description[{{ $log->id }}]" class="form form-control input-hidden input-activity" id="">{{ $log->description }}</textarea>
                                <input type="hidden" name="Log_id[]" value="{{ $log->id }}">
                                @if(!isset($log->maintenanceAfter))
                                <!-- <button type="button" style="display:none;" class="btn bg-outline-danger icon-btn b-r-22 delete-activity-btn me-3 mt-3 input-hidden" data-id="{{ $log->id }}" >
                                        <i class="ti ti-trash  f-s-18 input-hidden"> </i>
                                </button> -->
                                
                                @endif
                            </div>
                            <div class="ms-5">
                                <p>Log Maintenance</p>
                            </div>
                        </div>
                        <ul class="d-flex flex-wrap ms-5">
                            <li class="me-3 w-250 mb-3">
                                <div class="ticket-details-comment p-3 w-100">
                                    @foreach($log->maintenanceLogDetail as $detail)
                                        <p class="mb-0 text-secondary label-hidden">{{$detail->maintenance_item_id}} : {{$detail->status}}</p>
                                       
                                    @endforeach
                                    @foreach($log->maintenanceLogDetail as $detail)
                                        <div class="form-check form-switch input-hidden">
                                            @if($detail->status === "OK")
                                            <input class="form-check-input before_check input-hidden" type="checkbox" name="after_check[]" id="" value="{{ $detail->id }}" checked>
                                            @elseif($detail->status === "ERROR")
                                            <input class="form-check-input before_check input-hidden" type="checkbox" name="after_check[]" id="" value="{{ $detail->id }}">
                                            @endif
                                            <label class="form-check-label ms-2 input-hidden">{{ $detail->maintenance_item_id }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </div>
                    @php
                        $afterLog = $log->maintenanceAfter; // Ambil Maintenance After dari Maintenance Log
                    @endphp
                    @if(isset($log->maintenanceAfter))
                    <div class="ticket-comment-box mb-3">
                        <div class="d-flex justify-content-between position-relative flex-wrap">
                            <div class="h-45 w-45 d-flex-center b-r-50 bg-primary overflow-hidden position-absolute">
                            <a href="{{ asset('storage/reportImg/' . $afterLog->photos) }}" class="glightbox" data-glightbox="type: image; zoomable: true;"><img src="{{ asset('storage/reportImg/' . $afterLog->photos) }}" alt="" class="img-fluid"></a>
                            </div>
                            <div class="flex-grow-1 ps-2 pe-2 ms-5">
                                <h6 class="mb-0">After {{ $activity->activity_description }}</h6>
                                <p class="text-muted f-s-14">{{ $report->detail_activity }} of {{ optional($activity->device)->device_name }}</p>
                                <p class="text-dark mb-3">{{optional($afterLog)->description}}</p>
                                <textarea name="after_description[{{ $afterLog->id }}]" class="form form-control input-hidden input-after-activity" id="">{{ $afterLog->description }}</textarea>
                                <input type="hidden" name="afterLog_id[]" value="{{ $afterLog->id }}">
                                <!-- <button type="button" style="display:none;" class="btn bg-outline-danger icon-btn b-r-22 delete-after-btn me-3 mt-3 input-hidden" data-id="{{ $afterLog->id }}" >
                                        <i class="ti ti-trash  f-s-18 input-hidden"> </i>
                                </button> -->
                            </div>
                            <div class="ms-5">
                                <p>Log Maintenance</p>
                            </div>
                        </div>
                        <ul class="d-flex flex-wrap ms-5">
                            <li class="me-3 w-250 mb-3">
                                <div class="ticket-details-comment p-3 w-100">
                                    @php
                                        $afterLogs = $log->maintenanceAfter->maintenanceLogAfterDetail; // Ambil Maintenance After dari Maintenance Log
                                    @endphp
                                    @foreach($afterLogs As $row)
                                        <p class="mb-0 text-secondary label-hidden">{{ $row->item_name}} : {{$row->status}}</p>
                                    @endforeach
                                    @foreach($afterLogs As $row)
                                        <div class="form-check form-switch input-hidden">
                                            @if($row->status === "ok" || $row->status === "OK")
                                            <input class="form-check-input after_check input-hidden" type="checkbox" name="after_check[]" id="after_check" value="{{ $row->id }}" checked>
                                            @elseif($row->status === "error" || $row->status === "ERROR")
                                            <input class="form-check-input after_check input-hidden" type="checkbox" name="after_check[]" id="after_check" value="{{ $row->id }}">
                                            @endif
                                            <label class="form-check-label ms-2 input-hidden">{{ $row->item_name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
                <!-- endloop -->
                <div class="app-divider-v text-secondary">
                    <span class="badge text-bg-secondary">Next Record</span>
                </div>
                @endforeach
                @endforeach
                <!-- endloop -->
            </div>
        </div>   
    </div>
</main>

@endsection

@push('item-scripts')
<script>
    const toggleButton = document.getElementById('button-eyes');

    toggleButton.addEventListener('click', function() {
        hideEdit();

    });

    function hideEdit() {
        const inputHidden = document.querySelectorAll('.input-hidden');
        const labelHidden = document.querySelectorAll('.label-hidden');
        inputHidden.forEach(element => {
            if (element.style.display === 'none' || element.style.display === '') {
                element.style.display = 'block';
                document.getElementById("save-btn").disabled = false;

            } else {
                element.style.display = 'none';
                document.getElementById("save-btn").disabled = true;
            }
            
        });
        labelHidden.forEach(element2 => {
            if (element2.style.display === 'block' || element2.style.display === '') {
                element2.style.display = 'none';
                
            } else {
                element2.style.display = 'block';
            }
            
        });
    }
   
</script>
<script>
    
    function mySave(){

        konfirmasi2().then((result) => {
        if (result.isConfirmed) {
            location.reload();
        }});
    }
$(document).ready(function() {

   

    $(document).on('click', '.delete-btn', function() {
        const id = $(this).data('id');
        konfirmasi().then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/report/delete/${id}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    
                    setTimeout(function(){
                        window.location.replace("/report");
                    }, 2000);
                    pesan("Terhapus","Data berhasil di hapus","success");
                }
            });
        }});
    });
    $(document).on('click', '.delete-activity-btn', function() {
        const id = $(this).data('id');
        konfirmasi().then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/log/delete/${id}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                    pesan("Terhapus ","Data berhasil di hapus","success");
                }
            });
        }});
    });

    $(document).on('click', '.delete-after-btn', function() {
        const id = $(this).data('id');
        konfirmasi().then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/logafter/delete/${id}`,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                    pesan("Terhapus ","Data berhasil di hapus","success");
                }
            });
        }});
    });

    // this work reason edit function
    $(".work_reason").focusout(function(){

        const formValue = $('#work_reason').val();
        const DBField= 'work_reason';
        const id = $('#report_id').val();
        const url = `/reports/update/${id}`;
        myUpdate(formValue,DBField,id,url)
       
    });
    
    $(".service_data").focusout(function(){

        const id = $('#report_id').val();
        const formValue = $('#service_data').val();
        const DBField= 'service_data';
        const url = `/reports/update/${id}`;
        myUpdate(formValue,DBField,id,url)
       
    });
    
    $(".before_check").change(function () {
      
        let id = $(this).val(); // Mengambil ID dari value checkbox
        let status = $(this).is(":checked") ? "OK" : "ERROR"; // Mengecek status checked atau tidak
        let DBField = 'logDetail';
        const url = `/logdetail/update/${id}`;

        // console.log("ID:", id, "Status:", status);

        myUpdate(status, DBField, id,url);
        
        // Kirim data ke fungsi update atau AJAX jika diperlukan
        
    });
    $(".after_check").change(function () {
      
        let id = $(this).val(); // Mengambil ID dari value checkbox
        let status = $(this).is(":checked") ? "OK" : "ERROR"; // Mengecek status checked atau tidak
        let DBField = 'logAfterDetail';
        const url = `/logdetail/update/${id}`;

        // console.log("ID:", id, "Status:", status);

        myUpdate(status, DBField, id,url);
        
        // Kirim data ke fungsi update atau AJAX jika diperlukan
        
    });

    $(".input-activity").focusout(function () {
        let logId = $(this).closest(".mb-3").find("input[name='Log_id[]']").val();
        let formValue = $(this).val();
        let DBField = 'description';
        const url = `/log/update/${logId}`;

        if (logId && formValue) {
            // Kirim data ke fungsi update
            myUpdate(formValue, DBField, logId,url);
            // pemberitahuan("success","berhasil mengupdate "+ url);
        }
    });

    $(".input-after-activity").focusout(function () {
        let logId = $(this).closest(".mb-3").find("input[name='afterLog_id[]']").val();
        let formValue = $(this).val();
        let DBField = 'after_description';
        const url = `/log/update/${logId}`;

        if (logId && formValue) {
            // Kirim data ke fungsi update
            myUpdate(formValue, DBField, logId,url);
            // pemberitahuan("success","berhasil mengupdate "+ url);
        }
    });

    function myUpdate(formValue, DBField,id, url){
        
        const method = 'PUT';

        
        $.ajax({
            url: url,
            method: method,
            data: {
                FieldData: formValue,
                SetField: DBField,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // pemberitahuan("success","berhasil mengupdate "+ response.data);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                pesan('error' ,xhr.responseJSON.message, "error");
            }
        });
    }

});

</script>

@endpush