<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function getAllProducts(Request $request)
    {
        return ProductResource::collection(
            Product::query()
                ->paginate(30)
        );
    }

    public function getProductById($id)
    {
        return new ProductResource(Product::find($id));
    }

    public function searchByName(Request $request)
    {
        $search = $request->get('search');
        if (!$search) {
            return response()->json(['message' => 'Search query is required'], 400);
        }

        $products = Product::query()
            ->where('title', 'like', "%$search%")
            ->paginate(10);

        return ProductResource::collection($products);
    }
}
