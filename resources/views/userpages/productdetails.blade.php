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
             <a >
                <h2>{{ $product->name }}</h2>
            </a>
            <p class="product-price">
                @if($product->discount_price)
                    <span style="text-decoration: line-through; color: #999;">${{ $product->price }}</span>
                @else
                    {{ $product->price }}
                @endif
            </p>
            <p class="product-price">{{ $product->discount_price }}</p>

             
            <form class="cart-form clearfix" method="post">
                @if ($product->options->isNotEmpty())
                <div class="select-box d-flex mt-50 mb-30">
                    <select name="size" id="productSize" class="mr-5">
                        @foreach($product->options as $option)
                            <option value="{{ $option->id }}">Size: {{ $option->option }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="cart-fav-box d-flex align-items-center">
                    @if ($product->quantity == 0)            
                    <a href="#" class="btn essence-btn" style="width: 100%; padding: 15px; display: flex; justify-content: center; align-items: center; cursor: not-allowed;border:1px solid black;background:none;color:black">Sold Out</a>
                    @else
                    <a data-product-id="{{ $product->id }}" class="btn essence-btn addtocartproduct" style="  padding: 15px; display: flex; justify-content: center; align-items: center;border:1px solid black;background:none">Add to Cart</a>
                    @endif
                     <div class="product-favourite ml-4">
                        <a href="#" class="favme fa fa-heart"></a>
                    </div>
                </div>
            </form>

         
 
            <div class="write-review mt-4">
                <a href="javascript:void(0);" 
                   class="btn essence-btn" 
                   id="writeReviewBtn" 
                   style="display: flex; justify-content: center; align-items: center;"
                   data-product-id="{{ $product->id }}">
                   Write a Review
                </a>
            </div>

            <h3 class="mt-3">Description</h3>

            <p class="product-description-under-button mt-3">{{ $product->description }}</p>
            @if ($averageRating > 0) 
            <div style="color: #FFD700; font-size: 20px; margin-bottom: 10px;">
               
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $averageRating)
                        <i class="fa fa-star" style="margin-right: 3px;"></i>
                    @elseif ($i - 0.5 <= $averageRating)
                        <i class="fa fa-star-half-o" style="margin-right: 3px;"></i>
                    @else
                        <i class="fa fa-star-o" style="margin-right: 3px;"></i>
                    @endif
                @endfor
               
            </div>
        @endif
            
        </div>
    </section>

    <div class="container review-form" style="display: none; background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 100%; max-width: 600px; margin: auto; transform: translateY(-100%); transition: transform 0.3s ease-in-out;">
        <h2 style="text-align: center; margin-bottom: 20px;">Write a Review</h2>

        <h5 style="text-align: center;color:grey">Rating</h5>
        <form>
        <div class="stars" style="text-align: center; margin-bottom: 20px;">
            <label for="star1" class="star" style="font-size: 30px; color: #ccc; cursor: pointer;">&#9733;</label>
            <input type="radio" id="star1" name="rating" value="1" style="display: none;">
            <label for="star2" class="star" style="font-size: 30px; color: #ccc; cursor: pointer;">&#9733;</label>
            <input type="radio" id="star2" name="rating" value="2" style="display: none;">
            <label for="star3" class="star" style="font-size: 30px; color: #ccc; cursor: pointer;">&#9733;</label>
            <input type="radio" id="star3" name="rating" value="3" style="display: none;">
            <label for="star4" class="star" style="font-size: 30px; color: #ccc; cursor: pointer;">&#9733;</label>
            <input type="radio" id="star4" name="rating" value="4" style="display: none;">
            <label for="star5" class="star" style="font-size: 30px; color: #ccc; cursor: pointer;">&#9733;</label>
            <input type="radio" id="star5" name="rating" value="5" style="display: none;">
        </div>
        
        <div class="form-group" style="margin-bottom: 15px;">
            <input type="text" id="reviewTitle" name="review_title" placeholder="Review Title" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;">
        </div>
        
        <div class="form-group" style="margin-bottom: 15px;">
            <input type="text" id="reviewerName" name="name" placeholder="Your Name" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;">
        </div>
        
        <div class="form-group" style="margin-bottom: 15px;">
            <input type="email" id="reviewerEmail" name="email" placeholder="Your Email" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px;">
        </div>
        
        <div class="form-group" style="margin-bottom: 15px;">
            <textarea placeholder="Write your review here..." id="reviewText" name="message_review" style="width: 100%; height: 150px; padding: 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 14px; resize: none;"></textarea>
        </div>
        
         <div style="display: flex; justify-content: space-between;">
            <button class="submit-btn" id="submitReviewBtn" style="padding: 12px 20px; background-color: #4CAF50; color: white; font-size: 16px; border: none; border-radius: 5px; cursor: pointer; width: 48%;">Submit Review</button>
            <a class="cancel-btn" style="padding: 12px 20px; background-color: #f44336; color: white; font-size: 16px; border: none; border-radius: 5px; cursor: pointer; width: 48%;">Cancel Review</a>
        </div>
        </form>
    </div>
    
    

    @include('userpages.footer') 
    @include('userpages.js')
    @include('ajax')

</body>
</html>