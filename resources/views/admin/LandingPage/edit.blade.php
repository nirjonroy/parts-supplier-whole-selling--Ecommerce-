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

<form method="POST" action="{{ route('admin.landing_pages.update',[$item->id])}}"  enctype="multipart/form-data">
    @csrf
    <!-- @method('PATCH') -->
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-3">
                <label  class="form-label">Page Title</label>
                <input type="text" name="title1" value="{{$item->title1}}" class="form-control" placeholder="Title">
            <input type="hidden" name="product_id" value="{{ $item->product_id }}" class="form-control">
            <input type="hidden" id="new_product_id" name="new_product_id" class="form-control">
            </div>
        </div>

        <div class="col-lg-12">
            <div class="mb-3">
                <label  class="form-label">Quality Assurance</label>
                <textarea class="form-control summernote" name="title2" rows="10" cols="10">{{$item->title2}}</textarea>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="mb-3">
                <label  class="form-label">Video Url (Embedded Code)</label>
                <input type="text" name="video_url" class="form-control" value="{{$item->video_url}}" placeholder="Title">
            </div>
        </div>

        <div class="col-lg-12">
            <div class="mb-3">
                <label  class="form-label">Product Overview</label>
                <textarea class="form-control summernote" name="des1" rows="10" cols="10">{{$item->des1}}</textarea>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="mb-3">
                <label  class="form-label">Slider Top Text</label>
                 <input type="text" name="feature" value="{{$item->feature}}" class="form-control" placeholder="Title">
            </div>
        </div>

        <!--<div class="col-lg-12">-->
        <!--    <div class="mb-3">-->
        <!--        <img src="{{asset($item->image)}}" alt="df" >-->
        <!--        <label class="form-label">Image</label>-->
        <!--       <input type="file" name="image" class="form-control">-->
        <!--    </div>-->
        <!--</div>-->
        
        
        <div class="col-lg-4 mb-3">
                            <div class="d-flex">
                                @foreach ($item->images as $key => $image)
                                <div class="img-box">
                                    <a href="" class="" onclick="return confirm(' you want to delete?');">&times;</a>
                                    <img src="{{ getImage('landing_sliders',$image->image)}}" width="50">
                                </div>
                                @endforeach
                            </div>
                            <label  class="form-label">Slider Image</label>
                            <input type="file" name="sliderimage[]" class="form-control" multiple>
                        </div>
        

        <!--<div class="col-lg-12">-->
        <!--    <div class="mb-3">-->
        <!--        <label  class="form-label">Slider Image</label>-->
        <!--       <input type="file" name="sliderimage[]" class="form-control" multiple>-->
        <!--    </div>-->
        <!--</div>-->

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
                <input type="text" name="phone" value="{{$item->phone}}" class="form-control" placeholder="Title">
            </div>
        </div> 

        <div class="col-lg-12">
            <div class="mb-3">
                <label  class="form-label">Feature</label>
                <textarea class="form-control summernote" name="des3" rows="10" cols="10">{{$item->des3}}</textarea>
            </div>
        </div>

        <!--<div class="col-lg-12">-->
        <!--    <div class="mb-3">-->
        <!--        <label  class="form-label">Home Delivery</label>-->
        <!--        <input type="text" name="pay_text" value="{{$item->pay_text}}" class="form-control" placeholder="Title">-->
        <!--    </div>-->
        <!--</div>-->

        <div class="col-lg-12" id="product_search" style="display: none;">
                            <div class="mb-3">
                                <label  class="form-label">Add Product</label>
                                <input type="text" id="search2" class="form-control" placeholder="product search here">
                            </div>
                        </div>
                        <div class="col-lg-12">
                             <div class="product_table" id="data">
                            <table class="table table-centered table-nowrap mb-0" id="product_table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Image</th>
                                        <th>Product</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="data">
                                   <tr>
                                        <td><img src="{{ asset('uploads/custom-images2/'.$single_product->thumb_image) }}" height="50" width="50"/></td>
                                      
                            		    <td>{{ $single_product->name }}</td>
                                        
                                        <td><a class="remove btn btn-sm btn-danger"> <i class="fa fa-trash" aria-hidden="true" style="color:white"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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


<script>
var path2 = "{{ route('admin.getOrderProduct2') }}";
const products=[];
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
                    $('div#data').html(res.html);
                }
                if (res.pr_id)
                {
                    $('#new_product_id').val(res.pr_id);
                }
            }
          });
      }
      
      $(document).on('click',".remove",function(e) {
        var whichtr = $(this).closest("tr");
        whichtr.remove();  
        document.getElementById('product_search').style.display = 'block';
    });
      
</script>




@endsection
