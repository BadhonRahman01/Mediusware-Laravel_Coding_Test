<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //$products = products()->latest()->paginate(10);
        $products = Product::paginate(10);
        //$products = Product::all();
        //return view('products.index', compact('products'));

    
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'sku' => 'required|unique',
            'description' => 'nullable',
        ]);
    
        Product::create($request->all());
        $request->validate([
            'product_id' => 'required',
            'file_path' => 'required',
            'thumbnail' => 'nullable',
        ]);
        Product_image::create($request->all());
        
        $request->validate([
            'variant' => 'required',
            'variant_id' => 'required',
            'product_id' => 'required',
        ]);
        Product_variant::create($request->all());
        $request->validate([
            'product_variant_one' => 'nullable',
            'product_variant_two' => 'nullable',
            'product_variant_three' => 'nullable',
            'price' => 'required',
            'stock' => 'nullable',
            'product_id' => 'required',
        ]);
    Pproduct_variant_price::create($request->all());

        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        return view('products.edit', compact('variants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'sku' => 'required|unique',
            'description' => 'nullable',
        ]);
    
        Product::update($request->all());
        $request->validate([
            'product_id' => 'required',
            'file_path' => 'required',
            'thumbnail' => 'nullable',
        ]);
        Product_image::update($request->all());
        
        $request->validate([
            'variant' => 'required',
            'variant_id' => 'required',
            'product_id' => 'required',
        ]);
        Product_variant::update($request->all());
        $request->validate([
            'product_variant_one' => 'nullable',
            'product_variant_two' => 'nullable',
            'product_variant_three' => 'nullable',
            'price' => 'required',
            'stock' => 'nullable',
            'product_id' => 'required',
        ]);
    Pproduct_variant_price::update($request->all());

        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')
                        ->with('success','Product deleted successfully');
    }
}
