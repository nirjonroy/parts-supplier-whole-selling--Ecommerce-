@extends('admin.master_layout')
@section('title')
<title>Create Landing Page</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Create A Landing Page</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">Create A Landing Page</div>
            </div>
          </div>
          <div class="col-xl-4">
                        <div class="text-xl-end mt-xl-0 mt-2">
                        
                            <a href="{{ route('admin.landing.create')}}" class="btn btn-danger mb-2 me-2"><i class="mdi mdi-basket me-1"></i> Add Landing Page</a>
                        
                        </div>
                    </div>
          <div class="card">
                    <div class="card-body">
          <div class="table-responsive table-invoice">
                     <table class="table table-striped" id="dataTable">
                        <thead class="table-light">
                            <tr>
                                <th>SL</th>
                                <th>Page Title</th>
                                <th>View Page</th>
                                <th style="width: 125px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $key=> $item)
                            <tr>
                                <td> {{$key+1}} </td>
                                
                                <td> {{$item->title1}} </td>
                              @if(!empty($item->product->slug))
                                <td><a href="{{ route('user.landing_index',['id' => $item->id, 'name' => $item->product->slug]) }}">View Page</a></td>
                              
                              @endif
                                <td>
                                    <a href="{{route('admin.landing_edit', $item->id)}}" class="action-icon"> 
                                        Edit
                                    </a>
                                    <a href="{{ route('admin.landing_pages.destroy', [$item->id]) }}"
                                                class="delete action-icon"> <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                
                                </td>
                               
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> </div>     
        </section>
        </div>
@endsection