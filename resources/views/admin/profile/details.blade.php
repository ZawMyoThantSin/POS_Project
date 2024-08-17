@extends('admin.layouts.master')

@section('content')
      <!-- Begin Page Content -->
      <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Profile Details</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('profileUpdate')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            @if (auth()->user()->profile ==null)
                                <img class="img-profile rounded img-thumbnail" id="output" src="{{asset('profileImages/undraw_profile.svg')}}">
                            @else
                            <img class="img-profile rounded img-thumbnail" id="output" src="{{asset('profileImages/'.auth()->user()->profile)}}">
                            @endif
                            <input type="file" name="image" class="form-control my-3  @error('image') is-invalid @endError" onchange="loadFile(event)">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                             @endError
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                                        <input type="text" name="name" value="{{ old('name',auth()->user()->name == null ? auth()->user()->nickname : auth()->user()->name)}}" class="form-control  @error('name') is-invalid @endError" id="exampleFormControlInput1" placeholder="Name...">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @endError
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput2" class="form-label">Email</label>
                                        <input type="text" name="email" value="{{old('email',auth()->user()->email)}}"
                                        @if(auth()->user()->provider != 'simple') disabled @endif  class="form-control @error('email') is-invalid @endError" id="exampleFormControlInput2" placeholder="example@email.com...">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @endError
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput4" class="form-label">Phone</label>
                                        <input type="text" name="phone" value="{{ old('phone',auth()->user()->phone)}}" class="form-control @error('phone') is-invalid @endError" id="exampleFormControlInput4" placeholder="09xxxxxxx...">
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @endError
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput5" class="form-label">Address</label>
                                        <input type="text" name="address" value="{{ old('address',auth()->user()->address)}}" class="form-control @error('address') is-invalid @endError" id="exampleFormControlInput5" placeholder="Address...">
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @endError
                                    </div>
                                </div>
                            </div>

                           @if(auth()->user()->provider =='simple')
                            <a class="d-block my-3" href="{{route('changePasswordPage')}}">Change Password?</a>
                           @endif
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
