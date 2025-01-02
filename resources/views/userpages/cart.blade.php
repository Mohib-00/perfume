<!DOCTYPE html>
<html lang="en">

<head>
    @include('userpages.css')
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        
        .container-fluid {
            padding: 30px;
        }

        .table {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .thead-dark {
            background-color: #343a40;
            color: #fff;
        }

        .table th,
        .table td {
            padding: 15px;
            font-size: 16px;
            text-align: center;
        }

        .table img {
            border-radius: 5px;
        }

        .input-group-btn button {
            border-radius: 5px;
            background-color: #007bff;
            color: white;
        }

        .input-group-btn button:hover {
            background-color: #0056b3;
        }

        .form-control-sm {
            border-radius: 5px;
            background-color: #f1f1f1;
        }

        .btn-danger {
            border-radius: 5px;
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-primary {
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            color: #555;
        }

        .bg-light {
            background-color: #f8f9fa;
        }

        .cart-summary {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .cart-summary h6 {
            font-size: 16px;
        }

        .cart-summary h5 {
            font-size: 18px;
            font-weight: bold;
        }

        /* Media Queries for responsiveness */
        @media (max-width: 767px) {
            .col-lg-8,
            .col-lg-4 {
                width: 100%;
                padding-left: 0;
                padding-right: 0;
                margin-bottom: 20px;
            }

            .cart-summary {
                padding: 15px;
            }

            .table th,
            .table td {
                padding: 10px;
                font-size: 14px;
            }

            .input-group {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    @include('userpages.header')
    <div class="container-fluid">
        <div class="row px-xl-5">
             <div class="col-lg-8 table-responsive mt-5">
                <table class="table table-light table-borderless table-hover mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Size</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartItems as $cartItem)
                            <tr>
                                <td class="align-middle">
                                    <img height="100" width="100" src="{{ asset('images/' . $cartItem->product->image) }}" 
                                         alt="{{ $cartItem->product->name }}">
                                </td>
                                <td class="align-middle">{{ $cartItem->product->name }}</td>
                                <td class="align-middle">
                                    @if ($cartItem->product->discount_price)
                                        Rs:{{ number_format($cartItem->product->discount_price) }}
                                    @else
                                        Rs:{{ number_format($cartItem->product->price) }}
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-danger btn-minus update-quantity" 
                                                    data-action="decrease" 
                                                    data-id="{{ $cartItem->id }}">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" 
                                               value="{{ $cartItem->quantity }}" 
                                               id="quantity-{{ $cartItem->id }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus update-quantity" 
                                                    data-action="increase" 
                                                    data-id="{{ $cartItem->id }}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    {{ App\Models\Option::where('product_id', $cartItem->product_id)
                                    ->where('id', $cartItem->option_id)
                                    ->first()
                                    ->option ?? 'N/A' }}                                
                                </td>
                                <td class="align-middle" id="total-{{ $cartItem->id }}">
                                    Rs:{{ number_format($cartItem->total) }}
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-sm btn-danger remove-cart-item" 
                                            data-id="{{ $cartItem->id }}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>

             <div class="col-lg-4 mt-5">
                 
                <div class="cart-summary bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subtotal">Rs:{{ number_format($subtotal) }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">Rs:{{ number_format($deliveryCharges) }}</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="total-price">Rs:{{ number_format($subtotal + $deliveryCharges) }}</h5>
                        </div>
                        @if ($cartItems->isNotEmpty())
                         <button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                    @else
                         <button class="btn btn-block btn-secondary my-3 py-3" style="cursor: not-allowed;" disabled>
                            Cart is Empty
                        </button>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('userpages.footer')
    @include('userpages.js')
    @include('ajax')
</body>

</html>
