@extends('layouts.master', ['activePage' => 'delivery_fee', 'titlePage' => __('New Delivery Fee')])

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <!-- <h1>Main Service Management</h1> -->
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a class="text-gray" href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" >Create Delivery Fee</li>
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
                          <h3 class="card-title">Create Delivery Fee</h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        {!! Form::open(array('route' => 'delivery_fees.store','method'=>'POST', 'class'=>'form-horizontal')) !!}
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="delivery_type" class="col-sm-2 col-form-label">Delivery Type <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                        <select name="delivery_type" id="delivery_type" class="form-control @error('delivery_type') is-invalid @enderror">
                                            <option value="">Select Delivery Type</option>
                                            <option value="Distance">Distance</option>
                                            <option value="Weight">Weight</option>
                                        </select>
                                        @error('delivery_type')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="from" class="col-sm-2 col-form-label">From <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                    <input type="number" class="form-control @error('from') is-invalid @enderror" id="from" name="from" placeholder="From" value="{{ old('from') }}" step="0.001">
                                        @error('from')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">To <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                    <input type="text" class="form-control @error('to') is-invalid @enderror" id="to" name="to" placeholder="To" value="{{ old('to') }}" step="0.001">
                                        @error('to')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="amount" class="col-sm-2 col-form-label">Amount <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                    <input type="text" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" placeholder="Amount" value="{{ old('amount') }}">
                                        @error('to')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                           
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                    <a class="btn btn-primary" href="{{url('admin/delivery_fees')}}">Back</a>
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
