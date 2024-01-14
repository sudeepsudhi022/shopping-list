<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    public function index()
    {
        return view('shoppinglist');
    }

    public function calculate(Request $request)
    {
        $products = $request->input('products');

        // Ensure that products are provided
        if (!$products || empty($products)) {
            return redirect()->back()->with('error', 'Please add at least one product.');
        }

        $totalCost = 0;
        $maxProduct = null;
        $minProduct = null;

        foreach ($products as $product) {
            // Check if 'name' key and 'price' key exist for the product
            if (isset($product['name']) && isset($product['price'])) {
                $name = $product['name'];
                $price = $product['price'];

                // Calculate total cost
                $totalCost += $price;

                // Check for the product with the highest price
                if (!$maxProduct || $price > $maxProduct['price']) {
                    $maxProduct = ['name' => $name, 'price' => $price];
                }

                // Check for the product with the lowest price
                if (!$minProduct || $price < $minProduct['price']) {
                    $minProduct = ['name' => $name, 'price' => $price];
                }
            }
        }

        return view('shoppinglist', compact('totalCost', 'maxProduct', 'minProduct'));
    }
}
