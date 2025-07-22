<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    @include('home.css')
</head>
<body>
<div class="hero_area">
        @include('home.header')
        <div class="container">
            <table class="table table-striped table-bordered mt-4">
                <tr class="bg-primary text-white">
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Delivery Status</th>
                    <th>Image</th>
                </tr>
                @foreach($orders as $order)
                <tr>
                    <td>{{$order->product->title}}</td>
                    <td>{{$order->product->price}}</td>
                    <td>
                        @if($order->status == 'In progress')
                        <span style="color:red;">{{$order->status}}</span>
                        @elseif($order->status == 'On the way')
                        <span style="color:skyblue;">{{$order->status}}</span>
                        @else
                        <span style="color:green;">{{$order->status}}</span>
                        @endif
                    </td>
                    @if($order->product->image)
                    <td width=20px><img src="{{'/products/'.$order->product->image}}" width=100 height=100 alt="Image"></td>
                    @else
                    <td></td>
                    @endif
                </tr>
                @endforeach
            </table>
        </div>

</div>
<br><br><br>
@include('home.footer')

</body>
</html>