@extends('layouts.master', ['activePage' => 'customer', 'titlePage' => __('Detail Customer')])

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
            <li class="breadcrumb-item active">Customer List</li>
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
                            <h3 class="card-title">Customer Detail</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Name :</strong> </div>
                                <div class="col-md-6">{{ $customer->name }}</div>
                                
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Myanmar Name :</strong> </div>
                                <div class="col-md-6">{{ $customer->mm_name }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Email :</strong> </div>
                                <div class="col-md-6">{{ $customer->email }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Username :</strong> </div>
                                <div class="col-md-6">{{ $customer->username }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Mobile :</strong> </div>
                                <div class="col-md-6">{{ $customer->mobile }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Address :</strong> </div>
                                <div class="col-md-6">{{ $customer->address }}</div>
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
