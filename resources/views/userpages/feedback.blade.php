<section class="community-section section-padding-80" style="padding: 80px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style="font-size: 28px; font-weight: bold;">From Our Community</h2>
            
            <div class="stars" style="margin-bottom: 15px; display: inline-block; padding: 10px;">
                <span class="fa fa-star" style="color: white; background-color: black; font-size: 20px; padding: 10px; border-radius: 50%;"></span>
                <span class="fa fa-star" style="color: white; background-color: black; font-size: 20px; padding: 10px; border-radius: 50%;"></span>
                <span class="fa fa-star" style="color: white; background-color: black; font-size: 20px; padding: 10px; border-radius: 50%;"></span>
                <span class="fa fa-star" style="color: white; background-color: black; font-size: 20px; padding: 10px; border-radius: 50%;"></span>
                <span class="fa fa-star" style="color: white; background-color: black; font-size: 20px; padding: 10px; border-radius: 50%;"></span>
            </div>
        </div>

        @if ($reviews->isNotEmpty())
        <div class="reviews-scroll-container d-flex" style="overflow-x: auto; gap: 15px; padding-bottom: 20px;">
            @foreach($reviews as $review)
            <div class="review-item col-lg-4 col-md-6 col-sm-12" 
                 style="flex: 0 0 auto; 
                        background-color: whitesmoke; 
                        padding: 20px; 
                        border-radius: 8px; 
                        text-align: center; 
                        min-width: 300px; 
                        max-width: 300px; 
                        height: 100%; 
                        display: flex; 
                        flex-direction: column; 
                        justify-content: space-between;
                        min-height: 350px;"> 
                <div class="stars" style="margin-bottom: 15px; display: inline-block; padding: 5px;">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="fa fa-star" 
                              style="color: {{ $i <= $review->rating ? 'yellow' : 'white' }}; 
                                     background-color: black; 
                                     font-size: 15px; 
                                     padding: 10px; 
                                     border-radius: 50%;"></span>
                    @endfor
                </div>
    
                <p style="font-size: 14px; font-weight: bold; color: #333;">{{ $review->review_title }}</p>
    
                <p style="font-size: 16px; color: #333; line-height: 1.5; margin-bottom: 15px;">  
                    "{{ Str::limit($review->message_review, 100, '...') }}"
                </p>
    
                <p style="font-size: 14px; color: #777;">{{ $review->name }}</p>
    
                <p style="font-size: 14px; font-weight: bold; color: #333;">{{ $review->product_name }}</p>
            </div>
            @endforeach
        </div>
    @else
        <p style="text-align: center; color: #fff;">No reviews available at the moment.</p>
    @endif
    
    </div>
</section>
