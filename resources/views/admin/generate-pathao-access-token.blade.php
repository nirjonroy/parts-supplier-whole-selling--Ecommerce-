@extends('admin.master_layout')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">SIS</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                    <li class="breadcrumb-item active">Generate Pathao Courier Access Token</li>
                </ol>
            </div>
            <h4 class="page-title">Generate Pathao Courier Access Token</h4>
        </div>
    </div>
</div>   
<!-- end page title --> 

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                
                <br>
                <form action="{{route('admin.generatePathaoAccessToken')}}" method="POST" id="">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                    <strong for="client_id">Client ID</strong>
                                    <input type="text" id="client_id" class="form-control" name="client_id" placeholder="Client ID..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="client_secret">Client Secret</strong>
                                <input type="text" id="client_secret" class="form-control" name="client_secret" placeholder="Client Secret..." required>
                            </div>
                        </div>
                      	
                      	<div class="col-md-6">
                            <div class="form-group">
                                <strong for="client_email">Client Email</strong>
                                <input type="email" class="form-control" name="client_email" placeholder="Client Email..." required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong for="client_password">Client Password</strong>
                                <input type="password" id="client_password" class="form-control" name="client_password" required placeholder="Client Password...">
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="submit" value="SUBMIT" class="btn btn-success">
                    <hr>
                </form>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection 

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">

  
</script>

@endpush