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
                <li class="breadcrumb-item active text-white">Cart</li>
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
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody >
                            <input type="hidden" id="userId" value="{{auth()->user()->id}}">
                            @foreach ($cartData as $item)
                            <tr>
                                <input type="hidden" id="productId" value="{{$item->product_id}}">
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{asset('productImages/'.$item->image)}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{$item->name}}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4" id="price">{{$item->price}} mmk</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" id="qty" class="form-control form-control-sm text-center border-0" value="{{$item->qty}}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4" id="eachTotal">{{$item->price * $item->qty}}</p>
                                </td>
                                <td>
{{-- important --}}
                                    <input type="hidden" id="cartId" value="{{$item->id}}">
                                    <button class="btn btn-md rounded-circle bg-light border mt-4 btn-remove" >
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>

                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-5">
                    <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                    <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
                </div>
                <div class="row g-4 justify-content-end">
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
                            <button id="checkOutBtn" @if(count($cartData)== 0) disabled @endif class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Payment Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart Page End -->

@endsection

@section('js-section')
   <script>
     $(document).ready(function(){
        //order checkout
        $('#checkOutBtn').click(function(){
            $orderList = [];
            // change to number format Number() OR multiply with 1
            $orderCode =  Math.floor(Math.random() * 10000000); //random number
            $userId = $('#userId').val() * 1;
            $(' #dataTable tbody tr').each(function(item,row){
                $qty = $(row).find('#qty').val() * 1;
                $productId = $(row).find('#productId').val() * 1;
                $totalPrice = $(row).find('#eachTotal').text().replace('mmk','') *1;

                $orderList.push({
                    'userId' : $userId,
                    'orderCode' :'POS' +$orderCode,
                    'qty' : $qty,
                    'productId' :$productId,
                    'totalPrice' :$totalPrice

            });
            });
            $.ajax({
                type : 'get',
                url :'order',
                data : Object.assign({},$orderList),
                dataType : 'json',
                success : function (response) {
                    if(response.status ==200){
                        location.href = 'payment';
                    }
                }
            });
            console.log('success');
        });

        // delete the cart item
        $('.btn-remove').click(function(){
            $parentNode = $(this).parents('tr');
            $cartId = $parentNode.find('#cartId').val();

            $deleteData = {
                'cartId' : $cartId
            };

            $.ajax({
                type : 'get',
                url : 'remove/cart',
                data : $deleteData,
                dataType: 'json',
                success : function(response){
                    if(response.message == 'success'){
                        location.reload();
                    }
                }
            });
        });

        // plus button clicked
        $('.btn-plus').click(function(){
           $parentNode = $(this).parents('tr');
           $price = $parentNode.find('#price').text().replace('mmk','')
           $qty = $parentNode.find('#qty').val();
           $totalPrice = $price * $qty;
           $parentNode.find('#eachTotal').html($totalPrice + 'mmk')
           finalCalculation();
        });

        // minus button clicked
        $('.btn-minus').click(function(){
           $parentNode = $(this).parents('tr');
           $price = $parentNode.find('#price').text().replace('mmk','')
           $qty = $parentNode.find('#qty').val();
           $totalPrice = $price * $qty;
           $parentNode.find('#eachTotal').html($totalPrice + 'mmk')
           finalCalculation();
        });

        function finalCalculation(){
            $totalPrice = 0;
            $(" #dataTable tbody tr ").each(function(item , row){
               $totalPrice += Number($(row).find("#eachTotal").text().replace('mmk',''));

            })
            $('#subTotal').html(`${$totalPrice} mmk`)
            $('#finalFee').html(`${$totalPrice + 500} mmk`)
        }

    })

   </script>

@endsection
