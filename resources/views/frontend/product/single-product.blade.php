<div>
    <div class="product">
        <div class="favouriteIcon d-none">
            <svg style="display:inline-block;vertical-align:middle;" width="22px" height="22px" viewBox="0 0 23.098 21.673">
                <g transform="translate(.883 .774)">
                    <path fill="#fff" stroke="#ff686e" stroke-width="1.5" d="M10.667 20C-9.777 6.491 4.372-4.053 10.432 1.524c.08.073.159.149.235.228q.113-.118.235-.227C16.96-4.056 31.11 6.489 10.667 20z" data-name="Path 67492"></path>
                </g>
            </svg>
        </div>
        <div class="imageWrapper">
            <div class="imageWrapperWrapper">
                <img src="{{ asset($product->thumb_image) }}" size="400" style="background-color:transparent;">
            </div>
            <div class="name" data-reactid=".1n7kkwy0qp6.b.2.0.0.0.0.2.5.1.0:$14822_Grocery.0.2.2">{{ $product->name }}</div>
            <div class="subText" data-reactid=".1n7kkwy0qp6.b.2.0.0.0.0.2.5.1.0:$14822_Grocery.0.2.3">
                @if($product->qty > 0)
                <span>{{ $product->weight }} {{ $product->measure }}</span>
                @else
                <strong class="text-danger">Stock not available!</strong>
                @endif
            </div>
            <div class="discountedPriceSection">
                @if(empty($product->offer_price))
                    <div class="discountedPrice" data-reactid=".1n7kkwy0qp6.b.2.0.0.0.0.2.5.1.0:$14822_Grocery.0.2.4.0"><span data-reactid=".1n7kkwy0qp6.b.2.0.0.0.0.2.5.1.0:$14822_Grocery.0.2.4.0.0">৳ </span><span data-reactid=".1n7kkwy0qp6.b.2.0.0.0.0.2.5.1.0:$14822_Grocery.0.2.4.0.1">{{ $product->price }}</span></div>
                @else
                    <div class="discountedPrice" data-reactid=".1n7kkwy0qp6.b.2.0.0.0.0.2.5.1.0:$14822_Grocery.0.2.4.0"><span data-reactid=".1n7kkwy0qp6.b.2.0.0.0.0.2.5.1.0:$14822_Grocery.0.2.4.0.0">৳ </span><span data-reactid=".1n7kkwy0qp6.b.2.0.0.0.0.2.5.1.0:$14822_Grocery.0.2.4.0.1">{{ $product->offer_price }}</span></div>
                    <div class="price" data-reactid=".1n7kkwy0qp6.b.2.0.0.0.0.2.5.1.0:$14822_Grocery.0.2.4.1"><span data-reactid=".1n7kkwy0qp6.b.2.0.0.0.0.2.5.1.0:$14822_Grocery.0.2.4.1.0">৳ </span><span data-reactid=".1n7kkwy0qp6.b.2.0.0.0.0.2.5.1.0:$14822_Grocery.0.2.4.1.1">{{ $product->price }}</span></div>
                @endif
            </div>
            <div class="overlay text">
              
                <p class="addText add-to-cart" data-id="{{ $product->id }}" data-url="{{ route('front.cart.store') }}">Add to Shopping Bag</p>
                <span>
                    <a href="{{ route('front.product.show', [ $product->id ] ) }}" class="btnShowDetails">
                        <span>Details</span>
                        <span>  &gt;</span>
                    </a>
                    <a href="{{ route('front.product.show', [ $product->id ] ) }}" class="btnShowDetailsIcon">
                        <svg width="24px" height="24px" style="fill:#e1e1e1;stroke:#e1e1e1;display:inline-block;vertical-align:middle;" version="1.1" viewBox="0 0 100 100">
                            <path d="m50 5c-24.898 0-45 20.102-45 45s20.102 45 45 45 45-20.102 45-45-20.102-45-45-45zm7.1016 70c0 2.1992-1.8984 4.1016-4.1016 4.1016h-6.1992c-2.1992 0-4.1016-1.8984-4.1016-4.1016v-26.199c0-2.3008 1.8984-4.1016 4.1016-4.1016h6.1992c2.1992 0 4.1016 1.8984 4.1016 4.1016zm-7.2031-37.102c-4.6016 0-8.3984-3.8008-8.3984-8.5 0-4.6992 3.8008-8.5 8.3984-8.5 4.6992 0 8.5 3.8008 8.5 8.5 0 4.7031-3.7969 8.5-8.5 8.5z"></path>
                        </svg>
                    </a>
                </span>
            </div>
        </div>
        <span data-reactid=".1n7kkwy0qp6.b.2.0.0.0.0.2.5.1.0:$14822_Grocery.0.3">
            <a href="" class="btnShowDetails" data-reactid=".1n7kkwy0qp6.b.2.0.0.0.0.2.5.1.0:$14822_Grocery.0.3.0"><span data-reactid=".1n7kkwy0qp6.b.2.0.0.0.0.2.5.1.0:$14822_Grocery.0.3.0.1">Details</span><span data-reactid=".1n7kkwy0qp6.b.2.0.0.0.0.2.5.1.0:$14822_Grocery.0.3.0.2">  &gt;</span></a>
            <a href="{{ route('front.product.show', [ $product->id ] ) }}" class="btnShowDetailsIcon">
                <svg width="24px" height="24px" style="fill:#e1e1e1;stroke:#e1e1e1;display:inline-block;vertical-align:middle;" version="1.1" viewBox="0 0 100 100">
                    <path d="m50 5c-24.898 0-45 20.102-45 45s20.102 45 45 45 45-20.102 45-45-20.102-45-45-45zm7.1016 70c0 2.1992-1.8984 4.1016-4.1016 4.1016h-6.1992c-2.1992 0-4.1016-1.8984-4.1016-4.1016v-26.199c0-2.3008 1.8984-4.1016 4.1016-4.1016h6.1992c2.1992 0 4.1016 1.8984 4.1016 4.1016zm-7.2031-37.102c-4.6016 0-8.3984-3.8008-8.3984-8.5 0-4.6992 3.8008-8.5 8.3984-8.5 4.6992 0 8.5 3.8008 8.5 8.5 0 4.7031-3.7969 8.5-8.5 8.5z" data-reactid=".1n7kkwy0qp6.b.2.0.0.0.0.2.5.1.0:$14822_Grocery.0.3.1.0.0"></path>
                </svg>
            </a>
        </span> 
        
      
      
      
      	@if(!in_array($product->id,getCartProductArray()))
      <a data-id="{{ $product->id }}" data-url="{{ route('front.cart.store') }}" class="buyText ag add-to-cart">
        <section class="addButtonWrapper border-radius-small">
            <span class="fifteenMinute" id="svgIcon">
                <svg width="22px" height="25px" style="display:inline-block;vertical-align:middle;" version="1.1" x="0px" y="0px" viewBox="0 -5 5.153 40.012">
                    <path d="M38.487 11.472H31.78l6.12-9.643h-8.457L21.9 16.906h5.723l-6.289 14.935z" transform="translate(-21.334 -1.829)"></path>
                </svg>
            </span>
            <p id="ag" class="buyText ag add-to-cart">ব্যাগে রাখুন</p>         
        </section>
      </a>
      	@else
        
      	<section class="addButtonWrapper border-radius-small" style="background: #FF8182;">         
          
          <div data-url="{{ route('front.cart.decrease', [$product->id]) }}" style="display: inline;color: white;font-size: 16px;font-weight: 900;
    margin-right: 10px;;" class="caret caret-up increase" title="Add one more to bag">
                                      -    </div>
           
            <p id="ag" class="buyText ag add-to-cart" style="color: white;">
              
              @foreach(cartItems() as $key => $item)
               @if($key == $product->id)
              
                   <span class="onHoverCursor quantity-value">
                                        <span class="current-qty">{{ $item['quantity'] }} টি ব্যাগে আছে </span>
                    </span>            
             
             
               @endif
         @endforeach
              
          </p>  
          
          <div data-url="{{ route('front.cart.increase', [$product->id]) }}" style="display: inline;color: white;font-size: 16px;font-weight: 900;
    margin-left: 10px;" class="caret caret-up increase" title="Add one more to bag">
                                      +    </div>
          
           
        </section>
      	@endif
    </div>
</div>