<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">
        @foreach($product as $prod)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="{{url('product_details',$prod->id)}}">
              <div class="img-box">
                <img src="products/{{$prod->image}}" alt="">
              </div>
              <div class="detail-box">
                <h6>{{$prod->title}}</h6>
                <h6>Price : <span>{{$prod->price}}</span></h6>
              </div>
              <div class="d-flex mt-3">
                <a href="{{url('product_details',$prod->id)}}" class="btn btn-info text-white">Details</a>
                <a href="{{url('add_cart',$prod->id)}}" class="btn btn-primary text-white mx-3">Add to cart</a>
              </div>
            </a>
          </div>
        </div>
        @endforeach
      </div>
      
    </div>
  </section>