<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all()->load('owner', 'contact');
        return view('home')->with('companies', $companies);
    }

    public function create(Request $request)
    {

        $request->validate([
            'company_email' => "required|unique:companies"
        ]);

        $companyData = $request->only(['company_name', 'company_email', 'company_address', 'company_number', 'deactivated']);
        $ownerData = $request->only(['owner_name', 'owner_email', 'owner_number']);
        $contactData = $request->only(['contact_name', 'contact_email', 'contact_number']);

        DB::beginTransaction();

        

        try {
            $company = Company::create($companyData);

            $company->owner()->create($ownerData);

            $company->contact()->create($contactData);

            DB::commit();

            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Falha no envio!  ' . $th]);
        }
    }

    public function edit($id)
    {
        $company = Company::where('id', $id)->with('owner', 'contact', 'products.translations', 'products.detail', 'products.weight')->first();
        return view('company-edit')->with('company', $company);
    }

    public function update(Request $request, Company $id)
    {
        $companyData = $request->only(['company_name', 'company_email', 'company_address', 'company_number', 'deactivated']);
        $ownerData = $request->only(['owner_name', 'owner_email', 'owner_number']);
        $contactData = $request->only(['contact_name', 'contact_email', 'contact_number']);

        if (count($companyData)) {
            $id->update($companyData);
        }

        if (count($ownerData)) {
            $id->owner()->update($ownerData);
        }

        if (count($contactData)) {
            $id->contact()->update($contactData);
        }

        if (isset($request['deactivated'])) {
            $id->products()->update(['hidden' => $request['deactivated'] ? 1 : 0]);
        }
        return redirect()->back();
    }
}
