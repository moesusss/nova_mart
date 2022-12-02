@extends('layouts.master', ['activePage' => 'hub-vendor', 'titlePage' => __('New Hub Vendor')])

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a class="text-gray" href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" >Create Hub Vendor</li>
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
                          <h3 class="card-title">Create Hub Vendor</h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        {!! Form::open(array( 'url' => 'admin/hub_vendors' ,'files' => 'true', 'class'=>'form-horizontal')) !!} 
                        {{-- <form class="form-horizontal"> --}}
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
                            <div class="form-group row">
                              <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                              <div class="col-sm-6">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{ old('email') }}">
                                @error('email')
                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobile" class="col-sm-2 col-form-label">Mobile </label>
                                <div class="col-sm-6">
                                  <input type="mobile" name="mobile" class="form-control @error('mobile') is-invalid @enderror" id="mobile" placeholder="Mobile No" value="{{ old('mobile') }}">
                                  @error('mobile')
                                      <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                              <label for="password" class="col-sm-2 col-form-label">Password <span class="text-danger">*</span></label>
                              <div class="col-sm-6">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" >
                                @error('password')
                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation" class="col-sm-2 col-form-label"> Confrim Password <span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Confirm Password" >
                                    @error('password_confirmation')
                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                <a href="{{url('admin/hub_vendors')}}" class="btn btn-primary">Back</a>
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                          </div>
                          {!! Form::close() !!}
                            <!-- <div class="card-footer">
                                <div class="card-tools">
                                    <a style="color:rgba(0,0,0,.5)" href="{{url('admin/main_services')}}">
                                        <h3 class="card-title text-warning">BACK TO User</h3>
                                    </a>
                                </div>
                            </div> -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
<!-- /.content -->
@endsection
