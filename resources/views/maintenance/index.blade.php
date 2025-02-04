@extends('layouts.app')
@section('title')
    Daily Activity Details
@endsection
@section('content')

<main>
    <div class="container-fluid">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12">
                <h4 class="main-title">@yield('title')</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li>
                        <a href="{{ route('dashboard') }}" class="f-s-14 f-w-500"> 
                            <span>
                                <i class="ph-duotone ph-table f-s-16"></i> Home
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('daily_reports.index') }}" class="f-s-14 f-w-500">Daily Reports</a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">@yield('title')</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb end -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5> @yield('title')</h5>
                        <a href="{{ url('maintenance/form/'.$detail_id)}}"><button class="btn btn-primary mb-3" >Add Activity Detail</button></a>
                    </div>
                    <div class="card-body p-0">
                        <div class="app-datatable-default overflow-auto">
                            <table id="example" class="display app-data-table default-data-table">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Foto</th>
                                        <th>Description</th>
                                        <th>Maintenance Item</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                    @foreach($data->maintenanceLogs as $row)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$row->photos}}</td>
                                            <td>{{$row->description}}</td>
                                            <td>
                                                @foreach($row->maintenanceLogDetail as $logDetail)
                                                <p>{{$logDetail->maintenance_item_id}} : {{$logDetail->status}}</p>
                                                @endforeach
                                            </td>
                                            <td>Before Maintenance</td>
                                            <td>this button</td>
                                        </tr>
                                        @php
                                            $i = $i +1;
                                        @endphp
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$row->maintenanceAfter->photos}}</td>
                                            <td>{{$row->maintenanceAfter->description}}</td>
                                            <td>
                                            @foreach($row->maintenanceAfter->maintenanceLogAfterDetail as $logDetailAfter)
                                                <p>{{$logDetailAfter->item_name}} : {{$logDetailAfter->status}}</p>
                                                @endforeach
                                            </td>
                                            <td>After Maintenance</td>
                                            <td>this button</td>
                                        </tr>
                                        @php
                                            $i = $i + 1;
                                        @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>      
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="dailyActivityDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="dailyActivityDetailForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="dailyActivityDetailModalLabel">Add Activity Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="device_id" class="form-label">Daily Report</label>
                        <select class="form-select selectpicker" id="device_id" name="device_id" required>
                            @foreach($item as $row)
                                <option value="{{ $row->id }}">{{$row->item_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="activity" class="form-label">Activity</label>
                        <textarea class="form-control" id="activity_description" name="activity_description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Daily Report</label>
                        <select class="form-select selectpicker" id="status" name="status" required>
                            <option value="regular">Regular</option>
                            <option value="non-regular">Non Regular</option>
                            <option value="activity">Activity</option>
                        </select>
                    </div>
                    <input type="hidden" id="report_id" name="report_id" value="{{$detail_id}}">
                    <input type="hidden" id="activity_detail_id" name="activity_detail_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('devices-scripts')
<script>
    $(document).ready(function() {
       

        $('#createActivityDetail').click(function() {
            
            $('#dailyActivityDetailForm')[0].reset();
            $('#dailyActivityDetailModalLabel').text('Add Activity Detail');
            $('#activity_detail_id').val('');
            $('#dailyActivityDetailModal').modal('show');
        });

       

        $('#submitBtn').click(function() {
            const id = $('#activity_detail_id').val();
            const url = id ? `/daily-activity-details/update/${id}` : '/daily-activity-details/store';
            const method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: {
                    report_id: $('#report_id').val(),
                    activity_description: $('#activity_description').val(),
                    device_id: $('#device_id').val(),
                    status: $('#status').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#dailyActivityDetailModal').modal('hide');
                    table.ajax.reload();
                },
                error: function (response) {
                            pesan("Gagal",response.responseJSON.message,"error");
                        }
            });
        });

        $('#daily-activity-details-table').on('click', '.edit-activity-detail', function() {
            var id = $(this).data('id');
            $.get(`/daily-activity-details/show/${id}`, function(data) {
                $('#activity_detail_id').val(data.id);
                $('#daily_report_id').val(data.daily_report_id);
                $('#activity').val(data.activity);
                $('#start_time').val(data.start_time);
                $('#end_time').val(data.end_time);
                $('#dailyActivityDetailModalLabel').text('Edit Activity Detail');
                $('#dailyActivityDetailModal').modal('show');
            });
        });

        $('#daily-activity-details-table').on('click', '.delete-activity-detail', function() {
            konfirmasi().then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).data('id');
                    $.ajax({
                        url: `/daily-activity-details/destroy/${id}`,
                        method: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function() {
                            table.ajax.reload();
                        }
                    });
                }
            });
            
        });
    });
</script>
@endpush
