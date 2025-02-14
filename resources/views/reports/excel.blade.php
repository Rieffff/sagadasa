<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Activity Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            font-size: 11pt;
        }
        .container {
            width: 100%;
            margin: auto;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
            height:12px;
        }
        th {
            background-color: #CDCDCD;
        }
        .header-table td {
            font-weight: bold;
            border: none;
            padding: 5px;
        }
        .header-table {
            border: none;
        }
        .header-table tr td:first-child {
            
        }
        .section-title {
            font-weight: bold;
            background-color: #ddd;
            text-align: center;
        }
        table{
            max-width:1400px;
            margin-left:auto;
            margin-right:auto;

        }
        .two-column{
            text-align:center;
        }
        .header{
            /* border:none; */
            font-weight: bold;
        }
        .header1{
            width:25px;"
        }
        .w-5{ width: 10px; }
        .w-10{ width: 10px; }
        .w-15{ width: 15px; }
        .w-20{ width: 20px; }
        .w-25{ width: 25px; }
        .w-30{ width: 30px; }
        .w-35{ width: 35px; }
        .w-50{ width: 50px; }
        .w-100{ width: 100px; }
        .w-150{ width: 150px; }
        .w-250{ width: 250px; }
        .w-300{ width: 300px; }
    </style>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px; padding: 0; font-size: 11pt;">
    <div style="width: 100%; margin: auto;">
        
        <!-- Header Informasi -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; border:none;">
            <tr>
                <td colspan="15" rowspan="2" style="border:none; font-weight:bold;font-size:22px; text-align:center;">Daily Activity Report (Subcontractor)</td>
            </tr>
            <tr></tr>
            <tr colspan="15" rowspan="2" style="border:none;">&nbsp;</tr>
            <tr></tr>
            <tr style="font-weight: bold; border:none;">
                <td colspan="3" style="padding: 10px; border:none;">Project</td>
                <td style=" border:none;">:</td>
                <td style="border:none;" colspan="2">{{ $report->company->company_name ?? '-' }}</td>
                <td style="border:none;" >Contractor No</td>
                <td style="border:none;">:</td>
                <td style="border:none;" colspan="2">{{ date('dmY', strtotime($report->report_date)) }}-{{ $report->id }}</td>
                <td rowspan="3" style="border: 1px solid black; text-align: center; font-weight: bold;">Working<br>Time(H)</td>
                <td colspan="2" style="border: 1px solid black; text-align: center; font-weight: bold;">Work</td>
                <td colspan="2" style="border: 1px solid black; text-align: center; font-weight: bold;">Work Break</td>
            </tr>
            <tr>
                <td colspan="3" style="padding: 10px; border:none;">Discipline</td>
                <td style="border:none;">:</td>
                <td style="border:none;" colspan="2">TF</td>
                <td style="border:none;" >Date</td>
                <td style="border:none;">:</td>
                <td style="border:none;" colspan="2">{{ date('d F Y', strtotime($report->report_date)) }}</td>
                <td style="border: 1px solid black; text-align: center; font-weight: bold;">From</td>
                <td style="border: 1px solid black; text-align: center; font-weight: bold;">To</td>
                <td style="border: 1px solid black; text-align: center; font-weight: bold;">Hour</td>
                <td style="border: 1px solid black; text-align: center; font-weight: bold;">Reason</td>
            </tr>
            <tr>
                <td colspan="3" style="padding: 10px; border:none;">Subcontractor</td>
                <td style="border:none;">:</td>
                <td style="border:none;" colspan="2">{{ $report->contractor->contractor_name ?? '-' }}</td>
                <td style="border:none;" >Report No</td>
                <td style="border:none;">:</td>
                <td style="border:none; text-align:left;" colspan="2">{{ $indexNumber }}</td>
                <td style="border: 1px solid black;">{{ $report->work_start ?? '-' }}</td>
                <td style="border: 1px solid black;">{{ $report->work_stop ?? '-' }}</td>
                <td style="border: 1px solid black;">{{ $report->work_break ?? '-' }}</td>
                <td style="border: 1px solid black;">{{ $report->work_reason ?? '-' }}</td>
            </tr>
            <tr>
                <td colspan="3" style="padding: 10px; border:none;">Work Activity</td>
                <td style="border:none;">:</td>
                <td style="border:none;" colspan="2">{{ $report->detail_activity ?? '-' }}</td>
                <td style="border:none;" ></td>
                <td style="border:none;"></td>
                <td style="border:none;" colspan="3"></td>
                <td style="border:none;" colspan="4">Today Work : {{ $totalHours ?? '0' }} Hours {{ $totalMinutes ?? '0' }} Minutes</td>
            </tr>
            <tr>
                <td colspan="15" style="border: 1px solid black;  font-weight: bold;">Work Activity</td>
            </tr>
            <tr style="background-color: #CDCDCD;">
                <td colspan="8" style="border: 1px solid black; text-align:center;"><b>Today / Done</b></td>
                <td colspan="7" style="border: 1px solid black; text-align:center;"><b>Notes</b></td>
            </tr>
            @foreach ($report->manPowers as $index => $manPower)
            <tr>
                <td colspan="8" style="border: 1px solid black; ">Standby {{ $report->company->company_name ?? '-' }} - {{ $manPower->name }}</td>
                <td colspan="7" style="border: 1px solid black; ">{{ $manPower->notes ?? '-' }}</td>
            </tr>
            @endforeach
            @for ($i = 0; $i < 7; $i++)
            <tr>
                <td colspan="8" style="border: 1px solid black; ">&nbsp;</td>
                <td colspan="7" style="border: 1px solid black; ">&nbsp;</td>
            </tr>
            @endfor
            <!-- spacing -->
            <tr style="">
                <td style="border: none;" colspan="15"><b>Gate's Status</b></td>
            </tr>
            <!-- spacing -->
            <tr style="background-color: #CDCDCD;">
                <td style="border: 1px solid black; font-weight:bold;">No</td>
                <td style="border: 1px solid black; font-weight:bold;" colspan="3">Location/Device</td>
                <td style="border: 1px solid black; font-weight:bold;" colspan="4">Description</td>
                @foreach($item as $col)
                <td style="border: 1px solid black; font-weight:bold;">{{$col->item_name}}</td>
                @endforeach
                <td style="border: 1px solid black; font-weight:bold;">Item Replacement</td>
            </tr>
            @php 
                $no = 1;
            @endphp
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;">1</td>
                <td style="border: 1px solid black;" colspan="3"><b>{{$report->location}}</b></td>
                <td style="border: 1px solid black;" colspan="4"></td>
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;"></td>
            </tr>
            @foreach($regularActivitiesRegular as $activity)
            @foreach($activity->maintenanceLogs as $log)
            @php
                $afterLog = $log->maintenanceAfter; // Ambil Maintenance After dari Maintenance Log
            @endphp
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;" colspan="3">{{ optional($activity->device)->device_name }}</td>
                <td style="border: 1px solid black;" colspan="4"> {{optional($afterLog)->description}}</td>
                @php
                    $afterLogs = $log->maintenanceAfter->maintenanceLogAfterDetail; // Ambil Maintenance After dari Maintenance Log
                @endphp
                @foreach($afterLogs as $detail)
                <td style="border: 1px solid black;">{{$detail->status}}</td>
                @endforeach
                <td style="border: 1px solid black;"></td>
            </tr>
            @php 
                $no++;
            @endphp
            @endforeach
            @endforeach

            <!-- spacing -->
            <tr style="">
                <td style="border: none;" colspan="15"><b>INDIRECTION MANPOWER (MD)</b></td>
            </tr>
            <tr style="border: 1px solid black; background-color: #CDCDCD;">
                <td style="border: 1px solid black;"><b>No</b></td>
                <td style="border: 1px solid black;" colspan="4"><b>MANPOWER</b></td>
                <td style="border: 1px solid black;" colspan="3"><b>POSITION</b></td>
                <td style="border: 1px solid black;"><b>No</b></td>
                <td style="border: 1px solid black;" colspan="3"><b>Problem (Today)</b></td>
                <td style="border: 1px solid black;" colspan="3"><b>Solution</b></td>
            </tr>

            @foreach ($report->manPowers as $index => $manPower)
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;">{{ $index + 1 }}</td>
                <td style="border: 1px solid black;" colspan="4">{{ $manPower->name }}</td>
                <td style="border: 1px solid black;" colspan="3">{{ $manPower->position }}</td>
                <td style="border: 1px solid black;">{{ $index + 1 }}</td>
                <td style="border: 1px solid black;" colspan="3"></td>
                <td style="border: 1px solid black;" colspan="3"></td>
            </tr>
            @endforeach
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;" colspan="4"></td>
                <td style="border: 1px solid black;" colspan="3"></td>
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;" colspan="3"></td>
                <td style="border: 1px solid black;" colspan="3"></td>
            </tr>

            <!-- spacing -->
            <tr style="">
                <td style="border: none;" colspan="15"> </td>
            </tr>
            <!-- signature -->
            <tr>
                <td colspan="8" style="border-top: 1px solid black; border-right: 1px solid black; border-left: 1px solid black; border-bottom: none;"><b>Prepared by Subcontractor</b></td>
                <td colspan="7" style="border-top: 1px solid black; border-right: 1px solid black; border-left: 1px solid black; border-bottom: none;"><b>Reviewed by Contractor</b></td>
            </tr>
            <tr>
                <td colspan="3" style="border-left: 1px solid black; border-top: none; border-right: none; border-bottom: none;">Name</td>
                <td colspan="2" style="border: none;">:</td>
                <td colspan="3" style="border-right: 1px solid black; border-top: none; border-left: none; border-bottom: none;">Signature :</td>
                <td style="border-left: 1px solid black; border-top: none; border-right: none; border-bottom: none;">Name</td>
                <td colspan="3" style="border: none;">:</td>
                <td colspan="3" style="border-right: 1px solid black; border-top: none; border-left: none; border-bottom: none;">Signature :</td>
            </tr>
            <tr>
                <td colspan="3" style="border-left: 1px solid black; border-top: none; border-right: none; border-bottom: none;"></td>
                <td style="border: none;"></td>
                <td colspan="4" style="border-right: 1px solid black; border-top: none; border-left: none; border-bottom: none;"></td>
                <td colspan="2" style="border-left: 1px solid black; border-top: none; border-right: none; border-bottom: none;"></td>
                <td style="border: none;"></td>
                <td colspan="4" style="border-right: 1px solid black; border-top: none; border-left: none; border-bottom: none;"></td>
            </tr>
            <tr>
                <td colspan="3" style="border-left: 1px solid black; border-top: none; border-right: none; border-bottom: none;">Date</td>
                <td colspan="2" style="border: none;">:</td>
                <td colspan="3" style="border-right: 1px solid black; border-top: none; border-left: none; border-bottom: none;"></td>
                <td style="border-left: 1px solid black; border-top: none; border-right: none; border-bottom: none;">Date</td>
                <td colspan="2" style="border: none;">:</td>
                <td colspan="4" style="border-right: 1px solid black; border-top: none; border-left: none; border-bottom: none;"></td>
            </tr>
            <tr>
                <td colspan="3" style="border-left: 1px solid black; border-top: none; border-right: none; border-bottom: none;"></td>
                <td style="border: none;"></td>
                <td colspan="4" style="border-right: 1px solid black; border-top: none; border-left: none; border-bottom: none;"></td>
                <td colspan="2" style="border-left: 1px solid black; border-top: none; border-right: none; border-bottom: none;"></td>
                <td style="border: none;"></td>
                <td colspan="4" style="border-right: 1px solid black; border-top: none; border-left: none; border-bottom: none;"></td>
            </tr>
            <tr>
                <td colspan="8" style="border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black; border-top: none;"><b>Prepared by Subcontractor</b></td>
                <td colspan="7" style="border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black; border-top: none;"><b>Reviewed by Contractor</b></td>
            </tr>
            <!-- This line for settings width -->
            <tr>
                <td style="border: none; width:15px;"></td>
                <td style="border: none; width: 25px;"></td>
                <td style="border: none; width: 50px;"></td>
                <td style="border: none; width: 10px;"></td>
                <td style="border: none; width: 200px"></td>
                <td style="border: none; width: 100px"></td>
                <td style="border: none;"></td>
                <td style="border: none; width: 10px;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none;"></td>
                <td style="border: none; width:150px;"></td>
            </tr>
        </table>
    

</div>

</body>
</html>
