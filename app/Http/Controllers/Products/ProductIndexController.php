<?php

namespace App\Http\Controllers\Products;

use App\Domain\Product\Product;
use Illuminate\Http\Request;

class ProductIndexController
{
    public function __invoke(Request $request)
    {
        $city = $request->get('city', []);
        $category = $request->get('category', 'none');
        $query = Product::query();

        if (!empty($city)) {
            $query->whereHas('cities', function($query) use ($city) {
                $query->whereIn('name', $city);
            });
        }

        if ($category !== 'none') {
            $query->whereHas('categories', fn($query) =>
                $query->where('name', $category)
            );
        }

        return view('products.index', [
            'products' => $query->paginate()->appends($request->all()),
            'city' => $city,
            'category' => $category,
        ]);
    }
}
