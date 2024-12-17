

      
        <p style="text-align:center">Select Product</p>
        <table class="table table-responsive table-bordered">
            <thead style="background:#010138; color: white;">
                <tr>
                <td> Image </td>
                <td> Name </td>
                <td> Price </td>
                <td> Action </td>
            </tr>    
            </thead>
            
            @forelse($products as $key => $sale) 
            <tbody>
                <tr>
                <td><img src="{{asset('uploads/custom-images2/'.$sale->thumb_image)}}" alt="" style="width:60px; height: 60px"></td>
                <td>
                    {{$sale->name}}
                </td>
                <td>
                    {{$sale->price}}
                </td>
                 <td>
                    
                    <a data-id="{{ $sale->id }}" data-url="{{ route('front.cart.store') }}" style="color: white;font-size: 8px; " class="btn btn-sm btn-warning semi bg-orange  add-to-cart">
                      Add 
                      </a>
                      <p class="is_selected_{{ $sale->id }}"> </p>
                </td>
            </tr>    
            </tbody>
            
             @empty
             <div align="center">
                <strong class="text-center text-danger">No products are available</strong>
             </div>
             @endforelse
        </table>
          <hr>
        
    
   
     



<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<script>
   $(function () {
     // Add CSS to initially hide the .offerBox
          function setCookie(name, value, minutes) {
              var expires = "";
              if (minutes) {
                  var date = new Date();
                  date.setTime(date.getTime() + (minutes * 60 * 1000));
                  expires = "; expires=" + date.toUTCString();
              }
              document.cookie = name + "=" + (value || "") + expires + "; path=/";
          }
          
          function getCookie(name) {
              var nameEQ = name + "=";
              var ca = document.cookie.split(';');
              for(var i = 0; i < ca.length; i++) {
                  var c = ca[i];
                  while (c.charAt(0) == ' ') {
                      c = c.substring(1, c.length);
                  }
                  if (c.indexOf(nameEQ) == 0) {
                      return c.substring(nameEQ.length, c.length);
                  }
              }
              return null;
          }
          
          $(".modal-overlay").click(function(){
              $('.offerBox').hide();
              setCookie('offerBoxHidden', 'true', 5);
          })
          
          $(".offerBox .content .close").click(function(){
              $('.offerBox').hide();
              setCookie('offerBoxHidden', 'true', 5);
          })
          
          // Check if the offerBox should be hidden based on the cookie
          var offerBoxHidden = getCookie('offerBoxHidden');
          
          if (offerBoxHidden === 'true') {
              $('.offerBox').hide();
          }
          
          
          
          
          
      $(document).on('click', '.add-to-cart', function (e) {
          let id = $(this).data('id');
          let url = $(this).data('url');
          
          addToCart(url, id);
          
      });
   
      // ... other click event handlers ...
   
      function addToCart(url, id, variation = "", quantity = 1) {
          var csrfToken = $('meta[name="csrf-token"]').attr('content');
   
          $.ajax({
              type: "POST",
              url: url,
              headers: {
                  'X-CSRF-TOKEN': csrfToken
              },
              data: { id, quantity, variation},
              success: function (res) {
                  if (res.status) {
                           toastr.success(res.msg);
                           window.location.reload();
                            $('.is_selected_'+data.id).text('added');
                  } else {
                      toastr.error(res.msg);
                  }
              },
              error: function (xhr, status, error) {
                  toastr.error('An error occurred while processing your request.');
              }
          });
      }
   
      // ... other functions ...
   
   });
   
</script>
<script>
   $(document).ready(function() {
   $('.select2').select2({
   closeOnSelect: true
   });
   });
</script>
<!-- Place this JavaScript code after your HTML content -->
<script>
   document.addEventListener("DOMContentLoaded", function () {
       var popUpForm = document.getElementById("popUpForm");
   
       var shouldShowPopup = localStorage.getItem("showPopup");
       var lastCloseTime = localStorage.getItem("lastCloseTime");
   
       if (!shouldShowPopup || (shouldShowPopup && lastCloseTime && Date.now() - lastCloseTime >= 5 * 60 * 1000)) {
           popUpForm.style.display = "block";
       }
       // setTimeout(function () {
       //         popUpForm.style.display = "none";
       //     }, 10000); 
       document.querySelector('.popupGrid').addEventListener('click', function(event) {
           if (event.target.classList.contains('popupGrid')) {
               popUpForm.style.display = "none";
               localStorage.setItem("showPopup", false);
               localStorage.setItem("lastCloseTime", Date.now());
           }
       });
       document.getElementById("close").addEventListener("click", function () {
           popUpForm.style.display = "none";
           localStorage.setItem("showPopup", false);
           localStorage.setItem("lastCloseTime", Date.now());
       });
   });
       
</script>
