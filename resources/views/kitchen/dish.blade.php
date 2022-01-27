@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dishes Panel</h1>
          </div><!-- /.col -->
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col --> --}}
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  
    <!-- Main content -->
    <div class="content">
      <div class="card">
        <div class="card-header">
          <a href="/dish/create" class="btn btn-primary">New</a>
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
                            <th>Category Name</th>
                            {{-- <th>Image</th> --}}
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($dishes as $dish)
                      <tr class="text-center">
                        <td>{{$dish->name}}</td>
                        <td>{{$dish->category->name}}</td>
                        {{-- <td><img src="{{url('/images/'.$dish->image)}}" style="width:50px;height:50px;object-fit:contain"></td> --}}
                        <td>{{$dish->created_at}}</td>
                        <td>{{$dish->updated_at}}</td>
                        <td><a href="/dish/{{$dish->id}}/edit" class="btn btn-secondary">Info</a></td>
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

