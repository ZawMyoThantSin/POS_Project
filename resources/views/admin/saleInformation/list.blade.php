@extends('admin.layouts.master')

@section('content')
       <!-- Begin Page Content -->
       <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Sale Information</h6>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-left">
                                <th>Product</th>
                                <th>Name</th>
                                <th >User Name</th>
                                <th >Date</th>
                                <th class="col-1">Quantity</th>
                                <th>Total Price</th>
                                <th>Order Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderList as $item)
                               <tr>
                                <td class="col-2"><img src="{{asset('productImages/'.$item->image)}}" class="img-thumbnail" alt=""></td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->user_name != null ? $item->user_name : $item->nickname }}</td>
                                <td>{{$item->created_at->format('j-F-Y')}}</td>
                                <td>{{$item->count}}</td>
                                <td>{{$item->total_price}}</td>
                                <td><a href="{{route('adminOrderDetails',$item->order_code)}}">{{$item->order_code}}</a></td>
                               </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <span class="d-flex justify-content-end">{{$orderList->links()}}</span> --}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection


