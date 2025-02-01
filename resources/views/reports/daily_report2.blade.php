<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Daily Report</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <style>
         html{
            width:70%;
            margin-right:auto;
            margin-left:auto;
        }
        body { 
            font-size: 12px;
            align-content:center;
         }
         div> p{
            font-weight: bold;
            font-size:14px;
         }
        .table-bordered th, .table-bordered td { border: 1px solid black !important; }
        .text-bold{
            font-weight: bold;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body class="mt-5" >
    <div class="container container-fluid">
        <table class="table table-bordered">
            <tr>
                <th colspan="4" class="text-center"><h4>{{ $report->company->company_name }}</h4></th>
            </tr>
            <tr>
                <td rowspan="3">
                    @if($report->company->logo)
                        <img src="{{ asset('storage/logos/' . $report->company->logo) }}" alt="Company Logo" class="rounded mx-auto d-block" width="150" >
                    @else
                        <p>No Logo Available</p>
                    @endif
                </td>
                <td rowspan="2" colspan="2"><p class="text-center text-bold">document Title:</p><br><h3 class="text-center">DAILY REPORT</h3></td>
                <td rowspan="3"> 
                    @if($report->contractor->logo)
                        <img src="{{ asset('storage/logos/' . $report->contractor->logo) }}" alt="Company Logo" class="rounded mx-auto d-block" width="150" >
                    @else
                        <p>No Logo Available</p>
                    @endif</td>
            </tr>
            <tr>

            </tr>
            <tr>
                <td><b>Reff No:</b></td>
                <td>Page 1 of </td>
            </tr>
        </table>
        
        <h2 class="text-center text-decoration-underline">DAILY REPORT</h2>

       
        <div class="row justify-content-center mx-5 px-5">
            <div class="col-4 text-start"><p>COMPANY</p></div>
            <div class="col-2 text-end"><p>:</p></div>
            <div class="col-4 text-start"><p>{{ $report->company->company_name }}</p></div>
        </div>
        <div class="row justify-content-center mx-5 px-5">
            <div class="col-4 text-start"><p>CONTRACTOR</p></div>
            <div class="col-2 text-end"><p>:</p></div>
            <div class="col-4 text-start"><p>{{ $report->contractor->contractor_name }}</p></div>
        </div>
        <div class="row justify-content-center mx-5 px-5">
            <div class="col-4 text-start"><p>CONTRACT REF</p></div>
            <div class="col-2 text-end"><p>:</p></div>
            <div class="col-4 text-start"><p></p></div>
        </div>
        <div class="row justify-content-center mx-5 px-5">
            <div class="col-4 text-start"><p>LOCATION</p></div>
            <div class="col-2 text-end"><p>:</p></div>
            <div class="col-4 text-start"><p>{{ $report->location }}</p></div>
        </div>
        <div class="row justify-content-center mx-5 px-5">
            <div class="col-4 text-start"><p>DETAIL ACTIVITY</p></div>
            <div class="col-2 text-end"><p>:</p></div>
            <div class="col-4 text-start"><p>{{ $report->detail_activity }}</p></div>
        </div>
        <div class="row justify-content-center mx-5 px-5">
            <div class="col-4 text-start"><p>DATE</p></div>
            <div class="col-2 text-end"><p>:</p></div>
            <div class="col-4 text-start"><p>{{ date('d F Y', strtotime($report->report_date)) }}</p></div>
        </div>
        
     
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="2"><h6 class="text-decoration-underline">Actual Work / service data:</h6></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2" class="py-5 px-4"><p><b>{{ $report->service_data }}</b></p></td>
                </tr>
                <tr>
                    <td colspan="2"><h6 class="text-decoration-underline">Conformity to P.O :</h6></td>
                </tr>
                <tr>
                    <td width="50%">
                        <b>
                        <p class="my-0">{{ $report->contractor->contractor_name }}</p>
                        <p class="my-0">Representative</p>
                        <p class="my-0">sign :</p>
                        <br>
                        <br>
                        <br>
                        <br>
                        <p><div class="row"><div class="col-1">Name </div><div class="col-6">:</div></div></p>
                        <p><div class="row"><div class="col-1">Date </div><div class="col-6">:</div></div></p>
                        </b>
                    </td>
                    <td>
                        <b>
                        <p class="my-0">{{ $report->company->company_name }}</p>
                        <p class="my-0">Representative</p>
                        <p class="my-0">sign :</p>
                        <br>
                        <br>
                        <br>
                        <br>
                        <p><div class="row"><div class="col-1">Name </div><div class="col-6">:_______________</div></div></p>
                        <p><div class="row"><div class="col-1">Date </div><div class="col-6">:_______________</div></div></p>
                        </b>
                    </td>
                </tr>
            </tbody>
        </table>

        

        
       <div class="mt-5 text-start">
            <p><strong>{{ $report->contractor->contractor_name }} - Daily Report - {{ $report->detail_activity }} - {{ date('Y', strtotime($report->report_date)) }}</strong> </p>
        </div>
    </div>

    @foreach($maintenanceLogsActivity as $activity)
    <div class="page-break"></div>

    <div class="container container-fluid">
        <table class="table table-bordered">
            <tr>
                <th colspan="4" class="text-center"><h4>{{ $report->company->company_name }}</h4></th>
            </tr>
            <tr>
                <td rowspan="3">
                    @if($report->company->logo)
                        <img src="{{ asset('storage/logos/' . $report->company->logo) }}" alt="Company Logo" class="rounded mx-auto d-block" width="150" >
                    @else
                        <p>No Logo Available</p>
                    @endif
                </td>
                <td rowspan="2" colspan="2"><p class="text-center text-bold">document Title:</p><br><h3 class="text-center">DAILY REPORT</h3></td>
                <td rowspan="3"> 
                    @if($report->contractor->logo)
                        <img src="{{ asset('storage/logos/' . $report->contractor->logo) }}" alt="Company Logo" class="rounded mx-auto d-block" width="150" >
                    @else
                        <p>No Logo Available</p>
                    @endif</td>
            </tr>
            <tr>

            </tr>
            <tr>
                <td><b>Reff No:</b></td>
                <td>Page 1 of </td>
            </tr>
        </table>
        
        

        <h6 class="mt-4">Attachment</h6>
        <br>
        <h6 class="mt-4">Detail Activity</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center size22">Photo</th>
                    <th  class="text-center size22">Activity</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td width="40%"><img src="{{ asset('storage/reportImg/' . $activity->photos) }}" alt="Company Logo" class="rounded mx-auto d-block" width="100%" ></td>
                        <td><p class="size22">{{ $activity->description }}</p></td>
                    </tr>
            </tbody>
        </table>

       <div class="mt-5 text-start">
            <p><strong>{{ $report->contractor->contractor_name }} - Daily Report - {{ $report->detail_activity }} - {{ date('Y', strtotime($report->report_date)) }}</strong> </p>
        </div>
    </div>
    
    @endforeach


    @foreach($regularActivitiesRegular as $activity)
     @foreach($activity->maintenanceLogs as $log)
    <div class="page-break"></div>

    <div class="container container-fluid">
        <table class="table table-bordered">
            <tr>
                <th colspan="4" class="text-center"><h4>{{ $report->company->company_name }}</h4></th>
            </tr>
            <tr>
                <td rowspan="3">
                    @if($report->company->logo)
                        <img src="{{ asset('storage/logos/' . $report->company->logo) }}" alt="Company Logo" class="rounded mx-auto d-block" width="150" >
                    @else
                        <p>No Logo Available</p>
                    @endif
                </td>
                <td rowspan="2" colspan="2"><p class="text-center text-bold">document Title:</p><br><h3 class="text-center">DAILY REPORT</h3></td>
                <td rowspan="3"> 
                    @if($report->contractor->logo)
                        <img src="{{ asset('storage/logos/' . $report->contractor->logo) }}" alt="Company Logo" class="rounded mx-auto d-block" width="150" >
                    @else
                        <p>No Logo Available</p>
                    @endif</td>
            </tr>
            <tr>

            </tr>
            <tr>
                <td><b>Reff No:</b></td>
                <td>Page 1 of </td>
            </tr>
        </table>

        <h6 class="mt-4">Attachment</h6>
        <br>
        <h6 class="mt-4">Regular Activity</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center size22">Photo</th>
                    <th class="text-center size22">Activity</th>
                </tr>
            </thead>
            <tbody>
                        <tr>
                            <td width="40%"><img src="{{ asset('storage/reportImg/' . $log->photos) }}" alt="Company Logo" class="rounded mx-auto d-block" width="100%" > <div class="text-center size22"><b>Before</b></div></td>
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
                            <td width="40%"><img src="{{ asset('storage/reportImg/' . $afterLog->photos) }}" alt="Company Logo" class="rounded mx-auto d-block" width="100%" > <div class="text-center size22"><b>After</b></div></td>
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
            </tbody>
        </table>
        

       <div class="mt-5 text-start">
            <p><strong>{{ $report->contractor->contractor_name }} - Daily Report - {{ $report->detail_activity }} - {{ date('Y', strtotime($report->report_date)) }}</strong> </p>
        </div>
    </div>
    @endforeach
    @endforeach
    
    @foreach($maintenanceLogsNonregular as $activity)
    <div class="page-break"></div>
    
    <div class="container container-fluid">
        <table class="table table-bordered">
            <tr>
                <th colspan="4" class="text-center"><h4>{{ $report->company->company_name }}</h4></th>
            </tr>
            <tr>
                <td rowspan="3">
                    @if($report->company->logo)
                        <img src="{{ asset('storage/logos/' . $report->company->logo) }}" alt="Company Logo" class="rounded mx-auto d-block" width="150" >
                    @else
                        <p>No Logo Available</p>
                    @endif
                </td>
                <td rowspan="2" colspan="2"><p class="text-center text-bold">document Title:</p><br><h3 class="text-center">DAILY REPORT</h3></td>
                <td rowspan="3"> 
                    @if($report->contractor->logo)
                        <img src="{{ asset('storage/logos/' . $report->contractor->logo) }}" alt="Company Logo" class="rounded mx-auto d-block" width="150" >
                    @else
                        <p>No Logo Available</p>
                    @endif</td>
            </tr>
            <tr>

            </tr>
            <tr>
                <td><b>Reff No:</b></td>
                <td>Page 1 of </td>
            </tr>
        </table>

        <h6 class="mt-4">Attachment</h6>
        <br>
        <h6 class="mt-4">Non Regular Activity</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center size22">Photo</th>
                    <th class="text-center size22">Activity</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td width="40%"><img src="{{ asset('storage/reportImg/' . $activity->photos) }}" alt="Company Logo" class="rounded mx-auto d-block" width="100%" ></td>
                        <td>{{ $activity->description }}</td>
                    </tr>
            </tbody>
        </table>

        

       <div class="mt-5 text-start">
            <p><strong>{{ $report->contractor->contractor_name }} - Daily Report - {{ $report->detail_activity }} - {{ date('Y', strtotime($report->report_date)) }}</strong> </p>
        </div>
    </div>
    
    @endforeach
    
</body>
</html>
