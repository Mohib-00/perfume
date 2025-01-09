<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Thank you for your order, {{ $order->customer->first_name }}!</h1>
    <p>SubTotal: Rs: {{ $order->total }}</p>
    <p>We will notify you when your order is shipped.</p>

    <h2>Order Details:</h2>
    <table cellpadding="10">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Option</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $orderItem)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $orderItem->product->name }}</td>
                <td>
                    @if($orderItem->option)
                        {{ $orderItem->option->option }}
                    @else
                        No Option
                    @endif
                </td>
                <td>Rs: 
                    @if($orderItem->product->discount_price)
                        {{ $orderItem->product->discount_price }}
                    @else
                        {{ $orderItem->price }}
                    @endif
                </td>
                <td>{{ $orderItem->quantity }}</td>
                <td>Rs:{{ $orderItem->quantity * $orderItem->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    

    <p>If you have any questions, feel free to contact us!</p>
</body>
</html>
