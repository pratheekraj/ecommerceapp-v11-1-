<?php

namespace App\Http\Controllers;
use Yoeunes\Toastr\Facades\Toastr;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function view_category(){
        $data = Category::all();
        return view('admin.category',compact('data'));
    }

    public function add_category(Request $request){
        $category = new Category();
        $category->category_name = $request->category;
        $category->save();
        toastr()->timeOut(5000)->closeButton()->success('Category added successfully');
        return redirect()->back();
    }

    public function deletecategory($id){
        $data = Category::findorfail($id);
        $data->delete();
        toastr()->timeOut(5000)->closeButton()->success('Category deleted successfully');
        return redirect()->back();
    }

    public function editcategory($id){
        $data = Category::findorfail($id);
        return view('admin.edit-category',compact('data'));
    }

    public function updatecategory(Request $request,$id){
        $category = Category::findorfail($id);
        $category->category_name = $request->category;
        $category->save();
        toastr()->timeOut(5000)->closeButton()->success('Category updated successfully');
        return redirect('/view_category');
    }

    public function addproduct(){
        $category = Category::all();
        return view('admin.add-product',compact('category'));
    }

    public function uploadproduct(Request $request){
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        // $image = $request->image;
        // $image = $request->file('image');
        if($request->image){
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move('products',$imagename);
            $product->image = $imagename; 
        }
        
        $product->save();
        toastr()->timeOut(5000)->closeButton()->success('Product added successfully');
        return redirect()->back();
    }

    public function viewproduct(){
        $product = Product::paginate(5);
        return view('admin.product-view',compact('product'));
    }

    public function deleteproduct($id){
        $product = Product::find($id);
        $image = public_path('products/'.$product->image);
        if(file_exists($image)){
            unlink($image);
        }
        $product->delete();
        toastr()->timeOut(5000)->closeButton()->success('Product deleted successfully');
        return redirect()->back();
    }
    
    public function editproduct($id){
        $product = Product::find($id);
        $category = Category::all();

        return view('admin.product-edit',compact('product','category'));
    }

    public function updateproduct($id,Request $request){
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        if($request->image){
            $image = public_path('products/'.$product->image);
            if(file_exists($image)){
                unlink($image);
            }
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move('products',$imagename);
            $product->image = $imagename; 
        }
        $product->save();
        toastr()->timeOut(5000)->closeButton()->success('Product updated successfully');
        return redirect('/view_product');
    }

    public function searchproduct(Request $request){
        $search = $request->search;
        $product = Product::where('title','like','%'.$search.'%')->Orwhere('category','like','%'.$search.'%')->paginate(5);

        return view('admin.product-view',compact('product'));
    }

    public function view_orders(){
        $orders = Order::all();
        return view('admin.orders',compact('orders'));
    }

    public function on_the_way($id){
        $orders = Order::find($id);
        $orders->status = 'On the way';
        $orders->save();
        return redirect('/view_orders');
    }

    public function delivered($id){
        $orders = Order::find($id);
        $orders->status = 'Delivered';
        $orders->save();
        return redirect('/view_orders');
    }

    public function print_PDF($id){
        $order = Order::find($id);
        $pdf = Pdf::loadView('admin.invoice',compact('order'));
        return $pdf->download('invoice.pdf');
    }
}
