<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductsCollection;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        return view('product-create')->with('comp', $comp);
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
        $request->validate([
            'gtin' => ['required', 'string', 'min:13', 'max:14', Rule::unique('products', 'gtin')->ignore($gtin?->gtin, 'gtin')],
            'company_id' => 'required|exists:companies,id',
        ]);

        $product = Product::updateOrCreate(
            ['gtin' => $request->gtin],
            $request->only('gtin', 'hidden', 'company_id')
        );

        $product->detail()->updateOrCreate([], $request->only('brand', 'country'));
        $product->weight()->updateOrCreate([], $request->only('unit', 'net', 'gross'));

        foreach ($request->input('translations', []) as $lang => $data) {
            $product->translations()->updateOrCreate(
                ['language' => $lang],
                ['name' => $data['name'], 'description' => $data['description']]
            );
        }

        $product->image()->updateOrCreate([], [
            'image_path' => $request->file('image_path')?->store('products', 'public') ?? $product->image?->image_path ?? 'placeholder.jpg'
        ]);

        return redirect()->back();
    }

    public function toggle(Request $request, Product $gtin)
    {
        $gtin->hidden = $request->hidden ? 1 : 0;
        $gtin->save();
        return back();
    }

    public function delete(Product $gtin)
    {
        if ($gtin['hidden']) {
            $gtin->delete();
            return redirect()->route('products');
        }

        return redirect()->back();
    }

    public function deleteImage(Product $gtin)
    {
        $image = $gtin->load('image')['image']['image_path'] ?? null;

        $image && $image != 'placeholder.png' && Storage::delete($image);

        $gtin->image()->update([
            'image_path' => 'placeholder.jpg'
        ]);

        return redirect()->back();
    }


    public function getAll(Request $request)
    {
        $query = $request->query('query');
        $prods = Product::with('company.owner', 'company.contact', 'weight', 'detail', 'translations')
        ->where("hidden", 0)
        ->where(function ($q) use ($query) {
            $q->whereHas('translations', function ($qt) use ($query) {
                $qt->whereIn('language', ['en', 'fr'])
                    ->where(function ($sub) use ($query) {
                        $sub->where('name', 'like', "%{$query}%")
                            ->orWhere('description', 'like', "%{$query}%");
                    });
            });
        })->paginate(10);
        return response()->json([
            'data' => ProductResource::collection($prods->items()),
            'pagination' => [
                'current_page' => $prods->currentPage(),
                'total_pages' => $prods->lastPage(),
                'per_page' => $prods->perPage(),
                'next_page_url' => $prods->nextPageUrl(),
                'prev_page_url' => $prods->previousPageUrl(),
            ]
        ]);
    }

    public function getSingle($gtin)
    {
        $prod = Product::with('company.owner', 'company.contact', 'weight', 'detail', 'translations')
            ->where("gtin", $gtin)
            ->where("hidden", 0)
            ->first();

        return $prod ? response()->json(ProductResource::make($prod)) : response()->json(['message' => "Not Found"], 404);
    }
}
