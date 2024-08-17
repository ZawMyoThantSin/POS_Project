@extends('admin.layouts.master')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="row">
        <div class="card shadow col-4">
            <div class="card-header py-3">
                <a href="{{route('paymentHome')}}">
                     <span class="px-2"><i class="fa-solid fa-arrow-left-long"></i></span>
                </a>
                <span class="m-0 font-weight-bold text-danger">Edit Payment Method</span>
            </div>
            <div class="card-body">
                <form action="{{ route('paymentUpdate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="paymentId" value="{{$payment->id}}">
                    <div class="mb-3">
                        <label for="paymentType" class="form-label">Payment Type</label>
                       <select name="type" class="form-control  @error('type') is-invalid @endError" >
                        <option value="">Select the Payment Type...</option>
                        <option value="KBZ Pay" @if(old('type',$payment->type)== 'KBZ Pay') selected @endif>KBZ Pay</option>
                        <option value="AYA Pay" @if(old('type',$payment->type)== 'AYA Pay') selected @endif>AYA Pay</option>
                        <option value="CB Pay" @if(old('type',$payment->type)== 'CB Pay') selected @endif>CB Pay</option>
                        <option value="Mytel Pay" @if(old('type',$payment->type)== 'Mytel Pay') selected @endif>Mytel Pay</option>
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
                               value="{{ old('accountName', $payment->account_name) }}" id="accountName2" placeholder="Enter Account Name...">
                        @error('accountName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="categoryName3" class="form-label">Account Number</label>
                        <input type="text" name="accountNumber" class="form-control @error('accountNumber') is-invalid @enderror"
                               value="{{ old('accountNumber',$payment->account_number) }}" id="accountNumber3" placeholder="Enter Account Number...">
                        @error('accountNumber')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <input type="submit" value="Update" class="btn btn-primary">
                </form>
            </div>
        </div>

        <div class="col-6 offset-1 mr-3">
            <div class="row shadow-sm rounded">
                    <div class="col-12 p-3 mb-2">

                            <div class="card">
                                <div class="card-body">
                                    <h4>{{$payment->account_name}}</h4>
                                    <div class="d-flex justify-content-between text-muted">
                                        <span class="fw-bold">{{$payment->type}}</span>
                                        <small>{{$payment->account_number}}</small>
                                    </div>
                                </div>
                            </div>

                    </div>
            </div>

        </div>
    </div>
</div>

<!-- /.container-fluid -->

@endsection
