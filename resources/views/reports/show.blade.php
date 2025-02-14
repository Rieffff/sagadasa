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
                        </div>
                        <div>
                            <a href="{{ url('/daily-report/'.$report->id.'/pdf') }}">
                                <button type="button" class="btn bg-outline-info icon-btn b-r-22 me-3">
                                    <i class="ti ti-download f-s-18"></i> 
                                </button>
                            </a>
                            
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
                            <p class="text-secondary f-s-16">{{ $report->work_reason }}</p>
                        </div>
                        <div class="mb-3">
                        <h6>Service Data</h6>
                        <p class="text-secondary">{{ $report->service_data }}</p>
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
                                <p class="text-dark mb-1"> {{ $log->description }} at {{ $report->work_start }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endforeach
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
                            </div>
                            <div class="ms-5">
                                <p>Log Maintenance</p>
                            </div>
                        </div>
                        <ul class="d-flex flex-wrap ms-5">
                            <li class="me-3 w-250 mb-3">
                                <div class="ticket-details-comment p-3 w-100">
                                    @foreach($log->maintenanceLogDetail as $detail)
                                        <p class="mb-0 text-secondary">{{$detail->maintenance_item_id}} : {{$detail->status}}</p>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </div>
                    @php
                        $afterLog = $log->maintenanceAfter; // Ambil Maintenance After dari Maintenance Log
                    @endphp
                    <div class="ticket-comment-box mb-3">
                        <div class="d-flex justify-content-between position-relative flex-wrap">
                            <div class="h-45 w-45 d-flex-center b-r-50 bg-primary overflow-hidden position-absolute">
                            <a href="{{ asset('storage/reportImg/' . $afterLog->photos) }}" class="glightbox" data-glightbox="type: image; zoomable: true;"><img src="{{ asset('storage/reportImg/' . $afterLog->photos) }}" alt="" class="img-fluid"></a>
                            </div>
                            <div class="flex-grow-1 ps-2 pe-2 ms-5">
                                <h6 class="mb-0">After {{ $activity->activity_description }}</h6>
                                <p class="text-muted f-s-14">{{ $report->detail_activity }} of {{ optional($activity->device)->device_name }}</p>
                                <p class="text-dark mb-3">{{optional($afterLog)->description}}</p>
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
                                        <p class="mb-0 text-secondary">{{ $row->item_name}} : {{$row->status}}</p>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </div>
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
    $(document).ready(function() {
        $(document).on('click','.print-btn', function(){
            
        });
        

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
                        pesan("Terhempas","Device berhasil di hapus","success");
                    }
                });
            }});
        });
    });
</script>

@endpush