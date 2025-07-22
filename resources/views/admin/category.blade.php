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
    .table-des{
        border:2px solid yellowgreen;
        margin: auto;
        text-align: center;
        margin-top: 20px;
        font-size: 20px;
        width: 600px;
    }
    th{
        background-color: skyblue;
        padding: 15px;
        color: white;
        font-weight: bold;
    }
    td{
        border: 1px solid white;
        padding: 5px;
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
                    <h1 style="color:white;">Add Category</h1>
                    <form action="{{url('add_category')}}" method="post">
                    @csrf    
                    <div class="divdes">
                            <input type="text" class="form-control" name="category">
                            &nbsp;<input type="submit" class="btn btn-primary" value="Add Category">
                        </div>
                    </form>

                    <table class="table-des">
                        <tr>
                            <th>Category Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        @foreach($data as $dt)
                            <tr>
                                <td>{{$dt->category_name}}</td>
                                <td><a href="{{url('edit-category',$dt->id)}}" class="btn btn-success">Edit</a></td>
                                <td><a href="{{url('delete-category',$dt->id)}}" onclick="deleteCategory(event)" class="btn btn-danger">Delete</a></td>
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