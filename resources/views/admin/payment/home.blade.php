@extends('admin.layouts.master')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="row">
        <div class="card shadow col-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Payment Method</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('paymentCreate') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="paymentType" class="form-label">Payment Type</label>
                       <select name="type" class="form-control  @error('type') is-invalid @endError" >
                        <option value="">Select the Payment Type...</option>
                        <option value="KBZ Pay" @if(old('type')== 'KBZ Pay') selected @endif>KBZ Pay</option>
                        <option value="AYA Pay" @if(old('type')== 'AYA Pay') selected @endif>AYA Pay</option>
                        <option value="CB Pay" @if(old('type')== 'CB Pay') selected @endif>CB Pay</option>
                        <option value="Mytel Pay" @if(old('type')== 'Mytel Pay') selected @endif>Mytel Pay</option>
                       </select>
                        @error('type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="accountName2" class="form-label">Account Name</label>
                        <input type="text" name="accountName" class="form-control @error('accountName') is-invalid @enderror"
                               value="{{ old('accountName') }}" id="accountName2" placeholder="Enter Account Name...">
                        @error('accountName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="categoryName3" class="form-label">Account Number</label>
                        <input type="text" name="accountNumber" class="form-control @error('accountNumber') is-invalid @enderror"
                               value="{{ old('accountNumber') }}" id="accountNumber3" placeholder="Enter Account Number...">
                        @error('accountNumber')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <input type="submit"  value="Add" class="px-3 btn btn-primary">
                </form>
            </div>
        </div>

        <div class="col-6 offset-1 mr-3">
            <div class="row shadow-sm rounded">
                @foreach ($data as $item)
                    <div class="col-12 p-3 mb-1">
                        <a href="{{route('paymentEdit',$item->id)}}" class="text-decoration-none text-dark">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between text-muted">
                                        <h4>{{$item->account_name}}</h4>
                                        <small><i class="fa-solid fa-pen-to-square"></i></small>
                                    </div>
                                    <div class="d-flex justify-content-between text-muted">
                                        <span class="fw-bold">{{$item->type}}</span>
                                        <small>{{$item->account_number}}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="d-flex justify-content-end m-1">
                           <a href="{{route('paymentDelete',$item->id)}}">
                            <button type="button" class="btn text-dark " >
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <span class="d-flex justify-content-end mt-3">{{$data->links()}}</span>

        </div>
    </div>
</div>

<!-- /.container-fluid -->


@endsection
