@extends('layouts.master', ['activePage' => 'vendor', 'titlePage' => __('Detail Vendor')])

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
            <li class="breadcrumb-item active">Vendor List</li>
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
                            <h3 class="card-title">Vendor Detail</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Hub Vendor Name :</strong> </div>
                                <div class="col-md-6">{{ $vendor->hub_vendor->name }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Name :</strong> </div>
                                <div class="col-md-6">{{ $vendor->name }}</div>
                                
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Myanmar Name :</strong> </div>
                                <div class="col-md-6">{{ $vendor->mm_name }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Email :</strong> </div>
                                <div class="col-md-6">{{ $vendor->email }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Username :</strong> </div>
                                <div class="col-md-6">{{ $vendor->username }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Mobile :</strong> </div>
                                <div class="col-md-6">{{ $vendor->mobile }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Address :</strong> </div>
                                <div class="col-md-6">{{ $vendor->address }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Opening Time :</strong> </div>
                                <div class="col-md-6">{{ $vendor->opening_time }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Closing Time :</strong> </div>
                                <div class="col-md-6">{{ $vendor->closing_time }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Lattitude :</strong> </div>
                                <div class="col-md-6">{{ $vendor->lat }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Longitude :</strong> </div>
                                <div class="col-md-6">{{ $vendor->lng }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Minimum Order Time :</strong> </div>
                                <div class="col-md-6">{{ $vendor->min_order_time }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Minimum Order Amount :</strong> </div>
                                <div class="col-md-6">{{ $vendor->min_order_amount }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Cover Image :</strong> </div>

                                <div class="col-md-6"><img src="{{ asset('storage/vendors/'.$vendor->cover_image) }}" alt="" width="300px" class="img-responsive"></div>
                            </div>
                        </div>
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
