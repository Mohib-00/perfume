@if ($stories->isNotEmpty())
@foreach ($stories as $product)
<section class="custom-section section-padding-80" style="background-color: #2e2e2e; padding: 80px 0;">
    <div class="container-fluid">
        <div class="row">

             <div class="col-lg-6 col-md-12" style="padding: 0;">
                <img src="{{ asset('images/'.$product->image) }}" alt="Image" class="img-fluid" style="width: 100%; height: auto; border-radius: 8px;">
            </div>

             <div class="col-lg-6 col-md-12 d-flex justify-content-center align-items-center" style="padding: 20px;">
                <div class="text-content storypage" style="color: #fff; text-align: center;">
                    <h2 style="font-size: 28px; font-weight: bold; margin-bottom: 20px;color:white">Our Story</h2>
                    <p style="font-size: 16px; color: #ccc; line-height: 1.6; margin-bottom: 20px;">{{$product->paragraph}}.</p>
                    <a href="#" class="btn btn-primary" style="padding: 10px 20px; font-size: 14px; font-weight: bold; text-transform: uppercase; border-radius: 30px; background-color: #007bff; color: #fff; border: none;" onmouseover="this.style.backgroundColor='#333'" onmouseout="this.style.backgroundColor='#007bff'">Our Story</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach
@endif