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
            <h1 class="text-center text-white display-6">Payment</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{route('userDashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('shopPage')}}">Shop</a></li>
                <li class="breadcrumb-item active text-white">Payment</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Cart Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">

                <div class="card shadow-sm">
                    <div class="card-header">Payment Information</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                @foreach ($payments as $item)
                                <div class="card mb-1">
                                    <div class="card-body">
                                        <h4>{{$item->type}}</h4>
                                        <div class="d-flex justify-content-between text-muted">
                                            <span class="fw-bold">{{$item->account_name}}</span>
                                            <small>{{$item->account_number}}</small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col offset-1 me-3">
                                <div class="row">
                                    <div class="card">
                                       <form action="{{route('orderProduct')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                            <div class="card-body">
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <p class="fw-bold">Order Code: <span class="btn btn-sm bg-dark text-white"> {{$orderList[0]['order_code']}}</span>
                                                        </p>
                                                        <input type="hidden" name="orderCode" value="{{$orderList[0]['order_code']}}">
                                                    </div>
                                                <div class="col">
                                                    <p class="fw-bold">Total Price : <span class="btn btn-sm btn-secondary"> {{$totalPrice + 500}}</span></p>
                                                    <input type="hidden" name="totalPrice" value="{{$totalPrice + 500}}">
                                                </div>

                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col">
                                                        <label for="form-group1" class="mb-1">Name</label>
                                                        <input type="text" name="customerName" id="form-group1" class="form-control" placeholder="Enter Name...">
                                                        @error('customerName')
                                                            <small class="text-danger">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                <div class="col">
                                                    <label for="form-group2">Phone Number</label>
                                                    <input type="text" id="form-group2" name="phone" class="form-control" placeholder="Enter Phone...">
                                                    @error('phone')
                                                        <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="form-group3">Payment Method</label>
                                                        <select name="paymentMethod" id="form-group3" class="form-control">
                                                            <option value="">Choose Payment Method...</option>
                                                            @foreach ($payments as $item)
                                                                <option value="{{$item->id}}">{{$item->type}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('paymentMethod')
                                                            <small class="text-danger">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <label for="form-group4">Payment Invoice</label>
                                                        <input id="form-group4" type="file" name="invoiceImage" class="form-control">
                                                        @error('invoiceImage')
                                                            <small class="text-danger">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row my-3">
                                                    <div class="col-5">
                                                        <input type="submit" class="btn btn-primary" value="Order Product">

                                                    </div>
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
        </div>
        <!-- Cart Page End -->

@endsection

