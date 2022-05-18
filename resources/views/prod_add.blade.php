@extends('layouts.app')

@section('css')
@endsection

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Add</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Product Add</li>
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
                <h3 class="card-title">Product Add</h3>
              </div>
              <form action="{{ route('prod_add') }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="row">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="product_sku">Product SKU</label>
                        <input type="text" name="product_sku" class="form-control {{ $errors->has('product_sku') ? ' is-invalid' : '' }}" id="product_sku" placeholder="Enter Product SKU" value="{{ old('product_sku',strtoupper(\Illuminate\Support\Str::random(5))) }}" readonly>
                        @if ($errors->has('product_sku'))
                          <span class="error invalid-feedback">{{ $errors->first('product_sku') }}</span>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="product_name"> Product Name</label>
                        <input type="text" name="product_name" class="form-control {{ $errors->has('product_name') ? ' is-invalid' : '' }}" id="product_name" placeholder="Enter Product Name" value="{{ old('product_name') }}">
                        @if ($errors->has('product_name'))
                          <span class="error invalid-feedback">{{ $errors->first('product_name') }}</span>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category" class="form-control {{ $errors->has('category') ? ' is-invalid' : '' }}" >
                          <option value="">Select category</option>
                          @foreach($category as $cat)
                            <option value="{{ $cat->id }}" @if(old('category')==$cat->id) selected @endif>{{ $cat->category_name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('category'))
                          <span class="error invalid-feedback">{{ $errors->first('category') }}</span>
                        @endif
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}">
                          <option value="">Select status</option>
                          <option value="0" @if(old('status') == "0") selected @endif>Active</option>
                          <option value="1" @if(old('status') == "1") selected @endif>Inactive</option>
                        </select>
                        @if ($errors->has('status'))
                          <span class="error invalid-feedback">{{ $errors->first('status') }}</span>
                        @endif
                      </div>
                    </div>

                  </div>
                 
                  <div class="">
                    <button type="submit" class="btn btn-primary toastrDefaultSuccess">Submit</button>
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

@section('js')
@endsection