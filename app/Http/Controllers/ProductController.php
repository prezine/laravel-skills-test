<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $data = [];
        $file = storage_path('app/public/products.json');

        if (file_exists($file)) {
            $json = file_get_contents($file);
            $data = json_decode($json, true) ?? [];
        }

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string',
            'quantity' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $validated['datetime'] = now()->toDateTimeString();
        $validated['total_value'] = $validated['quantity'] * $validated['price'];

        $file = storage_path('app/public/products.json');
        $existing = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        $existing[] = $validated;

        file_put_contents($file, json_encode($existing, JSON_PRETTY_PRINT));

        return response()->json(['success' => true, 'products' => $existing]);
    }

    public function update(Request $request, $index)
    {
        $file = storage_path('app/public/products.json');

        if (!file_exists($file)) {
            return response()->json(['success' => false]);
        }

        $products = json_decode(file_get_contents($file), true);

        if (!isset($products[$index])) {
            return response()->json(['success' => false]);
        }

        $products[$index]['product_name'] = $request->input('product_name');
        $products[$index]['quantity'] = (int) $request->input('quantity');
        $products[$index]['price'] = (float) $request->input('price');

        file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT));

        return response()->json(['success' => true]);
    }
}
