<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class ProductController extends Controller
{
    // Register page
    public function index(Request $request)
    {
        $keyword = trim($request->get('q'));
        $selectedCategory = $request->get("category");
        $categories = DB::table("categories")->get();
        $products = DB::table('products');

        // Both search keyword and filter by category
        if (strlen($keyword) && $selectedCategory > 0) {
            $products = $products->whereRaw(' products.category_id = ? and products.name like ?', ["$selectedCategory", "%$keyword%"]);
        }
        // Only filter by category
        elseif ($selectedCategory > 0) {
            $products = $products->whereRaw('products.category_id = ?', ["$selectedCategory"]);
        }
        // Only search keyword
        elseif (strlen($keyword)) {
            $products = $products->whereRaw('products.name like ? ', ["%$keyword%"]);
        }

        $products = $products->paginate(4);

        return view("products.index", compact("products", "categories", "keyword", "selectedCategory"));
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
            "price" => "required|numeric",
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

    // Store a product in manage page
    public function storeInManage(Request $request)
    {
        $formFields = $request->validate([
            "name" => "required",
            "price" => "required|numeric",
            "category" => "required",
            "description" => "required"
        ]);

        $formFields["user_id"] = auth()->user()->id;
        $formFields["category_id"] = $request->category;

        // Store the user
        $product = Product::create($formFields);

        return redirect("/products/manage")->with("success", "Create selling product successfully");
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
        $userId = auth()->user()->id;
        $categories = DB::table("categories")->get();
        $products = DB::table("products")->whereRaw('products.user_id = ?', ["$userId"])->paginate(4);
        return view("products.manage", compact("products", "categories"));
    }

    // Update the product
    public function update(Request $request, Product $product)
    {
        if (auth()->user()->id !== $product->user_id) {
            abort(403, "Unauthorized action");
        }

        $formFields = $request->validate([
            "name" => "required",
            "price" => "required|numeric",
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

        return redirect("/products/manage")->with("success", "Delete selling product successfully");
    }

    // Export excel
    public function export()
    {
        return Excel::download(new ProductExport, "products.xlsx");
    }


    public function showImport()
    {
        return view("products.import");
    }

    // Import 
    public function import(Request $request)
    {
        try {
            Excel::import(new ProductImport, $request->file("product_xlsx_file"));
        } catch (ValidationException $ex) {
            $failures = $ex->failures();

            // foreach ($failures as $failure) {
            //     $failure->row(); // row that went wrong
            //     $failure->attribute(); // either heading key (if using heading row concern) or column index
            //     $failure->errors(); // Actual error messages from Laravel validator
            //     $failure->values(); // The values of the row that has failed.
            // }

            return back()->withErrors($failures);
        }

        return redirect('/products/manage')->with('success', 'Imported products successfully!');
    }
}
