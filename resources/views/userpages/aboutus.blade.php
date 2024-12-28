<!DOCTYPE html>
<html lang="en">

<head>
     @include('userpages.css')
</head>

<body>
    @include('userpages.header')
    @include('userpages.cartmodel')
     
    <div class="container py-5">
        <div class="row justify-content-center my-5">

            <div class="col-lg-6 col-md-12 d-flex justify-content-center">
                <img src="{{asset('dummy.png')}}" alt="Descriptive Alt Text" class="img-fluid" style="max-width: 100%; height: auto;">
            </div>
            <!-- Big Paragraph -->
            <div class="col-12 text-center mb-4 my-5">
                <h4>Our Story</h4>
                <i style="font-size: 1.5rem; line-height: 2rem;color:black">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.

                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.

                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.

                </i>
            </div>
        </div>
    </div>



    <div class="container-fluid py-5">
        <div class="row">
            <!-- Image Section -->
            <div class="col-12">
                <img src="{{asset('dummy.png')}}" alt="Descriptive Alt Text" class="img-fluid" style="width: 100%; max-height: 500px;  ">
            </div>
        </div>
    </div>
    
    <div class="container py-5">
        <!-- Section Heading -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">Get in Touch</h2>
            <p class="text-muted">Have questions or feedback? Fill out the form below, and we’ll respond promptly!</p>
        </div>
    
        <!-- Form Section -->
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <form class="p-4 shadow rounded" style="background-color: #f8f9fa;">
                    <!-- Row 1: Name and Phone -->
                    <div class="row">
                        <div class="col-lg-6 col-md-12 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control border-0 shadow-sm" id="name" required>
                        </div>
                        <div class="col-lg-6 col-md-12 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" class="form-control border-0 shadow-sm" id="phone"" required>
                        </div>
                    </div>
    
                    <!-- Row 2: Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control border-0 shadow-sm" id="email" required>
                    </div>
    
                    <!-- Row 3: Message -->
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea rows="10" class="form-control border-0 shadow-sm" id="message" placeholder="Write your message here" required></textarea>
                    </div>
    
                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5 py-2 shadow-sm">Send Message</button>
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