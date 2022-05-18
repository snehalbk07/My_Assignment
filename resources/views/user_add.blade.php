@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>User Add</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">User Add</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">User Add</h3>
            </div>
            <form action="{{ route('user_add') }}" method="POST">
              @csrf
              <div class="card-body">
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" value="{{ old('name') }}" placeholder="Enter Name">
                        @if ($errors->has('name'))
                          <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group ">
                      <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" value="{{ old('email') }}" placeholder="Enter email">
                        @if ($errors->has('email'))
                          <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                  </div>

                  <div class="col-md-6"> 
                    <div class="form-group ">
                      <label for="exampleInputEmail1">Mobile No</label>
                        <input type="text" name="mobile" class="form-control {{ $errors->has('mobile') ? ' is-invalid' : '' }}" id="mobile" value="{{ old('mobile') }}" placeholder="Enter mobile">
                        @if ($errors->has('mobile'))
                          <span class="error invalid-feedback">{{ $errors->first('mobile') }}</span>
                        @endif
                    </div>
                  </div>

                  <div class="col-md-6"> 
                    <div class="form-group ">
                      <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" value="{{ old('password') }}" placeholder="Enter password">
                        @if ($errors->has('password'))
                          <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                  </div>
                  
                  
                 
                </div>

                <div class="">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
@endsection