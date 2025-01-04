@if ($openings->isNotEmpty())
@foreach ($openings as $product)
<section class="custom-section section-padding-80 mt-1" style="padding: 80px 0; background-color: #f9f9f9;">
    <div class="container-fluid">
        <div class="row">
             <div class="col-lg-6 col-md-12">
                <img src="{{ asset('images/'.$product->image) }}"   class="img-fluid" style="width: 100%; height: auto; border-radius: 8px;">
            </div>

             <div class="col-lg-6 col-md-12" Style="display: flex;justify-content:center;align-items:center">
                <div class="content-wrapper" style="padding: 20px;">
                    <h2 class="section-heading" style="font-size: 28px; font-weight: bold; color: #333; margin-bottom: 20px;display: flex;justify-content:center;align-items:center">{{$product->heading}}</h2>
                    <p class="section-paragraph" style="font-size: 16px; color: #666; line-height: 1.6;">{{$product->paragraph}}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach
@endif