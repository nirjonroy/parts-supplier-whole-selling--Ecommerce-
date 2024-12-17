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
                    <a href="{{url('admin/create-permission')}}"  class="btn btn-warning"> Add Permission </a>

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rows as $row)
                        <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>
                            {{$row->name}}
                        </td>
                        <td>
                            <a class="btn btn-warning" href="{{route('admin.user.permission.edit', $row->id)}}">Edit</a>
                            <a href="{{route('admin.user.permission.delete', $row->id)}}" class="btn btn-danger">Delete</a>
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
