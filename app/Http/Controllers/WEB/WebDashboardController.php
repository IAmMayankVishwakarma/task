<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class WebDashboardController extends Controller
{
    public function index()
    {
        $totalDepartments = Department::count();
        $totalEmployees = Employee::count();
        $recentEmployees = Employee::with('department')
            ->latest()
            ->take(5)
            ->get();
            
        return view('dashboard', compact(
            'totalDepartments',
            'totalEmployees',
            'recentEmployees'
        ));
    }
}

