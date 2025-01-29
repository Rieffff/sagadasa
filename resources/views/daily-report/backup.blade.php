@extends('layouts.app')
@section('title')
Daily Report
@endsection
@section('content')
<div class="container">
    <h2>Daily Report</h2>
    <form id="dailyReportForm" method="POST" action="{{ route('technician.reports.store') }}">
        @csrf
        <div class="form-group">
            <label for="company_id">Company</label>
            <select name="company_id" id="company_id" class="form-control" required>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ $company->default ? '1' : '0' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="location_id">Location</label>
            <select name="location_id" id="location_id" class="form-control" required>
                <option value="">Select a location</option>
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->location_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="device_id">Device</label>
            <select name="device_id" id="device_id" class="form-control" required>
                <option value="">Select a device</option>
                @foreach ($devices as $device)
                    <option value="{{ $device->id }}">{{ $device->device_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="activity_details">Activity Details</label>
            <textarea name="activity_details" id="activity_details" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="regular">Regular</option>
                <option value="non-regular">Non-Regular</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit Report</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dailyReportForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert('Report submitted successfully!');
                    window.location.reload();
                },
                error: function(response) {
                    alert('There was an error submitting the report.');
                }
            });
        });
    });
</script>
@endpush