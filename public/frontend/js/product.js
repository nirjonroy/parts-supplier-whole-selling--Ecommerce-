$(function(){
    $(document).on('click', 'a.btnShowDetails, a.btnShowDetailsIcon', function(e){
        e.preventDefault();
        let url = $(this).attr('href');
        $.ajax({
            type: "GET",
            url,
            beforeSend: function(){
                $(document).find('div.loading').show();
            },
            success: function(data)
            {
                $(document).find('div.loading').hide();
                $(document).find('div.lightboxContainer').html(data).show();
            }
        });
    });
$('.lightboxContainer').click(function(event) {
    if (!$(event.target).closest('.lightbox').length) {
      $('.lightboxContainer').hide();
    }
  });
      $(document).on('click', '.lightbox .close', function(){
        $('.lightboxContainer').hide();
      });

    //   $(document).on('click', 'div.lightboxContainer', function(){
    //     $(this).hide();
    //   });

    $(document).on('click', 'button.addButton', function(e){       
        let prevQty = parseInt($(this).closest('div').find('input[name="qty"]').val());
        let newQty = prevQty + 1;
        $(this).closest('div').find('input[name="qty"]').val(newQty);
        $('div.quantity span').text(newQty);


      });    
      
      $(document).on('click', 'button.removeButton', function(e){
        let prevQty = parseInt($(this).closest('div').find('input[name="qty"]').val());
        if(prevQty > 1)
        {
            let newQty = prevQty - 1;
            $(this).closest('div').find('input[name="qty"]').val(newQty);
            $('div.quantity span').text(newQty);
        }

      });

      $(document).on('click', 'a#placeOrder', function(e){
        e.preventDefault();
        let url = $(this).attr('href');
        let auth = $(this).data('auth');
        if(!auth)
        {
            $('#signin').modal('show');
        }
        else{
            document.location.href = url;
        }
      });


      $(document).on('click', 'a.view-details-btn', function(e){
        e.preventDefault();
        let url = $(this).attr('href');
        $.ajax({
          type: "GET",
          url,
          success: function(res)
          {
            if(res.status)
            {
              $('#order-details').html(res.html).modal('show');
            }
          }
        });
      });
      
      
});