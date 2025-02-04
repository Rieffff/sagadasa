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
                        <button class="btn btn-primary mb-3" id="createActivityDetail">Add Activity Detail</button>
                    </div>
                    <div class="card-body p-0">
                        <form action="{{ route('maintenance_logs.store') }}" method="POST" class="container mt-4">
                            @csrf
                            <div class="mb-3">
                                <label for="log_date" class="form-label">Log Date</label>
                                <input type="date" name="log_date" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" name="description" class="form-control" required>
                            </div>
                            
                            <h5>Maintenance Log Details</h5>
                            <div id="log-details">
                                <div class="row log-detail mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Maintenance Item</label>
                                        <select name="maintenance_item_id[]" class="form-select" required>
                                            @foreach ($maintenance_items as $item)
                                                <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">Status</label>
                                        <input type="text" name="status[]" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mb-3" id="add-log-detail">Add Detail</button>
                            
                            <h5>Maintenance Log After</h5>
                            <div class="mb-3">
                                <label class="form-label">Upload Photos</label>
                                <input type="file" name="photos" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description After</label>
                                <input type="text" name="after_description" class="form-control">
                            </div>
                            
                            <h5>Material Replacement</h5>
                            <div id="material-replacements">
                                <div class="row material-replacement mb-3">
                                    <div class="col-md-6">
                                        <label for="item_name" class="form-label">Item Name</label>
                                        <input type="text" name="item_name[]" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="replacement_status" class="form-label">Status</label>
                                        <input type="text" name="replacement_status[]" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mb-3" id="add-material-replacement">Add Material</button>
                            
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>    
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
                            
                                <option value="{row->id }">{$row->item_name}</option>
                            
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
                    <input type="hidden" id="report_id" name="report_id" value="1">
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
    document.getElementById('add-log-detail').addEventListener('click', function() {
        let newDetail = document.querySelector('.log-detail').cloneNode(true);
        document.getElementById('log-details').appendChild(newDetail);
    });

    document.getElementById('add-material-replacement').addEventListener('click', function() {
        let newMaterial = document.querySelector('.material-replacement').cloneNode(true);
        document.getElementById('material-replacements').appendChild(newMaterial);
    });
</script>
@endpush
