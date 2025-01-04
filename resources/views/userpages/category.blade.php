@if ($showcaseimages->isNotEmpty())
<div class="top_catagory_area section-padding-80 clearfix">
    <div class="container-fluid">
        <div class="row justify-content-center">

            
            @foreach ($showcaseimages as $product)

             <div class="col-6 col-sm-4 col-md-2 my-2">
                <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img"style="background-image: url({{ asset('images/'.$product->image) }});height:400px">
                    <div class="catagory-content">
                        <a href="#">{{$product->name}}</a>
                    </div>
                </div>
            </div>

            @endforeach
            

        </div>
    </div>
</div>
@endif