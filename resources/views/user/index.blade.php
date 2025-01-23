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
                    <td>{{$row->contact}}</td>
                    <td> 
                    @if(auth()->user()->role != 'technician')
                    <button class="btn btn-warning btn-sm edit-user" id="edit-user" data-id="{{$row->id}}"><i class="ph-duotone  ph-pencil-simple-line"></i></button>
                    
                    @endif
                    @if($row->role === 'technician' && auth()->user()->role != 'technician')
                    <button class="btn btn-danger btn-sm delete-user" data-id="{{$row->id}}"><i class="ph-duotone  ph-trash"></i></button>
                    @elseif($row->role === 'supervisor' && auth()->user()->role === 'admin')
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
                            <label for="user-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="user-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-check-input mg-2" type="checkbox" value="" id="showPassword">
                            <label for="showPassword"> Show Password</label>
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
                            <label for="user-contact" class="form-label">contact</label>
                            <input type="text" class="form-control" id="user-contact">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save-user">Save</button>
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
            $('#modalTitle').text('Add user');
            $('#userModal').modal('show');
        });
    
        
        $('#save-user').click(function() {
            const id = $('#user-id').val();
            const url = id ? `/users/update/${id}` : '/users/store';
            const method = id ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: {
                    user_name: $('#user-name').val(),
                    position: $('#user-position').val(),
                    contact: $('#user-contact').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#userModal').modal('hide');
                    table.ajax.reload();
                    pemberitahuan("success","berhasil mengupdate table");
                }
            });
        });

        $('#users-table').on('click', '.edit-user', function() {
            var id = $(this).data('id');
            var url = "/users/show/" + id;
            $.get(url , function(data) {
                $('#user-id').val(data.id);
                $('#user-name').val(data.user_name);
                $('#user-position').val(data.position);
                $('#user-contact').val(data.contact);
                $('#modalTitle').text('Edit user');
                $('#userModal').modal('show');
            });
        });

        $(document).on('click', '.delete-user', function() {
            const id = $(this).data('id');
            konfirmasi().then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/users/destroy/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        table.ajax.reload();
                        pesan("Terhempas","Device berhasil di hapus","success");
                    }
                });
            }});
           
        });
    });
</script>
@endpush