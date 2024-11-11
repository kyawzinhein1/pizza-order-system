@extends('admin.layouts.master')

@section('title','Account Profile')

@section('content')
                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="col-lg-9 offset-1">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Account Profile</h3>
                                        </div>
                                        <hr>
                                        <form action="{{ route('admin#update',Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-4 offset-1 mt-3">
                                                    @if (Auth::user()->image == null)
                                                        @if(Auth::user()->gender == 'male')
                                                            <td class=" col-2"><img src="{{ asset('image/default_user.jpg') }}" class=" img-thumbnail"></td>
                                                        @else
                                                            <td class=" col-2"><img src="{{ asset('image/default_female.png') }}" class=" img-thumbnail"></td>
                                                        @endif
                                                    @else
                                                        <img src="{{ asset('storage/'.Auth::user()->image) }} " class=" img-thumbnail"/>
                                                    @endif
                                                    <div class=" mt-4">
                                                        <input type="file" name="image" class=" form-control-sm @error('image') is-invalid @enderror">
                                                        @error('image')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class=" mt-4">
                                                        <button class="btn bg-dark text-white col-12">
                                                            <i class="fa-regular fa-pen-to-square"></i> Update
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-1">Name</label>
                                                        <input id="cc-pament" name="name" type="text" value="{{ old('name',Auth::user()->name) }}" class="form-control @error('name') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter Admin Name">
                                                        @error('name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label mb-1">Email</label>
                                                        <input id="cc-pament" name="email" type="email" value="{{ old('email',Auth::user()->email) }}" class="form-control @error('email') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                                        @error('email')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label mb-1">Phone</label>
                                                        <input id="cc-pament" name="phone" type="number" value="{{ old('phone',Auth::user()->phone) }}" class="form-control @error('phone') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone">
                                                        @error('phone')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label mb-1">Gender</label>
                                                        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                                            <option value="">Choose Gender...</option>
                                                            <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                            <option value="male" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                                        </select>
                                                        @error('gender')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label mb-1">Address</label>
                                                        <textarea name="address" class=" form-control @error('address') is-invalid @enderror" cols="20" rows="4" placeholder="Enter Admin Address">{{ old('address',Auth::user()->address) }}</textarea>
                                                        @error('address')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label mb-1">Role</label>
                                                        <input id="cc-pament" name="role" type="text" value="{{ old('role',Auth::user()->role) }}" class="form-control"  aria-required="true" aria-invalid="false" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->
@endsection
