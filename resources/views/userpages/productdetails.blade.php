<!DOCTYPE html>
<html lang="en">

<head>
    @include('userpages.css')
</head>

<body>
    @include('userpages.header')
    @include('userpages.cartmodel')
 
     <section style="margin-top:10px" class="single_product_details_area d-flex align-items-center">

         <div class="single_product_thumb clearfix my-5">
            <div class="product_thumbnail_slides owl-carousel">
                <img style="height:600px" src="{{ asset('images/'.$product->image) }}" alt="">
                <img style="height:600px" src="{{ asset('images/'.$product->hover_image) }}" alt="">
             </div>
        </div>

         <div class="single_product_desc clearfix ">
            <span>mango</span>
            <a href="cart.html">
                <h2>{{ $product->name }}</h2>
            </a>
            <p class="product-price">
                @if($product->discount_price)
                    <span style="text-decoration: line-through; color: #999;">${{ $product->price }}</span>
                @else
                    ${{ $product->price }}
                @endif
            </p>
            <p class="product-price">${{ $product->discount_price }}</p>
            <p class="product-desc">{{ $product->description }}</p>

             <form class="cart-form clearfix" method="post">
                 <div class="select-box d-flex mt-50 mb-30">
                    <select name="size" id="productSize" class="mr-5">
                        @foreach($product->options as $option)
                            <option value="{{ $option->id }}">Size: {{ $option->option }}</option>
                        @endforeach
                    </select>
                    
                </div>
                 <div class="cart-fav-box d-flex align-items-center">
                     <button type="submit" name="addtocart" value="5" class="btn essence-btn">Add to cart</button>
                     <div class="product-favourite ml-4">
                        <a href="#" class="favme fa fa-heart"></a>
                    </div>
                </div>
            </form>
        </div>
    </section>

    @include('userpages.footer') 
    @include('userpages.js')
    @include('ajax')

</body>
</html>