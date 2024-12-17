@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Error Page')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Error Page')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Error Page')}}</div>
            </div>
          </div>

          <div class="section-body">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-none">
                                <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                    @foreach ($errorPages as $index => $errorPage)
                                        <li class="nav-item border rounded mb-1">
                                            <a class="nav-link {{ $index == 0  ? 'active' : '' }}" id="error-tab-{{ $errorPage->id }}" data-toggle="tab" href="#errorTab-{{ $errorPage->id }}" role="tab" aria-controls="errorTab-{{ $errorPage->id }}" aria-selected="true">{{ $errorPage->page_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="col-12">
                                <div class="border rounded">
                                    <div class="tab-content no-padding" id="settingsContent">
                                        @foreach ($errorPages as $index => $errorpage)
                                            <div class="tab-pane fade {{ $index == 0  ? 'show active' : '' }}" id="errorTab-{{ $errorpage->id }}" role="tabpanel" aria-labelledby="error-tab-{{ $errorpage->id }}">
                                                <div class="card m-0">
                                                    <div class="card-body">
                                                        <form action="{{ route('admin.error-page.update',$errorpage->id) }}" method="POST" enctype="multipart/form-data">
                                                            @method('PATCH')
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="">{{__('admin.Existing Image')}}</label>
                                                                        <div>
                                                                            <img width="200px" src="{{ asset($errorpage->image) }}" alt="">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-12">
                                                                    <label>{{__('admin.New Image')}}</label>
                                                                    <input type="file" name="image" class="form-control-file">
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="">{{__('admin.Page Name')}}</label>
                                                                        <input type="text" name="page_name" class="form-control" value="{{ $errorpage->page_name }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="">{{__('admin.Header')}}</label>
                                                                        <input type="text" name="header" class="form-control" value="{{ $errorpage->header }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
@endsection

