<?php

namespace App\Http\Controllers\Backend\Employee;

use PDF;
use App\Models\Employee;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function exportPdf()
    {
        $employees = Employee::all();
        $pdf = PDF::loadView('pdf.employees', compact('employees'));
        $fileName = 'employees-'.Str::random(5).'-'.date('Y-M-d').'.pdf';
        return $pdf->download($fileName);
    }
}
