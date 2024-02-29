<?php

// ApiProductController.php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiProductController extends Controller
{
    public function all()
    {
        $products = Product::all();
        if($products===null)
        {
            return response()->json([
                "msg"=>"Products not found",
                404
            ]);
        }
        return ProductResource::collection($products);
    }
    public function show($id)
    {
        $product = Product::find($id);
        if($product===null)
        {
            return response()->json([
                "msg"=>"Product not found",
                404
            ]);
        }

        return new ProductResource($product);
    }

    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'image' => 'requierd|image|mimes:png,jpg,jpeg,gif',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',

         ]);

         if($validator->fails())
         {
            return response()->json([
                "errors" => $validator->errors()  ,
                301
            ]) ;
            // return response(Hello world, HTTP code, headers)
         }
         $imageName  = $request->image ;
         if ($request->hasFile('image')) {
             // If an image is uploaded in the request
             $imageName = Storage::putFile("products", $imageName);
         } else {
             // If no image is uploaded, use a default image
             $imageName = 'products/1.png'; // Change this to your default image path
         }


// create
Product::create([
    "title" => $request->title ,
    "desc" => $request->desc ,
    "price" => $request->price ,
    "quantity" => $request->quantity ,
    "image" => $imageName,
    "category_id" => $request->category_id,
]) ;

// msg

return response()->json([
    "msg"=>"Product added successfully",
    201
]);
    }

    public function update(Request $request , $id)
    {

        $validator  = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'image|mimes:png,jpg,jpeg,gif',
            'quantity' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',

         ]);

         if($validator->fails())
         {
            return response()->json([
                "errors" => $validator->errors()  ,
                301
            ]) ;
            // return response(Hello world, HTTP code, headers)
         }
// find
$product = Product::find($id);
if($product===null)
{
    return response()->json([
        "msg"=>"Product not found",
        404
    ]);
}
// storage
$imageName  = $product->image ;
if ($request->hasFile('image')) {
    // If an image is uploaded in the request
    $imageName = Storage::putFile("products", $request->image);
}
// update
$product->update([
    "title" => $request->title ,
    "desc" => $request->desc ,
    "price" => $request->price ,
    "quantity" => $request->quantity ,
    "image" => $imageName,
    "category_id" => $request->category_id,
]) ;

// msg

return response()->json([
    "msg"=>"Product updated successfully",
    "product"=>new ProductResource($product) ,
    201
]);
    }


    public function destroy($id)
    {
        $products = Product::all();
        $product = Product::find($id);
        if($product===null)
        {
            return response()->json([
                "msg"=>"Product not found",
                404
            ]);
    }
    if ($product->image !== 'products/1.png') {
        // Delete the product image
        Storage::delete($product->image);
    }
    $product->delete();


    return response()->json([
        "msg"=>"Product deleted successfully",
        "products"=>ProductResource::collection($products) ,
        201
    ]);

    }
    // public function search(Request $request)
    // {
    //     $key = $request->input('key');

    //     $products = Product::where('title', 'like', "%$key%")
    //         ->orWhere('desc', 'like', "%$key%")
    //         ->orWhere('price', 'like', "%$key%")
    //         ->get();
    //         if($products===null)
    //         {
    //             return response()->json([
    //                 "msg"=>"Product not found",
    //                 404
    //             ]);
    //              return response()->json(['data' => ProductResource::collection($products)], 200);
    //     }

    // }


    public function search(Request $request)
    {
        $key = $request->input('key');
        $products = Product::where('title', 'like', "%$key%")
                 ->orWhere('desc', 'like', "%$key%")
                 ->orWhere('price', 'like', "%$key%")
                 ->get();        if($products===null)
        {
            return response()->json([
                "msg"=>"Product not found",
                404
            ]);
        }

                 return response()->json(['data' => ProductResource::collection($products)], 200);
}

}
