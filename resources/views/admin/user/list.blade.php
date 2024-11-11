@extends('admin.layouts.master')

@section('title','User List')

@section('content')
                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="overview-wrap">
                                            <h2 class="title-1">User List</h2>
                                        </div>
                                    </div>
                                </div>

                                @if (session('deleteSuccess'))
                                    <div class=" col-4 offset-8">
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <i class="zmdi zmdi-close-circle"></i>  {{ session('deleteSuccess') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif

                                <div class="table-responsive table-responsive-data2 text-center">
                                    <table class="table table-data2 table-hover">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Gender</th>
                                                <th>Address</th>
                                                <th>Role</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataList">
                                            <div class="table-data-feature">
                                                @foreach ($users as $user )
                                                @if ($user->role == 'admin')

                                                @else
                                                    <tr class="tr-shadow">
                                                        <td class="col-2">
                                                            @if ($user->image == null)
                                                                @if($user->gender == 'male')
                                                                    <img src="{{ asset('image/default_user.jpg') }}" class=" img-thumbnail shadow-sm">
                                                                @else
                                                                    <img src="{{ asset('image/default_female.png') }}" class=" img-thumbnail shadow-sm">
                                                                @endif
                                                            @else
                                                                <img src="{{ asset('storage/'.$user->image) }}" class=" img-thumbnail shadow-sm">
                                                            @endif
                                                        </td>
                                                        <input type="hidden" class="userId" value="{{ $user->id }}">
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone }}</td>
                                                        <td>{{ $user->gender }}</td>
                                                        <td>{{ $user->address }}</td>
                                                        <td class="tr-shadow">
                                                            <select class=" statusChange" title="Change Account Role">
                                                                <option value="admin" @if($user->role == 'admin') selected  @endif >Admin</option>
                                                                <option value="user" @if($user->role == 'user') selected  @endif>User</option>
                                                            </select>
                                                        </td>
                                                        <td class="tr-shadow">
                                                            <div class="table-data-feature">
                                                                <a href="{{ route('user#edit',$user->id) }}">
                                                                    <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                                    </button>
                                                                </a>
                                                                <a href="{{ route('user#delete',$user->id) }}">
                                                                    <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                        <i class="fa-solid fa-trash-can"></i>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </div>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function(){

            $('.statusChange').change(function(){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $userId = $parentNode.find('.userId').val();

                $data = {
                    'role' : $currentStatus ,
                    'userId' : $userId
                };

                $.ajax({
                    type : 'get' ,
                    url : '/admin/ajax/user/role/change' ,
                    data : $data ,
                    dataType : 'json' ,
                })
                location.reload();
            })

        })
    </script>
@endsection
