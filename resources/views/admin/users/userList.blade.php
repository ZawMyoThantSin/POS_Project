@extends('admin.layouts.master')

@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <form action="{{route('userList')}}" method="GET">
                                    <div class="input-group mb-3">
                                            <input type="text" name="searchKey" class="form-control" value="{{request('searchKey')}}" placeholder="Search User...">
                                            <button type="submit" class="btn btn-outline-secondary "><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </form>
                            </h6>

                        </div>
                        <div class="">
                            <a href="{{route('adminList')}}"><button class="btn btn-primary">Admin <span class="badge badge-light">{{$adminCount}}</span></button></a>
                            <a href="{{route('userList')}}"><button class="btn btn-primary active">User <span class="badge badge-light">{{$userList->total()}}</span></button></a>

                        </div>
                        <div class="">

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    @if(auth()->user()->role=='superAdmin')
                                     <th></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userList as $user)
                                    <tr>
                                        <td>
                                            <a href="{{route('accountProfile',$user->id)}}">{{$user->name == null ? $user->nickname : $user->name}}</a>
                                        </td>
                                        <td >{{$user->email}}</td>
                                        <td>{{$user->address}} </td>
                                        <td>{{$user->phone}}</td>
                                        <td class="text-uppercase">{{$user->role}}</td>
                                        @if(auth()->user()->role =='superAdmin' )
                                           <td>
                                                <a href="{{route('userDelete',$user->id)}}" class="text-white"> <button class="btn btn-sm btn-danger" ><i class="fa-solid fa-trash-can"></i></button></a>
                                                <a href="{{route('adminRoleChange',$user->id)}}" class="text-white"> <button class="btn btn-sm btn-secondary" >Role Change<i class="fa-solid fa-arrow-up"></i></button></a>

                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <span class=" d-flex justify-content-end">{{$userList->links()}}</span>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

@endsection
