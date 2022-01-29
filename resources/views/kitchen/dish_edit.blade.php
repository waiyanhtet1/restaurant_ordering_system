@extends('layouts.master')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0">Edit Your "{{$dish->name}}" Dish Information</h4>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dish">Home</a></li>
            <li class="breadcrumb-item active">Edit Dish</li>
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
        <form action="/dish/{{$dish->id}}" method="POST" class="w-50 mx-auto" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="name">Dish Name</label>
            <input type="text" name="dishname" class="form-control" value="{{old('dishname', $dish->name)}}">
          </div>
          <div class="form-group">
            <label for="name">Category</label>
            <select name="category" class="form-control">
              <option value="" disabled selected>Select Category</option>
              @foreach ($categories as $cat)
              <option value="{{ $cat->id }}" {{ $cat->id == $dish->category_id ? 'selected' : '' }}>{{ $cat->name }}
              </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="formFile" class="form-label">Image</label>
            <br>
            <img src="{{url('/images/'.$dish->image)}}" style="width:350px;height:300px;object-fit:contain"
              class="ml-5">
            <input type="file" name="dish_image" accept="image/*" class="mt-1">
          </div>
          <div class="form-group text-center mt-4">
            <button class="btn btn-primary w-75" type="submit">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="card">
      <div class="card-header">
        <h4 class="text-danger">Delete?</h4>
      </div>
      <div class="card-body">
        <blockquote class="blockquote mb-0">
          <p>Do You want to delete "{{$dish->name}}" Dish?</p>
          <form action="/dish/{{$dish->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this item?');">DELETE</button>
          </form>
        </blockquote>
      </div>
    </div>
  </div>
</div>


@endsection