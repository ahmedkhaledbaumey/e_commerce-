<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('admin.products.index', compact(['products', 'categories']));
    }

    public function create()
    {
        $categories = Category::all();
        return view('Admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            // validation
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'desc' => 'required|string',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
            ]);

            if ($request->hasFile('image')) {
                // If an image is uploaded in the request
                $data['image'] = Storage::putFile("products", $data['image']);
            } else {
                // If no image is uploaded, use a default image
                $data['image'] = 'products/1.png'; // Change this to your default image path
            }

            // create
            $products = Product::create($data);

            // redirect
            return redirect()->route('products.index')->with('success', 'Product created successfully');
        } catch (ValidationException $e) {
            return redirect()->route('products.create')->withErrors($e->errors())->withInput();
        }
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('Admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        try {
            // validation
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'desc' => 'required|string',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
            ]);

            $product = Product::findOrFail($id);

            if ($request->hasFile('image')) {
                // If an image is uploaded in the request
                $data['image'] = Storage::putFile("products", $data['image']);
            } else {
                // If no image is uploaded, use the existing image
                $data['image'] = $product->image;
            }

            // update
            $product->update($data);

            // redirect
            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
        } catch (ValidationException $e) {
            return redirect()->route('admin.products.edit', $id)->withErrors($e->errors())->withInput();
        }
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Check if the image is not the default one before attempting to delete
        if ($product->image !== 'products/1.png') {
            // Delete the product image
            Storage::delete($product->image);
        }

        // Delete the product
        $product->delete();

        // redirect
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }
}
