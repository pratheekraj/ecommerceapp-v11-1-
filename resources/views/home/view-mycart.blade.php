<!DOCTYPE html>
<html>
<head>
    @include('home.css')
</head>
<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
    </div>
    <div class="container mt-3 d-flex justify-content-center">
        <div class="col-md-8 mt-3">
            <table class="table table-striped table-bordered"><tr class="text-center bg-primary text-white"><th>Product Name</th><th>Price</th><th>Image</th><th>Remove</th></tr>
            <?php $totAmt = 0; ?>
            @foreach($cart as $cart)
                <tr class="text-center"><td>{{$cart->product->title}}</td><td>{{$cart->product->price}}</td><td><img src="/products/{{$cart->product->image}}" width=100></td><td><a class="btn btn-danger" href="{{url('remove_cart',$cart->id)}}">Remove</a></td></tr>
                <?php $totAmt = $totAmt + $cart->product->price; ?>
            @endforeach    
            </table>
        </div>
        <div class="col-md-4 bg-light mt-3">
            <form action="{{url('update_cart')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="recievername" class="form-label">Reciever Name</label>
                    <input type="text" class="form-control" name="recievername" id="recievername" value="{{Auth::user()->name}}" placeholder="Reciever Name">
                </div>
                <div class="mb-3">
                    <label for="recieveraddress" class="form-label">Reciever Address</label>
                    <textarea class="form-control" name="recieveraddress" id="recieveraddress" placeholder="Reciever Address" rows="3">{{Auth::user()->address}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Reciever Phone No</label>
                    <input type="text" class="form-control" name="recieverphone" id="recieverphone" value="{{Auth::user()->phone}}" placeholder="Reciever Phone No">
                </div>
                <div class="mb-3 float-end">
                    <button class="btn btn-primary" type="submit">Cash on delivery</button>
                    <a class="btn btn-success" href="{{url('stripe',$totAmt)}}">Pay Using Card</a>
                </div>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <mark>Total value of cart is : ${{$totAmt}}</mark>
    </div>
    <br><br><br>
    <!-- end contact section -->
    @include('home.footer')
    <!-- info section -->
</body>
</html>