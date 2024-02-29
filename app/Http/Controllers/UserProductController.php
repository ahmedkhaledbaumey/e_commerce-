<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\order;
use App\Models\orderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('User.home', compact(['products', 'categories']));
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('user.products.show', compact('product'));
    }

    public function search(Request $request)
    {
        $key = $request->key;
        $products = Product::where('title', 'like', "%$key%")
            ->orWhere('desc', 'like', "%$key%")
            ->orWhere('price', 'like', "%$key%")
            ->get();
        return view('User.home', compact('products'));
    }





    public function add_to_cart($id, Request $request)
    {
        $qyt = $request->qyt;
        $product = Product::findOrFail($id);
        $cart = session()->get("cart");

        if (!$cart) {
            $cart = [
                $id => [
                    "title" => $product->title,
                    "price" => $product->price,
                    "image" => $product->image,
                    "qyt" => $qyt,
                ]
            ];
        } else {
            if (isset($cart[$id])) {
                $cart[$id]["qyt"] += $qyt;
            } else {
                $cart[$id] = [
                    "title" => $product->title,
                    "price" => $product->price,
                    "image" => $product->image,
                    "qyt" => $qyt
                ];
            }
        }

        session()->put("cart", $cart);
        session()->save(); // Add this line to save changes immediately
        // session()->flush();


        // Debugging: Dump the updated cart
        // dd(session()->get("cart"));

        // You may return a response or redirect here
        return redirect()->back()->with("success", "added success");
    }





    // public function add_to_cart($id, Request $request)
    // {
    //     $qyt  = $request->qyt;
    //     $product = Product::findOrFail($id);
    //     $cart = session()->get("cart");
    //     // dd($cart) ;
    //     if (!$cart) {

    //         $cart = [

    //             $id => [
    //                 "title" => $product->title,
    //                 "price" => $product->price,
    //                 "image" => $product->image,
    //                 "qyt" => $qyt,
    //             ]
    //         ];
    //         session()->put("cart", $cart);
    //                   dd(session()->get("cart"));

    //         // return redirect()->back()->with("success", "added success");
    //     } else {

    //         if (isset($cart[$id])) {

    //             $cart[$id]["qyt"] += $qyt;
    //         }
    //         $cart[$id] = [
    //             "title" => $product->title,
    //             "price" => $product->price,
    //             "image" => $product->image,
    //             "qyt" => $qyt
    //         ];
    //         session()->put("cart", $cart);
    //         session_destroy() ;
    //                    dd(session()->get("cart"));

    //         // return redirect()->back()->with("success", "added success");
    //     }
    //     //create  cart
    //     //add to cart

    // }





    public function mycart()
    {
        //  dd(session()->get("cart"));

        $products = session()->get("cart");
        $user = Auth::user();
        return view('User.products.myCart', compact("products"));
    }

    public function makeOrder(Request $request)
    {
        $user_id = Auth::user()->id;
        $day = $request->day;
        $products = session()->get("cart");

        if ($products) {
            $order = Order::create([
                "requiredDate" => $day,
                "user_id" => $user_id,
            ]);

            foreach ($products as $id => $product) {
                OrderDetails::create([
                    "order_id" => $order->id,
                    "product_id" => $id,
                    "qyt" => $product['qyt'],
                    "price" => $product['price'],
                ]);
            }

            // Remove the specific key related to the order data from the session
            $cartKey = "cart";
            if (session()->has($cartKey)) {
                session()->forget($cartKey);
            }

            return redirect(route("user"))->with("success", "Order Confirmed");
        } else {
            // Handle the case where there are no products in the cart
            return redirect(route("user"))->with("error", "No products in the cart");
        }
    }


    // public function makeOrder(Request $request)
    // {
    //     $user_id = Auth::user()->id;
    //     // $requierd_date = $request->requierd_date;
    //     $requierd_date = $request->requierd_date;
    //     //ا لوقت الي انت محتاج الطلب يوصل فيه
    //     $products = session()->get("cart");
    //     $order = order::create([
    //         "requierdDate" => $requierd_date,

    //         "user_id" => $user_id,

    //     ]);
    //     foreach ($products  as $id => $product) {
    //         orderDetails::create([
    //             "order_id" => $order->id,
    //             "product_id" => $id,
    //             "qyt" => $product['qyt'],
    //             "price" => $product['price'],



    //         ]);
    //     }
    //     return redirect(route("user"))->with("success", "Order Confirmed");
    // }
}
