<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
  </head>
  <body>
  @include('admin.header')
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">
                <div class="container">
                    <h1>Add Product</h1>
                    <form action="{{url('update_product',$product->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Product Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="{{$product->title}}" placeholder="Product title">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" placeholder="Description" rows="3">{{$product->description}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" value="{{$product->price}}" name="price" placeholder="Price">
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{$product->quantity}}" placeholder="Quantity">
                        </div>
                    
                        <div class="mb-3">
                            <label for="category" class="form-label">Product Category</label>
                            <select class="form-control" id="category" name="category"  placeholder="Product Category">
                                @foreach($category as $catgry)
                            
                                    <option value="{{$catgry->category_name}}"  {{($product->category === $catgry->category_name)?'selected':''}}>{{$catgry->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Current Image</label>
                            <img src="{{'/products/'.$product->image}}" width=200 height=150>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" name="image" id="image" alt="_Image">
                        </div>
                        <div class="mb-3 float-end">
                            <button class="btn btn-success" type="submit">Update Product</buttom>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript files-->
   @include('admin.js')
</html>