<!DOCTYPE html>
<html>
<head>
    @include('home.css')
</head>
<body>
    <div class="hero_area">
        @include('home.header')
    </div>
    <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
          <h3 class="mx-5 text-primary">{{$product->title}}</h3>
            <div class="d-flex justify-content-center">
            <img src="/products/{{$product->image}}" width=200 alt="">
            </div>
            <div class="detail-box">
                
                <h6>Price : <span>{{$product->price}}</span></h6>
            </div>
            <div class="detail-box">
                <h6>Category : {{$product->title}}</h6>
                <h6>Availabel Quantity : {{$product->price}}</span></h6>
            </div>
            <div class="detail-box pt-3">
                <h6>{{$product->description}}</h6>
                
            </div>
            <div class="detail-box pt-2">
              <a href="{{url('add_cart',$product->id)}}" class="btn btn-primary text-white mx-3">Add to cart</a>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>
    @include('home.contact')
    <br><br><br>

    @include('home.footer')
 
</body>
</html>