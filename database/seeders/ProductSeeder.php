<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = database_path('seeders/data/products.csv');

        $data = array_map('str_getcsv', file($file));
        $header = null;

        $companiesTot = 7;
        $compAct = 1;

        foreach ($data as $row) {
            if (!$header) {
                $header = $row;
                continue;
            }

            $rowData = array_combine($header, $row);

            DB::table('products')->insert([
                'gtin' => $rowData['GTIN'],
                'hidden' => 0,
                'company_id' => $compAct
            ]);

            DB::table('product_translation')->insert([
                'language' => 'en',
                'name' => $rowData['Name'],
                'description' => $rowData['Description'],
                'product_gtin' => $rowData['GTIN']
            ]);

            DB::table('product_translation')->insert([
                'language' => 'fr',
                'name' => $rowData['Name in French'],
                'description' => $rowData['Description in French'],
                'product_gtin' => $rowData['GTIN']
            ]);

            DB::table('product_detail')->insert([
                'brand' => $rowData['Brand Name'],
                'country' => $rowData['Country of Origin'],
                'product_gtin' => $rowData['GTIN']
            ]);

            DB::table('product_weight')->insert([
                'unit' => $rowData['Weight Unit'],
                'gross' => $rowData['Gross Weight (with packaging)'],
                'net' => $rowData['Net Content Weight'],
                'product_gtin' => $rowData['GTIN']
            ]);

            DB::table('product_image')->insert([
                'product_gtin' => $rowData['GTIN']
            ]);

            $compAct = ($compAct % $companiesTot) + 1;
        }
    }
}
