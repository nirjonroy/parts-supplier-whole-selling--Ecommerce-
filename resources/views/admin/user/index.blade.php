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
                    <a href="{{url('admin/create-user')}}" style="margin-bottom: 15px;" class="btn btn-warning"> Add Employe </a>
                      <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($emploies as $employee)
                        <tr>
                            <td>{{$employee->name}}</td>
                            <td>{{$employee->email}}</td>
                            <td>
                        @foreach ($employee->roles as $role)
                                            <span class="badge badge-info mr-1">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                        </td>
                        <td>
                            @if($employee->active_status == 1)
                            <a href="javascript:;" onclick="changeEmployeeStatus({{ $employee->id }})">
                                <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.InActive')}}" data-onstyle="success" data-offstyle="danger">
                            </a>
    
                            @else
                            <a href="javascript:;" onclick="changeEmployeeStatus({{ $employee->id }})">
                                <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.InActive')}}" data-onstyle="success" data-offstyle="danger">
                            </a>
    
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.user.edit', $employee->id)}}" class="btn btn-warning">Edit</a>
                            <a href="" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
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
                        </div>
                        </div>
</div>
@endsection 



<script>

    function changeEmployeeStatus(id){
        var isDemo = "{{ env('APP_MODE') }}"
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{url('/admin/employee-status/')}}"+"/"+id,
            success:function(response){
                toastr.success(response)
            },
            error:function(err){
                console.log(err);
            }
        })
    }
</script>


