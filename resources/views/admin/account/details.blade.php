@extends('admin.layouts.master')

@section('title','Account Info')

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
                                            <h3 class="text-center title-2">Account Info</h3>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-3 offset-1 mt-2">
                                                @if (Auth::user()->image == null)
                                                    @if(Auth::user()->gender == 'male')
                                                        <td class=" col-2"><img src="{{ asset('image/default_user.jpg') }}" class=" img-thumbnail"></td>
                                                    @else
                                                        <td class=" col-2"><img src="{{ asset('image/default_female.png') }}" class=" img-thumbnail"></td>
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/'.Auth::user()->image) }} " />
                                                @endif
                                            </div>
                                            <div class="col-7 offset-1">
                                                <h4 class=" my-3"> <i class="fa-regular fa-user me-2"></i> {{ Auth::user()->name }}</h4>
                                                <h4 class=" my-3"> <i class="fa-solid fa-at me-2"></i> {{ Auth::user()->email }}</h4>
                                                <h4 class=" my-3"> <i class="fa-solid fa-phone me-2"></i> {{ Auth::user()->phone }}</h4>
                                                <h4 class=" my-3"> <i class="fa-solid fa-venus-mars me-2"></i> {{ Auth::user()->gender }}</h4>
                                                <h4 class=" my-3"> <i class="fa-regular fa-address-card me-2"></i> {{ Auth::user()->address }}</h4>
                                                <h4 class=" my-3"> <i class="fa-regular fa-calendar-plus me-2"></i> {{ Auth::user()->created_at->format('j-M-Y') }}</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <a href="{{ route('admin#edit') }}">
                                                <button class="btn bg-dark text-white col-3 offset-8 my-3"> <i class="zmdi zmdi-edit mr-2"></i> Edit Profile</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->
@endsection
