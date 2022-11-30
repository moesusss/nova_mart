@extends('layouts.master', ['activePage' => 'sub-category', 'titlePage' => __('Update Sub Category')])

@section('content')
<!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <!-- <h1>Role Management</h1> -->
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Sub Category List</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                          <h3 class="card-title"> Edit Sub Category</h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        
                        {!! Form::model($sub_category, ['method' => 'PATCH','route' => ['sub_categories.update', $sub_category->id]]) !!}
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-2 col-form-label">Sub Category <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <!-- <label>Please Select Role</label> -->
                                        <div class="select2-purple">
                                            <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" data-placeholder="Select Main Service" data-dropdown-css-class="" style="width: 100%;">
                                                <option value="">Select Main Service</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{($category->id==$sub_category->category_id)?"selected":""}}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="code" class="col-sm-2 col-form-label">Code<span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                    <input type="name" class="form-control @error('code') is-invalid @enderror" id="code" name="code" placeholder="Code" value="{{ $sub_category->code }}">
                                        @error('code')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name<span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                    <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ $sub_category->name }}">
                                        @error('name')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Myanmar Name</label>
                                    <div class="col-sm-6">
                                    <input type="name" class="form-control @error('mm_name') is-invalid @enderror" id="mm_name" name="mm_name" placeholder="Name" value="{{ $sub_category->mm_name }}">
                                        @error('mm_name')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                    <a class="btn btn-primary" href="{{url('admin/sub_categories')}}">Back</a>
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                      </div>
                      <!-- /.card -->
          
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
<!-- /.content -->
<!-- </div> -->
@endsection