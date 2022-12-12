@extends('layouts.master', ['activePage' => 'item', 'titlePage' => __('Detail Item')])

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
            <li class="breadcrumb-item active">Item List</li>
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
                            <h3 class="card-title">Item Detail</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Hub Vendor Name :</strong> </div>
                                <div class="col-md-6">{{ $item->vendor->name }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Name :</strong> </div>
                                <div class="col-md-6">{{ $item->name }}</div>
                                
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Myanmar Name :</strong> </div>
                                <div class="col-md-6">{{ $item->mm_name }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Category :</strong> </div>
                                <div class="col-md-6">{{ $item->category->name }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Sub Category :</strong> </div>
                                <div class="col-md-6">{{ $item->sub_category->name }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Brand :</strong> </div>
                                <div class="col-md-6">{{ optional($item->brand)->name }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>SKU :</strong> </div>
                                <div class="col-md-6">{{ $item->sku }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Qty :</strong> </div>
                                <div class="col-md-6">{{ $item->qty }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Price :</strong> </div>
                                <div class="col-md-6">{{ $item->price }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Weight :</strong> </div>
                                <div class="col-md-6">{{ $item->weight }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Unit Type :</strong> </div>
                                <div class="col-md-6">{{ $item->unit_type }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Item Type :</strong> </div>
                                <div class="col-md-6">{{ $item->item_type }}</div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"><strong>Description :</strong> </div>
                                <div class="col-md-6">{{ $item->description }}</div>
                            </div>
                            <div class="form-group row">
                            <div class="col-md-2"><strong>Images :</strong> </div>
                                <div class="images-preview-div col-md-6"> 
                                    @php
                                        $item_images = $item->images()->get();
                                    @endphp
                                    @if(isset($item_images))
                                        @foreach($item_images as $key=>$value)
                                        <img src=" {{asset('storage/items/'.$value->image_url)}}" alt="">
                                        @endforeach
                                    @endif
                                    
                                </div>
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
