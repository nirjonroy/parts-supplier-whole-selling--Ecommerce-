@extends('admin.master_layout')
@section('title')
<title>IP Block  </title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>IP Block</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">IP Block</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                            <form action="{{ route('admin.ipblock.submit') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                               
                                <div class="row">
                                   <div class="form-group col-12">
                                        <label for="">IP Address<span class="text-danger">which you wanna block*</span></label>
                                       <input type="text" class="form-control" id="Ipaddress" name="ip_address" placeholder="Which ip you want to Block">
                                    </div>
                                   
                                    <div class="form-group col-12">
                                        <label for="">Reason <span class="text-danger">Why you Want to block this ip *</span></label>
                                        <textarea name="reason" id=""  class="form-control" cols="30" rows="10"></textarea>
                                    </div>
                                    
                                   

                                  
                                  
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-primary">Block</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                  </div>
                </div>
              
          </div>
       	
            <div class="container">
  <h2>IP Table </h2>
  <p></p>            
  <table class="table">
    <thead>
      <tr>
        <th>SL</th>
        <th>IP Address</th>
        <th>Block For </th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @php $serialNumber = 1; @endphp   
 @foreach($AllIp as $ips)
     <tr>
        <td>{{ $serialNumber++ }}</td>
        <td>{{$ips->ip_address}}</td>
        <td>{{$ips->reason}}</td>
       <td> <a href="{{route('admin.ipblock.delete', ['id' => $ips->id])}}" class="btn btn-danger">Delete </a>
       		<a href="{{route('admin.ipblock.edit', ['id' => $ips->id])}}" > </a>
         <a href="#" data-toggle="modal" data-target="#editIpBlockModal{{ $ips->id }}" class="btn btn-primary">Edit </a>
       </td>
      </tr>
     
     <div class="modal fade" id="editIpBlockModal{{ $ips->id }}" tabindex="-1" role="dialog" aria-labelledby="editIpBlockModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editIpBlockModalLabel">Edit IP Block</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.ipblock.update', ['id' => $ips->id]) }}" method="POST" class="edit-form">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="editIp">IP Address</label>
                            <input type="text" class="form-control" id="editIp" name="ip_address" value="{{ $ips->ip_address }}">
                        </div>
                        <div class="form-group">
                            <label for="editReason">Reason</label>
                            <textarea class="form-control" id="editReason" name="reason">{{ $ips->reason }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 @endforeach    
    </tbody>
  </table>
</div>
<script>
    $(document).ready(function() {
        $('.edit-form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            var data = form.serialize();
            
            $.ajax({
                type: 'PUT',
                url: url,
                data: data,
                success: function(response) {
                    if (response.success) {
                        // Update table row with new data
                        var row = form.closest('tr');
                        row.find('.ip-address').text(response.ip_address);
                        row.find('.reason').text(response.reason);
                        
                        // Close the modal
                        form.closest('.modal').modal('hide');
                    }
                },
                error: function() {
                    alert('Error updating IP block.');
                }
            });
        });
    });
</script>            
            
@endsection

