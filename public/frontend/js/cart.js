$(function(){

    $(document).on('click', '.add-to-cart', function(e){
        let id = $(this).data('id');
        let url = $(this).data('url');
        addToCart(url, id);
    });       
    
    $(document).on('click', 'button#buyNowButton', function(e){        
      
        let variation_count = parseInt($(document).find('input.isVariation').val());
        let variation = $(document).find("input[name='variation']:checked").val();

        if(variation_count > 0 && variation === undefined)
        {
            toastr.error('Product Size is Required!');
            return;
        }

        let id = $(this).data('id');
        let url = $(this).data('url');
        let quantity = parseInt($(this).closest('div').find('input[name="qty"]').val());
        addToCart(url, id, variation,quantity);

    });   
    

    function addToCart(url, id, variation = "", type = "", quantity = 1)
    {
        $.ajax({
            type: "POST",
            url,
            data: {id, quantity, variation},
            success: function(res){
                if(res.status)
                {
                    toastr.success(res.msg);
                    if(type)
                    {
                        if(res.url != '')
                        {
                           document.location.href = res.url;
                        }
                       
                        else{
                        //  $('span.cart-sticky').text('hi');
                           // $('.lightboxContainer').hide();
                           // $('#signin').modal('show');
                        }
                    }
                    else {
                        window.location.reload();
                    }
                }                
                else 
                {
                    toastr.error(res.msg);
                }
            }
        });
    }
    
    $(document).on('click', '.increase', function(e){
        let url = $(this).data('url');
        $.ajax({
            type: "GET",
            url,
            success: function(res){
                if(res.status)
                {
                    toastr.success(res.msg);
                    location.reload();
                }                
                else 
                {
                    toastr.error(res.msg);
                }
            }
        });
    });    
    
    $(document).on('click', '.decrease', function(e){
        let url = $(this).data('url');
        $.ajax({
            type: "GET",
            url,
            success: function(res){
                if(res.status)
                {
                    toastr.success(res.msg);
                    location.reload();
                }                
                else 
                {
                    toastr.error(res.msg);
                }
            }
        });
    });    
    
    $(document).on('click', '.remove', function(e){
        let url = $(this).data('url');
        $.ajax({
            type: "GET",
            url,
            success: function(res){
                if(res.status)
                {
                    toastr.success(res.msg);
                    location.reload();
                }                
                else 
                {
                    toastr.error(res.msg);
                }
            }
        });
    });


    $(document).on('change', 'select[name="billing_country"]', function(e){
        let id = $(this).val();
        let elem = $('select[name="billing_state"]');
        stateByCountry(id, elem);
        
    });    
    
    $(document).on('change', 'select[name="billing_state"]', function(e){
        let id = $(this).val();
        let elem = $('select[name="billing_city"]');
        cityByState(id, elem);
        
    });

    $(document).on('change', 'select[name="shipping_country"]', function(e){
        let id = $(this).val();
        let elem = $('select[name="shipping_state"]');
        stateByCountry(id, elem);
        
    });    
    
    $(document).on('change', 'select[name="shipping_state"]', function(e){
        let id = $(this).val();
        let elem = $('select[name="shipping_city"]');
        cityByState(id, elem);
        
    });


    function stateByCountry(id, elem){
        $.ajax({
            type: "GET",
            url: "front/state-by-country/"+id,
            success: function(res)
            {
                if(res.states)
                {
                    elem.html(res.html);
                }
            }
        });
    }    
    
    function cityByState(id, elem){
        $.ajax({
            type: "GET",
            url: "front/city-by-state/"+id,
            success: function(res)
            {
                if(res.cities)
                {
                    elem.html(res.html);
                }
            }
        });
    }


    
});