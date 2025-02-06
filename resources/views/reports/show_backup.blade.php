@extends('layouts.app')
@section('title')
Daily Report
@endsection
@section('content')


<main>
    <div class="container-fluid">

    <div class="row">
        <div class="col-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="main-title text-center">@yield('title')</h4>
            </div>
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table">
                    <tr>
                        <td>
                        <table class="table table-lg w-100 invoice-header">
                            <tbody>
                            <tr>
                                <td>
                                <div class=" mb-3">
                                    <div class="mb-3">
                                    <img src="{{ asset('assets/images/logo/sagadasa2.png') }}" class="" width="200" alt="">
                                    </div>
                                    <div>
                                </div>
                                </td>
                                <td>
                                <div class=" text-end">
                                    <div class="mb-1">
                                        <h3 class="text-primary">Activity</h3>
                                    </div>
                                    <div class="">
                                        <p>Activity <strong>{{ $report->detail_activity }}</strong></p>
                                        <p>Activity Date <strong>{{ date('d F Y', strtotime( $report->report_date)) }}</strong></p>
                                        <p>Activity Start At <strong>{{ $report->work_start }}</strong></p>
                                        <p>Activity Stop At <strong>{{ $report->work_stop }}</strong></p>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>

                    <tr>
                        <td>
                        <table class="invoice-details-table table table-lg w-100">
                            <tbody>
                            <tr>
                                <td>
                                <div class="mb-3 ">
                                    <h6 class="f-w-600">Company</h6>
                                    {{ $report->company->company_name }}
                                    <address>
                                    {{ $report->company->address }}
                                    </address>
                                    {{ $report->company->contact }}
                                </div>
                                </td>
                                <td>
                                <div class="mb-3">
                                    <h6 class="f-w-600">Contractor</h6>
                                    {{ $report->contractor->contractor_name }}
                                    <address>
                                    {{ $report->contractor->address }}
                                    <br>
                                    {{ $report->approved_by }}
                                    </address>
                                    {{ $report->contractor->contact_information }}
                                </div>
                                </td>
                                <td>
                                <div class=" text-end mb-3">
                                    <h6 class="f-w-600">Man Powers</h6>
                                    @foreach($report->manPowers As $man)
                                    <p>{{ $man->name }}</p>
                                    <p>As {{ $man->position }}</p>
                                    @endforeach
                                </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>

                    <tr>
                        <td>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center size22">Photo</th>
                                    <th class="text-center size22">Activity</th>
                                </tr>
                            </thead>
                            @foreach($regularActivitiesRegular as $activity)
                                @foreach($activity->maintenanceLogs as $log)
                                        <tr>
                                            <td width="40%"><div class="text-center size22"><b>Before</b></div></td>
                                            <td>
                                                <p style="font-size:16px;">{{ $activity->activity_description }} of {{ optional($activity->device)->device_name }} <br><br> {{ $log->description }}</b>
                                                @foreach($log->maintenanceLogDetail as $detail)
                                                    <div class="row" style="font-size:14px;">
                                                        <div class="col-sm-2">{{$detail->maintenance_item_id}}</div>
                                                        <div class="col-sm-1">:</div>
                                                        <div class="col-sm-3">{{$detail->status}}</div>
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                        @php
                                            $afterLog = $log->maintenanceAfter; // Ambil Maintenance After dari Maintenance Log
                                        @endphp
                                        <tr>
                                            <td width="40%"><div class="text-center size22"><b>After</b></div></td>
                                            <td>
                                                <p style="font-size:16px;">{{ $activity->activity_description }} of {{ optional($activity->device)->device_name }} {{optional($afterLog)->description}}<br><br> </b>
                                                @foreach($log->maintenanceLogDetail as $detail)
                                                    <div class="row" style="font-size:14px;">
                                                        <div class="col-2">{{$detail->maintenance_item_id}}</div>
                                                        <div class="col-1">:</div>
                                                        <div class="col-3">{{$detail->status}}</div>
                                                    </div>
                                                @endforeach
                                            
                                            </td>

                                        </tr>
                                        @endforeach
                                        @endforeach
                            </tbody>
                        </table>
                        </td>
                    </tr>
                    </table>
                </div>
                <hr>
                <div class="invoice-footer float-end mb-3">
                  <button type="button" class="btn btn-primary m-1" onclick="window.print()"><i
                      class="ti ti-printer"></i> Print</button>
                  <a href="{{ url('/daily-report/'.$report->id.'/pdf') }}"><button type="button" class="btn btn-success m-1"><i class="ti ti-download"></i> Download</button></a>
                  <button type="button" class="btn btn-danger m-1 delete-btn" data-id="{{ $report->id }}" >
                            <i class="ti ti-trash"> </i>Hapus
                 </button>
                </div>
                <div class="invoice-footer mb-3">
                    <p></p>
                </div>
            </div>
        </div>
        </div>      
    </div>
    </div>
</main>

@endsection

@push('item-scripts')
<script>
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
                        pesan("Terhempas","Device berhasil di hapus","success");
                    }
                });
            }});
        });
    });
</script>
@endpush