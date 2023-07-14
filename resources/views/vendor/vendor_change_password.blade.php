@extends('vendor.vendor_dashboard')
@section('content')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
            <div class="breadcrumb-title pe-3">Vendor Change Password</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('vendor.update.password') }}" method="POST">
                                    @csrf

                                    @if(session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{session('status')}}
                                        </div>
                                    @elseif(session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{session('error')}}
                                        </div>
                                    @endif

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Current Password</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror"  id="current_password" placeholder="Enter current password"/>

                                            @error('current_password')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">New Password</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="password"  name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" placeholder="Enter New password"/>

                                            @error('new_password')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>

                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Confirm Password</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" placeholder="re-enter password"/>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
