<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Thank you for your order, {{ $order->customer->first_name }}!</h1>
    <p>Order ID: {{ $order->id }}</p>
    <p>Total: Rs:{{ $order->total }}</p>
    <p>We will notify you when your order is shipped.</p>
</body>
</html>
