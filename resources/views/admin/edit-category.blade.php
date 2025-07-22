<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
   <style>
    input[type='text']{
        width: 400px;
        height: 42px;
    }
    .divdes{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    </style>
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
                    <h1 style="color:white;">Update Category</h1>
                    <form action="{{url('update-category',$data->id)}}" method="post">
                        @csrf
                        <div class="divdes">
                            <input type="text" name="category" class="form-control" value="{{$data->category_name}}">
                            &emsp;<input type="submit" class="btn btn-primary" value="Update Category"> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>
  </body>
</html>