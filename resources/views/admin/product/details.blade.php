@extends('admin.layouts.master')

@section('content')
      <!-- Begin Page Content -->
      <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Product Detail</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <img src="{{asset('productImages/'.$product->image)}}" class=" img-thumbnail "alt="" id="output">

                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                                        <h4>{{$product->name}}</h4>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput2" class="form-label">Price</label>
                                        <h4>{{$product->price}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput4" class="form-label">Category Name</label>
                                        <h4>{{$product->category_name}}</h4>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput5" class="form-label">Stock Count</label>
                                        <h4>{{$product->count}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput3" class="form-label">Description</label>
                                        <h6>{{$product->description}}</h6>
                                    </div>
                                </div>
                            </div>
                            <a href="{{route('productList')}}"><input type="button" value="Back" class="btn bg-dark text white"></a>
                        </div>
                    </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
