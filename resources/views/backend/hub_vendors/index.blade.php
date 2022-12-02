@extends('layouts.master', ['activePage' => 'hub_vendor', 'titlePage' => __('Hub Vendor')])

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <!-- <h1>Roles</h1> -->
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active">Hub Vendors</li>
            </ol>
        </div>
    </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <div class="col-md-3">
                    <a href="{{route('hub_vendors.create')}}" class="btn btn-block btn-primary"><i class="fas fa-plus"></i>
                    Add Hub Vendor</a>
                    </div>
                    </div>
                    <div class="card-body">
                       
                        <div id="table_url" data-table-url="{{route('hub_vendors.index')}}"></div>
                        <div class="row table-responsive">
                            <table class="table table-bordered table-hover hub-vendor-data-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Main Service</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Active Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
<!-- /.content-wrapper -->
@endsection