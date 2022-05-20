<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Form</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
</head>
<body>

    <div class="row my-1">
        <div class="col-12">
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                        <li class="pt-2 px-3"><h3 class="card-title">Order</h3></li>
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Order Form</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Order List</a>
                        </li>
                    </ul>
                </div>
            <div class="card-body">
        <div class="tab-content" id="custom-tabs-two-tabContent">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                <form action="{{ route('order.submit') }}" method="POST">
                    @csrf
                    <div class="row">
                        @foreach($dishes as $dish)
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="{{ asset('images/'.$dish->image) }}" width=100 height=100> <br><br>
                                        <label for="">{{ $dish->name }}</label> <br>
                                        <input type="number" value="1" name={{ $dish->id }}> <br><br>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <label for="">Table</label>
                        <select name="table" class="form-group">
                            @foreach($tables as $table)
                                <option class="form-control" value={{ $table->id }}>{{ $table->number }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" class="btn btn-success" value="Submit">
                    <a href="{{ route('order') }}" class="btn btn-primary float-right">Kitchen Pannel</a>
                </form>
            </div>
            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                <table id="order" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Dish Name</th>
                            <th>Table Number</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->dish->name }}</td>
                                <td> {{ $order->table_id }}</td>
                                <td>{{ $status[$order->status] }}</td>
                                <td>
                                    <div>
                                        <a href="{{ route('order.serve',$order->id) }}" class="btn btn-warning">Serve</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('order') }}" class="btn btn-primary float-right">Kitchen Pannel</a>
            </div>
        </div>
    </div>



    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
</body>
</html>
