<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(10);
         return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'nullable|email',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
                'website' => 'nullable',
                // 'website' => 'nullable|url',
            ]);

            // Upload logo
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('public/logo');
                $logoFilename = str_replace('public/', '', $logoPath);
            } else {
                $logoFilename = null;
            }

            $companyData = $request->except('logo');
            $companyData['logo'] = $logoFilename;

            Company::create($companyData);

            return redirect()->route('companies.index')
                ->with('success', 'Company created successfully.');
        } catch (\Exception $e) {
            // Log the exception
            \Illuminate\Support\Facades\Log::error($e->getMessage());

            // Handle the exception or redirect with an error message
            return redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'nullable|email',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
                // 'website' => 'nullable|url',
                'website' => 'nullable',
            ]);

            // Upload logo
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('public/logo');
                $logoFilename = str_replace('public/', '', $logoPath);
            } else {
                $logoFilename = $company->logo;
            }

            $companyData = $request->except('logo');
            $companyData['logo'] = $logoFilename;

            $company->update($companyData);

            return redirect()->route('companies.index')
                ->with('success', 'Company updated successfully.');

            } catch (\Exception $e) {
                // Log the exception
                \Illuminate\Support\Facades\Log::error($e->getMessage());

                // Handle the exception or redirect with an error message
                return redirect()->back()->with('error', 'An error occurred while processing your request.');
            }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully.');
    }
}
