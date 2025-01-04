 
<div id="whatsapp-chat">      
    <a href="#" class="whatsapp" id="whatsapp-link" target="_blank">
        <span class="whatsapp-text">Need Help? Chat with Us</span>
        <img src="{{ asset('whatsapp.jpg') }}" alt="Chat with Us" />
    </a>     
</div>

<header class="header_area">
    <!-- Notification Bar -->
<div style="background-color: black; text-align: center; padding: 15px; font-weight: bold; color: white;">
    FREE SHIPPING ON ORDERS ABOVE PKR 8000
</div>
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">

        
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand"><img src="{{asset('essence/img/core-img/logo.png')}}" alt=""></a>
            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
                <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>
            <!-- Menu -->
            <div class="classy-menu">
                <!-- close btn -->
                <div class="classycloseIcon">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>
                <!-- Nav Start -->
                <div class="classynav">
                    <ul>
                        <li><a class="home">Home</a></li>
                        <li><a href="#">Perfumes</a>
                            <div class="megamenu">
                                <ul class="single-mega cn-col-4">
                                    <li style="font-size:25px" class="title womenfragrances">Women's Fragrances</li>
                                </ul>
                                
                                <ul class="single-mega cn-col-4">
                                    <li style="font-size:25px" class="title menfragrances">Men's Fragrances</li>
                                     
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li style="font-size:25px" class="title travel">Travel Size</li>
                                </ul>
                                

                                <div class="single-mega cn-col-4">
                                    <img style="width:100%" src="{{asset('fragrance.jpg')}}" alt="">
                                </div>

                                <ul class="single-mega cn-col-4">
                                    <li style="font-size:25px" class="title discovery">Discovery</li>
                                </ul>

                                <ul class="single-mega cn-col-4">
                                    <li style="font-size:25px" class="title viewcollection">View Collection</li>
                                </ul>
                                 
                            </div>
                        </li>
                        
                        <li><a class="openblogs">Blog</a></li>
                        <li><a class="contacttttttt">Contact</a></li>
                        <li><a class="saleeeee">Sale</a></li>
                     </ul>
                </div>
             </div>
        </nav>

         <div class="header-meta d-flex clearfix justify-content-end">
             <div class="search-area">
                <form action="#" method="post">
                    <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
             <div class="favourite-area">
                <a href="#"><img src="{{asset('essence/img/core-img/heart.svg')}}" alt=""></a>
            </div>
            @if ($user)
            <div class="user-dropdown mt-2">
                <input type="checkbox" id="dropdownToggle" class="dropdown-checkbox">
                <label for="dropdownToggle" class="user-name" style="white-space: nowrap; cursor: pointer;">
                    {{ $user->name }} <span style="font-size: 0.8em; margin-left: 5px;">▼</span>
                </label>
                <div class="dropdown-menu">
                    <a class="logoutuser">Logout</a>
                </div>
            </div>
            @else
            <div class="user-login-info">
                <a class="signUp">SignUp</a>
            </div>
            <div class="user-login-info">
                <a class="signIn">SignIn</a>
            </div>
            @endif

             <div class="cart-area opencart">
                <a id="essenceCartBtn"><img  src="{{asset('essence/img/core-img/bag.svg')}}" alt=""> <span>{{ $cartCount }}</span>
                </a>
            </div>
        </div>
    </div>
</header>
