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
                    </div>
                    <div class="card-body p-0">
                        <form id="maintenanceLogForm" action="{{ route('maintenance_logs.store') }}" method="POST" class="container mt-4"  enctype="multipart/form-data">
                            @csrf
                            <!-- <div class="mb-3">
                                <label for="log_date" class="form-label">Log Date</label>
                                <input type="date" name="log_date" class="form-control" required>
                            </div> -->
                            <h5>Before Activity</h5>
                            <div class="mb-3">
                                <label class="form-label">Upload Photos</label>
                                <input type="file" name="photos" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" name="description" class="form-control" required>
                                <input type="hidden" name="detail_id" class="form-control" value="{{$detail_id}}" required>
                            </div>
                            
                            <h5>Before Activity Details</h5>
                            <div id="log-details">
                                <div class="row log-detail mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Maintenance Item</label>
                                        <select name="maintenance_item_id[]" class="form-select" required>
                                            @foreach ($maintenance_items as $item)
                                                <option value="{{ $item->item_name }}">{{ $item->item_name }}</option>
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
                            
                            <h5>After  Activity</h5>
                            <div class="mb-3">
                                <label class="form-label">Upload Photos</label>
                                <input type="file" name="after_photos" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description After</label>
                                <input type="text" name="after_description" class="form-control">
                            </div>

                           <h5>After Activity Detail</h5>
                            <div id="log-details-after">
                                <div class="row log-detail-after mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Maintenance Item</label>
                                        <select name="item_name[]" class="form-select" required>
                                            @foreach ($maintenance_items as $item)
                                                <option value="{{ $item->item_name }}">{{ $item->item_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">Status</label>
                                        <input type="text" name="status_after[]" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mb-3" id="add-log-detail-after">Add Detail</button>
                            
                            <h5>Material Replacement</h5>
                            <div id="material-replacements">
                                <div class="row material-replacement mb-3">
                                    <div class="col-md-6">
                                        <label for="material_name" class="form-label">Item Name</label>
                                        <input type="text" name="material_name[]" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="material_description" class="form-label">Status</label>
                                        <input type="text" name="material_description[]" class="form-control" required>
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


@endsection

@push('devices-scripts')
<script>
    document.getElementById('add-log-detail').addEventListener('click', function() {
        let newDetail = document.querySelector('.log-detail').cloneNode(true);
        document.getElementById('log-details').appendChild(newDetail);
    });

    document.getElementById('add-log-detail-after').addEventListener('click', function() {
        let newDetailAfter = document.querySelector('.log-detail-after').cloneNode(true);
        document.getElementById('log-details-after').appendChild(newDetailAfter);
    });

    document.getElementById('add-material-replacement').addEventListener('click', function() {
        let newMaterial = document.querySelector('.material-replacement').cloneNode(true);
        document.getElementById('material-replacements').appendChild(newMaterial);
    });
</script>
<script>
$('#maintenanceLogForaaaam').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: "{{ route('maintenance_logs.store') }}",
        method: "POST",
        data: $(this).serialize(),
        success: function(response) {
            alert('Success: ' + response.message);
        },
        error: function(xhr) {
            pesan("error",xhr.responseJSON.message,"error");
            // alert('Error: ' + xhr.responseJSON.error);
        }
    });
});
</script>
@endpush
