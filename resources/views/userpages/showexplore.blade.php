<!DOCTYPE html>
<html lang="en">

<head>
     @include('userpages.css')
</head>

<body>
     @include('userpages.header')
     @include('userpages.cartmodel')

     <div class="breadcumb_area bg-img" style="background-image: url({{asset('essence/img/bg-img/breadcumb.jpg')}};">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2> </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
     <section class="shop_grid_area section-padding-80">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                         <div class="widget catagory mb-50">
                            <h2 class="mx-5 mt-5">Explore Product</h2>
                            <p style="margin:0px 20px 0px 50px">Discover our Travel Collection, featuring pocket-sized 10ml bottles that are perfect for your on-the-go lifestyle. Easily slip one into your bag for a quick refresh throughout the day or pack several for your next adventure. Whether you're commuting to work or embarking on a journey, our travel size perfumes are the ideal companions for keeping you beautifully scented wherever you go.</p>
                        </div>

                        <div class="product-sorting d-flex mx-5">
                            <p class="mt-1">Sort by:</p>
                            <form class="mx-1" action="#" method="get">
                                <select name="select" id="sortByselect">
                                    <option value="value">Highest Rated</option>
                                    <option value="value">Newest</option>
                                    <option value="value">Price: $$ - $</option>
                                    <option value="value">Price: $ - $$</option>
                                </select>
                                <input type="submit" class="d-none" value="">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                     
                                </div>
                            </div>
                        </div>

                        <div class="row all">
                            @if ($relatedProducts->isNotEmpty())
                             @foreach($relatedProducts as $relatedProduct)
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img style="height:500px" src="{{ asset('images/'.$relatedProduct->image) }}" alt="">
                                        <img style="height:500px" class="hover-img" src="{{ asset('images/'.$relatedProduct->hover_image) }}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="{{ route('single.product.page', ['slug' => $relatedProduct->slug]) }}">
                                            <h6>{{ $relatedProduct->name }}</h6>
                                        </a>
                                        <p class="product-price">
                                            @if($relatedProduct->discount_price)
                                                <span style="text-decoration: line-through; color: #999;">${{ $relatedProduct->price }}</span>
                                            @else
                                                ${{ $relatedProduct->price }}
                                            @endif
                                        </p>
                                        <p class="product-price">{{ $relatedProduct->discount_price }}</p>
                
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @endif
                          
                        </div>
                        
                       
                         
                    </div>
                    <!-- Pagination -->
                    <nav class="paginationforall" aria-label="navigation">
                        <ul class="pagination mt-50 mb-70">
                            <li class="page-item" data-page="prev"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                             
                            <li class="page-item" data-page="next"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </nav>
                    

                   

                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->

    
    @include('userpages.footer') 
    @include('userpages.js')
    @include('ajax')

</body>

</html>