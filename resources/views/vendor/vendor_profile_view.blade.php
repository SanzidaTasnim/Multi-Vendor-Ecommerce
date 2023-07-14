@extends('vendor.vendor_dashboard')
@section('content')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">User Profile</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img
                                        src="{{ (!empty($user->photo)) ? url('upload/vendor_images/'.$user->photo) : url('upload/no-image.png')}}"
                                        alt="Admin" class="rounded-circle p-1 bg-primary" width="110"
                                    >
                                    <div class="mt-3">
                                        <h4>{{ $user->name }}</h4>
                                        <p class="text-secondary mb-1"> {{ $user->email }} </p>
                                        <p class="text-muted font-size-sm"> {{ $user->address }} </p>
                                        <button class="btn btn-primary">Follow</button>
                                        <button class="btn btn-outline-primary">Message</button>
                                    </div>
                                </div>
                                <hr class="my-4" />
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
                                        <span class="text-secondary">https://codervent.com</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                                        <span class="text-secondary">codervent</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('vendor.profile.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">User Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" value="{{ $user->username}}" disabled/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Shop Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" value="{{ $user->name}}" name="name"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="email" class="form-control" value="{{ $user->email }}" name="email" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Phone</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" value="{{ $user->phone }}" name="phone"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Address</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" value="{{ $user->address }}" name="address"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Joining Date</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select class="form-select mb-3" aria-label="default select example" name="vendor_join_date" value="{{$user->vendor_join_date}}">

                                                <option selected="Select From the option below" >Select From the option below</option>
                                                <option value="2015" {{ $user->vendor_join_date == 2015 ? 'selected' : '' }}>2015</option>
                                                <option value="2016" {{ $user->vendor_join_date == 2016 ? 'selected' : '' }}>2016</option>
                                                <option value="2017" {{ $user->vendor_join_date == 2017 ? 'selected' : '' }}>2017</option>
                                                <option value="2018" {{ $user->vendor_join_date == 2018 ? 'selected' : '' }}>2018</option>
                                                <option value="2019" {{ $user->vendor_join_date == 2019 ? 'selected' : '' }}>2019</option>
                                                <option value="2020" {{ $user->vendor_join_date == 2020 ? 'selected' : '' }}>2020</option>

                                            </select>

                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Description</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <textarea class="form-control" name="vendor_info" id="inputAddress2"
                                            placeholder="Vendor Description" rows="3">
                                                {{$user->vendor_info}}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Photo</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" class="form-control" id="uploadInput" name="photo"/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary" id="imageContainer" >
                                            <img
                                                id="imageTag"
                                                src="{{ (!empty($user->photo)) ? url('upload/vendor_images/'.$user->photo) : url('upload/no-image.png')}}"
                                                alt="Vendor"
                                                style="width: 100px; height: 100px;"
                                            >
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

    <script>
        var uploadInput = document.getElementById('uploadInput');

        uploadInput.addEventListener('change', function() {
            var file = uploadInput.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.querySelector('#imageTag');
                img.src = e.target.result;
                var imageContainer = document.getElementById('imageContainer');
                imageContainer.innerHTML = '';
                imageContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    </script>
@endsection
