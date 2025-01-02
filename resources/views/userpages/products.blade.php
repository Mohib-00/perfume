<section class="new_arrivals_area section-padding-80 clearfix my-5" style="background-color:#fafafa">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <h1>Our Selections</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="popular-products-slides owl-carousel">

                    
                    @if ($selectionProducts->isNotEmpty())
                    @foreach ($selectionProducts as $product)
                     <div  data-product-name="{{ $product->name }}" class="single-product-wrapper" style="background-color: #ffffff;border-radius:10px">
                         <div data-product-name="{{ $product->name }}" class="product-img viewdetail">
                            <img style="height:500px" src="{{ asset('images/'.$product->hover_image) }}" alt="">
                             <img style="height:500px" class="hover-img" src="{{ asset('images/'.$product->image) }}" alt="">
                             <div class="product-favourite">
                                <a href="#" class="favme fa fa-heart"></a>
                            </div>
                        </div>
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
                            <div class="add-to-cart-btn">
                                @if ($product->quantity == 0)
                                   
                                <a href="#" class="btn essence-btn" style="width: 100%; padding: 15px; background-color: #ccc; display: flex; justify-content: center; align-items: center; cursor: not-allowed;">Sold Out</a>
                                @elseif ($product->options->isNotEmpty()) 
                                <a  data-product-name="{{ $product->name }}"class="btn essence-btn viewdetail" style="width: 100%; padding: 15px; display: flex; justify-content: center; align-items: center;">View Options</a>
                                @else
                                   
                                    <a data-product-id="{{ $product->id }}" class="btn essence-btn addtocartproduct" style="width: 100%; padding: 15px; display: flex; justify-content: center; align-items: center;">Add to Cart</a>
                                @endif
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
