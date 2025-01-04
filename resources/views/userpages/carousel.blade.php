@if($carousels && $carousels->image)
<div class="banner">
    <img class="welcome_area bg-img" style="margin-top:80px" src="{{asset('images/' . $carousels->image) }}" alt="Banner Image">  
</div>
@endif
  