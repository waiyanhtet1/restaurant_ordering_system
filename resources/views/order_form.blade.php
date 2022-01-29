<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    {{--
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css"> --}}
</head>

<body>
    <div class="mt-3">
    <h4 class="text-center">Restaurant Ordering System</h4>
    </div>
    <div class="card m-3">
        <div class="card-header">
            <h4>Orders Panel</h4>
        </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif
            <div class="col-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill"
                                    href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home"
                                    aria-selected="true">New Order</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-three-profile" role="tab"
                                    aria-controls="custom-tabs-three-profile" aria-selected="false">Order Lists</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel"
                                aria-labelledby="custom-tabs-three-home-tab">
                                <form action="{{route('order.submit')}}" method="post">
                                @csrf
                    <div class="row">
                    @foreach ($dishes as $dish)
                    <div class="col-sm-12 col-md-4 col-lg-3 col-xl-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                <img src="{{url('/images/'.$dish->image)}}" style="width:150px;height:150px;object-fit:cover">
                                </div>
                            <br>
                            <label>{{$dish->name}}</label><br>
                            <input type="number" class="form-control" min="1" max="10" placeholder="value" name="{{$dish->id}}">
                            </div>
                        </div>
                        </div>
                    @endforeach
                    </div>
                    <div class="form-group mt-4">
                        <select name="table" class="form-control w-25">
                            <option value="" disabled selected>Select Table</option>
                            @foreach ($tables as $table)
                                <option value="{{$table->id}}">{{$table->number}}</option>
                            @endforeach
                        </select>
                    </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-three-profile-tab">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Dish Name</th>
                                            <th>Table Number</th>
                                            {{-- <th>Image</th> --}}
                                            <th>Status</th>
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
                                        <td><a href="/order/{{$order->id}}/serve" class="btn btn-primary">Serve</a></td>
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
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function () {

            $('.increment-btn').click(function (e) {
                e.preventDefault();
                var incre_value = $(this).parents('.quantity').find('.qty-input').val();
                var value = parseInt(incre_value, 10);
                value = isNaN(value) ? 0 : value;
                if(value<10){
                    value++;
                    $(this).parents('.quantity').find('.qty-input').val(value);
                }

            });

            $('.decrement-btn').click(function (e) {
                e.preventDefault();
                var decre_value = $(this).parents('.quantity').find('.qty-input').val();
                var value = parseInt(decre_value, 10);
                value = isNaN(value) ? 0 : value;
                if(value>1){
                    value--;
                    $(this).parents('.quantity').find('.qty-input').val(value);
                }
            });

            });
    </script>
</body>

</html>