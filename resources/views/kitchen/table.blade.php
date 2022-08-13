@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-bold">Table</h1>
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
                    <a href="{{ route('table.create') }}" class="btn btn-outline-dark">Create</a>
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
                                <th>Table Id</th>
                                <th>Table Number</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tables as $table)
                                <tr>
                                    <td>{{ $table->id }}</td>
                                    <td> {{ $table->number }}</td>
                                    <td>{{ $table->created_at }}</td>
                                    <td>
                                        <div class="form-row">
                                            <a href="{{ route('table.edit',$table->id) }}" style="height: 40px; margin-right:10px;" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('table.destroy',$table->id) }}" method="POST">
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
