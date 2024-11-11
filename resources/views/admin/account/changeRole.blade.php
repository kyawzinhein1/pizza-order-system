@extends('admin.layouts.master')

@section('title','Admin Change Role')

@section('content')
                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="col-lg-9 offset-1">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Change Role</h3>
                                            <i class="fa-solid fa-angles-left ms-5 text-dark" onclick="history.back()"></i>
                                        </div>
                                        <hr>
                                        <form action="{{ route('admin#role',$account->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-4 offset-1 mt-3">
                                                    @if ($account->image == null)
                                                        @if($account->gender == 'male')
                                                            <td class=" col-2"><img src="{{ asset('image/default_user.jpg') }}" class=" img-thumbnail"></td>
                                                        @else
                                                            <td class=" col-2"><img src="{{ asset('image/default_female.png') }}" class=" img-thumbnail"></td>
                                                        @endif
                                                    @else
                                                        <img src="{{ asset('storage/'.$account->image) }} " />
                                                    @endif

                                                    <div class=" mt-4">
                                                        <button class="btn bg-dark text-white col-12">
                                                            <i class="zmdi zmdi-chevron-up me-2"></i> Update
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-1">Name</label>
                                                        <input id="cc-pament" disabled name="name" type="text" value="{{ old('name',$account->name) }}" class="form-control @error('name') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter Admin Name">
                                                        @error('name')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label mb-1">Role</label>
                                                        <select name="role" class="form-control">
                                                            <option value="admin" @if($account->role == 'admin') selected @endif>Admin</option>
                                                            <option value="user" @if($account->role == 'user') selected @endif>User</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label mb-1">Email</label>
                                                        <input id="cc-pament" disabled name="email" type="email" value="{{ old('email',$account->email) }}" class="form-control @error('email') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                                        @error('email')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label mb-1">Phone</label>
                                                        <input id="cc-pament" disabled name="phone" type="number" value="{{ old('phone',$account->phone) }}" class="form-control @error('phone') is-invalid @enderror"  aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone">
                                                        @error('phone')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label mb-1">Gender</label>
                                                        <select name="gender" disabled class="form-control @error('gender') is-invalid @enderror">
                                                            <option value="">Choose Gender...</option>
                                                            <option value="male" @if ($account->gender == 'male') selected @endif>Male</option>
                                                            <option value="male" @if ($account->gender == 'female') selected @endif>Female</option>
                                                        </select>
                                                        @error('gender')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label mb-1">Address</label>
                                                        <textarea name="address" disabled class=" form-control @error('address') is-invalid @enderror" cols="10" rows="1" placeholder="Enter Admin Address">{{ old('address',$account->address) }}</textarea>
                                                        @error('address')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
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
