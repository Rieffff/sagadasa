@extends('layouts.app')
@section('title')
Master Companies
@endsection
@section('content')


<main>
    <div class="container-fluid">
    <!-- Breadcrumb start -->
    <div class="row m-1">
        <div class="col-12 ">
            <h4 class="main-title">@yield('title')</h4>
            <ul class="app-line-breadcrumbs mb-3">
                <li class="">
                <a href="{{ route('dashboard') }}" class="f-s-14 f-w-500"> 
                    <span>
                    <i class="ph-duotone  ph-table f-s-16"></i> Home
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
        <div class="card ">
            <div class="card-header">
            <h5> @yield('title')</h5>
            @if($rowCompany < 1)
            <button class="btn btn-primary mb-3" id="createcompany">Add company</button>
            @endif
            </div>
            <div class="card-body p-0">
            <div class="app-datatable-default overflow-auto">
                <table id="companies-table" class="display app-data-table default-data-table">
                <thead>
                    <tr>
                    <th>NO</th>
                    <th>Company Name</th>
                    <th>Contact</th>
                    <th>Addres</th>
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
   <div class="modal fade" id="companyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="companyForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="companyModalLabel">Add company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="company_name" class="form-label">company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact" name="contact" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class=" col-4 mb-3">
                        <img  class="w-100 rounded" id="logos"  src="" alt="Company Logo" style="display:none;" /> 
                    </div>
                    <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="logo">
                        </div>
                    <input type="hidden" id="company_id">
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
@push('companies-scripts')
<script>
    $(document).ready(function() {
        const table = $('#companies-table').DataTable({
            columnDefs: [{ width: '20%', targets: 4 }],
          ajax: {
                    url: '/companies/list',                 
                },
            columns: [
                { data: 'index', name: 'index', searchable: false},
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                        <div class="d-flex align-items-center ">
                            <div class="h-30 w-30 d-flex-center b-r-50 overflow-hidden me-2 text-bg-secondary simple-table-avtar">
                                <a href="{{asset('storage/logos/${row.logo}')}}" class="glightbox" data-glightbox="type: image; zoomable: true;" target="blank"><img src="{{asset('storage/logos/${row.logo}')}}" alt="" class="img-fluid"></a>
                            </div>
                            <p>${row.company_name}</p>
                        </div>
                        `;
                    }
                },
                { data: 'contact' , name:'contact'},
                { data: 'address', name: 'address'},
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                        @can("edit master data")
                            <button class="btn btn-light-success icon-btn b-r-4" id="edit-company" data-id="${row.id}"><i class="ph-duotone  ph-pencil-simple-line"></i></button>
                        @endcan
                        @can("delete master data")
                            <button class="btn btn-light-danger icon-btn b-r-4" delete-btn" id="delete-company"  data-id="${row.id}"><i class="ph-duotone  ph-trash"></i></button>
                        @endcan
                        `;
                    }
                }
            ]
        });

        // Open Add company Modal
        $('#createcompany').click(function () {
            $('#companyForm')[0].reset();
            $('#company_id').val('');
            $('#companyModalLabel').text('Add company');
            $('#companyModal').modal('show');
        });

        // Open Edit company Modal
        $('#companies-table').on('click', '#edit-company', function() {
            var id = $(this).data('id');
            var url = "/companies/show/" + id;
            $.get(url , function(data) {
                $('#company_id').val(data.id);
                $('#company_name').val(data.company_name);
                $('#address').val(data.address);
                // $('#logo').val(data.logo);
                var logoUrl = 'assets/images/logo/' + data.logo;  // Endpoint untuk gambar
        
                if (logoUrl) {
                    // Menampilkan gambar di modal
                    $('#logos').attr('src', logoUrl).show(); // Menampilkan gambar
                } else {
                    $('#logos').hide(); // Menyembunyikan gambar jika tidak ada
                }
                
                $('#contact').val(data.contact);
                $('#modalTitle').text('Edit companies');
                $('#companyModal').modal('show');
            });
        });

        // Save or Update company
        

        $('#submitBtn').click(function() {
            const id = $('#company-id').val();
            const url = id ? `/companies/${id}` : '/companies/store';
            const method = id ? 'POST' : 'POST'; // Gunakan POST untuk PUT (Override _method untuk Laravel)
            const formData = new FormData();

            formData.append('company_name', $('#company_name').val());
            formData.append('address', $('#address').val());
            formData.append('logo', $('#logo')[0].files[0]);
            formData.append('contact', $('#contact').val());
            formData.append('_token', '{{ csrf_token() }}'); // Tambahkan token CSRF
            if (id) {
                formData.append('_method', 'PUT'); // Override ke PUT untuk Laravel
            }

            $.ajax({
                url: url,
                method: method,
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    $('#companyModal').modal('hide');
                    table.ajax.reload();
                    pemberitahuan("success", "Berhasil menyimpan data.");
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    pesan('error',response.responseJSON.message, "error");
                }
            });
        });

        // Delete company
        $("#companies-table").on('click', '#delete-company', function () {
            konfirmasi().then((result) => {
                if (result.isConfirmed) {
                    let companyId = $(this).data('id');
                    $.ajax({
                        url: `/companies/destroy/${companyId}`,
                        method: 'DELETE',
                        data: { 
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            pesan("Terhapus","Device berhasil di hapus","success");
                            table.ajax.reload();
                        },
                        error: function () {
                            pesan("Gagal","Device Gagal di hapus","error");
                        }
                    });
                   }
                });
        });
    });
</script>
@endpush