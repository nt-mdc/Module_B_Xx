<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = database_path('seeders/data/companies.csv');

        $data = array_map('str_getcsv', file($file));
        $header = null;

        foreach ($data as $row) {
            if (!$header) {
                $header = $row;
                continue;
            }

            $rowData = array_combine($header, $row);

            $company = DB::table('companies')->insertGetId([
                'name' => $rowData['Company Name'],
                'address' => $rowData['Company Address'],
                'number' => $rowData['Company Telephone Number'],
                'email' => $rowData['Company Email Address'],
                'deactivated' => 0
            ]);

            DB::table('owner')->insert([
                'name' => $rowData['Owner Name'],
                'number' => $rowData['Owner Mobile Number'],
                'email' => $rowData['Owner Email Address'],
                'company_id' => $company
            ]);
            DB::table('contact')->insert([
                'name' => $rowData['Contact Name'],
                'number' => $rowData['Contact Mobile Number'],
                'email' => $rowData['Contact Email Address'],
                'company_id' => $company
            ]);
        }
    }
}
