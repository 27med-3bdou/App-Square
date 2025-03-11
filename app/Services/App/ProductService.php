<?php

namespace App\Services;

use App\Models\Products;

class ProductService
{
    public function index()
    {
        return 'ahmed33';
    }

    public function createProduct(array $data)
    {
        $product = Products::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'image' => $data['image'] ?? null,
            'price' => $data['price'],
            'weight' => $data['weight'] ?? null,
            'category_id' => $data['category_id'],
            'brand_id' => $data['brand_id'],
            'status' => $data['status'] ?? 1,
        ]);
        return $product;
    }
}
