@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-bold">Dishes</h1>
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
                    <a href="{{ route('dish.create') }}" class="btn btn-outline-dark">Create</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table id="dish" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Dish Name</th>
                                <th>Category Name</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dishes as $dish)
                                <tr>
                                    <td>{{ $dish->name }}</td>
                                    <td> {{ $dish->category->name }}</td>
                                    <td>{{ $dish->created_at }}</td>
                                    <td>
                                        <div class="form-row">
                                            <a href="{{ route('dish.edit',$dish->id) }}" style="height: 40px; margin-right:10px;" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('dish.destroy',$dish->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="confirm('Are you sure to delete?')">Delete</button>
                                            </form>
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
