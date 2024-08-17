@extends('admin.layouts.master')

@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <form action="{{route('productList')}}" method="GET">
                                    <div class="input-group mb-3">
                                            <input type="text" name="searchKey" class="form-control" value="{{request('searchKey')}}" placeholder="Search Product...">
                                            <button type="submit" class="btn btn-outline-secondary "><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </form>
                            </h6>

                        </div>
                        <div class="">
                            <a href="{{route('productCreatePage')}}"><i class="fa-solid fa-plus"></i> Add Product</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                    <tr>
                                        <td>{{ $item->name}}</td>
                                        <td class="col-2"><img src="{{asset('productImages/'.$item->image)}}" class="img-thumbnail" alt=""></td>
                                        <td>{{$item->price}} MMK</td>
                                        <td>{{$item->count}}</td>
                                        <td class="col-2">
                                            <a href="{{ route('productDetails',$item->id)}}"><i class="fa-solid fa-eye btn btn-primary"></i></a>
                                            <a href="{{route('productEdit', $item->id)}}"><i class="fa-solid fa-pen-to-square btn btn-warning"></i></a>
                                            <a href="{{route('productDelete',$item->id)}}"><i class="fa-solid fa-trash-can btn btn-danger"></i></a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <span class=" d-flex justify-content-end">{{ $products->links() }}</span>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

@endsection
