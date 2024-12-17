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
                        <h1>Edit  an Employee Profile</h1>
                    <form action="{{route('admin.user.update', $user->id)}}" method="post">
                        @csrf
                        <div class="card-body">
                  <div class="form-group">
                    <label for="name">Employee Name</label>
                    <input type="text" class="form-control" id="name" value="{{$user->name}}" placeholder="Enter User Name" name="name" required>
                  </div>
                  <div class="form-group">
                    <label for="email">Employee Email</label>
                    <input type="email" class="form-control" id="email" value="{{$user->email}}" placeholder="Enter Email " name="email">
                  </div>
                  
                  <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="password">Assign Roles</label>
                                <select name="roles[]" id="roles" class="form-control select2" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                  <div class="form-group">
                    <label for="password">Employee Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter User Password" name="password" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
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