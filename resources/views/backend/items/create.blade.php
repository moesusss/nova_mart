@extends('layouts.master', ['activePage' => 'item', 'titlePage' => __('New Item')])

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
            <li class="breadcrumb-item active" >Create Item</li>
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
                          <h3 class="card-title">Create Item</h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        {!! Form::open(array( 'url' => 'admin/items' ,'files' => true, 'enctype' => 'multipart/form-data' ,'class'=>'form-horizontal')) !!} 
                        {{-- <form class="form-horizontal"> --}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="vendor_id" class="col-sm-3 col-form-label">Vendor <span class="text-danger">*</span></label>
                                            <div class="col-sm-6">
                                                <!-- <label>Please Select Role</label> -->
                                                <div class="select2-purple">
                                                    <select class="form-control @error('vendor_id') is-invalid @enderror select2" name="vendor_id" data-placeholder="Select Vendor" data-dropdown-css-class="" style="width: 100%;">
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
                                            <label for="name" class="col-sm-3 col-form-label">Name <span class="text-danger">*</span></label>
                                            <div class="col-sm-6">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                                                @error('name')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="mm_name" class="col-sm-3 col-form-label">Myanmar Name </label>
                                            <div class="col-sm-6">
                                            <input type="mm_name" class="form-control @error('mm_name') is-invalid @enderror" id="mm_name" name="mm_name" placeholder="Myanmar Name" value="{{ old('mm_name') }}">
                                                @error('mm_name')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="category_id" class="col-sm-3 col-form-label">Category </label>
                                            <div class="col-sm-6">
                                                <!-- <label>Please Select Role</label> -->
                                                <div class="select2-purple">
                                                    <select class="category_id form-control @error('category_id') is-invalid @enderror select2" name="category_id" data-placeholder="Select Category" data-dropdown-css-class="" style="width: 100%;" data-attr-url="{{url('admin/sub_categories/getDataByCategoryID')}}">
                                                        <option value="">Select Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" {{ (old('category_id')==$category->id)?"selected":"" }}>{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            
                                            </div>
                                        </div>
                                
                                        <div class="form-group row">
                                            <label for="sub_category_id" class="col-sm-3 col-form-label">Sub Category </label>
                                            <div class="col-sm-6">
                                                <!-- <label>Please Select Role</label> -->
                                                <div class="select2-purple">
                                                    <select class="form-control @error('sub_category_id') is-invalid @enderror select2 sub_category_id" name="sub_category_id" data-placeholder="Select Sub Category" data-dropdown-css-class="" style="width: 100%;" id="sub_category_id" data-attr-url="{{url('admin/brands/getDataBySubCategoryID')}}">
                                                        <option value="">Select Sub Category</option>
                                                    </select>
                                                    @error('sub_category_id')
                                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="brand_id" class="col-sm-3 col-form-label">Brand </label>
                                            <div class="col-sm-6">
                                                <!-- <label>Please Select Role</label> -->
                                                <div class="select2-purple">
                                                    <select class="form-control @error('brand_id') is-invalid @enderror select2" id="brand_id" name="brand_id" id="" data-placeholder="Select Brand" data-dropdown-css-class="" style="width: 100%;">
                                                        <option value="">Select Brand</option>
                                                       
                                                    </select>
                                                    @error('brand_id')
                                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bar_code" class="col-sm-3 col-form-label">BarCode </label>
                                            <div class="col-sm-6">
                                                <input type="text" name="bar_code" class="form-control @error('bar_code') is-invalid @enderror" id="bar_code" placeholder="Bar Code" value="{{ old('bar_code') }}" >
                                                @error('bar_code')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="qty" class="col-sm-3 col-form-label">Qty </label>
                                            <div class="col-sm-6">
                                            <input type="number" name="qty" class="form-control @error('qty') is-invalid @enderror" id="qty" placeholder="Qty" min=0 value="{{ (old('qty'))?old('qty'):0 }}">
                                                @error('qty')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="price" class="col-sm-3 col-form-label"> Price <span class="text-danger">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Price" min=0 value="{{ (old('price'))?old('price'):0 }}">
                                                @error('price')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="weight" class="col-sm-3 col-form-label"> Weight </label>
                                            <div class="col-sm-6">
                                                <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror" id="weight" placeholder="Weight" min=0 value="{{ (old('weight'))?old('weight'):0 }}" max=6>
                                                @error('weight')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="unit_type" class="col-sm-3 col-form-label">Unit Type </label>
                                            <div class="col-sm-6">
                                                <div class="select2-purple">
                                                    <select class="unit_type form-control @error('unit_type') is-invalid @enderror select2" name="unit_type" data-placeholder="Select Unit Type" data-dropdown-css-class="" style="width: 100%;">
                                                        <option value="">Select Unit Type</option>
                                                        @foreach ($unit_types as $unit_type)
                                                            <option value="{{ $unit_type->key }}" {{ (old('unit_type')==$unit_type->key)?"selected":"" }}>{{$unit_type->value}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('unit_type')
                                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="item_type" class="col-sm-3 col-form-label">Item Type </label>
                                            <div class="col-sm-6">
                                                <!-- <label>Please Select Role</label> -->
                                                <div class="select2-purple">
                                                    <select class="item_type form-control @error('item_type') is-invalid @enderror select2" name="item_type" data-placeholder="Select Item Type" data-dropdown-css-class="" style="width: 100%;">
                                                        <option value="">Select Item Type</option>
                                                        @foreach ($item_types as $item_type)
                                                            <option value="{{ $item_type->key }}" {{ (old('item_type')==$item_type->key)?"selected":"" }}>{{$item_type->value}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('item_type')
                                                        <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description" class="col-sm-3 col-form-label"> Description <span class="text-danger">*</span></label>
                                            <div class="col-sm-6">
                                                <textarea name="description" id="" class="form-control @error('description') is-invalid @enderror">{{old('description')}}</textarea>
                                                @error('description')
                                                    <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        

                                        <div class="form-group row">
                                            <label for="description" class="col-sm-3 col-form-label"> Images <span class="text-danger">*</span></label>
                                            <div class="col-sm-6">
                                                <input type="file" name="images[]" id="images" placeholder="Choose images" multiple >
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="row">
                                            <div class="images-preview-div"> </div>
                                            </div>
                                        </div>
                                </div>
          
                            
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                <a href="{{url('admin/items')}}" class="btn btn-primary">Back</a>
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
        

<!-- /.content -->

@endsection
