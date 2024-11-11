@extends('admin.layouts.master')

@section('title','Product List')

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
                                            <h2 class="title-1">Product List</h2>

                                        </div>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <a href="{{ route('product#createPage') }}">
                                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                                <i class=" fa fa-plus"></i>Add Pizza
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
                                    <form action="{{ route('product#list') }}" method="GET">
                                        @csrf
                                        <div class=" d-flex">
                                            <input class="form-control" type="text" name="key" placeholder="search..." value="{{ request('key') }}">
                                            <button class="btn btn-dark text-white" type="submit"><i class="zmdi zmdi-search"></i></button>
                                        </div>
                                    </form>
                                </div>


                                @if (count($pizzas) != 0)
                                <div class="table-responsive table-responsive-data2 text-center">
                                    <table class="table table-data2 table-hover">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Category</th>
                                                <th>View Count</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pizzas as $p )
                                                <tr class="tr-shadow">
                                                    <td class=" col-2"><img src="{{ asset('storage/'.$p->image) }}" class=" img-thumbnail shadow-sm"></td>
                                                    <td>{{ $p->name }}</td>
                                                    <td>{{ $p->price }}</td>
                                                    <td>{{ $p->category_name }}</td>
                                                    <td><i class="fa-regular fa-eye"></i> {{ $p->view_count }}</td>
                                                    <td>
                                                        <div class="table-data-feature">
                                                            <a href="{{ route('product#edit',$p->id) }}">
                                                                <button class="item me-2" data-toggle="tooltip" data-placement="top" title="View">
                                                                    <i class="zmdi zmdi-eye"></i>
                                                                </button>
                                                            </a>
                                                            <a href="{{ route('product#updatePage',$p->id) }}">
                                                                <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                    <i class="zmdi zmdi-edit"></i>
                                                                </button>
                                                            </a>
                                                            <a href="{{ route('product#delete',$p->id) }}">
                                                                <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                    <i class="zmdi zmdi-delete"></i>
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class=" mt-3">
                                        {{ $pizzas->links() }}
                                    </div>
                                </div>
                                @else
                                    <h3 class=" text-secondary text-center mt-5">There is no Pizza Here!</h3>
                                </div>
                                @endif
                                <!-- END DATA TABLE -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->
@endsection
