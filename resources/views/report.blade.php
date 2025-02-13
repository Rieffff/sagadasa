@extends('layouts.app')
@section('title')
Report
@endsection
@section('content')


<main>
    <div class="container-fluid">
    <!-- Breadcrumb start -->
    <div class="row m-1">
        <div class="col-12 ">
            <h4 class="main-title">Data Table</h4>
            <ul class="app-line-breadcrumbs mb-3">
                <li class="">
                <a href="{{ route('dashboard') }}" class="f-s-14 f-w-500"> 
                    <span>
                    <i class="ph-duotone  ph-table f-s-16"></i> Home
                    </span>
                </a>
                </li>
                <li class="active">
                <a href="#" class="f-s-14 f-w-500">Data Table</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb end -->

    <div class="row">
        <div class="col-12">
        <div class="card ">
            <div class="card-header">
            <h5>Default Datatable</h5>
            <p>DataTables has most features enabled by default, so all you need to do to use it with your own
                tables is to call the construction function: <code>$().DataTable();</code>. </p>
                <a href="{{ url('/daily-report2/1/pdf') }}" target="_blank"><button class="btn btn-primary"><i class="ph-duotone  ph-file-pdf"></i></button></a>
            </div>
            <div class="card-body p-0">
            <div class="app-datatable-default overflow-auto">
                <table id="example" class="display app-data-table default-data-table">
                <thead>
                    <tr>
                    <th>no</th>
                    <th>Date</th>
                    <th>Activity</th>
                    <th>Location</th>
                    <th>Contractor</th>
                    <th>Start Time</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                    <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ date('d F Y', strtotime( $row->report_date)) }}</td>
                    <td><span class="badge text-light-primary">{{$row->detail_activity}}</span></td>
                    <td>{{$row->location}}</td>
                    <td>{{$row->contractor->contractor_name}}</td>
                    <td>{{$row->work_start}} - {{$row->work_stop}}</td>
                    <td>
                        <!-- <a href="{{ url('/daily-report/'.$row->id.'/pdf') }}" target="_blank"><button type="button" class="btn btn-light-primary icon-btn b-r-4">
                        <i class="ti ti-printer text-primary"></i> 
                        </button></a> -->
                        <button type="button" id="show-data" data-id="{{ $row->id }}" class="btn btn-light-primary icon-btn b-r-4">
                        <i class="ti ti-eye text-primary"></i> 
                        </button>
                        <!-- <button type="button" class="btn btn-light-danger icon-btn b-r-4 delete-btn" datadata-id="{{ $row->id }}">
                            <i class="ti ti-trash"></i>
                        </button> -->
                    </td>
                    </tr>
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

@endsection
@push('item-scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '#show-data', function () {
            var id = $(this).data('id');
            $.ajax({
                url: "{{ route('report.encrypt-id') }}",
                type: "POST",
                data: { id: id,
                        _token: '{{ csrf_token() }}' },
                success: function(response) {
                    var url = "{{ route('report.show', ':encryptedId') }}".replace(':encryptedId', response.encryptedId);
                    window.location.href = url;
                }, error(e){
                    
                    pesan("succes",e.responseJSON.message,"success")
                }
            });
        });
        // kene line anyar Developer line wkwkwk
    });
</script>

@endpush

