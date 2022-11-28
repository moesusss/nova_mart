@extends('layouts.master', ['activePage' => 'role', 'titlePage' => __('Update Role')])

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
            <li class="breadcrumb-item active">Role List</li>
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
                          <h3 class="card-title"> Edit Role</h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{-- {!! Form::open(['route' => ['users.update', $role->id], 'class'=>'form-horizontal','method' => 'PATCH']) !!} --}}
                        {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name<span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                    <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ $role->name }}">
                                        @error('name')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Permission<span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="select-all" onclick="toggle(this);">
                                            <label for="select-all">Select All</label>
                                         </div>
                                        <br>
                                        <div class="row">
                                            @foreach($permission as $value)
                                                <div class="col-md-3">
                                                    <div class="icheck-primary d-inline">
                                                        {{-- <input type="checkbox" id="checkboxPrimary{{$value}}"> --}}
                                                        {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name','id' => 'checkboxPrimary'.$value->id)) }}
                                                        <label for="checkboxPrimary{{$value->id}}">
                                                            {{ $value->name }}
                                                        </label>
                                                    </div>
                                                    <br/>
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        @error('permission')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
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
                      <!-- /.card -->
          
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
<!-- /.content -->
<!-- </div> -->
@endsection