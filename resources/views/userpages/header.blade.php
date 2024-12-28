 
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
                        <li><a>Shop</a>
                            <ul class="dropdown">
                                <li><a class="shop">Women's Collection</a></li>
                                <li><a class="mens-collection">Men's Collection</a></li>
                                <li><a class="kids-collection">Kid's Collection</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a class="home">Home</a></li>
                                <li><a class="shop">Shop</a></li>
                                <li><a>Product Details</a></li>
                                <li><a>Checkout</a></li>
                                <li><a>Blog</a></li>
                                <li><a>Single Blog</a></li>
                                <li><a>Regular Page</a></li>
                                <li><a>Contact</a></li>
                            </ul>
                        </li>
                        <li><a>Blog</a></li>
                        <li><a>Contact</a></li>
                     </ul>
                </div>
                <!-- Nav End -->
            </div>
        </nav>

        <!-- Header Meta Data -->
        <div class="header-meta d-flex clearfix justify-content-end">
            <!-- Search Area -->
            <div class="search-area">
                <form action="#" method="post">
                    <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <!-- Favourite Area -->
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

            <!-- Cart Area -->
            <div class="cart-area">
                <a href="#" id="essenceCartBtn"><img src="{{asset('essence/img/core-img/bag.svg')}}" alt=""> <span>3</span></a>
            </div>
        </div>
    </div>
</header>
