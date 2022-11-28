@extends('layouts.master', ['activePage' => 'new_role', 'titlePage' => __('New Role')])

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <!-- <h1>User Management</h1> -->
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a class="text-gray" href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" >Create Role</li>
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
                          <h3 class="card-title">Create Role</h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        {!! Form::open(array('route' => 'roles.store','method'=>'POST', 'class'=>'form-horizontal')) !!}
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                    <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                                        @error('name')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group clearfix row">
                                    <label for="name" class="col-sm-2 col-form-label"> <strong>Permission </strong>
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="select-all" onclick="toggle(this);">
                                        <label for="select-all">Select All</label>
                                     </div>
                                    <br>
                                    <div class="row">
                                        @foreach($permission as $key => $value)
                                            <div class="col-sm-3">
                                  
                                                <div class="icheck-primary d-inline">
                                                    {{-- <input type="checkbox" id="checkboxPrimary{{$value}}"> --}}
                                                    {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name','id' => 'checkboxPrimary'.$value->id)) }}
                                                    <label for="checkboxPrimary{{$value->id}}">
                                                        {{ $value->name }} 
                                                    </label>
                                                </div>
                                                
                                            </div>
                                        <br/>
                                    @endforeach
                                </div>
                                    </div>
                                </div>
                           
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                    <a href="{{url('admin/roles')}}" class="btn btn-primary">Back</a>
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
<!-- /.content -->
@endsection
