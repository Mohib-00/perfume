<!DOCTYPE html>
<html lang="en">

<head>
     @include('userpages.css')
     <style>
        
        .container {
            text-align: center;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 80%;
            max-width: 600px;
        }
        h1 {
            margin: 0;
            font-size: 32px;
        }
    </style>
</head>

<body>
     @include('userpages.header')
     <div class="container">
        <h1>Terms of Service</h1>
    </div>
     @include('userpages.footer')
     @include('userpages.js')
     @include('ajax')
</body>

</html>