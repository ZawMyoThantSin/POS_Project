@extends('admin.layouts.master')

@section('content')
      <!-- Begin Page Content -->
      <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Add Product Page</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('productCreate')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <img src="{{asset('defaultImg/defaultImg.jpg')}}" class=" img-thumbnail "alt="" id="output">
                            <input type="file" name="image" class="form-control my-3  @error('image') is-invalid @endError" onchange="loadFile(event)">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                             @endError
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                                        <input type="text" name="name" value="{{old('name')}}" class="form-control  @error('name') is-invalid @endError" id="exampleFormControlInput1" placeholder="Name...">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @endError
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput2" class="form-label">Price</label>
                                        <input type="text" name="price" value="{{old('price')}}" class="form-control @error('price') is-invalid @endError" id="exampleFormControlInput2" placeholder="Price...">
                                        @error('price')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @endError
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput4" class="form-label">Category Name</label>
                                        <select name="categoryId" class="form-control @error('categoryId') is-invalid @endError" id="exampleFormControlInput4">
                                            <option value="">Choose Category...</option>
                                            @foreach ($categories as $item)
                                                <option value="{{$item->id}}" @if(old('categoryId') == $item->id) selected @endif>{{ $item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('categoryId')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @endError
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput5" class="form-label">Count</label>
                                        <input type="text" name="count" value="{{old('count')}}" class="form-control @error('count') is-invalid @endError" id="exampleFormControlInput5" placeholder="Count...">
                                        @error('count')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @endError
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput3" class="form-label">Description</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @endError" id="exampleFormControlInput3w" cols="10" rows="7" placeholder="Description..."
                                        >{{old('description')}}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @endError
                                    </div>
                                </div>
                            </div>

                            <input type="submit" value="Create" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
