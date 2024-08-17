@extends('admin.layouts.master')

@section('content')
       <!-- Begin Page Content -->
       <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                    </div>
                    <div class="">
                        <a href="{{route('categoryCreatePage')}}"><i class="fa-solid fa-plus"></i> Add Category</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Created Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                         {{-- #show counter number through pagination --}}
                         @php
                             //  $data->currentPage() gets the current page number.
                            // $data->perPage() gets the number of items per page.
                            // $counter is initialized to the correct starting value for the current page.
                            // {{ $counter++ }} increments the counter after displaying it.
                             $counter = ($data->currentPage() - 1) * $data->perPage() + 1;
                             //             (1 -1 ) * 5 + 1 =1 => so show counter at 1;
                        @endphp
                           @foreach ($data as $item)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>{{ $item->name}}</td>
                                <td>{{ $item->created_at}}</td>
                                <td class="d-flex justify-content-end">
                                    <a href="{{ route('categoryEdit',$item->id)}}" class="btn btn-outline-warning mx-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="{{ route('categoryDelete',$item->id)}}" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></i></a>
                                </td>

                            </tr>

                           @endforeach


                        </tbody>
                    </table>
                    <span class="d-flex justify-content-end">{{ $data->links()}}</span>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


@endsection
