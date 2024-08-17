@extends('authentication.layouts.master')

@section('content')
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 offset-3">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form method="POST" action="{{ route('register') }}" class="user">
                                @csrf
                                <div class="form-group ">
                                        <input type="text" name="name" value="{{old('name')}}"
                                         class="form-control form-control-user @error('name') is-invalid @endError" id="exampleFirstName"
                                            placeholder="Enter Name...">
                                        @error('name')
                                            <small class="invalid-feedback">
                                                {{$message}}
                                            </small>
                                        @endError
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" value="{{old('email')}}"
                                    class="form-control form-control-user @error('email') is-invalid @endError" id="exampleInputEmail"
                                        placeholder="Email Address">
                                        @error('email')
                                        <small class="invalid-feedback">
                                            {{$message}}
                                        </small>
                                        @endError

                                </div>
                                <div class="form-group ">
                                    <input type="text" name="phone" value="{{old('phone')}}"
                                    class="form-control form-control-user @error('phone') is-invalid @endError" id="exampleFirstName"
                                        placeholder="Enter Phone...">

                                    @error('phone')
                                        <small class="invalid-feedback">
                                            {{$message}}
                                        </small>
                                    @endError
                                 </div>
                                 <div class="form-group ">
                                    <input type="text" name="address" value="{{old('address')}}" class="form-control form-control-user @error('address') is-invalid @endError" id="exampleFirstName"
                                      placeholder="Enter Address...">
                                    @error('address')
                                        <small class="invalid-feedback">
                                            {{$message}}
                                        </small>
                                    @endError
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @endError"
                                            id="exampleInputPassword" placeholder="Password">
                                        @error('password')
                                            <small class="invalid-feedback">
                                                {{$message}}
                                            </small>
                                        @endError
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="password_confirmation" class="form-control form-control-user @error('password_confirmation') is-invalid @endError"
                                            id="exampleRepeatPassword" placeholder="Comfirm Password">
                                    </div>
                                    @error('password_confirmation')
                                        <small class="invalid-feedback">
                                            {{$message}}
                                        </small>
                                    @endError
                                </div>
                                <input type="submit" value="Register Account" class="btn btn-primary btn-user btn-block">



                            </form>
                            <hr>

                            <div class="text-center">
                                <a class="small" href="{{ route('userLogin')}}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
