<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::paginate(10);
     return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));

    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'first_name' => 'required',
    //             'last_name' => 'required',
    //             'company_id' => 'required|exists:companies,id',
    //             'email' => 'nullable|email',
    //             'phone' => 'nullable',
    //         ]);

    //         Employee::create($request->all());

    //         return redirect()->route('employees.index')
    //          ->with('success', 'Employee created successfully.');

    //     } catch (\Exception $e) {
    //         // Log the exception
    //         \Illuminate\Support\Facades\Log::error($e->getMessage());

    //         // Handle the exception or redirect with an error message
    //         return redirect()->back()->with('error', 'An error occurred while processing your request.');
    //     }
    // }
    public function store(Request $request)
    {

            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'company_id' => 'required|exists:companies,id',
                'email' => 'nullable|email',
                'phone' => 'nullable',
                ] , [
                    'first_name.required' => 'First name is required.',
                    'last_name.required' => 'last name is required.',
                    'email.email' => 'Please provide a valid email address.',
                    'company_id.required' => 'Choosing Company Name is required.',
                ]);

            Employee::create($request->all());

            return redirect()->route('employees.index')
             ->with('success', 'Employee created successfully.');


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
    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required|exists:companies,id',
            'email' => 'nullable|email',
            'phone' => 'nullable',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
