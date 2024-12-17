@extends('admin.master_layout')
@section('title')
<title>Courier Settings</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Courier Settings</h1>
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
                                                      <form action="{{ route('admin.update-courier-setting') }}" method="POST" enctype="multipart/form-data">
                                                          @csrf
                                                          @method('PUT')     
                                                        
                                                            <div class="row">
                                                                    <div class="col-md-6">                                                              
                                                                         <div class="form-group">
                                                                            <label for="">{{__('Pathao API Base URL')}}</label>
                                                                           <input type="text" name="pathao_api_base_url" id="pathao_api_base_url" class="form-control" value="{{ $info->pathao_api_base_url }}">                                                              
                                                                        	<input type="hidden" name="courier_id" value="{{ $info->id }}">
                                                                      </div>
                                                                    </div>                                                             
                                                                    <div class="col-md-6">                                                            
                                                                              <div class="form-group">
                                                                                <label for="">{{__('Pathao API Store ID  ')}}</label>
                                                                                 <input type="text" name="pathao_store_id" id="pathao_store_id" class="form-control" value="{{ $info->pathao_store_id }}">
                                                                              </div>
                                                                    </div>                                                            
                                                              </div>  
                                                        
                                                        <div class="form-group">
                                                                            <label for="">{{__('Pathao API Access Token')}}</label>
                                                                          <textarea class="form-control" name="pathao_api_access_token" id="pathao_api_access_token" rows="10" cols="20">
                                                          					{{ $info->pathao_api_access_token }}
                                                          				 </textarea>                                                              
                                                                        </div>
                                                        
                                                        <div class="form-group">
                                                                            <label for="">{{__('Redx API Base URL')}}</label>
                                                                           <input type="text" name="redx_api_base_url" id="redx_api_base_url" class="form-control" value="{{ $info->redx_api_base_url }}">                                                              
                                                                        </div>
                                                                        
                                                        <div class="form-group">
                                                                            <label for="">{{__('Redx API Access Token')}}</label>
                                                                          <textarea class="form-control" name="redx_api_access_token" id="redx_api_access_token" rows="10" cols="20">
                                                                           {{ $info->redx_api_access_token }}
                                                          					</textarea>                                                              
                                                                        </div>     
                                                                        
                                                        <div class="row">
                                                                    <div class="col-md-4">                                                              
                                                                         <div class="form-group">
                                                                            <label for="">{{__('Stead Fast API Base URL')}}</label>
                                                                           <input type="text" name="steadfast_api_base_url" id="steadfast_api_base_url" class="form-control" value="{{ $info->steadfast_api_base_url }}">                                                              
                                                                        </div>
                                                                    </div>                                                             
                                                                    <div class="col-md-4">                                                            
                                                                              <div class="form-group">
                                                                                <label for="">{{__('Stead Fast API Key')}}</label>
                                                                                 <input type="text" name="steadfast_api_key" id="steadfast_api_key" class="form-control" value="{{ $info->steadfast_api_key }}">
                                                                              </div>
                                                                    </div>
                                                                    <div class="col-md-4">                                                            
                                                                              <div class="form-group">
                                                                                <label for="">{{__('Stead Fast Secret Key')}}</label>
                                                                                 <input type="text" name="steadfast_secret_key" id="steadfast_secret_key" class="form-control" value="{{ $info->steadfast_secret_key }}">
                                                                              </div>
                                                                    </div>
                                                              </div>                 
                                                                            
                                                          <button class="btn btn-primary" type="submit">{{__('admin.Update')}}</button>
                                                        <a class="btn btn-success text-right" href="{{ route('admin.create-access-token') }}">Create Pathao Access Token</a>
                                                        
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
