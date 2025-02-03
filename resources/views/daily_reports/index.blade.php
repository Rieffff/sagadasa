@extends('layouts.app')
@section('title')
    Daily Reports
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
                        <button class="btn btn-primary mb-3" id="createReport">Add Report</button>
                    </div>
                    <div class="card-body p-0">
                        <div class="app-datatable-default overflow-auto">
                            <table id="daily-reports-table" class="display app-data-table default-data-table">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Report Date</th>
                                        <th>Company</th>
                                        <th>Contractor</th>
                                        <th>Work Start</th>
                                        <th>Work Stop</th>
                                        <th>Approved By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>      
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="dailyReportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="dailyReportForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="dailyReportModalLabel">Add Daily Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="report_date" class="form-label">Report Date</label>
                        <input type="date" class="form-control" id="report_date" name="report_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="company_id" class="form-label">Company</label>
                        <select class="form-select selectpicker" id="company_id" name="company_id" required>
                            <option value="">Select Company</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="contractor_id" class="form-label">Contractor</label>
                        <select class="form-select selectpicker" id="contractor_id" name="contractor_id" required>
                            <option value="">Select Contractor</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <select class="form-select selectpicker" id="location" name="location" required>
                           @foreach($locations as $row)
                            <option value="{{ $row->location_name }}">{{ $row->location_name }}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="work_start" class="form-label">Work Start</label>
                        <input type="time" class="form-control" id="work_start" name="work_start" required>
                    </div>
                    <div class="mb-3">
                        <label for="work_break" class="form-label">Work break</label>
                        <input type="number" class="form-control" id="work_break" name="work_break" required>
                        <input type="hidden" class="form-control" id="po" name="po" value="Yes" required>
                        <input type="hidden" class="form-control" id="approved_by" name="approved_by" value="{{ auth()->user()->name; }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="work_stop" class="form-label">Work Stop</label>
                        <input type="time" class="form-control" id="work_stop" name="work_stop" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="work_reason" class="form-label">Work reason</label>
                        <input type="text" class="form-control" id="work_reason" name="work_reason" required>
                    </div>
                    <div class="mb-3">
                        <label for="service_data" class="form-label">Service Data</label>
                        <input type="text" class="form-control" id="service_data" name="service_data" required>
                    </div>
                    <div class="mb-3">
                        <label for="detail_activity" class="form-label">Activity</label>
                        <input type="text" class="form-control" id="detail_activity" name="detail_activity"  required>
                    </div>
                    <input type="hidden" id="report_id" name="report_id">
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
        const table = $('#daily-reports-table').DataTable({
            ajax: {
                url: '/daily-reports/data'
            },
            columns: [
                { data: 'index', name: 'index', searchable: false }, 
                { data: 'report_date', name: 'report_date' },
                { data: 'company.company_name', name: 'company_name' },
                { data: 'contractor.contractor_name', name: 'contractor_name' },
                { data: 'work_start', name: 'work_start' },
                { data: 'work_stop', name: 'work_stop' },
                { data: 'approved_by', name: 'approved_by' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <a href="{{ url('daily-report-detail/${row.id}') }}"><button class="btn btn-primary btn-sm view-report">
                                <i class="ph-duotone ph-eye"></i> Daily Report Detail
                            </button></a>
                            <button class="btn btn-warning btn-sm edit-report" data-id="${row.id}">
                                <i class="ph-duotone ph-pencil-simple-line"></i> Activity Detail
                            </button>
                            <button class="btn btn-danger btn-sm delete-report" data-id="${row.id}">
                                <i class="ph-duotone ph-trash"></i> Man Powers
                            </button>
                        `;
                    }
                }
            ]
        });

        $('#createReport').click(function() {
            $('#dailyReportForm')[0].reset();
            $('#report_id').val('');
            $('#dailyReportModalLabel').text('Add Daily Report');
            loadCompanies();
            loadContractors();
            $('#dailyReportModal').modal('show');
        });

        function loadCompanies() {
            $.get("{{ route('companies.list') }}", function(response) {
                let options = '<option value="">Select Company</option>';
                response.data.forEach(company => {
                    options += `<option value="${company.id}">${company.company_name}</option>`;
                });
                $('#company_id').html(options);
            });
        }

        function loadContractors() {
            $.get("{{ route('master-contractors.list') }}", function(response) {
                let options = '<option value="">Select Contractor</option>';
                response.data.forEach(contractor => {
                    options += `<option value="${contractor.id}">${contractor.contractor_name}</option>`;
                });
                $('#contractor_id').html(options);
            });
        }

        $('#submitBtn').click(function() {
            const id = $('#report_id').val();
            const url = '/daily-reports/store';
            const method = 'POST';

            $.ajax({
                url: url,
                method: method,
                data: {
                    report_date: $('#report_date').val(),
                    company_id: $('#company_id').val(),
                    contractor_id: $('#contractor_id').val(),
                    work_start: $('#work_start').val(),
                    work_stop: $('#work_stop').val(),
                    location: $('#location').val(),
                    work_break: $('#work_break').val(),
                    work_reason: $('#work_reason').val(),
                    service_data: $('#service_data').val(),
                    detail_activity: $('#detail_activity').val(),
                    po: $('#po').val(),
                    approved_by: $('#approved_by').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#dailyReportModal').modal('hide');
                    table.ajax.reload();
                },
                error: function (response) {
                            pesan("Gagal",response.responseJSON.message,"error");
                        }
            });
        });
    });
</script>
@endpush
