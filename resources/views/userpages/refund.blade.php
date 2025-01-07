<!DOCTYPE html>
<html lang="en">

<head>
     @include('userpages.css')
     
</head>

<body>
     @include('userpages.header')
     @if ($terms->isNotEmpty())
     
     <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            @foreach ($terms as $term)
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        @if (!empty($term->paragraph))
                        <h1>{{$term->main_heading}}</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    
        <div class="container-fluid" style="display: flex; justify-content: center; align-items: center; padding: 20px;">
            <div class="row" style="width: 100%; max-width: 800px;">
                <div class="col-12">
                    @if (!empty($term->sub_heading))
                        <h5 class="no-margin" style="text-align: left;">{{$term->sub_heading}}</h5>
                    @endif
        
                    @if (!empty($term->paragraph))
                        <p class="no-margin">{{$term->paragraph}}</p>
                    @endif
                </div>
            </div>
        </div>
        
        @endforeach
        
        
        
    </section>
    @endif
     @include('userpages.footer')
     @include('userpages.js')
     @include('ajax')
</body>

</html>