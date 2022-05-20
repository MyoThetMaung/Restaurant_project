@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-bold">Orders</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
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
                                            <a href="{{ route('order.approve',$order->id) }}" class="btn btn-success">Approve</a>
                                            <a href="{{ route('order.cancel',$order->id) }}" class="btn btn-danger">Cancel</a>
                                            <a href="{{ route('order.ready',$order->id) }}" class="btn btn-warning">Ready</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
