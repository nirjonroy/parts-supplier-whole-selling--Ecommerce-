@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Homepage Section Title')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{__('admin.Homepage Section Title')}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a>
                    </div>
                    <div class="breadcrumb-item">{{__('admin.Homepage Section Title')}}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.update-homepage-section-title') }}" method="post">
                                    @csrf
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="50%">{{__('admin.Default')}}</th>
                                            <th width="50%">{{__('admin.Changable')}}</th>
                                        </tr>
                                        @foreach ($sections as $index => $section)
                                            <tr>
                                                <td width="50%">{{ $section->default }}</td>
                                                <td width="50%">
                                                    <input type="text" class="form-control" name="customs[]"  value="{{ $section->custom }}" required>
                                                    <input type="hidden" name="defaults[]"  value="{{ $section->default }}" required>
                                                    <input type="hidden" name="keys[]"  value="{{ $section->key }}" required>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      </div>
@endsection

