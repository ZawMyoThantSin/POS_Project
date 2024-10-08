@extends('authentication.layouts.master')

@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 offset-3">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" name="email" value="{{old('email')}}" class="form-control form-control-user
                                             @error('email') is-invalid @endError"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                                @error('email')
                                                <small class="invalid-feedback">
                                                    {{$message}}
                                                </small>
                                                @endError
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user  @error('password') is-invalid @endError""
                                                id="exampleInputPassword" placeholder="Password">
                                                @error('password')
                                                <small class="invalid-feedback">
                                                    {{$message}}
                                                </small>
                                                @endError
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <input type="submit" value="Login" class="btn btn-primary btn-user btn-block">

                                        <hr>
                                        <a href="{{url('/auth/google/redirect')}}" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="{{url('/auth/github/redirect')}}" class="btn bg-dark text-white btn-user btn-block">
                                            <i class="fa-brands fa-github "></i> Login with Github
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('userRegister')}}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
