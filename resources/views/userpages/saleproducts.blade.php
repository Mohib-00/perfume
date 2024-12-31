<section class="new_arrivals_area section-padding-80 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <h1>Sale Products</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="popular-products-slides owl-carousel">

                    @if ($saleProducts->isNotEmpty())
                    @foreach ($saleProducts as $product)
                     <div class="single-product-wrapper">
                        <!-- Product Image -->
                        <div class="product-img">
                            <img style="height:500px" src="{{ asset('images/'.$product->hover_image) }}" alt="">
                            <!-- Hover Thumb -->
                            <img style="height:500px" class="hover-img" src="{{ asset('images/'.$product->image) }}" alt="">
                            <!-- Favourite -->
                            <div class="product-favourite">
                                <a href="#" class="favme fa fa-heart"></a>
                            </div>
                        </div>
                        <!-- Product Description -->
                        <div class="product-description">
                            <a>
                                <h6>{{$product->name}}</h6>
                            </a>
                            <p class="product-price">
                            @if($product->discount_price)
                                <span style="text-decoration: line-through; color: #999;">${{ $product->price }}</span>
                            @else
                                ${{ $product->price }}
                            @endif
                            </p>
                            <p class="product-price">{{ $product->discount_price }}</p>

                             <div style="color: #FFD700; font-size: 20px; margin-bottom: 10px;">
                                <span style="margin-right: 8px; color: black; font-size: 16px;">4.5</span>
                                <i class="fa fa-star" style="margin-right: 3px;"></i>
                                <i class="fa fa-star" style="margin-right: 3px;"></i>
                                <i class="fa fa-star" style="margin-right: 3px;"></i>
                                <i class="fa fa-star-half-o" style="margin-right: 3px;"></i>
                                <i class="fa fa-star-o" style="margin-right: 3px;"></i>
                            </div>
                             <div class="hover-content">
                                 <div class="add-to-cart-btn">
                                    <a href="#" class="btn essence-btn">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                 

                  

                </div>
            </div>
        </div>
    </div>
</section>
