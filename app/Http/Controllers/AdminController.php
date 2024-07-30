<?php

namespace App\Http\Controllers;

use App\Models\Brand;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function manage()
    {
        $products = Product::orderBy("created_at", "DESC")->get();
        $categories = Category::orderBy("created_at", "ASC")->get();
        $brands = Brand::orderBy("created_at", "ASC")->get();

        return view('admin.manage', ['products'=>$products, 'categories' => $categories, 'brands'=>$brands]);
    }

    public function create()
    {
        return view('admin.form_product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
        ]);

        $product = new product;

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('assets/image/product/main-pic'), $imageName);

        // $product->name = $request->name;
        // $product->description = $request->description;
        // $product->price = $request->price;
        // $product->stock = $request->stock;
        // $stock->image = $imageName;
        // $product->category = $request->category;
        // $product->brand = $request->brand;

        if($request->image != null){
                $path = $request->image->store('public/assets/images/product/main-pic');
                $fileName = explode('/',$path);
                $img = $fileName[5];
                var_dump($img);
                die();


            // $product->save();
            $product = Product::create([
                "name" => $request->name,
                "slug" => Str::slug($request->name, '-'),
                "description" => $request->description,
                "price" => $request->price,
                "quantity" => $request->quantity,
                "image" => $img,
                "category_id" => $request->category_id,
                "brand_id" => $request->brand_id
            ]);
            $response = ['message' => 'product has been added successfully!'];
            return redirect('/manage')->with($response);

        } else {
            return redirect()->route('admin.create')->with('message','Image is not filled!');

        }


    }






    public function delete($id_product)
    {
        $product = Product::find($id_product);
        $product->delete();
        return redirect()->route('admin.manage')->with('message','Product has been deleted successfully');
    }

    public function deleteBrand($id_brand)
    {
        $brand = Brand::find($id_brand);
        $brand->delete();
        return redirect()->route('admin.manage')->with('message','brand has been deleted successfully');

    }
}



