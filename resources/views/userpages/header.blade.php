 
<div id="whatsapp-chat">      
    <a href="#" class="whatsapp" id="whatsapp-link" target="_blank">
        <span class="whatsapp-text">Need Help? Chat with Us</span>
        <img src="{{ asset('whatsapp.jpg') }}" alt="Chat with Us" />
    </a>     
</div>

<header class="header_area">

    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">

        
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand">
                <img class="nav-brandimg" src="{{ asset('images/' . $settings->image) }}" alt="Logo" style="height: 160px; width: auto;">
            </a>
            
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
                                    <li style="font-size:25px" class="title womenfragrances">{{$headersettings->heading1}}</li>
                                </ul>
                                
                                <ul class="single-mega cn-col-4">
                                    <li style="font-size:25px" class="title menfragrances">{{$headersettings->heading2}}</li>
                                     
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li style="font-size:25px" class="title travel">{{$headersettings->heading3}}</li>
                                </ul>
                                

                                <div class="single-mega cn-col-4">
                                    <img style="width:100%;height:400px" src="{{ asset('images/' . $headersettings->image) }}" alt="">
                                </div>

                                <ul class="single-mega cn-col-4">
                                    <li style="font-size:25px" class="title discovery">{{$headersettings->heading4}}</li>
                                </ul>

                                <ul class="single-mega cn-col-4">
                                    <li style="font-size:25px" class="title viewcollection">{{$headersettings->heading5}}</li>
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
                    <form action="{{ route('search') }}" method="GET">
                        <input type="search" name="search" id="headerSearch" placeholder="Type for Search">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
                
            <div class="favourite-area">
                <a class="wishlistpage">
                    <svg class="element" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                     </svg>
                    <span>{{ isset($wishlistCount) ? $wishlistCount : 0 }}</span>
                </a>
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
                <a class="signIn sigininelemnt"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                  </svg>
                </a>
            </div>
            
            @endif

             <div class="cart-area opencart">
                <a id="essenceCartBtn"><svg class="element" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart-check" viewBox="0 0 16 16">
                    <path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                  </svg> <span>{{ $cartCount }}</span>
                </a>
            </div>
        </div>
    </div>
</header>