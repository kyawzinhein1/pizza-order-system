@extends('admin.layouts.master')

@section('title','Category List')

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
                                            <h2 class="title-1">Category List</h2>

                                        </div>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <a href="{{ route('category#createPage') }}">
                                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                                <i class=" fa fa-plus"></i>Add Category
                                            </button>
                                        </a>
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            CSV download
                                        </button>
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
                                    <form action="{{ route('category#list') }}" method="GET">
                                        @csrf
                                        <div class=" d-flex">
                                            <input class="form-control" type="text" name="key" placeholder="search..." value="{{ request('key') }}">
                                            <button class="btn btn-dark text-white" type="submit"><i class="zmdi zmdi-search"></i></button>
                                        </div>
                                    </form>
                                </div>

                                @if (count($categories) != 0)
                                <div class="table-responsive table-responsive-data2 text-center">
                                    <table class="table table-data2 table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category Name</th>
                                                <th>Created Date</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category )
                                            <tr class="tr-shadow">
                                                <td>{{ $category->id }}</td>
                                                <td class=" col-6">{{ $category->name }}</td>
                                                <td><i class="zmdi zmdi-calendar"></i> {{ $category->created_at->format('j-M-Y') }}</td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <a href="{{ route('category#edit',$category->id) }}">
                                                            <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('category#delete',$category->id) }}">
                                                            <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class=" mt-3">
                                        {{ $categories->links() }}
                                        {{-- {{ $categories->appends(request()->query())->links() }} --}}
                                    </div>
                                </div>
                                @else
                                    <h3 class=" text-secondary text-center mt-5">There is no Category Here!</h3>
                                @endif
                                <!-- END DATA TABLE -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->
@endsection
