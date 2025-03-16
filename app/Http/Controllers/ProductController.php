<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    // Fetch all products
    public function index()
    {
        return response()->json(Product::all(), Response::HTTP_OK);
    }

    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::create($request->all());

        return response()->json($product, Response::HTTP_CREATED);
    }

    // Show a single product
    public function show(Product $product)
    {
        return response()->json($product, Response::HTTP_OK);
    }

    // Update a product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
        ]);

        $product->update($request->all());
        return response()->json($product, Response::HTTP_OK);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted'], Response::HTTP_NO_CONTENT);
    }
}
