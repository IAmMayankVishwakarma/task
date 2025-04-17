<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Log::debug('Auth Check', [
            'user' => auth()->user(),
            'token' => $request->bearerToken()
        ]);
        return Department::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);
        
        return Department::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request ,$id)
    {
        if (Department::find($id)){
            Log::debug('Auth Check', [
                'user' => auth()->user(),
                'token' => $request->bearerToken()
            ]);
            return Department::find($id);   
        }
        return response('data not found');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'status' => 'required|in:active,inactive',
    ]);

    // Find the department
    $department = Department::find($id);

    // If department not found
    if (!$department) {
        return response()->json(['message' => 'Department not found'], 404);
    }

    // Update the department
    $department->update([
        'name' => $request->name,
        'status' => $request->status,
    ]);

    // Return the updated department
    return response()->json($department);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return response()->noContent();
    }
}
