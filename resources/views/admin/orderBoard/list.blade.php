@extends('admin.layouts.master')

@section('content')
       <!-- Begin Page Content -->
       <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Order Board</h6>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-left">
                                <th >Date</th>
                                <th >Order Code</th>
                                <th >User Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderList as $item)
                                <tr class="text-left">
                                    <td>{{$item->created_at->format('j-F-Y')}}</td>
                                    <td>
                                        <a href="{{route('adminOrderDetails',$item->order_code)}}" class="orderCode">{{$item->order_code}}</a>
                                    </td>
                                    <td><a href="{{route('accountProfile',$item->user_id)}}">
                                        {{$item->user_name != null ? $item->user_name : $item->nickname}}</a>
                                    </td>
                                    <td >
                                        <select  class="form-control status-change">
                                            <option value="0" @if($item->status == 0 ) selected @endif>Pending</option>
                                            <option value="1" @if($item->status == 1 ) selected @endif>Accept</option>
                                            <option value="2" @if($item->status == 2 ) selected @endif>Reject</option>
                                        </select>
                                    </td>

                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                    <span class="d-flex justify-content-end">{{$orderList->links()}}</span>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
@section('js-section')
    <script>
        $(document).ready(function(){
            $('.status-change').change(function(){
                $status = $(this).val();
                $orderCode = $(this).parents('tr').find('.orderCode').text();

                $data = {
                    'status' : $status,
                    'orderCode' : $orderCode
                };
                $.ajax({
                    type : 'get',
                    url : 'change/status',
                    data : $data,
                    dataType : 'json'
                });
            });
        });

    </script>
@endsection


