@extends('layouts.master', ['activePage' => 'vendor', 'titlePage' => __('New Vendor')])

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
            <li class="breadcrumb-item active" >Create Vendor</li>
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
                          <h3 class="card-title">Create Vendor</h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        {!! Form::open(array( 'url' => 'admin/vendors' ,'files' => 'true', 'class'=>'form-horizontal')) !!} 
                        {{-- <form class="form-horizontal"> --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="hub_vendor_id" class="col-sm-4 col-form-label">Hub Vendor <span class="text-danger">*</span></label>
                                            <div class="col-sm-6">
                                                <!-- <label>Please Select Role</label> -->
                                                <div class="select2-purple">
                                                    <select class="form-control @error('hub_vendor_id') is-invalid @enderror select2" name="hub_vendor_id" data-placeholder="Select Vendor" data-dropdown-css-class="" style="width: 100%;">
                                                        <option value="">Select Hub Vendor</option>
                                                        @foreach ($hub_vendors as $hub_vendor)
                                                            <option value="{{ $hub_vendor->id }}" {{old('hub_vendor_id')==$hub_vendor->id?'selected':''}}>{{$hub_vendor->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('hub_vendor_id')
                                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-4 col-form-label">Name <span class="text-danger">*</span></label>
                                            <div class="col-sm-6">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                                                @error('name')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="mm_name" class="col-sm-4 col-form-label">Myanmar Name </label>
                                            <div class="col-sm-6">
                                            <input type="mm_name" class="form-control @error('mm_name') is-invalid @enderror" id="mm_name" name="mm_name" placeholder="Myanmar Name" value="{{ old('mm_name') }}">
                                                @error('mm_name')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="username" class="col-sm-4 col-form-label">UserName </label>
                                            <div class="col-sm-6">
                                            <input type="username" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" value="{{ old('username') }}">
                                                @error('username')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-4 col-form-label">Email </label>
                                            <div class="col-sm-6">
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{ old('email') }}">
                                                @error('email')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mobile" class="col-sm-4 col-form-label">Mobile <span class="text-danger">*</span></label>
                                            <div class="col-sm-6">
                                            <input type="mobile" name="mobile" class="form-control @error('mobile') is-invalid @enderror" id="mobile" placeholder="Mobile No" value="{{ old('mobile') }}">
                                            @error('mobile')
                                                <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-4 col-form-label">Password </label>
                                            <div class="col-sm-6">
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" >
                                                @error('password')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password_confirmation" class="col-sm-4 col-form-label"> Confrim Password </label>
                                            <div class="col-sm-6">
                                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Confirm Password" >
                                                @error('password_confirmation')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="commission_fee" class="col-sm-4 col-form-label"> Commission Fee (%) <span class="text-danger">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="number" name="commission_fee" class="form-control @error('commission_fee') is-invalid @enderror" id="commission_fee" placeholder="Minimum Order Amount" min=0 value="0">
                                                @error('commission_fee')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="min_order_amount" class="col-sm-4 col-form-label"> Minimum Order <span class="text-danger">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="number" name="min_order_amount" class="form-control @error('min_order_amount') is-invalid @enderror" id="min_order_amount" placeholder="Minimum Order Amount" min=0 value="0">
                                                @error('min_order_amount')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="min_order_time" class="col-sm-4 col-form-label"> Minimum Order Time <span class="text-danger">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="number" name="min_order_time" class="form-control @error('min_order_time') is-invalid @enderror" id="min_order_time" placeholder="Minimum Order Time" min=0  max=60 value="0">
                                                @error('min_order_time')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Opening Time -->
                                        <div class="bootstrap-timepicker">
                                            <div class="form-group row">
                                            <label for="opening_time" class="col-sm-4 col-form-label"> Opening Time <span class="text-danger">*</span></label>
                                                <div class="col-sm-6">
                                                    <div class="input-group date" id="opening_time" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input @error('opening_time') is-invalid @enderror" data-target="#opening_time" name="opening_time" onkeydown="return false" autocomplete="off" value="{{old('opening_time')}}"/>
                                                    <div class="input-group-append" data-target="#opening_time" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                    </div>
                                                    @error('opening_time')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Closing Time -->
                                        <div class="bootstrap-timepicker" readonly>
                                            <div class="form-group row">
                                            <label for="closing_time" class="col-sm-4 col-form-label"> Closing Time <span class="text-danger">*</span></label>
                                                <div class="col-sm-6">
                                                    <div class="input-group date" id="closing_time" data-target-input="nearest" >
                                                    <input type="text" class="form-control datetimepicker-input @error('closing_time') is-invalid @enderror" data-target="#closing_time" name="closing_time" onkeydown="return false" autocomplete="off" value="{{old('closing_time')}}"/>
                                                    <div class="input-group-append" data-target="#closing_time" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                    </div>
                                                    @error('closing_time')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Closing Order Time -->
                                        <div class="bootstrap-timepicker" readonly>
                                            <div class="form-group row">
                                            <label for="order_closing_time" class="col-sm-4 col-form-label"> Order Closing Time <span class="text-danger">*</span></label>
                                                <div class="col-sm-6">
                                                    <div class="input-group date" id="order_closing_time" data-target-input="nearest" >
                                                    <input type="text" class="form-control datetimepicker-input @error('order_closing_time') is-invalid @enderror" data-target="#order_closing_time" name="order_closing_time" onkeydown="return false" autocomplete="off" value="{{old('order_closing_time')}}"/>
                                                    <div class="input-group-append" data-target="#order_closing_time" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                    </div>
                                                    @error('order_closing_time')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                        <label for="origin_address" class="col-sm-4 col-form-label">Address <span class="text-danger">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control @error('address') is-invalid @enderror" data-toggle="modal" data-target="#originMap" id="origin_address" placeholder="Enter Address" name="origin_address" value="{{old('origin_address')}}" readonly>
                                                @error('address')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror

                                                <input type="hidden" name="address" id="address" value="{{old('address')}}" >
                                                <input type="hidden" name="lat" id="lat" value="{{old('lat')}}" >
                                                <input type="hidden" name="lng" id="lng" value="{{old('lng')}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="mm_name" class="col-sm-4 col-form-label">Cover Image</label>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="cover_image" readonly>
                                                        <span class="input-group-btn">
                                                            <span class="btn btn-default btn-file">
                                                                Browse??? <input type="file" id="imgInp" name="cover_image">
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <img id='img-upload' class="img-responsive" style="width:300px"/>
                                                    @error('file')
                                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="sub_category_id" class="col-sm-4 col-form-label">Highlight Sub Category </label>
                                            <div class="col-sm-6">
                                                <!-- <label>Please Select Role</label> -->
                                                <div class="select2-purple">
                                                    <select class="form-control @error('sub_category_id') is-invalid @enderror sub_category_id" name="sub_category_id[]" data-placeholder="Select Sub Category" data-dropdown-css-class="" style="width: 100%;" multiple="multiple">>
                                                        <option value="">Select Sub Category</option>
                                                        @foreach ($sub_categories as $sub_cat)
                                                            <option value="{{ $sub_cat->id }}" >{{$sub_cat->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('sub_category_id')
                                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                <a href="{{url('admin/vendors')}}" class="btn btn-primary">Back</a>
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
        <!-- Start Origin Map Modal -->
        <div class="modal fade" id="originMap" tabindex="-1" role="dialog" aria-labelledby="originMapLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" width="96%">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="destinationMapLabel">Enter Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="control-group">
                            <div class="controls">
                                <input type="text" class="form-control mb-3" name="keyword" id="keyword">
                            </div>
                        </div>
                        <div id="map_canvas" style="width:100%; height:400px"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary getDestinationMapData" data-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>  
        

<!-- /.content -->

@endsection
