@php   
    function base64($image){

        $path = storage_path('app/public/logos/' .$image);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

    function base66($image){
        $path = storage_path('app/public/reportImg/' .$image);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Daily Report</title>
    <link href="{{ public_path('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ public_path('css/bootstrap.css') }}" rel="stylesheet">
    <style>
       
        body { 
            font-size: 12px;
            margin-top:10px;
        }
        html{
            margin-top:5px;
        }
        h6{
            font-size:14px;
            margin-top:0px;
            margin-bottom:0px;
        }
        .size22{
            font-size:12px;
            margin:2px;
        }
        
        .table-bordered th, .table-bordered td { border: 1px solid black !important; }
        
       /* Container */
        .container, .container-fluid {
            width: 100%;
            margin: 0 auto;
            padding: 8px;
        }

        /* Grid System (Menggunakan Table) */
        .row {
            display: table;
            width: 100%;
            table-layout: fixed;
        }
        [class*="text-"]{
            margin:6px;
        }

        [class*="col-"] {
            display: table-cell;
            vertical-align: top;
            padding: 5px;
            margin-top:5px;
            margin-bottom:5px;
        }

        /* Fix width for specific col-* */
        .col-1 { width: 8.33%; }
        .col-2 { width: 16.66%; }
        .col-3 { width: 25%; }
        .col-4 { width: 33.33%; }
        .col-6 { width: 50%; }
        .col-12 { width: 100%; }

        /* Table */
        .table {
            width: 95%;
            border-collapse: collapse;
        }
        .table td > img{
            padding-top:0px;
            padding-bottom:0px;
            padding-right:auto;
            padding-left:auto;
            margin-top:0px;
            margin-bottom:0px;
            margin-right:auto;
            margin-left:auto;
        }

        .table th, .table td {
            padding-top: 4px;
            padding-bottom: 4px;
            padding-right: 8px;
            padding-left: 8px;
            border: 1px solid #000;
        }

        .table th {
            background-color: #ddd;
            font-weight: bold;
            text-align: center;
        }

        td > p{
            margin-top:12px;
        }

        /* Text Utilities */
        .text-center { text-align: center; }
        .text-start { text-align: left; }
        .text-end { text-align: right; }
        .text-decoration-underline { text-decoration: underline; }
        .text-bold { font-weight: bold; }

        /* Margins & Paddings */
        .mt-0 {margin-top:0px; margin-bottom:2px;}
        .mt-1 {margin-top:5px; margin-bottom:15px;}
        .mt-4 { margin-top: 15px; }
        .mt-5 { margin-top: 30px; }
        .my-0 { margin-top:0; margin-bottom:0;}
        .my-1 { margin-top:5px; margin-bottom:5px;}
        .my-2 { margin-top:10px; margin-bottom:10px;}
        .my-3 { margin-top:15px; margin-bottom:15px;}
        .mx-5 { margin-left: 30px; margin-right: 30px; }
        .px-4 { padding-left: 15px; padding-right: 15px; }
        .py-4 { padding-top: 15px; padding-bottom: 15px; }
        .px-5 { padding-left: 30px; padding-right: 30px; }
        .py-5 { padding-top: 30px; padding-bottom: 30px; }


        /* Image */
        .rounded {
            display: block;
            border-radius: 5px;
            margin-top:0px;
            margin-bottom:0px;
            margin-right:0px;
            margin-left:auto;
            padding-top:0px;
            padding-bottom:0px;
            padding-right:auto;
            padding-left:auto;
            max-width:120px;
            min-width:80px;
        }
        .activity{
            max-width:250px;
            max-height:280px;
        }

        /* Page Break for PDF */
        .page-break {
            page-break-before: always;
        }


        
    </style>
</head>
<body class="mt-5">
    <div class="container container-fluid">
        <table class="table table-bordered" >
            <tr >
                <th colspan="4" class="text-center"><h4>{{ $report->company->company_name }}</h4></th>
            </tr>
            <tr>
                <td rowspan="3" style="padding-right:auto;padding-left:auto;">
                    @if($report->company->logo)
                        

                        <img src="{{ base64($report->company->logo) }}" alt="Company Logo" class="rounded" >
                    @else
                        <p>No Logo Available</p>
                    @endif
                </td>
                <td rowspan="2" colspan="2"><p class="text-center text-bold">document Title:</p><br><h3 class="text-center">DAILY REPORT</h3></td>
                <td rowspan="3"> 
                    @if($report->contractor->logo)
                       
                        <img src="{{ base64($report->contractor->logo) }}" alt="Company Logo" class="rounded" >
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
                        <p><div class="row"><div class="col-1">Name </div><div class="col-6 my-0">:_______________</div></div></p>
                        <p><div class="row"><div class="col-1">Date </div><div class="col-6 my-0">:_______________</div></div></p>
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
                        <img src="{{ base64($report->company->logo) }}" alt="Company Logo" class="rounded mx-auto d-block" width="150" >
                    @else
                        <p>No Logo Available</p>
                    @endif
                </td>
                <td rowspan="2" colspan="2"><p class="text-center text-bold">document Title:</p><br><h3 class="text-center">DAILY REPORT</h3></td>
                <td rowspan="3"> 
                    @if($report->contractor->logo)
                        <img src="{{ base64($report->contractor->logo) }}" alt="Company Logo" class="rounded mx-auto d-block" width="150" >
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
        
        

        <h6 class="mt-0">Attachment</h6>
        <h6 class="mt-1">Detail Activity</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center size22">Photo</th>
                    <th  class="text-center size22">Activity</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td width="40%"><img src="{{ base66($activity->photos) }}" alt="Company Logo" class="activity mx-auto d-block" width="100%" ></td>
                        <td><p>{{ $activity->description }}</p></td>
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
                        <img src="{{ base64($report->company->logo) }}" alt="Company Logo" class="rounded mx-auto d-block" width="150" >
                    @else
                        <p>No Logo Available</p>
                    @endif
                </td>
                <td rowspan="2" colspan="2"><p class="text-center text-bold">document Title:</p><br><h3 class="text-center">DAILY REPORT</h3></td>
                <td rowspan="3"> 
                    @if($report->contractor->logo)
                        <img src="{{ base64($report->contractor->logo) }}" alt="Company Logo" class="rounded mx-auto d-block" width="150" >
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

        <h6 class="mt-0">Attachment</h6>
        <h6 class="mt-1">Regular Activity</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center size22">Photo</th>
                    <th class="text-center size22">Activity</th>
                </tr>
            </thead>
            <tbody>
                        <tr>
                            <td width="40%"><img src="{{ base66($log->photos) }}" alt="Company Logo" class="activity mx-auto d-block" width="100%" > <div class="text-center size22"><b>Before</b></div></td>
                            <td>
                                <p style="size22">{{ $activity->activity_description }} of {{ optional($activity->device)->device_name }} <br><br> {{ $log->description }}
                                @foreach($log->maintenanceLogDetail as $detail)
                                    <div class="row" style="font-size:10px;">
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
                            <td width="40%"><img src="{{ base66($afterLog->photos) }}" alt="Company Logo" class="activity mx-auto d-block" width="100%" > <div class="text-center size22"><b>After</b></div></td>
                            <td>
                                <p style="size22">{{ $activity->activity_description }} of {{ optional($activity->device)->device_name }} {{optional($afterLog)->description}}<br><br> </b>
                                @foreach($log->maintenanceLogDetail as $detail)
                                    <div class="row" style="font-size:10px;">
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
                        <img src="{{ base64($report->company->logo) }}" alt="Company Logo" class="rounded mx-auto d-block" width="150" >
                    @else
                        <p>No Logo Available</p>
                    @endif
                </td>
                <td rowspan="2" colspan="2"><p class="text-center text-bold">document Title:</p><br><h3 class="text-center">DAILY REPORT</h3></td>
                <td rowspan="3"> 
                    @if($report->contractor->logo)
                        <img src="{{ base64($report->contractor->logo) }}" alt="Company Logo" class="rounded mx-auto d-block" width="150" >
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

        <h6 class="mt-0">Attachment</h6>
        <h6 class="mt-1">Non Regular Activity</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center size22">Photo</th>
                    <th class="text-center size22">Activity</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td width="40%"><img src="{{ base66($activity->photos) }}" alt="Company Logo" class="activity mx-auto d-block" width="100%" ></td>
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
