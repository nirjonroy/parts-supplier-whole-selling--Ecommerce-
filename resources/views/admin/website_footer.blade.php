@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Footer')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Footer')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Footer')}}</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.footer.update', $footer->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <!--<div class="form-group col-12">-->
                                <!--    <label>{{__('admin.Existing Image')}}</label>-->
                                <!--    <div>-->
                                <!--        <img src="{{ asset($footer->background_image) }}" alt="" width="220px">-->
                                <!--    </div>-->
                                <!--</div>-->
                                <!--<div class="form-group col-12">-->
                                <!--    <label>{{__('admin.Payment Card Image')}}</label>-->
                                <!--    <input type="file" name="card_image" class="form-control-file" >-->
                                <!--</div>-->


                                <div class="form-group col-12">
                                    <label>{{__('admin.Email')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="email" class="form-control" value="{{ $footer->email }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Phone')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control" value="{{ $footer->phone }}">
                                </div>
                                
                                <div class="form-group col-12">
                                    <label>Phone 2 <span class="text-danger">*</span></label>
                                    <input type="text" name="phone2" class="form-control" value="{{ $footer->phone2 }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Address')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="address" class="form-control" value="{{ $footer->address }}">
                                </div>
                                
                                <div class="form-group col-12">
                                    <label>Open Time:</label>
                                    <input type="text" name="open" class="form-control" value="{{ $footer->open }}">
                                </div>
                                
                                <div class="form-group col-12">
                                    <label>Off Day:</label>
                                    <input type="text" name="holiday" class="form-control" value="{{ $footer->holiday }}">
                                </div>

                                <!--<div class="form-group col-12">-->
                                <!--    <label>{{__('admin.First Column Title')}} <span class="text-danger">*</span></label>-->
                                <!--    <input type="text" name="first_column" class="form-control" value="{{ $footer->first_column }}">-->
                                <!--</div>-->

                                <!--<div class="form-group col-12">-->
                                <!--    <label>{{__('admin.Second Column Title')}} <span class="text-danger">*</span></label>-->
                                <!--    <input type="text" name="second_column" class="form-control" value="{{ $footer->second_column }}">-->
                                <!--</div>-->

                                <!--<div class="form-group col-12">-->
                                <!--    <label>{{__('admin.Third Column Title')}} <span class="text-danger">*</span></label>-->
                                <!--    <input type="text" name="third_column" class="form-control" value="{{ $footer->third_column }}">-->
                                <!--</div>-->





                                <div class="form-group col-12">
                                    <label>{{__('admin.Copyright')}} <span class="text-danger">*</span></label>
                                    <input type="text" name="copyright" class="form-control" value="{{ $footer->copyright }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>
@endsection
