@extends('admin.master_layout')
@section('title')
<title>{{__('admin.About Us')}}</title>
@endsection
@section('admin-content')
<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Home Page Setting</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">Home Page Setting</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <h1>Create  a Permission </h1>
                    <form action="{{route('admin.user.permission.store')}}" method="post">
                        @csrf
                        <div class="card-body">
                  <div class="form-group">
                    <label for="name">Permission </label>
                    <input type="text" class="form-control" id="name" placeholder="Enter User Name" name="name" required>
                  </div>
                  
                  <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                    </form>
                                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <div>
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    @endif
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div> </div>
</div>
@endsection 