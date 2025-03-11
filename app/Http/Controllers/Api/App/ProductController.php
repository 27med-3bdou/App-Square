<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\App\ProductRequest;
use App\Models\Category;
use App\Models\Products;
use App\Services\ProductService;
use App\Services\ProductService as ServicesProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Products::all();
    }

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function store(ProductRequest $request)
    {
        $product = $this->productService->createProduct($request->validated());

        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product
        ], 201);
    }

    public function productOFcategore(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id'
        ]);

        $category = Category::with('products')->find($request->category_id);

        return response()->json([
            'category' => $category->name,
            'products' => $category->products
        ]);
    }
}
