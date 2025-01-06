@if ($selectionProducts->isNotEmpty())
<section class="new_arrivals_area section-padding-80 clearfix">
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

                    
                    
                    @foreach ($selectionProducts as $product)
                     <div  data-product-name="{{ $product->name }}" class="single-product-wrapper" style="border-radius:5px">
                         <div data-product-name="{{ $product->name }}" class="product-img viewdetail">
                            <img style="height:500px" src="{{ asset('images/'.$product->hover_image) }}" alt="">
                             <img style="height:500px" class="hover-img" src="{{ asset('images/'.$product->image) }}" alt="">
                             <div style="position: absolute; top: 10px; right: 10px; z-index: 10;">
                                <a class="favme fa fa-heart"></a>
                            </div>
                        </div>
                        <div class="product-description" style="display: flex; flex-direction: column; justify-content: space-between; align-items: center; text-align: center; padding: 20px; height: 200px;">
                            <a>
                                <h6 style="margin-bottom: 10px;">{{ $product->name }}</h6>
                            </a>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <p class="product-price" style="margin-bottom: 10px; display: inline-block;">
                                    @if($product->discount_price)
                                        <span style="text-decoration: line-through; color: #999;">Rs:{{ $product->price }}</span>
                                    @else
                                        Rs:{{ $product->price }}
                                    @endif
                                </p>
                            
                                @if($product->discount_price)
                                <p class="product-price" style="margin-bottom: 10px; display: inline-block; color: black; font-weight: bold;">
                                    Rs:{{ $product->discount_price }}
                                </p>
                                @endif
                            </div>
                            
                    
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
                            <div style="width: 109.5%;">
                                @if ($product->quantity == 0)
                                    <a href="#" class="btn eesence-btn  " style="width: 100%; padding: 15px; display: flex; justify-content: center; align-items: center; cursor: not-allowed;color:black;border:1px solid black">Sold Out</a>
                                @elseif ($product->options->isNotEmpty())
                                    <a data-product-name="{{ $product->name }}" class="btn eesence-btn   viewdetail" style="width: 100%; padding: 15px; display: flex; justify-content: center; align-items: center; color: black;border:1px solid black">View Options</a>
                                @else
                                    <a data-product-id="{{ $product->id }}" class="btn eesence-btn  addtocartproduct" style="width: 100%; padding: 15px; display: flex; justify-content: center; align-items: center;color:black;border:1px solid black">Add to Cart</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    

                   

                </div>
            </div>
        </div>
    </div>
</section>
@endif
