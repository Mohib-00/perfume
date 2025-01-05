<!DOCTYPE html>
<html lang="en">

<head>
     @include('userpages.css')
</head>

<body>
    @include('userpages.header')
    @include('userpages.cartmodel')
     
    <div class="container py-5">
        <div class="row justify-content-center">
            @if ($stories->isNotEmpty())
            @foreach ($stories as $product)
            <div class="col-lg-6 col-md-12 d-flex justify-content-center">
                <img style="margin-top:50px" src="{{ asset('images/'.$product->image_story) }}" alt="Descriptive Alt Text" class="img-fluid" style="max-width: 100%; height: 500px;">
            </div>
             <div class="col-12 text-center mb-4 my-5">
                <h4>{{$product->heading_story}}</h4>
                <i style="font-size: 1.5rem; line-height: 2rem;color:black">
                   {{$product->paragraph_story}}
                </i>
            </div>
        </div>
    </div>



    <div class="container-fluid">
        <div class="row">
             <div class="col-12">
                <img src="{{ asset('images/'.$product->image_1) }}" alt="Descriptive Alt Text" class="img-fluid" style="width: 100%; max-height: 500px;  ">
            </div>
        </div>
    </div>
    @endforeach
    @endif
    
    <div class="container py-5">
         <div class="text-center mb-5">
            <h2 class="fw-bold">Get in Touch</h2>
            <p class="text-muted">Have questions or feedback? Fill out the form below, and we’ll respond promptly!</p>
        </div>
    
         <div class="row justify-content-center">
            <div class="col-lg-12">
                <form id="contactForm" class="bg-light p-4 p-md-5 contact-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Your Name">
                            <small class="text-danger" id="error-name"></small>
                        </div>
                
                        <div class="col-md-6 form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Your Email">
                            <small class="text-danger" id="error-email"></small>
                        </div>
                
                        <div class="col-md-12 form-group">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" name="phone" class="form-control" placeholder="Phone">
                            <small class="text-danger" id="error-phone"></small>
                        </div>
                
                        <div class="col-md-12 form-group">
                            <label for="message" class="form-label">Message</label>
                            <textarea rows="10" name="message" class="form-control" placeholder="Message"></textarea>
                            <small class="text-danger" id="error-message"></small>
                        </div>
                
                        <div class="col-md-12 form-group">
                            <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

      
    @include('userpages.footer')
    @include('userpages.js')
    @include('ajax')
</body>

</html>