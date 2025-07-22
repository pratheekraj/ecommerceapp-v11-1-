<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $users = User::where('userType','user')->get()->count();
        $products = Product::all()->count();
        $orders = Order::all()->count();
        $delivered = Order::where('status','Delivered')->count();
        return view('admin.index',compact('users','products','orders','delivered'));
    }

    public function home(){
        $product = Product::all();
        if(Auth::id()){
            $user_id = Auth::user()->id;
            $count = Cart::where('user_id',$user_id)->count();
        }else{
            $count ='';
        }
        return view('home.index',compact('product','count'));
    }

    public function login_home(){
        $product = Product::all();
        if(Auth::id()){
            $user_id = Auth::user()->id;
            $count = Cart::where('user_id',$user_id)->count();
        }else{
            $count ='';
        }
        return view('home.index',compact('product','count'));
    }
    public function productdetails($id){
        $product = Product::find($id);
        if(Auth::id()){
            $user_id = Auth::user()->id;
            $count = Cart::where('user_id',$user_id)->count();
        }else{
            $count ='';
        }
        return view('home.product-details',compact('product','count'));
    }

    public function addcart($id){
        $product_id = $id;
        $user = Auth::User();
        $user_id = $user->id;
        $cart = new Cart();
        $cart->user_id = $user_id;
        $cart->product_id = $product_id;
        $cart->save();
        toastr()->timeOut(5000)->closeButton()->success('Product added to the cart successfully');

        return redirect()->back();
    }

    public function mycart(){
        if(Auth::id()){
            $user_id = Auth::user()->id;
            $count = Cart::where('user_id',$user_id)->count();
            $cart = Cart::where('user_id',$user_id)->get();
            return view('home.view-mycart',compact('cart','count'));
        }
    }

    public function update_cart(Request $request){
        
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        foreach($cart as $cartdt){
            $order = new Order();
            $order->name= $request->recievername;
            $order->address= $request->recieveraddress;
            $order->phone= $request->recieverphone;
            $order->user_id= Auth::user()->id;
            $order->product_id= $cartdt->product_id;
            $order->save();
        }
        foreach($cart as $cartdt){
            $delete = Cart::find($cartdt->id);
            $delete->delete();
        }

        toastr()->timeOut(5000)->closeButton()->success('Product ordered successfully');
        return redirect()->back();
    }
    
    public function viewmyorders(){
        $user_id = Auth::user()->id;
        $count = Cart::where('user_id',$user_id)->count();
        $orders = Order::where('user_id',$user_id)->get();
        return view('home.myorders',compact('count','orders'));
    }

    public function remove_cart($id){
        $cart = Cart::find($id);
        $cart->delete();
        toastr()->timeOut(5000)->closeButton()->success('Product deleted from the cart successfully');

        return redirect()->back();
    }

    public function stripe($value){
        return view('home.stripe',compact('value'));
    }

    public function stripePost(Request $request,$value){
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
        Stripe\Charge::create ([
                "amount" => $value * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment" 
            ]);
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        foreach($cart as $cartdt){
            $order = new Order();
            $order->name= Auth::user()->name;
            $order->address= Auth::user()->address;
            $order->phone= Auth::user()->phone;
            $order->user_id= Auth::user()->id;
            $order->product_id= $cartdt->product_id;
            $order->payment_status = 'Paid';
            $order->save();
        }
        foreach($cart as $cartdt){
            $delete = Cart::find($cartdt->id);
            $delete->delete();
        }

        toastr()->timeOut(5000)->closeButton()->success('Product ordered successfully');
        return redirect()->back();

    }

    public function shop(){
        $product = Product::all();
        if(Auth::id()){
            $user_id = Auth::user()->id;
            $count = Cart::where('user_id',$user_id)->count();
        }else{
            $count ='';
        }
        return view('home.shop',compact('product','count'));
    }

    public function why(){
        if(Auth::id()){
            $user_id = Auth::user()->id;
            $count = Cart::where('user_id',$user_id)->count();
        }else{
            $count ='';
        }
        return view('home.why',compact('count'));
    }
    public function testimonial(){
        if(Auth::id()){
            $user_id = Auth::user()->id;
            $count = Cart::where('user_id',$user_id)->count();
        }else{
            $count ='';
        }
        return view('home.testimonial',compact('count'));
    }
    public function contact(){
        if(Auth::id()){
            $user_id = Auth::user()->id;
            $count = Cart::where('user_id',$user_id)->count();
        }else{
            $count ='';
        }
        return view('home.contact',compact('count'));
    }
}
