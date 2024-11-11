@extends('admin.layouts.master')

@section('title','Pizza Info')

@section('content')
                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="row">
                        <col-3 class="col-4 offset-6">
                        @if (session('updateSuccess'))
                            <div class="">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="zmdi zmdi-close-circle"></i>  {{ session('updateSuccess') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        </col-3>
                    </div>
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="col-lg-9 offset-1">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <i class="fa-solid fa-angles-left ms-5 text-dark" onclick="history.back()"></i>

                                            {{-- <a href="{{ route('product#list') }}">
                                                <i class="fa-solid fa-angles-left ms-5 text-dark"></i>
                                            </a> --}}

                                            <h3 class="text-center title-2">Pizza Info</h3>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-3 offset-1 mt-2">
                                                    <img src="{{ asset('storage/'.$pizza->image) }} " class=" img-thumbnail shadow-sm" />
                                            </div>
                                            <div class="col-7 offset-1">
                                                <div class=" my-3 btn bg-danger text-white d-block w-50 fs-5"></i> {{ $pizza->name }}</div>
                                                <span class=" my-3 btn-sm bg-dark text-white"> <i class="fa-solid fa-money-bill-1-wave me-2"></i> {{ $pizza->price }}</span>
                                                <span class=" my-3 btn-sm bg-dark text-white"> <i class="fa-solid fa-clock me-2"></i> {{ $pizza->waiting_time }}</span>
                                                <span class=" my-3 btn-sm bg-dark text-white"> <i class="fa-solid fa-eye me-2"></i> {{ $pizza->view_count }}</span>
                                                <span class=" my-3 btn-sm bg-dark text-white"> <i class="fa-solid fa-coins me-2"></i> {{ $pizza->category_name }}</span>
                                                <div class="my-3">
                                                <span class=" btn-sm bg-dark text-white"> <i class="fa-regular fa-calendar-plus me-2"></i> {{ $pizza->created_at->format('j-M-Y') }}</span>
                                                </div>
                                                <div class="my-3"><i class="fa-solid fa-receipt"></i> Details </div>
                                                <div class="">{{ $pizza->description }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->
@endsection
