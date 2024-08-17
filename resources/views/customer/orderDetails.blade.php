@extends('customer.layouts.master')

@section('content')

        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->


        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Cart</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{route('userDashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('shopPage')}}">Shop</a></li>
                <li class="breadcrumb-item active text-white">OrderDetail</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Cart Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="table-responsive">
                    <table class="table" id="dataTable">
                        <thead>
                          <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                          </tr>
                        </thead>
                        <tbody >
                          @foreach ($orders as $item)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('productImages/'.$item->image)}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{$item->name}}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4" >{{$item->price}} mmk</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4" >{{$item->count}}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4" >{{$item->total_price}}</p>
                                </td>


                            </tr>
                          @endforeach


                        </tbody>
                    </table>
                </div>

                {{-- <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                <div class="d-flex justify-content-between mb-4 border-bottom ">
                                    <h5 class="mb-0 me-4">Subtotal:</h5>
                                    <p class="mb-0" id="subTotal">{{$totalPrice}} mmk</p>
                                </div>
                                <div class="d-flex justify-content-between mb-4 border-bottom ">
                                    <h5 class="mb-0 me-4">Shipping:</h5>
                                    <div class="">
                                        <p class="mb-0">500 mmk</p>
                                    </div>
                                </div>

                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Total</h5>
                                <p class="mb-0 pe-4" id="finalFee">{{$totalPrice + 500}} mmk</p>
                            </div>
                            <button id="checkOutBtn" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Payment Confirm</button>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- Cart Page End -->

@endsection
