<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class WebEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Employee::with('department');
        
        if ($request->has('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        $employees = $query->get();
        $departments = Department::all(); // For department filter dropdown

        return view('employees.index', compact('employees', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('employees.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'phone' => 'required|string',
            'joining_date' => 'required|date',
            'department_id' => 'required|exists:departments,id',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $data = $request->except('profile_photo');
        
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $data['profile_photo'] = $path;
        }
        
        Employee::create($data);

        return redirect()->route('web-employees.index')
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::with('department')->findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        return view('employees.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, $id)
     {
         $employee = Employee::findOrFail($id);
     
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => [
                 'required',
                 'email',
                 Rule::unique('employees')->ignore($employee->id),
             ],
             'phone' => 'required|string',
             'joining_date' => 'required|date',
             'department_id' => 'required|exists:departments,id',
             'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
         ]);
     
         $data = $request->except('profile_photo');
     
         if ($request->hasFile('profile_photo')) {
             if ($employee->profile_photo && Storage::disk('public')->exists($employee->profile_photo)) {
                 Storage::disk('public')->delete($employee->profile_photo);
             }
     
             $path = $request->file('profile_photo')->store('profile_photos', 'public');
             $data['profile_photo'] = $path;
         }
     
         $employee->update($data);
     
         return redirect()->route('web-employees.index')
             ->with('success', 'Employee updated successfully.');
     }
     
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $employee = Employee::findOrFail($id); // This was missing

    if ($employee->profile_photo && Storage::disk('public')->exists($employee->profile_photo)) {
        Storage::disk('public')->delete($employee->profile_photo);
    }

    $employee->delete();

    return redirect()->route('web-employees.index')
        ->with('success', 'Employee deleted successfully.');
}


    // Optional export functionality
    // public function export() 
    // {
    //     return Excel::download(new EmployeesExport, 'employees.xlsx');
    // }
}
