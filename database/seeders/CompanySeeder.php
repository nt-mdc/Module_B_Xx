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
                'company_name' => $rowData['Company Name'],
                'company_address' => $rowData['Company Address'],
                'company_number' => $rowData['Company Telephone Number'],
                'company_email' => $rowData['Company Email Address'],
                'deactivated' => 0
            ]);

            DB::table('owner')->insert([
                'owner_name' => $rowData['Owner Name'],
                'owner_number' => $rowData['Owner Mobile Number'],
                'owner_email' => $rowData['Owner Email Address'],
                'company_id' => $company
            ]);
            DB::table('contact')->insert([
                'contact_name' => $rowData['Contact Name'],
                'contact_number' => $rowData['Contact Mobile Number'],
                'contact_email' => $rowData['Contact Email Address'],
                'company_id' => $company
            ]);
        }
    }
}
