@extends('admin.master_layout')
@section('title')
<title>Generate Access Token</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Generate Access Token</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
            </div>
          </div>

        <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                        <div class="card-body">
                            <div class="row">                                
                                <div class="col-12 col-sm-12 col-md-12">
                                    <div class="border rounded">
                                        <div class="tab-content no-padding" id="settingsContent">

                                            <div class="tab-pane fade show active" id="generalSettingTab" role="tabpanel" aria-labelledby="general-setting-tab">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                      <form action="{{ route('admin.generate-access-token') }}" method="POST" enctype="multipart/form-data">
                                                          @csrf
                                                          
                                                        
                                                            <div class="row">
                                                                    <div class="col-md-6">                                                              
                                                                         <div class="form-group">
                                                                            <label for="">{{__('Client Id')}}</label>
                                                                           <input type="text" id="client_id" class="form-control" name="client_id" placeholder="Client ID..." required>                                                             
                                                                        
                                                                      </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-6">                                                            
                                                                              <div class="form-group">
                                                                                <label for="">{{__('Client Secret')}}</label>
                                                                                 <input type="text" id="client_secret" class="form-control" name="client_secret" placeholder="Client Secret..." required>
                                                                              </div>
                                                                    </div>                                                            
                                                              </div> 
                                                              
                                                              <div class="row">
                                                                    <div class="col-md-6">                                                              
                                                                         <div class="form-group">
                                                                            <label for="">{{__('Client Email')}}</label>
                                                                           <input type="text" id="client_email" class="form-control" name="client_email" placeholder="Client Email..." required>                                                             
                                                                        
                                                                      </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-6">                                                            
                                                                              <div class="form-group">
                                                                                <label for="">{{__('Client Password')}}</label>
                                                                                 <input type="text" id="client_password" class="form-control" name="client_password" placeholder="Client Password..." required>
                                                                              </div>
                                                                    </div>                                                            
                                                              </div> 
                                                                            
                                                          <button class="btn btn-primary" type="submit">{{__('admin.Update')}}</button>
                                                          
                                                      </form>
                                                    </div>
                                                </div>
                                            </div>                                                                                                                   
                                            

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        </section>
      </div>

      <script>        

     </script>
@endsection
