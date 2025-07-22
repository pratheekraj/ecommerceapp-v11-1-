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
                <div class="container-fluid">
                <h1>View Product</h1>
                    <form action="{{url('search_product')}}" method="get">
                        <div class="mt-5 d-flex" style="width:400px;">
                            <input type="text" class="form-control" name="search">&emsp;<button type="submit" class="btn btn-secondary">Search</button>
                        </div>
                    </form>
                
                <table class="table table-striped table-bordered text-white mt-4">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($product as $prod)
                    <tr>
                        <td>{{$prod->title}}</td>
                        <td>{!!Str::limit($prod->description,50)!!}</td>
                        <td>{{$prod->price}}</td>
                        <td>{{$prod->quantity}}</td>
                        <td>{{$prod->category}}</td>
                        @if($prod->image)
                        <td width=20px><img src="{{'/products/'.$prod->image}}" width=100 height=100 alt="Image"></td>
                        @else
                        <td></td>
                        @endif
                        <td width=20px><a href="{{url('edit_product',$prod->id)}}" class="btn btn-success">Edit</a></td>
                        <td width=20px><a href="{{url('delete_product',$prod->id)}}" class="btn btn-danger" onclick="deleteCategory(event)">Delete</a></td>

                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="mt-3">
                {{$product->onEachSide(1)->links()}}
            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>