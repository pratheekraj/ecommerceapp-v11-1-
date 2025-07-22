<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Details</title>
</head>
<body>
    <center>
        <h3>Name : {{$order->name}}</h3>
        <h3>Address : {{$order->address}}</h3>
        <h3>Phone : {{$order->phone}}</h3>
        <h3>Product Title : {{$order->product->title}}</h3>
        <h3>Product Price : {{$order->product->price}}</h3>
        <img src="{{'products/'.$order->product->image}}" width=300 height=250 alt="">
    </center>
</body>
</html>