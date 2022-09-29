<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Register page
    public function index()
    {
        $products = Product::paginate(4);
        return view("products.index", compact("products"));
    }

    // Create page
    public function create()
    {
        $categories = Category::all();
        return view("products.create", compact("categories"));
    }

    // Store a product
    public function store(Request $request)
    {
        $formFields = $request->validate([
            "name" => "required",
            "price" => "required",
            "category" => "required",
            // 'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            "description" => "required"
        ]);

        if ($request->hasFile("product_image")) {
            $formFields["image"] = $request->file("product_image")->store("images", "public");
        } else {
            $formFields["image"] = null;
        }

        $formFields["user_id"] = auth()->user()->id;
        $formFields["category_id"] = $request->category;

        // Store the user
        $product = Product::create($formFields);

        return redirect("/")->with("success", "Create selling product successfully");
    }

    // Show a product
    public function show($id)
    {
        $product = Product::find($id);
        return view("products.show", compact("product"));
    }

    // Edit page
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view("products.edit", compact("product", "categories"));
    }


    // Manage page
    public function manage()
    {
        $products = Product::all();
        return view("products.manage", compact("products"));
    }

    // Update the product
    public function update(Request $request, Product $product)
    {
        if (auth()->user()->id !== $product->user_id) {
            abort(403, "Unauthorized action");
        }

        $formFields = $request->validate([
            "name" => "required",
            "price" => "required",
            "category" => "required",
            "description" => "required"
        ]);

        if ($request->hasFile("product_image")) {
            $formFields["image"] = $request->file("product_image")->store("images", "public");
        }

        $formFields["user_id"] = auth()->user()->id;
        $formFields["category_id"] = $request->category;

        // Store the product
        $product->update($formFields);

        return redirect("/")->with("success", "Update selling product successfully");
    }

    // Show page destroy a product
    public function showDestroy($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view("products.destroy", compact("product", "categories"));
    }

    // Destroy a product
    public function destroy(Product $product)
    {
        if (auth()->user()->id !== $product->user_id) {
            abort(403, "Unauthorized action");
        }

        $product->delete();

        return redirect("/")->with("success", "Delete selling product successfully");
    }
}
