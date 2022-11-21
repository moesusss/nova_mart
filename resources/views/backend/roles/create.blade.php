@extends('layouts.master', ['activePage' => 'new_role', 'titlePage' => __('New Role')])

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>User Management</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a class="text-gray" href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active text-warning" >Create Role</li>
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
                          <h3 class="card-title">Create Role</h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        {!! Form::open(array('route' => 'roles.store','method'=>'POST', 'class'=>'form-horizontal')) !!}
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-6">
                                    <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                                        @error('name')
                                            <span id="exampleInputEmail1-error" class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group clearfix row">
                                    <label for="name" class="col-sm-2 col-form-label"> <strong>Permission </strong>
                                        <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="select-all" onclick="toggle(this);">
                                        <label for="select-all">Select All</label>
                                     </div>
                                    <br>
                                    <div class="row">
                                        @foreach($permission as $key => $value)
                                            <div class="col-sm-3">
                                  
                                                <div class="icheck-primary d-inline">
                                                    {{-- <input type="checkbox" id="checkboxPrimary{{$value}}"> --}}
                                                    {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name','id' => 'checkboxPrimary'.$value->id)) }}
                                                    <label for="checkboxPrimary{{$value->id}}">
                                                        {{ $value->name }} 
                                                    </label>
                                                </div>
                                                
                                            </div>
                                        <br/>
                                    @endforeach
                                </div>
                                    </div>
                                </div>
                           
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            <div class="card-footer">
                                <div class="card-tools">
                                    <a style="color:rgba(0,0,0,.5)" href="{{url('admin/roles')}}">
                                        <h3 class="card-title text-warning">BACK TO ROLES</h3>
                                    </a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
<!-- /.content -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script>  
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
} 
</script>
@endsection
