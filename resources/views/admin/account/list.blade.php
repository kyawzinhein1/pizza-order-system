@extends('admin.layouts.master')

@section('title','Admin List')

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
                                            <h2 class="title-1">Admin List</h2>

                                        </div>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <a href="{{ route('category#createPage') }}">
                                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                                <i class=" fa fa-plus"></i>Add Category
                                            </button>
                                        </a>
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

                                <div class=" col-4 offset-8">
                                    <form action="{{ route('admin#list') }}" method="GET">
                                        @csrf
                                        <div class=" d-flex">
                                            <input class="form-control" type="text" name="key" placeholder="search..." value="{{ request('key') }}">
                                            <button class="btn btn-dark text-white" type="submit"><i class="zmdi zmdi-search"></i></button>
                                        </div>
                                    </form>
                                </div>

                                <div class="table-responsive table-responsive-data2 text-center">
                                    <table class="table table-data2 table-hover">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Gender</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Role</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($admin as $a )
                                            <tr class="tr-shadow">
                                                <div class="table-data-feature">
                                                    <td>
                                                        @if ($a->image == null)
                                                            @if($a->gender == 'male')
                                                                <img src="{{ asset('image/default_user.jpg') }}" class=" img-thumbnail shadow-sm">
                                                            @else
                                                                <img src="{{ asset('image/default_female.png') }}" class=" img-thumbnail shadow-sm">
                                                            @endif
                                                        @else
                                                            <img src="{{ asset('storage/'.$a->image) }}" class=" img-thumbnail shadow-sm">
                                                        @endif
                                                    </td>
                                                    <input type="hidden" name="" id="adminId" value="{{ $a->id }}">
                                                    <td>{{ $a->name }}</td>
                                                    <td>{{ $a->email }}</td>
                                                    <td>{{ $a->gender }}</td>
                                                    <td>{{ $a->phone }}</td>
                                                    <td>{{ $a->address }}</td>
                                                    <td>
                                                        @if ($a->id == 1)
                                                            <span>Admin</span>
                                                        @else
                                                            <select class="statusChange" title="Change Account Role">
                                                                <option value="admin" @if($a->role == 'admin') selected @endif>Admin</option>
                                                                <option value="user" @if($a->role == 'user') selected @endif>User</option>
                                                            </select>
                                                        @endif
                                                    </td>
                                                    <td class="tr-shadow">
                                                        <div class="table-data-feature">
                                                            @if ($a->id == 1)

                                                            @else
                                                                    <a href="{{ route('admin#delete',$a->id) }}">
                                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                            <i class="zmdi zmdi-delete me-2"></i>
                                                                        </button>
                                                                    </a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </div>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <div class=" mt-3">
                                        {{ $admin->links() }}
                                </div>
                                <!-- END DATA TABLE -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->
@endsection

@section("scriptSource")
        <script>
            $(document).ready(function(){
                $('.statusChange').change(function(){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $adminId = $parentNode.find('#adminId').val();

                $data = {'adminId' : $adminId, 'role' : $currentStatus};

                $.ajax({
                    type : 'get' ,
                    url : '/admin/ajax/change/role' ,
                    data : $data ,
                    dataType : 'json' ,
                })
                location.reload();
                })
            })
        </script>
@endsection
