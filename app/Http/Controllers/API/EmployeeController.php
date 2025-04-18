<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
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
        return response()->json([
            "status" => true,
            "message" => "data fetched succefully",
            "employeeData"=> $employees
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate inputs
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:employees',
        'phone' => 'required|string',
        'joining_date' => 'required|date',
        'department_id' => 'required|exists:departments,id',
        'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    // If validation fails
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation errors',
            'errors' => $validator->errors()
        ], 422);
    }

    $data = $request->except('profile_photo');

    // If file is uploaded
    if ($request->hasFile('profile_photo')) {
        $path = $request->file('profile_photo')->store('profile_photos', 'public');
        $data['profile_photo'] = $path;
    } else {
        $data['profile_photo'] = null; // optional
    }

    // Save employee
    $employee = Employee::create($data);

    if ($employee) {
        return response()->json([
            'status' => true,
            'message' => 'Employee created successfully',
            'data' => $employee
        ], 201);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Something went wrong, please try again'
        ], 500);
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::with('department')->find($id);
    
        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }
    
        return response()->json($employee);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:employees,email,'.$employee->id,
            'phone' => 'string',
            'joining_date' => 'date',
            'department_id' => 'exists:departments,id',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $data = $request->except('profile_photo');
        
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($employee->profile_photo) {
                Storage::disk('public')->delete($employee->profile_photo);
            }
            
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $data['profile_photo'] = $path;
        }
        
        $employee->update($data);
        return $employee;
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if ($employee->profile_photo) {
            Storage::disk('public')->delete($employee->profile_photo);
        }
        
        $employee->delete();
        return response()->noContent();
    }
    
}
