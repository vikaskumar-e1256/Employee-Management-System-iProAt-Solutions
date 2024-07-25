<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class EmployeesImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;

    public function prepareForValidation($data, $index)
    {
        $data['date_of_birth'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($data['date_of_birth'])->format('Y-m-d');

        return $data;
    }

    public function rules(): array
    {
        return [
            '*.name' => 'required|string|max:255',
            '*.contact_number' => ['required', 'unique:employees,contact_number', 'regex:/^(\+\d{1,3}[- ]?)?\d{10}$/'],
            '*.email' => 'required|email|unique:employees,email|max:255',
            '*.date_of_birth' => 'required|date',
            '*.address' => 'nullable|string|max:255',
            '*.employee_register_number' => 'required|string',
        ];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $employee = Employee::updateOrCreate(
            ['employee_register_number' => $row['employee_register_number']], // Search by register number
            [
                'name' => $row['name'],
                'contact_number' => $row['contact_number'],
                'email' => $row['email'],
                'date_of_birth' => $row['date_of_birth'],
                'address' => $row['address'],
            ]
        );

        return $employee;
    }
}
