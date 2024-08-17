@extends('admin.layouts.master')

@section('content')
       <!-- Begin Page Content -->
       <div class="container-fluid">

        <a href="{{route('orderBoard')}}">
            <button class="btn bg-transparent text-primary"><i class="m-2  fa-solid fa-arrow-left-long "></i></button>
        </a>
       <div class="row">
        <div class="card col-5 mb-2 ">
            <div class="card-header py-3">Customer Details</div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-5">Name :</div>
                    <div class="col-7">{{$orders[0]->user_name != null ? $orders[0]->user_name : $orders[0]->nickname}}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-5">Email :</div>
                    <div class="col-7">{{$orders[0]->email}}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-5">Phone :</div>
                    <div class="col-7">{{$orders[0]->phone}}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-5">Order Code :</div>
                    <div class="col-7">{{$orders[0]->order_code}}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-5">Order Date :</div>
                    <div class="col-7">{{$orders[0]->created_at->format('j-F-Y')}}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-5">Total Price :</div>
                    <div class="col-7">{{$totalPrice}} <br> <small class="text-danger">(Contain Delivery Charges)</small></div>
                </div>
            </div>
        </div>
        <div class="card col-6  offset-1 mb-2 ">
            <div class="card-header py-3">Invoice Details</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="row mb-2">
                            <img style="width:150px" src="{{asset('invoiceImages/'.$invoiceData->invoice_image)}}" class="img-thumbnail" alt="">
                         </div>
                    </div>
                    <div class="col">
                        <div class="row mb-2">
                            <div class="col">Pay Slip Contact :</div>
                            <div class="col-5 text-dark">{{$invoiceData->phone}}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">Payment Method :</div>
                            <div class="col-5 text-dark">{{$invoiceData->payment_type}}</div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
       </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4 row">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-left">
                                <th >Products</th>
                                <th >Name</th>
                                <th class="text-center">Count</th>
                                <th>Price</th>
                                <th class="fw-bold">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($orders as $item)
                           <tr>
                            <td scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('productImages/'.$item->image)}}"
                                     class="img-fluid me-5 rounded shadow-sm" style="width: 80px; height: 80px;" alt="">
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">{{$item->name}}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4 text-center">{{$item->count}}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4" id="price">{{$item->price}} mmk</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4" id="price">{{$item->total_price}} mmk</p>
                            </td>

                        </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
@section('js-section')
    <script>


    </script>
@endsection


