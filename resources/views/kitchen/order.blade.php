@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0">Order Panel</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dish">Home</a></li>
              <li class="breadcrumb-item active">Order Lists</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <!-- Main content -->
    <div class="content">
      <div class="card">
        <div class="card-header">

        </div>
          <div class="card-body">
                @if (session('message'))
                  <div class="alert alert-success">
                    {{ session('message') }}
                  </div>
                @endif
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>Dish Name</th>
                            <th>Table Number</th>
                            {{-- <th>Image</th> --}}
                            <th>Status</th>
                            <th>Action</th>
                            <th>Action</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($orders as $order)
                      <tr class="text-center">
                        <td>{{$order->dish->name}}</td>
                        <td>{{$order->table_id}}</td>
                        {{-- <td><img src="{{url('/images/'.$dish->image)}}" style="width:50px;height:50px;object-fit:contain"></td> --}}
                        <td>{{$status[$order->status]}}</td>
                        <td><a href="/order/{{$order->id}}/approve" class="btn btn-primary">Approve</a></td>
                        <td><a href="/order/{{$order->id}}/ready" class="btn btn-success">Ready</a></td>
                        <td><a href="/order/{{$order->id}}/cancel" class="btn btn-danger">Cancel</a></td>
                      </tr>
                      @endforeach
                        {{-- <tr>
                            <td>Row 2 Data 1</td>
                            <td>Row 2 Data 2</td>
                            <td>Row 2 Data 2</td>
                        </tr>
                        <tr>
                            <td>Row 2 Data 1</td>
                            <td>Row 2 Data 1</td>
                            <td>Row 2 Data 2</td>
                        </tr> --}}
                    </tbody>
                </table>
          </div>
      </div>
    </div>
  </div>
@endsection

