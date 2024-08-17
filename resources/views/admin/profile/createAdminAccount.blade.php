@extends('admin.layouts.master')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4 col-5">
        <div class="card-header py-3">
            <div class="">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Add New Admin</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
           <form action="{{route('createAdmin')}}" method="POST">
            @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Admin Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @endError"
                     value="{{old('name')}}" id="exampleFormControlInput1" placeholder="Enter Name...">
                     @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                     @endError
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @endError"
                     value="{{old('email')}}" id="exampleFormControlInput2" placeholder="Enter Email...">
                     @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                     @endError
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput3" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @endError"
                      id="exampleFormControlInput3" placeholder="Password...">
                     @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                     @endError
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput4" class="form-label">Confirm Password</label>
                    <input type="password" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid @endError"
                     id="exampleFormControlInput4" placeholder="Confirm Password...">
                     @error('confirmPassword')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                     @endError
                </div>
                <input type="submit" value="Create" class="btn btn-primary">
           </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


@endsection
