@extends('layouts.master', ['activePage' => 'item_stock', 'titlePage' => __('New Item Stock')])

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <!-- <h1>Item Stock Management</h1> -->
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a class="text-gray" href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" >Create Item Stock</li>
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
                          <h3 class="card-title">Create Item Stock</h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        {!! Form::open(array('route' => 'item_stocks.store','method'=>'POST', 'class'=>'form-horizontal')) !!}
                            <div class="card-body">
                            <div class="form-group row">
                                    <label for="vendor_id" class="col-sm-2 col-form-label">Vendor<span class="text-danger">*</span> </label>
                                    <div class="col-sm-6">
                                        <!-- <label>Please Select Role</label> -->
                                        <div class="select2-purple">
                                            <select class="vendor_id form-control @error('vendor_id') is-invalid @enderror select2" name="vendor_id" data-placeholder="Select Vendor" data-dropdown-css-class="" style="width: 100%;" data-attr-url="{{url('admin/items/getDataByVendorID')}}">
                                                <option value="">Select Vendor</option>
                                                @foreach ($vendors as $vendor)
                                                    <option value="{{ $vendor->id }}" {{ (old('vendor_id')==$vendor->id)?"selected":"" }}>{{$vendor->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('vendor_id')
                                                <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="item_id" class="col-sm-2 col-form-label">Item<span class="text-danger">*</span> </label>
                                    <div class="col-sm-6">
                                        <!-- <label>Please Select Role</label> -->
                                        <div class="select2-purple">
                                            <select class="item_id form-control @error('item_id') is-invalid @enderror select2" name="item_id" data-placeholder="Select Item" data-dropdown-css-class="" style="width: 100%;">
                                                <option value="">Select Item</option>
                                                @foreach ($items as $item)
                                                    <option value="{{ $item->id }}" {{ (old('item_id')==$item->id)?"selected":"" }}>{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('item_id')
                                                <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="qty" class="col-sm-2 col-form-label">QTY <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                    <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty" placeholder="QTY" value="{{ old('qty') }}" min=0>
                                        @error('qty')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                    <a class="btn btn-primary" href="{{url('admin/main_services')}}">Back</a>
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
