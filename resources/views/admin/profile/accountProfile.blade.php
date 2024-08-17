@extends('admin.layouts.master')

@section('content')
      <!-- Begin Page Content -->
      <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col-10 offset-1">
            <div class="card-header py-3">
                <div class=" d-flex align-items-center">
                    <button class="bg-transparent btn" onclick="history.back()"><i class="fa-solid fa-arrow-left-long "></i></button>
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Profile Details</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            @if ($account->profile ==null)
                                <img class="img-profile rounded img-thumbnail" id="output" src="{{asset('profileImages/undraw_profile.svg')}}">
                            @else
                            <img class="img-profile rounded img-thumbnail" id="output" src="{{asset('profileImages/'.$account->profile)}}">
                            @endif

                        </div>
                        <div class="col offset-1">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <span class="col-2 h6" >Name :</span>
                                        <span class=" h6">{{ $account->name == null ? $account->nickname : $account->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <span class="col-2 h6" >Email :</span>
                                        <span class="h6">{{ $account->email == null ? '...' : $account->email }}</span>
                                     </div>
                                 </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <span class="col-2 h6" >Phone :</span>
                                        <span class="h6">{{ $account->phone }}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <span class="col-2 h6" >Address :</span>
                                        <span class="h6">{{ $account->address }}</span>
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
