@extends('layouts.app')
@section('title')
    users
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
            <button class="btn btn-primary" id="add-user">Add user</button>
            </div>
            <div class="card-body p-0">
            <div class="app-datatable-default overflow-auto">
                <table id="example" class="display app-data-table default-data-table">
                <thead>
                    <tr>
                    <th>NO</th>
                    <th>Name</th>
                    <th>position</th>
                    <th>email</th>
                    <th>contact</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                    <tr>
                    <td>{{$row->index}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->position}}</td>
                    <td>@can('manage users'){{$row->email}}@endcan</td>
                    <td><a href="https:wa.me/{{$row->contact}}" target="blank"><button type="button" class="btn btn-whatsapp icon-btn b-r-22"><i class="ti ti-brand-whatsapp text-white"></i></button> {{$row->contact}}</a></td>
                    <td> 
                    @if(auth()->user()->role != 'technician' && $row->position != 'Developer')
                    <button class="btn btn-warning btn-sm edit-user" id="edit-user" data-id="{{$row->id}}"><i class="ph-duotone  ph-pencil-simple-line"></i></button>
                    
                    @endif
                    @if($row->role === 'technician' && auth()->user()->role != 'technician')
                    <button class="btn btn-danger btn-sm delete-user" data-id="{{$row->id}}"><i class="ph-duotone  ph-trash"></i></button>
                    @elseif($row->role === 'supervisor' && auth()->user()->role === 'admin' )
                    <button class="btn btn-danger btn-sm delete-user" data-id="{{$row->id}}"><i class="ph-duotone  ph-trash"></i></button>

                    @endif
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

   <!-- Modal -->
   <div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="user-form">
                        <input type="hidden" id="user-id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label" id="labelEmail">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label" id="labelPassword">Password</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-check-input mg-2" type="checkbox" value="" id="showPassword">
                            <label for="showPassword" id="labelShow"> Show Password</label>
                        </div>
                        <div class="mb-3">
                            <label for="user-position" class="form-label">position</label>
                            <select class="form form-control" id="position" name="position">
                                <option value="technician">Technician</option>
                                <option value="supervisor">Supervisor</option>
                                @if(auth()->user()->position === 'Developer')
                                <option value="admin">Admin</option>
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="form-label">contact</label>
                            <input type="text" class="form-control" id="contact">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-user">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('users-scripts')
<script>
    $(document).ready(function() {

        $('#showPassword').click(function(){
            if(!$(this).is(':checked')){
                $('#password').attr('type','password');
            }else{
                $('#password').attr('type','text');
            }
        });

        $('#add-user').click(function() {
            $('#user-id').val('');
            $('#user-form')[0].reset();
                $('#labelEmail').show();
                $('#labelPassword').show();
                $('#labelShow').show();
                $('#email').show();
                $('#password').show();
                $('#showPassword').show();
            $('#modalTitle').text('Add user');
            $('#userModal').modal('show');
        });
    
        
        $('#save-user').click(function() {
            const id = $('#user-id').val();
            const url = id ? `/user/update/${id}` : '/user/store';
            const method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                
                data: {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    role: $('#position').text(),
                    position: $('#position').val(),
                    contact: $('#contact').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#userModal').modal('hide');
                    pemberitahuan("success","berhasil mengupdate table");
                    setTimeout(function(){
                        location.reload();
                    }, 3000);
                },
                error: function (response){
                    console.log(response);
                    pesan("error",response.responseJSON.message,"error");
                }
            });
        });

        $(document).on('click', '.edit-user', function() {
            var id = $(this).data('id');
            var url = "/user/show/" + id;
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('#user-id').val(data.id);
                    $('#name').val(data.name);
                    $('#labelEmail').hide();
                    $('#email').hide();
                    $('#position').val(data.role);
                    $('#contact').val(data.contact);
                    $('#modalTitle').text('Edit user');
                    $('#userModal').modal('show');
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });
        });

        $(document).on('click', '.delete-user', function() {
            const id = $(this).data('id');
            konfirmasi().then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/user/destroy/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        pesan("Terhapus",response.message,"success");
                        setTimeout(function(){
                            location.reload();
                        }, 3000);
                    },
                    error: function (response){
                        console.log(response);
                        pesan("error",response.responseJSON.message,"error");
                    }
                });
            }});
           
        });
    });
</script>
@endpush