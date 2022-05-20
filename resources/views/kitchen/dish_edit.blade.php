@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-bold">Edit Dish</h1>
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
                    <a href="{{ route('dish.index') }}" class="btn btn-primary float-right">Back</a>
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
                    <form action="{{ route('dish.update',$dish->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="dish_name" value="{{ old('dish_name',$dish->name) }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="category" class="form-control" >
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $dish->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Image</label> <br>
                            <img src="{{ asset('images/'.$dish->image) }}" width="150px" height="150px"> <br><br>
                            <input type="file" name="dish_image">
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
