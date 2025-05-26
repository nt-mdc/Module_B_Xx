<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->load('detail', 'translations', 'weight');
        return view('products')->with('products', $products);
    }

    // public function create(Request $request)
    // {
    //     $data = $request->all();

    //     DB::beginTransaction();

    //     try {
    //         $company = Company::create([
    //             'name' => $data['company_name'],
    //             'email' => $data['company_email'],
    //             'address' => $data['company_address'],
    //             'number' => $data['company_phone'],
    //             'deactivated' => 0,
    //         ]);

    //         $company->owner()->create([
    //             'name' => $data['owner_name'],
    //             'email' => $data['owner_email'],
    //             'number' => $data['owner_number'],
    //             'company_id' => $company->id
    //         ]);

    //         $company->contact()->create([
    //             'name' => $data['contact_name'],
    //             'email' => $data['contact_email'],
    //             'number' => $data['contact_number'],
    //             'company_id' => $company->id
    //         ]);

    //         DB::commit();

    //         return redirect()->back();
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         return response()->json(['error' => $th]);
    //     }
    // }

    public function edit($gtin)
    {
        $product = Product::where('gtin', $gtin)->with('detail', 'translations', 'weight')->first();
        return view('product-edit')->with('prod', $product);
    }

    // public function update(Request $request, Company $id)
    // {
    //     $data = $request->all();


    //     $id->update([
    //         'name' => $data['company_name'],
    //         'email' => $data['company_email'],
    //         'address' => $data['company_address'],
    //         'number' => $data['company_phone'],
    //         'deactivated' => $data['deactiv'],
    //     ]);

    //     $id->owner()->update([
    //         'name' => $data['owner_name'],
    //         'email' => $data['owner_email'],
    //         'number' => $data['owner_number'],
    //     ]);

    //     $id->contact()->update([
    //         'name' => $data['contact_name'],
    //         'email' => $data['contact_email'],
    //         'number' => $data['contact_number'],
    //     ]);

    //     if ($data['deactiv']) {
    //         $id->products()->update(['hidden' => 1]);
    //     }

    //     if (!$data['deactiv']) {
    //         $id->products()->update(['hidden' => 0]);
    //     }


    //     return redirect()->back();
    // }

    public function apiGet() {
        
    }
}
