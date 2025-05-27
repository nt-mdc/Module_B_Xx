<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Monolog\Handler\IFTTTHandler;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->load('detail', 'translations', 'weight');
        return view('products')->with('products', $products);
    }

    public function new()
    {
        $comp = Company::all();
        return view('products-create')->with('comp', $comp);
    }

    public function edit($gtin)
    {
        $product = Product::where('gtin', $gtin)->with('detail', 'translations', 'weight')->first();
        $companies = Company::all();
        return view('product-edit')->with([
            'prod' => $product,
            'comp' => $companies
        ]);
    }

    public function updateCreate(Request $request, Product $gtin = null)
    {
        $productGtin = $gtin?->gtin;

        $request->validate([
            'gtin' => ['required', 'string', 'min:13', 'max:14',Rule::unique('products', 'gtin')->ignore($productGtin)],
            'company_id' => 'required|exists:companies,id',
            'image_path' => 'image'
        ]);

        $image = $request->file('image');

        $product = Product::updateOrCreate(
            ['gtin' => $request->gtin],
            $request->only('gtin', 'hidden', 'company_id')
        );

        $product->detail()->updateOrCreate([], $request->only('brand', 'country'));
        $product->weight()->updateOrCreate([], $request->only('unit', 'net', 'gross'));

        foreach ($request->input('translations', []) as $lang => $data) {
            $product->translations()->updateOrCreate([
                'language' => $lang
            ], [
                'name' => $data['name'],
                'description' => $data['description']
            ]);
        }

        if ($image) {
            $path = $image->store('images', 'public');
            $product->image()->updateOrCreate([], [
                'image_path' => $path
            ]);
        }

        $product['hidden'] = $request->hidden ? 1 : 0;

        return redirect()->back();
    }

    public function delete(Product $gtin) {
        if ($gtin['hidden']) {
            $gtin->delete();
            return redirect()->route('products');
        }

        return redirect()->back();
    }

    public function deleteImage(Product $gtin) {
        $gtin->image()->update([
            'image_path' => null
        ]);

        return redirect()->back();
    }

    public function apiGet() {}
}
