<!DOCTYPE html>
<html lang="en">

<head>
     @include('userpages.css')
</head>

<body>
     @include('userpages.header')
     @include('userpages.cartmodel')

    <!-- ##### Breadcumb Area Start ##### -->
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
                            <h2 class="mx-5 mt-5">Collection</h2>
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
                            
                            @if ($collectionselections->isNotEmpty())
                            @foreach ($collectionselections as $product)
                             <div class="col-12 col-sm-6 col-lg-4">
                                <div data-product-name="{{ $product->name }}" class="single-product-wrapper">
                                    <div data-product-name="{{ $product->name }}" class="product-img viewdetail">
                                        <img style="height:500px;border-radius:10px 10px 0px 0px" src="{{ asset('images/'.$product->hover_image) }}" alt="">
                                        <img style="height:500px;border-radius:10px 10px 0px 0px" class="hover-img" src="{{ asset('images/'.$product->image) }}" alt="">
                                        <div style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                            <a class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description" style="display: flex; flex-direction: column; justify-content: space-between; align-items: center; text-align: center; padding: 20px; height: 200px;">
                                        <a>
                                            <h6>{{ $product->name }}</h6>
                                        </a>
                                        <p class="product-price">
                                            @if($product->discount_price)
                                                <span style="text-decoration: line-through; color: #999;">Rs:{{ $product->price }}</span>
                                            @else
                                            Rs:{{ $product->price }}
                                            @endif
                                      
                                         
                                            @if($product->discount_price)
                                                Rs:{{ $product->discount_price }}
                                            @endif
                                        </p>
                                        @if ($product->reviews->isNotEmpty())
                                        <div style="color: #FFD700; font-size: 20px; ">
                                            @php
                                                $averageRating = $product->average_rating;  
                                                $fullStars = floor($averageRating);
                                                $halfStar = $averageRating - $fullStars >= 0.5 ? 1 : 0;
                                                $emptyStars = 5 - $fullStars - $halfStar;
                                            @endphp
                            
                                            <span style="margin-right: 8px; color: black; font-size: 16px;">{{ $averageRating }}</span>
                            
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <i class="fa fa-star" style="margin-right: 3px;"></i>
                                            @endfor
                            
                                            @if ($halfStar)
                                                <i class="fa fa-star-half-o" style="margin-right: 3px;"></i>
                                            @endif
                            
                                            @for ($i = 0; $i < $emptyStars; $i++)
                                                <i class="fa fa-star-o" style="margin-right: 3px;"></i>
                                            @endfor
                                        </div>
                                        @endif
                        
                                        <div style="width: 109%;">
                                            @if ($product->quantity == 0)
                                                <a href="#" class="btn eesence-btn" style="width: 100%; padding: 15px; display: flex; justify-content: center; align-items: center; cursor: not-allowed; color:black; border:1px solid black;">Sold Out</a>
                                            @elseif ($product->options->isNotEmpty())
                                                <a data-product-name="{{ $product->name }}" class="btn eesence-btn viewdetail" style="width: 100%; padding: 15px; display: flex; justify-content: center; align-items: center; color: black; border:1px solid black;">View Options</a>
                                            @else
                                                <a data-product-id="{{ $product->id }}" class="btn eesence-btn addtocartproduct" style="width: 100%; padding: 15px; display: flex; justify-content: center; align-items: center; color:black; border:1px solid black;">Add to Cart</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif

                         </div>
                        
                       
                         
                    </div>
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