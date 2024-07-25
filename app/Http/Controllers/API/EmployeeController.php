<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function getEmployee(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json(['error' => 'Query parameter is required'], 400);
        }

        $employee = Employee::where('employee_register_number', $query)
            ->orWhere('contact_number', $query)
            ->orWhere('email', $query)
            ->first();

        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
        return new EmployeeResource($employee);
    }

    public function getAllEmployees()
    {
       return EmployeeResource::collection(Employee::all());
    }
}
