<!DOCTYPE html>
<html lang="en">

<head>
     @include('userpages.css')
</head>

<body>
     @include('userpages.header')

     <div class="breadcumb_area bg-img" style="background-image: url('{{ asset('essence/img/bg-img/breadcumb.jpg') }}');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <div class="checkout_area section-padding-80">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-page-heading mb-30">
                            <h5>Billing Address</h5>
                        </div>

                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">First Name <span>*</span></label>
                                    <input name="full_name" type="text" class="form-control" id="first_name">
                                    <span class="text-danger" id="error-full_name"></span>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name">Last Name <span>*</span></label>
                                    <input name="last_name" type="text" class="form-control" id="last_name">
                                    <span class="text-danger" id="error-last_name"></span>
                                </div>
                                 
                                <div class="col-12 mb-3">
                                    <label for="country">Country <span>*</span></label>
                                    <select class="w-100" id="country">
                                        <option value="usa">Pakistan</option>
                                         
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="street_address">Address <span>*</span></label>
                                    <input name="address" type="text" class="form-control mb-3" id="street_address">
                                    <span class="text-danger" id="error-address"></span>
                                 </div>
                               
                                <div class="col-12 mb-3">
                                    <label for="city">Town/City <span>*</span></label>
                                    <input name="city" type="text" class="form-control" id="city" >
                                    <span class="text-danger" id="error-city"></span>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="state">Province <span>*</span></label>
                                    <input name="province" type="text" class="form-control" id="state">
                                    <span class="text-danger" id="error-province"></span>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="phone_number">Phone No <span>*</span></label>
                                    <input name="phone_number" type="number" class="form-control" id="phone_number" min="0">
                                    <span class="text-danger" id="error-phone_number"></span>
                                </div>
                                <div class="col-12 mb-4">
                                    <label  for="email_address">Email Address <span>*</span></label>
                                    <input name="email" type="email" class="form-control" id="email_address">
                                    <span class="text-danger" id="error-email"></span>
                                </div>

                                
                            </div>
                     </div>
                </div>

                <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                    <div class="order-details-confirmation">

                        <div class="cart-page-heading">
                            <h5>Your Order</h5>
                            <p>The Details</p>
                        </div>

                        <ul class="order-details-form mb-4">
                            <li><span>Product Name</span> <span>Total</span></li>
                            @foreach($cartItems as $cartItem)
                            <li>
                                <span>{{ $cartItem->product->name }} ({{ $cartItem->quantity }})</span>
                                <span id="size">Size: 
                                    {{ App\Models\Option::where('product_id', $cartItem->product_id)
                                        ->where('id', $cartItem->option_id)
                                        ->first()
                                        ->option ?? 'N/A' }}
                                </span>
                                
                                <span>Rs:{{ number_format($cartItem->total) }}</span>
                            </li>
                        @endforeach
                        
                            <li><span>Subtotal</span> <span>Rs:{{ number_format($subtotal) }}</span></li>
                            <li><span>Shipping</span> <span>Rs:{{ number_format($shipping) }}</span></li>
                            <li><span>Total</span> <span>Rs:{{ number_format($total) }}</span></li>
                        </ul>
                        

                        <div id="accordion" role="tablist" class="mb-4">
                            <div class="card">
                                <div class="card-header" role="tab" id="headingOne">
                                    <h6 class="mb-0">
                                        <a style="color:black">
                                            <input type="radio" name="payment" id="paypal" value="paypal">
                                            Paypal
                                            <span class="text-danger" id="error-payment-method"></span> 
                                        </a>
                                    </h6>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="headingTwo">
                                    <h6 class="mb-0">
                                        <a style="color:black">
                                            <input class="cod" type="radio" name="payment" id="cash" value="cash on delivery">
                                            Cash on Delivery
                                            <span class="text-danger" id="error-payment-method"></span> <!-- Error span for Cash on Delivery -->
                                        </a>
                                    </h6>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="headingThree">
                                    <h6 class="mb-0">
                                        <a style="color:black">
                                            <input type="radio" name="payment" id="credit-card" value="credit card">
                                            Credit Card
                                            <span class="text-danger" id="error-payment-method"></span> <!-- Error span for Credit Card -->
                                        </a>
                                    </h6>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" role="tab" id="headingFour">
                                    <h6 class="mb-0">
                                        <a style="color:black" href="javascript:void(0);" id="bank-transfer-link">
                                            <input class="cod" type="radio" name="payment" id="bank-transfer" value="bank transfer">
                                            Direct Bank Transfer
                                            <span class="text-danger" id="error-payment-method"></span> <!-- Error span for Bank Transfer -->
                                        </a>
                                    </h6>
                                </div>
                                <div id="bank-details" style="display: none; padding: 10px;">
                                    <h6>Bank Details:</h6>
                                    <p>Bank Name: XYZ Bank</p>
                                    <p>Account Number: 1234567890</p>
                                    <p>IFSC Code: XYZ0001234</p>
                                    <p>Branch: Main Street</p>
                                </div>
                            </div>
                        </div>
                        
                        

                        <a class="btn essence-btn placeorder">Place Order</a>
                        <a style="display:none" class="btn essence-btn debitcardbutton">Pay now</a>
                        <a style="display:none" class="btn essence-btn paypalbtn">Pay now</a>


                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
     @include('userpages.footer')
     @include('userpages.js')
     @include('ajax')

     <script>
        $(document).ready(function() {
            
            $('#bank-transfer').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#bank-details').slideDown();  
                } else {
                    $('#bank-details').slideUp(); 
                }
            });

            $('input[name="payment"]').on('change', function() {
                 if ($(this).val() !== 'bank transfer') {
                    $('#bank-details').slideUp();  
                }
            });
        });
        $(document).ready(function() {
        $("#paypal").click(function() {
            $(".paypalbtn").show(); 
            $(".debitcardbutton").hide();  
            $(".placeorder").hide();
        });
    });
    $(document).ready(function() {
        $(".cod").click(function() {
            $(".paypalbtn").hide(); 
            $(".debitcardbutton").hide();  
            $(".placeorder").show();
        });
    });
    $(document).ready(function() {
        $("#credit-card").click(function() {
            $(".paypalbtn").hide(); 
            $(".debitcardbutton").show();  
            $(".placeorder").hide();
        });
    });
    </script>
     
</body>

</html>