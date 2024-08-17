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
    <h1 class="text-center text-white display-6">Shop</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{route('userDashboard')}}">Home</a></li>
        <li class="breadcrumb-item active text-white">Shop</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Fruits Shop Start-->
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <h1 class="mb-4">Fresh fruits shop</h1>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    <div class="col-xl-3">
                       <form action="{{route('shopPage')}}" method="GET">
                        @csrf
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="text" class="form-control p-3" value="{{request('searchKey')}}" name="searchKey" placeholder="keywords" aria-describedby="search-icon-1">
                                <button id="search-icon-1" type="submit" class="input-group-text p-3"><i class="fa fa-search"></i></button>
                            </div>
                       </form>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-xl-3">
                        <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                            <label for="fruits">Default Sorting:</label>
                            <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3" form="fruitform">
                                <option value="volvo">Nothing</option>
                                <option value="saab">Popularity</option>
                                <option value="opel">Organic</option>
                                <option value="audi">Fantastic</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4>Categories</h4>
                                    <ul class="list-unstyled fruite-categorie">
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a href="{{route('shopPage')}}"><i class="fas fa-apple-alt me-2"></i>All Categories</a>
                                                {{-- <span>(3)</span> --}}
                                            </div>
                                        </li>
                                        @foreach ($categories as $item)
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a href="{{route('shopPage',$item->id)}}"><i class="fas fa-apple-alt me-2"></i>{{$item->name}}</a>
                                                {{-- <span>(3)</span> --}}
                                            </div>
                                        </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                            {{-- <div class="col-lg-12">
                                <div class="mb-3">
                                    <h4 class="mb-2">Price</h4>
                                    <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="500" value="0" oninput="amount.value=rangeInput.value">
                                    <output id="amount" name="amount" min-velue="0" max-value="500" for="rangeInput">0</output>
                                </div>
                            </div> --}}

                            <div class="col-lg-12">
                               <form action="{{route('shopPage')}}" method="GET">
                                @csrf
                                    <div class="row">
                                        <label for="" class="mb-2">Filter By Price</label>
                                        <div class="col-4">
                                            <input type="text" name="minPrice" value="{{request('minPrice')}}"  class="form-control" placeholder="Min...">
                                        </div> -
                                        <div class="col-4">
                                            <input type="text" name="maxPrice" value="{{request('maxPrice')}}" class="form-control" placeholder="Max...">
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <button type="submit" class="mt-3 btn btn-success text-white ">Filter</button>
                                            </div>
                                        </div>
                                    </div>
                               </form>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row g-4 justify-content-center">

                            @foreach ($products as $item)
                                <div class="col-md-6 col-lg-6 col-xl-4">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <a href="{{route('shopDetails',$item->id)}}">
                                                <img style="height: 250px" src="{{asset('productImages/'.$item->image)}}" class="img-fluid w-100 rounded-top" alt="">
                                            </a>
                                        </div>
                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{$item->category_name}}</div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4>{{$item->name}}</h4>
                                            <p>{{Str::words($item->description,10,'....')}}</p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">{{$item->price}} mmk</p>
                                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-12">
                                <div class="pagination d-flex justify-content-center mt-5">
                                   <span>{{$products->links()}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->

@endsection
