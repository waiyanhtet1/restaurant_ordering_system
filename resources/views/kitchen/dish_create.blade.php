@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Add Your New Delicious Dish</h1>
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
          <a href="/dish" class="btn btn-primary">Back</a>
        </div>
          <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
              <form action="/dish" method="POST" class="w-50 mx-auto" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Dish Name</label>
                    <input type="text" name="dishname" class="form-control" value="{{old('dishname')}}">
                </div>
                <div class="form-group">
                    <label for="name">Category</label>
                    <select name="category" class="form-control">
                        <option value="" disabled selected>Select Category</option>
                        @foreach ($categories as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="formFile" class="form-label">Image</label>
                    <br>
                    <input type="file" name="dish_image" accept="image/*">
                </div>
                <div class="form-group text-center mt-4">
                    <button class="btn btn-primary w-50" type="submit">Add</button>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
@endsection

