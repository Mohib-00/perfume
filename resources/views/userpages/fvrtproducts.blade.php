<section class="favourites-section section-padding-80" style="padding: 80px 0; background-color: #f9f9f9;">
    <div class="container-fluid">
        <!-- Favourites Heading -->
        <div class="section-title text-center" style="margin-bottom: 50px;">
            <h2 style="font-size: 36px; font-weight: bold; color: #333; text-transform: uppercase; letter-spacing: 2px;">Favourites</h2>
            <p style="font-size: 18px; color: #777;">Explore some of our most popular items</p>
        </div>
        <div class="row">
            @foreach ($favouriteProducts as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="single-favourite-item" style="background-color: #fff; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); margin-bottom: 30px;">
                    <div class="product-img" style="position: relative; overflow: hidden;">
                        <img src="{{ asset('images/' . $product->image) }}" alt="Product Image" class="img-fluid" style="width: 100%; height: 400px; transition: all 0.3s ease;">
                    </div>
                    <div class="product-details" style="text-align: center; padding: 15px;">
                        <h5 class="product-name" style="font-size: 16px; font-weight: bold; color: #333; margin-bottom: 10px;">{{ $product->name }}</h5>
                        <div class="favourite-icon" style="margin-bottom: 15px;">
                         </div>
                         <a data-slug="{{ $product->slug }}" class="explore-btn btn btn-primary explore-product"
                            style="padding: 10px 20px; font-size: 14px; text-transform: uppercase; font-weight: bold; border-radius: 30px; transition: background-color 0.3s ease; background-color: #007bff; border: none;"
                            onmouseover="this.style.backgroundColor='#333'; this.style.color='#fff'"
                            onmouseout="this.style.backgroundColor='#007bff'; this.style.color='#fff'">
                            Explore
                         </a>
                                             </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</section>