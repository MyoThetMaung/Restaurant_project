@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-bold">Edit Table</h1>
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
                    <a href="{{ route('table.index') }}" class="btn btn-primary float-right">Back</a>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('table.update',$table->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Table Number</label>
                            <input type="number" name="table_number" value="{{ old('table_number',$table->number) }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
