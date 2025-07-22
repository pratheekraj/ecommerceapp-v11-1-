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
                    <h2>All Orders</h2>
                    <table class="table table-striped table-bordered text-white mt-4">
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Product Title</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Payment Status</th>
                            <th>Status</th>
                            <th>Change Status</th>
                            <th>Print PDF</th>
                        </tr>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$order->name}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->phone}}</td>
                            <td>{{$order->product->title}}</td>
                            <td>{{$order->product->price}}</td>
                            @if($order->product->image)
                            <td width=20px><img src="{{'/products/'.$order->product->image }}" width=100 height=100 alt="Image"></td>
                            @else
                            <td></td>
                            @endif
                            <td>{{$order->payment_status}}</td>
                            <td>
                                @if($order->status == 'In progress')
                                <span style="color:red;">{{$order->status}}</span>
                                @elseif($order->status == 'On the way')
                                <span style="color:skyblue;">{{$order->status}}</span>
                                @else
                                <span style="color:green;">{{$order->status}}</span>
                                @endif
                                
                            </td>
                            <td>
                                <a href="{{url('on_the_way',$order->id)}}" class="btn btn-danger">On the way</a>
                                <a href="{{url('delivered',$order->id)}}" class="btn btn-success">Delivered</a>

                            </td>
                            <td> <a href="{{url('print_PDF',$order->id)}}" class="btn btn-secondary">Print PDF</a></td>

                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>