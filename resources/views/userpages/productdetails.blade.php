<!DOCTYPE html>
<html lang="en">

<head>
    @include('userpages.css')
</head>

<body>
    @include('userpages.header')
    @include('userpages.cartmodel')
 
     <section class="single_product_details_area d-flex align-items-center">

         <div class="single_product_thumb clearfix">
            <div class="product_thumbnail_slides owl-carousel">
                <img src="{{asset('essence/img/product-img/product-big-1.jpg')}}" alt="">
                <img src="{{asset('essence/img/product-img/product-big-2.jpg')}}" alt="">
                <img src="{{asset('essence/img/product-img/product-big-3.jpg')}}" alt="">
            </div>
        </div>

         <div class="single_product_desc clearfix">
            <span>mango</span>
            <a href="cart.html">
                <h2>One Shoulder Glitter Midi Dress</h2>
            </a>
            <p class="product-price"><span class="old-price">$65.00</span> $49.00</p>
            <p class="product-desc">Mauris viverra cursus ante laoreet eleifend. Donec vel fringilla ante. Aenean finibus velit id urna vehicula, nec maximus est sollicitudin.</p>

             <form class="cart-form clearfix" method="post">
                 <div class="select-box d-flex mt-50 mb-30">
                    <select name="select" id="productSize" class="mr-5">
                        <option value="value">Size: XL</option>
                        <option value="value">Size: X</option>
                        <option value="value">Size: M</option>
                        <option value="value">Size: S</option>
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