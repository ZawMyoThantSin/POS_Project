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
                            <a href="{{route('adminList')}}"><button class="btn btn-primary active">Admin <span class="badge badge-light">{{$adminList->total()}}</span></button></a>
                            <a href="{{route('userList')}}"><button class="btn btn-primary">User <span class="badge badge-light">{{$userCount}}</span></button></a>

                        </div>
                        <div class="">
                           @if(auth()->user()->role =='superAdmin')
                                <a href="{{route('createAdminAccount')}}"><i class="fa-solid fa-plus"></i> Add Admin</a>
                           @endif
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
                                @foreach ($adminList as $admin)
                                    <tr>
                                        <td><a href="{{route('accountProfile',$admin->id)}}">{{$admin->name == null ? $admin->nickname : $admin->name}}</a></td>
                                        <td>{{$admin->email}}</td>
                                        <td>{{$admin->address}} </td>
                                        <td>{{$admin->phone}}</td>
                                        <td class="text-uppercase">{{$admin->role}}</td>
                                        @if(auth()->user()->role =='superAdmin' )
                                           @if (auth()->user()->id != $admin->id)
                                           <td>
                                            <a href="{{route('adminDelete',$admin->id)}}" class="text-white"> <button class="btn btn-sm btn-danger" ><i class="fa-solid fa-trash-can"></i></button></a>
                                            <a href="{{route('userRoleChange',$admin->id)}}" class="text-white"> <button class="btn btn-sm btn-secondary" >Role Change<i class="fa-solid fa-arrow-down"></i></button></a>

                                        </td>
                                           @endif
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <span class=" d-flex justify-content-end">{{$adminList->links()}}</span>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

@endsection
