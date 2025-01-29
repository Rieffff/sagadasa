<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-size: 12px; }
        .table-bordered th, .table-bordered td { border: 1px solid black !important; }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Daily Report</h2>
        <table class="table table-bordered">
            <tr>
                <th>Company</th>
                <td>{{ $report->company->contractor_name }}</td>
            </tr>
            <tr>
                <th>Contractor</th>
                <td>{{ $report->contractor->contractor_name }}</td>
            </tr>
            <tr>
                <th>Location</th>
                <td>Gate Access</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $report->report_date }}</td>
            </tr>
        </table>

        <h4 class="mt-4">Work Details</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Start</th>
                    <th>Break</th>
                    <th>Stop</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $report->work_start }}</td>
                    <td>{{ $report->work_break }}</td>
                    <td>{{ $report->work_stop }}</td>
                </tr>
            </tbody>
        </table>

        <h4 class="mt-4">Activities</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Device</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report->activities as $activity)
                    <tr>
                        <td>{{ $activity->device->device_name }}</td>
                        <td>{{ $activity->activity_description }}</td>
                        <td>{{ $activity->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="mt-4">Maintenance Logs</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report->maintenanceLogs as $log)
                    <tr>
                        <td>{{ $log->maintenanceItem->item_name }}</td>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="mt-4">Manpower</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report->manPowers as $manpower)
                    <tr>
                        <td>{{ $manpower->name }}</td>
                        <td>{{ $manpower->position }}</td>
                        <td>{{ $manpower->contact }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-5 text-center">
            <p><strong>Approved by:</strong> {{ $report->approved_by }}</p>
        </div>
    </div>
</body>
</html>
