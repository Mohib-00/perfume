@if($carousels && $carousels->image)
<div class="banner">
    <img class="welcome_area bg-img" src="{{asset('images/' . $carousels->image) }}" alt="Banner Image">  
</div>
@endif
  