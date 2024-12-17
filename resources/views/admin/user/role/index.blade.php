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
                    <a href="{{url('admin/create-role')}}"  class="btn btn-warning"> Add Role </a>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Role</th>
                            <th>permission</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                        <tr>
                        <td>{{$loop->index+1}}</td>
                        <td> {{$role->name}}</td>
                        <td>
                            {{-- @foreach($role->permissions as $perm)
                            <span class="badge badge-info mr-2">
                            {{$perm->name}}
                            </span>

                            @endforeach --}}
                        </td>
                        <td>
                            <a href="{{route('admin.user.role.edit', $role->id)}}" class="btn btn-warning">Edit</a>
                            <a href="{{route('admin.user.role.delete', $role->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>


                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div> </div>
</div>
@endsection
