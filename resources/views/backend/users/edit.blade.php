@extends('layouts.master', ['activePage' => 'main_service', 'titlePage' => __('Update Main Service')])

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
            <li class="breadcrumb-item active">Main Service List</li>
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
                          <h3 class="card-title"> Edit Main Service</h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        
                        {!! Form::open(['route' => ['users.update', $user->id], 'class'=>'form-horizontal','method' => 'PATCH']) !!}
                        {{-- {!! Form::open(array( 'url' => 'admin/users' ,'files' => 'true', 'class'=>'form-horizontal')) !!} 
                        {!! Form::model($category, ['route' => ['admin.category.update', $category->id], 'class' => 'form-horizontal', 'method' => 'PATCH']) !!} --}}

                        {{-- <form class="form-horizontal"> --}}
                          <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                   <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ $user->name }}">
                                    @error('name')
                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">UserName</label>
                                <div class="col-sm-6">
                                    <input type="username" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="UserName" value="{{ $user->username }}">
                                    @error('username')
                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="form-group row">
                              <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                              <div class="col-sm-6">
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{ $user->email }}">
                                @error('email')
                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                              </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobile" class="col-sm-2 col-form-label">Mobile No </label>
                                <div class="col-sm-6">
                                  <input type="mobile" name="mobile" class="form-control @error('mobile') is-invalid @enderror" id="mobile" placeholder="Mobile No" value="{{ $user->mobile }}">
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
                                <label for="roles" class="col-sm-2 col-form-label">Select Role <span class="text-danger">*</span></label>
                                <div class="col-sm-6">
                                    <div class="select2-purple">
                                        <select class="select2 form-control @error('roles') is-invalid @enderror" name="roles"  data-placeholder="Select a Role" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                            @foreach ($roles as $role)
                                                <option {!! in_array($role, $userRole ?: []) ? "selected": "" !!} value="{{ $role }}">{{$role}}</option>
                                            @endforeach
                                            {{in_array($role, $userRole ?: []) ? "selected": ""}}
                                        </select>
                                        @error('roles')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <a href="{{url('admin/users')}}" class="btn btn-primary">Back</a>
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