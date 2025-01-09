<!DOCTYPE html>
<html lang="en">

<head>
    @include('userpages.css')
</head>

<body>
    @include('userpages.header')
    @include('userpages.cartmodel')

    
        <div class="single-blog-wrapper">
            
            <div class="breadcumb_area breadcumb-style-two bg-img" style="background-image: url('{{ asset('essence/img/bg-img/breadcumb2.jpg') }}');">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="page-title text-center">
                                <h2>Our Blog</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($blogs->isNotEmpty())
            @foreach ($blogs as $blog)
                <div class="single-blog-content-wrapper d-flex">
                    <div class="single-blog--text">
                        <h2>{{ $blog->heading }}</h2>
                        <p>{{ $blog->paragraph }}</p>
                    </div>

                    <div class="related-blog-post">
                        <div class="single-related-blog-post my-2">
                            <img src="{{ asset('images/' . $blog->sub_image) }}" alt="">
                        </div>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
     

    @include('userpages.footer')
    @include('userpages.js')
    @include('ajax')
</body>
</html>
