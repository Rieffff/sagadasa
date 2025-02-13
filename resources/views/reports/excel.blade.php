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
            background-color: #f2f2f2;
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
        .w-5{ width: 5px; }
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
        <h2 style="text-align: center;">Daily Activity Report (Subcontractor)</h2>

        <!-- Header Informasi -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; border:none;">
            <tr style="font-weight: bold; border:none;">
                <td colspan="3" style="padding: 10px; border:none;">Project</td>
                <td style="width: 10px; border:none;">:</td>
                <td style="border:none;">{{ $report->company->company_name ?? '-' }}</td>
                <td style="border:none;" colspan="2">Contractor No</td>
                <td style="width: 10px;">:</td>
                <td style="border:none;">{{ date('dmY', strtotime($report->report_date)) }}-{{ $report->id }}</td>
                <td rowspan="3" style="border: 1px solid black; text-align: center; font-weight: bold;">Working<br>Time(H)</td>
                <td colspan="2" style="border: 1px solid black; text-align: center; font-weight: bold;">Work</td>
                <td colspan="2" style="border: 1px solid black; text-align: center; font-weight: bold;">Work Break</td>
            </tr>
            <tr>
                <td colspan="3" style="padding: 10px;">Discipline</td>
                <td style="width: 10px;">:</td>
                <td style="border:none;">TF</td>
                <td style="border:none;" colspan="2">Date</td>
                <td style="width: 10px;">:</td>
                <td style="border:none;">{{ date('d F Y', strtotime($report->report_date)) }}</td>
                <td style="border: 1px solid black; text-align: center; font-weight: bold;">From</td>
                <td style="border: 1px solid black; text-align: center; font-weight: bold;">To</td>
                <td style="border: 1px solid black; text-align: center; font-weight: bold;">Hour</td>
                <td style="border: 1px solid black; text-align: center; font-weight: bold;">Reason</td>
            </tr>
            <tr>
                <td colspan="3" style="padding: 10px;">Subcontractor</td>
                <td style="width: 10px;">:</td>
                <td style="border:none;">{{ $report->contractor->contractor_name ?? '-' }}</td>
                <td style="border:none;" colspan="2">Report No</td>
                <td style="width: 10px;">:</td>
                <td style="border:none;">{{ $indexNumber }}</td>
                <td style="border: 1px solid black;">{{ $report->work_start ?? '-' }}</td>
                <td style="border: 1px solid black;">{{ $report->work_stop ?? '-' }}</td>
                <td style="border: 1px solid black;">{{ $report->work_break ?? '-' }}</td>
                <td style="border: 1px solid black;">{{ $report->work_reason ?? '-' }}</td>
            </tr>
            <tr>
                <td colspan="3" style="padding: 10px;">Work Activity</td>
                <td style="width: 10px;">:</td>
                <td style="border:none;">{{ $report->detail_activity ?? '-' }}</td>
                <td style="border:none;" colspan="2"></td>
                <td style="border:none;"></td>
                <td style="border:none;" colspan="2"></td>
                <td style="border:none;" colspan="4">Today Work : {{ $totalHours ?? '0' }} Hours {{ $totalMinutes ?? '0' }} Minutes</td>
            </tr>
            <tr>
                <td colspan="14" style="border: 1px solid black;  font-weight: bold;">Work Activity</td>
            </tr>
            @foreach ($report->manPowers as $index => $manPower)
            <tr>
                <td colspan="7" style="border: 1px solid black; ">Standby {{ $report->company->company_name ?? '-' }} - {{ $manPower->name }}</td>
                <td colspan="7" style="border: 1px solid black; ">{{ $manPower->notes ?? '-' }}</td>
            </tr>
            @endforeach
            @for ($i = 0; $i < 5; $i++)
            <tr>
                <td colspan="7" style="border: 1px solid black; ">&nbsp;</td>
                <td colspan="7" style="border: 1px solid black; ">&nbsp;</td>
            </tr>
            @endfor
            <tr>
                <td style="width: 25px;"></td>
                <td style="width: 25px;"></td>
                <td style="width: 25px;"></td>
                <td style="width: 5px;"></td>
                <td style="width: 300px;"></td>
                <td></td>
                <td></td>
                <td style="width: 5px;"></td>
                <td style="width: 150px;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="width:150px;"></td>
            </tr>
        </table>
    <!-- Tabel Data Aktivitas -->
    <!-- Tabel Data Aktivitas -->
    <h3>Activity Details</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Device</th>
                <th>Location</th>
                <th>Description</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($report->activityDetails as $index => $activity)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $activity->device->name ?? '-' }}</td>
                <td>{{ $activity->device->location->name ?? '-' }}</td>
                <td>{{ $activity->activity_description }}</td>
                <td>{{ ucfirst($activity->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <!-- Tabel Maintenance Logs -->
    <h3>Maintenance Logs</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Log Type</th>
                <th>Description</th>
                <th>Technician</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($maintenanceLogsRegular as $index => $log)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>Regular</td>
                <td>$log->maintenanceLogDetail->description ?? '-' </td>
                <td>{{ $log->technician->name ?? '-' }}</td>
            </tr>
            @endforeach

            @foreach ($maintenanceLogsNonregular as $index => $log)
            <tr>
                <td>{{ $loop->iteration + count($maintenanceLogsRegular) }}</td>
                <td>Non-Regular</td>
                <td>{{ $log->maintenanceLogDetail->description ?? '-' }}</td>
                <td>{{ $log->technician->name ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    <!-- Tabel Man Powers -->
    <h3>Man Powers</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Technician Name</th>
                <th>Position</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($report->manPowers as $index => $manPower)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $manPower->name }}</td>
                <td>{{ $manPower->position }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

</body>
</html>
