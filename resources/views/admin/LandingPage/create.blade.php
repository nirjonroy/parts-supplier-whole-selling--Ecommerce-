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

          <div class="section-body">
            <a href="{{ route('admin.product.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Products')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                  <div class="card-body">

<form method="POST" action="{{ route('admin.landing_pages.store')}}"  enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-3">
                <label  class="form-label">Page Title</label>
                <input type="text" name="title1" class="form-control" placeholder="Title">
            </div>
        </div>

        <div class="col-lg-12">
            <div class="mb-3">
                <label  class="form-label">Quality Assurance</label>
                <textarea class="form-control summernote" name="title2" rows="10" cols="10"></textarea>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="mb-3">
                <label  class="form-label">Video Url (Embedded Code)</label>
                <input type="text" name="video_url" class="form-control" placeholder="Title">
            </div>
        </div>

        <div class="col-lg-12">
            <div class="mb-3">
                <label  class="form-label">Product Overview</label>
                <textarea class="form-control summernote" name="des1" rows="10" cols="10"></textarea>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="mb-3">
                <label  class="form-label">Slider Top Text</label>
                 <input type="text" name="feature" class="form-control" placeholder="Title">
            </div>
        </div>

        <!--<div class="col-lg-12">-->
        <!--    <div class="mb-3">-->
        <!--        <label class="form-label">Image</label>-->
        <!--       <input type="file" name="image" class="form-control">-->
        <!--    </div>-->
        <!--</div>-->

        <div class="col-lg-12">
            <div class="mb-3">
                <label  class="form-label">Slider Image</label>
               <input type="file" name="sliderimage[]" class="form-control" multiple>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="mb-3">
                <label  class="form-label">Old Price</label>
                <input type="text" name="old_price" class="form-control" placeholder="Title">
            </div>
        </div> 

        <div class="col-lg-12">
            <div class="mb-3">
                <label  class="form-label">New Price</label>
                <input type="text" name="new_price" class="form-control" placeholder="Title">
            </div>
        </div> 
        
         <div class="col-lg-12">
            <div class="mb-3">
                <label  class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" placeholder="Title">
            </div>
        </div> 

        <div class="col-lg-12">
            <div class="mb-3">
                <label  class="form-label">Feature</label>
                <textarea class="form-control summernote" name="des3" rows="10" cols="10"></textarea>
            </div>
        </div>

        <!--<div class="col-lg-12">-->
        <!--    <div class="mb-3">-->
        <!--        <label  class="form-label">Home Delivery</label>-->
        <!--        <input type="text" name="pay_text" class="form-control" placeholder="Title">-->
        <!--    </div>-->
        <!--</div>-->

        <div class="col-lg-12">
            <div class="mb-3">
                <label  class="form-label">Add Product</label>
                <input type="text" id="search2" class="form-control" placeholder="product search here">
            </div>
        </div>

        <input type="hidden" id="product_id" name="product_id" value="">

        <div id="data">

        </div>


        <div class="col-lg-12">
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>

</form>

</div> <!-- end card-body-->
                  </div>
                </div>
          </div>
        </section>
      </div>

      <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


<script type="text/javascript">
    var path = "{{ route('admin.getOrderProduct') }}";
    var path2 = "{{ route('admin.getOrderProduct2') }}";
    const products=[];

    $( "#search" ).autocomplete({
        selectFirst: true, //here
        minLength: 2,
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
                if (data.length ==0) {
                    toastr.error('Product Or Stock Not Found');
                }
                else if (data.length ==1) {
                    if(products.indexOf(data[0].id) ==-1){
                        landingProductEntry(data[0]);
                        products.push(data[0].id);
                    }
                    $('#search').val('');
                }else if (data.length >1) {
                    response(data);
                }
            }
          });
        },
        select: function (event, ui) {
           if(products.indexOf(ui.item.id) ==-1){
                landingProductEntry(ui.item);
                products.push(ui.item.id);
            }
           $('#search').val('');
           return false;
        }
      });
      
      $( "#search2" ).autocomplete({
        selectFirst: true, //here
        minLength: 2,
        source: function( request, response ) {
          $.ajax({
            url: path2,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
                if (data.length ==0) {
                    toastr.error('Product Or Stock Not Found2');
                }
                else if (data.length ==1) {
                    if(products.indexOf(data[0].id) ==-1){
                        landingProductEntry(data[0]);
                        products.push(data[0].id);
                    }
                    $('#search2').val('');
                }else if (data.length >1) {
                    response(data);
                }
            }
          });
        },
        select: function (event, ui) {
           if(products.indexOf(ui.item.id) ==-1){
                landingProductEntry(ui.item);
                products.push(ui.item.id);
            }
           $('#search').val('');
           return false;
        }
      });

      function landingProductEntry(item)
      {
          $.ajax({
            url: '{{ route("admin.landingProductEntry")}}',
            type: 'GET',
            dataType: "json",
            data: {id:item.id},
            success: function( res ) {
                if (res.html) {
                    $('div#data').append(res.html);
                }
                if (res.pr_id)
                {
                    $('#product_id').val(res.pr_id);
                }
            }
          });
      }

      function productEntry(item){


        $.ajax({
            url: '{{ route("admin.orderProductEntry")}}',
            type: 'GET',
            dataType: "json",
            data: {id:item.id},
            success: function( res ) {
                if (res.html) {
                   $('tbody#data').append(res.html);
                    calculateSum();
                }
            }
          });
    }

</script>




@endsection
