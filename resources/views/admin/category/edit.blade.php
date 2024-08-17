@extends('admin.layouts.master')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4 col-5">
        <div class="card-header py-3">
            <div class="">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Update Category Page</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
           <form action="{{route('categoryUpdate')}}" method="POST">
            @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <input type="text" name="categoryName" class="form-control @error('categoryName') is-invalid @endError"
                     value="{{ old('categoryName',$data->name) }}" id="exampleFormControlInput1" placeholder="Enter Category...">
                     @error('categoryName')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                     @endError
                </div>

                <input type="submit" value="Update" class="btn btn-primary">
           </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


@endsection
