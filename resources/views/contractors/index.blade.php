@extends('layouts.app')
@section('title')
Master Contractors
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
                <!-- <button class="btn btn-primary" id="add-contractor">Add Contractor</button> -->
            </div>
            <div class="card-body p-0">
            <div class="app-datatable-default overflow-auto">
                <table id="contractors-table" class="display app-data-table default-data-table">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Contractor Name</th>
                    <th>Address</th>
                    <th>Contact Information</th>
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
   <div class="modal fade" id="contractorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Contractor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="contractor-form" enctype="multipart/form-data">
                        <input type="hidden" id="contractor-id">
                        <div class="mb-3">
                            <label for="contractor-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="contractor-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="contractor-address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="contractor-address" required>
                        </div>
                        <div class=" col-4 mb-3">
                            <img  class="w-100 rounded" id="logos"  src="" alt="Company Logo" style="display:none;" /> 
                        </div>
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="logo">
                        </div>
                        <div class="mb-3">
                            <label for="contractor-contact" class="form-label">Contact Info</label>
                            <input type="text" class="form-control" id="contractor-contact">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-contractor">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('other-scripts')
<script>
    $(document).ready(function() {
        const table = $('#contractors-table').DataTable({
        columnDefs: [{ width: '20%', targets: 4 }],
          ajax: {
                    url: '/contractors/list'
                },
            columns: [
                { data: 'index', name: 'index', searchable: false},
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                        <div class="d-flex align-items-center ">
                            <div class="h-30 w-30 d-flex-center b-r-50 overflow-hidden me-2 text-bg-secondary simple-table-avtar">
                                <a href="{{asset('assets/images/logo/${row.logo}')}}" class="glightbox" data-glightbox="type: image; zoomable: true;" target="blank"><img src="{{asset('assets/images/logo/${row.logo}')}}" alt="" class="img-fluid"></a>
                            </div>
                            <p>${row.contractor_name}</p>
                        </div>
                        `;
                    }
                },
                { data: 'address' , name:'address'},
                { data: 'contact_information' , name: 'contact_information'},
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-light-success icon-btn b-r-4 edit-contractor" id="edit-contractor" data-id="${row.id}"><i class="ph-duotone  ph-pencil-simple-line"></i></button>
                            <button class="btn btn-light-danger icon-btn b-r-4 delete-contractor" data-id="${row.id}"><i class="ph-duotone  ph-trash"></i></button>
                        `;
                    }
                }
            ]
        });

        $('#save-contractor').click(function() {
            const id = $('#contractor-id').val();
            const url = id ? `/contractors/${id}` : '/contractors/store';
            const method = id ? 'POST' : 'POST'; // Gunakan POST untuk PUT (Override _method untuk Laravel)
            const formData = new FormData();

            formData.append('contractor_name', $('#contractor-name').val());
            formData.append('address', $('#contractor-address').val());
            formData.append('logo', $('#logo')[0].files[0]);
            formData.append('contact_information', $('#contractor-contact').val());
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
                    $('#contractorModal').modal('hide');
                    table.ajax.reload();
                    pemberitahuan("success", "Berhasil menyimpan data.");
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    pesan('error',response.responseJSON.message, "error");
                }
            });
        });

        $('#add-contractor').click(function() {
            $('#contractor-id').val('');
            $('#contractor-form')[0].reset();
            $('#modalTitle').text('Add Contractor');
            $('#contractorModal').modal('show');
        });

        

        $('#contractors-table').on('click', '.edit-contractor', function() {
            var id = $(this).data('id');
            var url = "/contractors/show/" + id;
            $.get(url , function(data) {
                $('#contractor-id').val(data.id);
                $('#contractor-name').val(data.contractor_name);
                $('#contractor-address').val(data.address);
                var logoUrl = 'assets/images/logo/' + data.logo;  // Endpoint untuk gambar
        
                if (logoUrl) {
                    // Menampilkan gambar di modal
                    $('#logos').attr('src', logoUrl).show(); // Menampilkan gambar
                } else {
                    $('#logos').hide(); // Menyembunyikan gambar jika tidak ada
                }
                $('#contractor-contact').val(data.contact_information);
                $('#modalTitle').text('Edit Contractor');
                $('#contractorModal').modal('show');
            });
        });

        $('#contractors-table').on('click', '.delete-contractor', function() {
            const id = $(this).data('id');
            konfirmasi().then((result) => {
                if (result.isConfirmed) {
                $.ajax({
                    url: `/contractors/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        table.ajax.reload();
                        pesan("Terhempas","Device berhasil di hapus","success");
                    }
                });
            }
        });
        });
    });
</script>
@endpush