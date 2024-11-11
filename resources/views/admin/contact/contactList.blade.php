@extends('admin.layouts.master')

@section('title','Contact List')

@section('content')
                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="col-md-12">
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="overview-wrap">
                                            <h2 class="title-1">Contact List</h2>

                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive table-responsive-data2 text-center">
                                    <table class="table table-data2 table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Message</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataList">
                                            <div class="table-data-feature">
                                                @foreach ($contacts as $contact )

                                                    <tr class="tr-shadow">
                                                        {{-- <input type="hidden" class="userId" value="{{ $user->id }}"> --}}
                                                        <td>{{ $contact->name }}</td>
                                                        <td>{{ $contact->email }}</td>
                                                        <td maxlength="30">{{ $contact->message }}</td>
                                                    </tr>
                                            @endforeach
                                            </div>
                                        </tbody>
                                    </table>
                                    <div class="mt-3">
                                        {{ $contacts->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->
@endsection
