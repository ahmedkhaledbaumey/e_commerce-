<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function  redirect()
    {
        if (Auth::user()->role == "admin") {


                $categories = Category::all();
                $products = Product::all();
                return view('admin.products.index', compact(['products', 'categories']));
           } else {
            $categories = Category::all();
            $products = Product::all();
            return view('User.home', compact(['products', 'categories']));
        };
    }
    // public function a(){
    //     return view('user.a');
    // }
}
