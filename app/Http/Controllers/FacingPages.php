<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FacingPages extends Controller
{
    public function indexGtin()
    {
        return view('gtin-bulk');
    }

    public function validateGtin(Request $request)
    {
        $ipt = $request->input('gtins');
        $gtins = preg_split("/\r\n|\r|\n/", $ipt);
        $gtins = array_filter(array_map('trim', $gtins));

        $prods = Product::where('hidden',0)->whereIn('gtin', array_values($gtins))->pluck('gtin')->toArray();

        $result = [];
        foreach ($gtins as $gtin) {
            $result[] = [
                'gtin' => $gtin,
                'valid' => in_array($gtin, $prods),
            ];
        }
        // return response()->json($gtins);
        return view('gtin-bulk')->with(['rst' => $result, 'allValid' => collect($result)->every(fn($item) => $item['valid'])]);
    }
}
