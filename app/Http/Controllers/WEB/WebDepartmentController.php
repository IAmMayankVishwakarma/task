<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class WebDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::latest()->paginate(10);
        return view('departments.index', compact('departments'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:departments',
            'status' => 'required|in:active,inactive'
        ]);

        Department::create($validated);

        return redirect()->route('web-departments.index')
            ->with('success', 'Department created successfully');
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
    // public function edit(Department $department)
    public function edit(Department $web_department)
    {  $department = $web_department;
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Department $department)
    public function update(Request $request, Department $web_department)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,'.$web_department->id,
            'status' => 'required|in:active,inactive'
        ]);
        $department = $web_department;
        $department->update($validated);

        return redirect()->route('web-departments.index')
            ->with('success', 'Department updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $web_department)
    {
        // dd($web_department->all());
        // Prevent deletion if department has employees
        if ($web_department->employees()->exists()) {
            return redirect()->back()
                ->with('error', 'Cannot delete department with assigned employees');
        }

        $web_department->delete();

        return redirect()->route('web-departments.index')
            ->with('success', 'Department deleted successfully');
    }
}
