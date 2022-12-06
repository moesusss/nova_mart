@extends('layouts.master', ['activePage' => 'hub_vendor', 'titlePage' => __('Hub Vendor')])

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
            <li class="breadcrumb-item active">Hub Vendor List</li>
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
                          <h3 class="card-title"> Edit Hub Vendor</h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        
                        {!! Form::open(['route' => ['hub_vendors.update', $hub_vendor->id], 'class'=>'form-horizontal','method' => 'PATCH']) !!}
                       

                        {{-- <form class="form-horizontal"> --}}
                          <div class="card-body">
                            <div class="form-group row">
                                    <label for="main_service_id" class="col-sm-2 col-form-label">Main Service <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <!-- <label>Please Select Role</label> -->
                                        <div class="select2-purple">
                                            <select class="form-control @error('main_service_id') is-invalid @enderror" name="main_service_id" data-placeholder="Select Main Service" data-dropdown-css-class="" style="width: 100%;">
                                                <option value="">Select Main Service</option>
                                                @foreach ($main_services as $main_service)
                                                    <option value="{{ $main_service->id }}" {{($main_service->id==$hub_vendor->main_service_id)?"selected":""}}>{{$main_service->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('main_service_id')
                                                <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    
                                    </div>
                                </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                   <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ $hub_vendor->name }}">
                                    @error('name')
                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">UserName</label>
                                <div class="col-sm-6">
                                    <input type="username" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="UserName" value="{{ $hub_vendor->username }}">
                                    @error('username')
                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="form-group row">
                              <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                              <div class="col-sm-6">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{ $hub_vendor->email }}">
                                @error('email')
                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobile" class="col-sm-2 col-form-label">Mobile No <span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                  <input type="mobile" name="mobile" class="form-control @error('mobile') is-invalid @enderror" id="mobile" placeholder="Mobile No" value="{{ $hub_vendor->mobile }}">
                                  @error('mobile')
                                      <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                              <label for="password" class="col-sm-2 col-form-label">Password </label>
                              <div class="col-sm-6">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" >
                                @error('password')
                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation" class="col-sm-2 col-form-label">Confrim Password </label>
                                <div class="col-sm-6">
                                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Confirm Password" >
                                    @error('password_confirmation')
                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-sm-2 col-form-label">Address <span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                    <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address">{{ $hub_vendor->address }}</textarea>
                                  <!-- <input type="address" name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Address" value="{{ old('address') }}"> -->
                                  @error('address')
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