<!DOCTYPE html>
<html lang="en">

<head>
     @include('userpages.css')
</head>

<body>
     @include('userpages.header')
     @include('userpages.cartmodel')

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url({{asset('essence/img/bg-img/breadcumb.jpg')}};">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2> </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
     <section class="shop_grid_area section-padding-80">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                         <div class="widget catagory mb-50">
                            <h2 class="mx-5 mt-5">Women's Fragrance</h2>
                            <p style="margin:0px 20px 0px 50px">Discover our Travel Collection, featuring pocket-sized 10ml bottles that are perfect for your on-the-go lifestyle. Easily slip one into your bag for a quick refresh throughout the day or pack several for your next adventure. Whether you're commuting to work or embarking on a journey, our travel size perfumes are the ideal companions for keeping you beautifully scented wherever you go.</p>
                        </div>

                        <div class="product-sorting d-flex mx-5">
                            <p class="mt-1">Sort by:</p>
                            <form class="mx-1" action="#" method="get">
                                <select name="select" id="sortByselect">
                                    <option value="value">Highest Rated</option>
                                    <option value="value">Newest</option>
                                    <option value="value">Price: $$ - $</option>
                                    <option value="value">Price: $ - $$</option>
                                </select>
                                <input type="submit" class="d-none" value="">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                     
                                </div>
                            </div>
                        </div>

                        <div class="row all">
                            <!-- Repeat this product structure for each product -->
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('essence/img/product-img/product-2.jpg')}}" alt="">
                                        <img class="hover-img" src="{{asset('essence/img/product-img/product-3.jpg')}}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Repeat for other products -->
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('essence/img/product-img/product-2.jpg')}}" alt="">
                                        <img class="hover-img" src="{{asset('essence/img/product-img/product-3.jpg')}}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('essence/img/product-img/product-2.jpg')}}" alt="">
                                        <img class="hover-img" src="{{asset('essence/img/product-img/product-3.jpg')}}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('essence/img/product-img/product-2.jpg')}}" alt="">
                                        <img class="hover-img" src="{{asset('essence/img/product-img/product-3.jpg')}}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('essence/img/product-img/product-2.jpg')}}" alt="">
                                        <img class="hover-img" src="{{asset('essence/img/product-img/product-3.jpg')}}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('essence/img/product-img/product-2.jpg')}}" alt="">
                                        <img class="hover-img" src="{{asset('essence/img/product-img/product-3.jpg')}}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('essence/img/product-img/product-2.jpg')}}" alt="">
                                        <img class="hover-img" src="{{asset('essence/img/product-img/product-3.jpg')}}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('essence/img/product-img/product-2.jpg')}}" alt="">
                                        <img class="hover-img" src="{{asset('essence/img/product-img/product-3.jpg')}}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('essence/img/product-img/product-2.jpg')}}" alt="">
                                        <img class="hover-img" src="{{asset('essence/img/product-img/product-3.jpg')}}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('essence/img/product-img/product-2.jpg')}}" alt="">
                                        <img class="hover-img" src="{{asset('essence/img/product-img/product-3.jpg')}}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('essence/img/product-img/product-2.jpg')}}" alt="">
                                        <img class="hover-img" src="{{asset('essence/img/product-img/product-3.jpg')}}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('essence/img/product-img/product-2.jpg')}}" alt="">
                                        <img class="hover-img" src="{{asset('essence/img/product-img/product-3.jpg')}}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('essence/img/product-img/product-2.jpg')}}" alt="">
                                        <img class="hover-img" src="{{asset('essence/img/product-img/product-3.jpg')}}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('essence/img/product-img/product-2.jpg')}}" alt="">
                                        <img class="hover-img" src="{{asset('essence/img/product-img/product-3.jpg')}}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('essence/img/product-img/product-2.jpg')}}" alt="">
                                        <img class="hover-img" src="{{asset('essence/img/product-img/product-3.jpg')}}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('essence/img/product-img/product-2.jpg')}}" alt="">
                                        <img class="hover-img" src="{{asset('essence/img/product-img/product-3.jpg')}}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <div class="product-img">
                                        <img src="{{asset('essence/img/product-img/product-2.jpg')}}" alt="">
                                        <img class="hover-img" src="{{asset('essence/img/product-img/product-3.jpg')}}" alt="">
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>
                                    <div class="product-description">
                                        <span>topshop</span>
                                        <a href="single-product-details.html">
                                            <h6>Knot Front Mini Dress</h6>
                                        </a>
                                        <p class="product-price">$80.00</p>
                                        <div class="hover-content">
                                            <div class="add-to-cart-btn">
                                                <a href="#" class="btn essence-btn">Add to Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Repeat this for more products -->
                        </div>
                        
                       
                         
                    </div>
                    <!-- Pagination -->
                    <nav class="paginationforall" aria-label="navigation">
                        <ul class="pagination mt-50 mb-70">
                            <li class="page-item" data-page="prev"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                             
                            <li class="page-item" data-page="next"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </nav>
                    

                   

                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->

    
    @include('userpages.footer') 
    @include('userpages.js')
    @include('ajax')

</body>

</html>